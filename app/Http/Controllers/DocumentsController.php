<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Cache;

class DocumentsController extends Controller
{
    public function store(User $user)
    {
        request()->validate([
            'articles' => ['required'],
            'articles.*' => ['required', 'file', 'mimes:docx,doc', 'distinct']
        ]);

        $uploadedFilePathes = [];

        foreach (request()->file('articles') as $file)  {
            $uploadedFilePathes[] = $file->store('documents/');
        }

        Cache::remember('upload_file_paths', 600, function() use ($uploadedFilePathes) {
            return $uploadedFilePathes;
        });
    }
}
