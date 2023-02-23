<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class NotificationController extends Controller
{
    //
    public function markAsRead($notificationId)
    {
        $notification = Auth::user()->notifications()->where('id', $notificationId)->first();

        if ($notification) {
            $notification->markAsRead();
        }

        return redirect()->back();
    }
    public function deleteNotification($notificationId)
    {
        $notification = Auth::user()->notifications()->where('id', $notificationId)->first();

        if ($notification) {
            $notification->markAsRead();
        }

        return redirect()->back();
    }
}
