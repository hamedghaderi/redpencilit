<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;

class UserNotificationsController extends Controller
{
    
    /**
     * Get all unread notifications for authenticated user.
     *
     * @param $locale
     * @param  User  $user
     *
     * @return mixed
     */
    public function index($locale, User $user)
    {
        return auth()->user()->unreadNotifications;
    }
    
    public function destroy($locale, User $user, DatabaseNotification $notification)
    {
        $notification = auth()->user()
                              ->unreadNotifications()
                              ->findOrFail($notification->id);
        
        $notification->markAsRead();
        
        return response()->json(['success' => true]);
    }
    
    /**
     * Destroy all user's notifications.
     *
     * @param $locale
     * @param  User  $user
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function destroyAll($locale, User $user)
    {
        if ( ! auth()->user()->is($user)) {
            abort(403);
        }
        
        $user->notifications()->delete();
        
        if (request()->expectsJson()) {
            return response()->json([
                'success' => true
            ]);
        }
        
        return back();
    }
}
