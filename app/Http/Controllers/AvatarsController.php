<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use mysql_xdevapi\Exception;

class AvatarsController extends Controller
{
    
    /**
     * Store a new avatar into DB.
     *
     * @param $locale
     * @param $userId
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function store($locale, $userId)
    {
        if ((int) auth()->id() != (int) $userId) {
            abort(403);
        }

        request()->validate([
            'avatar' => ['required', 'image']
        ]);

        $file_path = request()->file('avatar')->store('avatars', 'public');

        auth()->user()->update([
            'avatar' => $file_path
        ]);

        return response(['path' => $file_path], 200);
    }
}
