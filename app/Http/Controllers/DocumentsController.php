<?php

namespace App\Http\Controllers;

use App\Delivery;
use App\Setting;
use App\User;
use App\DocumentWordCount;
use App\Rules\MaxWord;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile as UploadedFileAlias;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class DocumentsController extends Controller
{
    
    protected $documents = [];
    
    /**
     * Store Document into a Draft table, Count The Words and calculate The
     * Price.
     *
     * @param  User  $user
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|void
     */
    public function store(User $user)
    {
        if (auth()->user()->isNot($user)) {
            return abort(403);
        }
        
        try {
            request()->validate(
                [
                    'articles' => ['required', new MaxWord, 'max:4'],
                    'articles.*' => 'required|file|mimes:docx|distinct'
                ]);
        } catch (ValidationException $e) {
            return response('بارگذاری فایل انجام نشد!', 400);
        }
        
        $words = DocumentWordCount::files(request()->articles)->countWords();
        
        $date = $this->estimateDeliveryDate($words);
        
        foreach (request()->articles as $file) {
            $path = $file->store(auth()->user()->username, 'documents');
            
            $document = auth()->user()->documents()->create(
                [
                    'name' => $file->getClientOriginalName(),
                    'path' => $path,
                    'words' => DocumentWordCount::file($file)->countWords(),
                    'delivery_date' => $date,
                    'price' => $this->calculateThePrice(DocumentWordCount::file($file)->countWords())
                ]);
        }
        
        return response(
            [
                'words' => DocumentWordCount::files(request()->articles)->countWords(),
                //                'date_available' => $delivery['deliver_date']->toDateString(),
                'date_available' => $date,
                //                'price' => ,
                'documents' => $this->documents
            ], 200);
    }
    
    /**
     * Delete documents from DB and also remove from documents folder.
     *
     * @param  User  $user
     *
     * @return \Illuminate\Http\JsonResponse|void
     */
    public function destroy(User $user)
    {
        if (auth()->user()->isNot($user)) {
            return abort(403);
        }
        
        $documents = $user->documents()->where('recent', true)->get();
        
        foreach ($documents as $document) {
            Storage::disk('documents')->delete($document->path);
        }
        
        $documents->each->delete();
        
        return response()->json(
            [
                'status' => 200
            ]);
    }
    
    /**
     * Save Documents in storage and count words for each document
     *
     * @param  UploadedFileAlias  $file
     *
     * @return int
     */
    protected function createDraftFrom(UploadedFileAlias $file)
    {
        $path = $file->store(auth()->user()->username, 'documents');
        
        $wordCount = (new DocumentWordCount())->countWords($file);
        
        $this->documents[] = auth()->user()->documents()->create(
            [
                'path' => $path,
                'words' => $wordCount,
                'name' => $file->getClientOriginalName(),
            ]);
        
        $key = array_key_last($this->documents);
        $this->documents[$key]['name'] = $file->getClientOriginalName();
        
        return $wordCount;
    }
    
    /**
     * Calculate price of uploaded documents
     *
     * @param  int  $words
     *
     * @return float|int
     */
    protected function calculateThePrice(int $words)
    {
        $setting = Setting::find(1);
        
        $price = $words * $setting->price_per_word;
        
        return ($price > $setting->base_price_for_docs)
            ?
            $price
            :
            $setting->base_price_for_docs;
    }
    
    /**
     * Estimate Delivery Date.
     *
     * @return Carbon|null
     */
    protected function estimateDeliveryDate($words)
    {
        $deliveries = Delivery::whereDate('date', '>=', Carbon::now()->addWeek())
                              ->where('total_words', '<=', Setting::first()->upload_words_per_day)
                              ->where('leftover', '>', 0)
                              ->get();
        
        if (!$deliveries->count()) {
            $date = Carbon::now()->addWeek();
            
            return $date;
        }
        
        foreach ($deliveries as $delivery) {
            if ($delivery->isNotReserved($words, request()->articles)) {
                return $delivery->date;
            }
        }
        
        return $date = $deliveries[-1]->date->addDay();
    }
}
