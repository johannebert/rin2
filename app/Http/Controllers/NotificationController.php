<?php

namespace App\Http\Controllers;

use App\Notifications\OneTimeNotification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /*
     * notifications list page
     */
    public function index()
    {
        return view('notification.index');
    }

    /*
     * mark notification as read
     */
    public function markNotification($id)
    {
        auth()->user()->unreadNotifications->where('id', $id)->markAsRead();

        return redirect()->back();
    }
}
