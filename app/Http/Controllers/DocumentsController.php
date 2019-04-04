<?php

namespace App\Http\Controllers;

use Facades\App\DocumentDelivery;
use App\DocumentDraft;
use App\DocumentWordCount;
use App\Rules\MaxWord;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile as UploadedFileAlias;
use Illuminate\Support\Facades\Cookie;

class DocumentsController extends Controller
{
    public function store()
    {
        try {
            request()->validate([
                'articles' => ['required', new MaxWord, 'max:4'],
                'articles.*' => ['required', 'file', 'mimes:docx', 'distinct']
            ]);
        } catch (\Exception $e) {
            return response('بارگذاری فایل انجام نشد!', 400);
        }

        $temp_user_id = uniqid();

        if ( !Cookie::has('temporary_user') ) {
           $cookie =  cookie()->forever('temporary_user', $temp_user_id);
        }


        DocumentDraft::where('temporary_user', Cookie::get('temporary_user'))
            ->update(['recent' => false]);


        $words = 0;

        foreach (request()->file('articles') as $file)  {
            $words += $this->createDraftFrom($file, $temp_user_id);
        }

        $delivery = DocumentDelivery::addDoc(
            $words, Carbon::now()->addWeeks(1),
            count( request()->file('articles') )
        );


        return response([
            'words' => $words,
            'date_available' => $delivery['deliver_date']->toDateString(),
        ], 200)->withCookie($cookie);
    }


    /**
     * @param UploadedFileAlias $file
     * @return int
     */
    protected function createDraftFrom(UploadedFileAlias $file, $temp_user_id)
    {
        $file->store('documents');

        $words = new DocumentWordCount();

        DocumentDraft::create([
            'path' => 'documents/' . $file->hashName(),
            'words' => $words->countWords($file),
            'recent' => true,
            'temporary_user' => Cookie::get('temporary_user') ?: $temp_user_id
        ]);

        return $words->countWords($file);
    }
}
