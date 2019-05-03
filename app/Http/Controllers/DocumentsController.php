<?php

namespace App\Http\Controllers;

use App\DocumentDraft;
use App\Setting;
use App\User;
use Facades\App\DocumentDelivery;
use App\DocumentWordCount;
use App\Rules\MaxWord;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile as UploadedFileAlias;
use Illuminate\Support\Str;

class DocumentsController extends Controller
{
    protected $token = null;

    /**
     * Store Document into a Draft table, Count The Words and calculate The Price.
     *
     * @param  User  $user
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|void
     */
    public function store(User $user)
    {
        if (auth()->user()->isNot($user)) {
            return abort(403);
        }

        try {
            request()->validate([
                'articles' => ['required', new MaxWord, 'max:4'],
                'articles.*' => ['required', 'file', 'mimes:docx', 'distinct']
            ]);
        } catch (\Exception $e) {
            return response('بارگذاری فایل انجام نشد!', 400);
        }

        $words = 0;

        $this->token = Str::random(30);

        foreach (request()->file('articles') as $file)  {
            $words += $this->createDraftFrom($file);
        }

        $delivery = DocumentDelivery::addDoc(
            $words,
            Carbon::now()->addWeeks(1),
            count( request()->file('articles') )
        );

        $price = $this->calculateThePrice($words);

        return response([
            'words' => $words,
            'date_available' => $delivery['deliver_date']->toDateString(),
            'price' => $price,
            'token' => $this->token
        ], 200);
    }

    public function destroy(User $user, $token)
    {
       if (auth()->user()->isNot($user))  {
           return abort(403);
       }

       DocumentDraft::where('token', $token)->delete();

       return response()->json([
           'status' => 200
       ]);
    }

    /**
     * Save Documents in storage and count words for each document
     *
     * @param UploadedFileAlias $file
     * @return int
     */
    protected function createDraftFrom(UploadedFileAlias $file)
    {
        $file->store('documents');

        $words = new DocumentWordCount();

        $wordCount = $words->countWords($file);

        auth()->user()->drafts()->create([
            'path' => 'documents/' . $file->hashName(),
            'words' => $wordCount,
            'token' => $this->token,
        ]);

        return  $wordCount;
    }

    /**
     * Calculate price of uploaded documents
     *
     * @param  int  $words
     * @return float|int
     */
    protected function calculateThePrice(int $words)
    {
        $setting = Setting::find(1);

        $price = $words * $setting->price_per_word;

        return ($price > $setting->base_price_for_docs) ?
            $price :
            $setting->base_price_for_docs;
    }
}
