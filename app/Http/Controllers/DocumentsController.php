<?php

namespace App\Http\Controllers;

use App\Delivery;
use App\DocumentDraft;
use App\DocumentWordCount;
use App\Rules\MaxWord;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile as UploadedFileAlias;

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

        $words = 0;

        foreach (request()->file('articles') as $file)  {
            $words += $this->createDraftFrom($file);
        }

        Delivery::addDoc($words, Carbon::now()->addWeeks(1), count(request()->file('articles')));

        return response(['words' => $words], 200);
    }


    /**
     * @param UploadedFileAlias $file
     * @return int
     */
    protected function createDraftFrom(UploadedFileAlias $file)
    {
        $file->store('documents');

        $words = new DocumentWordCount();

        DocumentDraft::create([
            'path' => 'documents/' . $file->hashName(),
            'words' => $words->countWords($file)
        ]);

        return $words->countWords($file);
    }
}
