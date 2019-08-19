<?php

namespace App\Http\Controllers;

use App\DocumentDraft;
use App\Service;
use App\User;
use Illuminate\Http\Request;

class DocumentServiceController extends Controller
{
    public function update(User $user, $token)
    {
        if (auth()->user()->isNot($user)) {
            abort(403);
        }

        $drafts = DocumentDraft::where('token', $token)->get();

        request()->validate([
            'service' => 'numeric|exists:services,id'
        ]);

        try {
            $drafts->each(function ($draft) {
                $draft->service_id = \request('service');
                $draft->save();
            });
        } catch (\Exception $e) {
           throw new \Exception('Update failed');
        }

        return response()->json([
            'status' => 200
        ]);
    }
}
