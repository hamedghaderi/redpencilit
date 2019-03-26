<?php

namespace App\Http\Controllers;

use App\DocumentDraft;
use App\DocumentWordCount;
use App\Rules\MaxWord;

class DocumentsController extends Controller
{
    public function store()
    {
        try {
            request()->validate([
                'articles' => ['required', new MaxWord],
                'articles.*' => ['required', 'file', 'mimes:docx', 'distinct']
            ]);
        } catch (\Exception $e) {
            return response('بارگذاری فایل انجام نشد!', 400);
        }

        $words = 0;

        foreach (request()->file('articles') as $file)  {
            $words += $this->createDraftFrom($file);
        }

        return response(['words' => $words], 200);
    }


    /**
     * @param \Illuminate\Http\UploadedFile $file
     * @return int
     */
    protected function createDraftFrom(\Illuminate\Http\UploadedFile $file)
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
