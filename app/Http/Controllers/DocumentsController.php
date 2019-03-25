<?php

namespace App\Http\Controllers;

use App\Rules\CountingWords;

class DocumentsController extends Controller
{
    public function store()
    {
        try {
            request()->validate([
                'articles' => ['required', new CountingWords],
                'articles.*' => ['required', 'file', 'mimes:docx,doc', 'distinct']
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
