<?php

namespace App\Http\Controllers;

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

    /*
     * delete specific notification
     */
    public function destroy($id)
    {
        auth()->user()->notifications()->where('id', $id)->delete();

        session()->flash('message', 'Notification deleted successfully');

        return redirect()->back();
    }
}
