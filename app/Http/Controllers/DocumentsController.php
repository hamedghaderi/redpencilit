<?php

namespace App\Http\Controllers;

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

        $uploadedFilePathes = [];

        foreach (request()->file('articles') as $file)  {
            $uploadedFilePathes[] = $file->store('documents');
        }

        return response('Your documents uploaded', 200);
    }
}
