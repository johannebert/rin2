<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\OneTimeNotification;
use Illuminate\Support\Facades\Notification;

class NotificationController extends Controller
{
    /*
     * notifications list page
     */
    public function index()
    {
        return view('notifications.index');
    }
    /*
     * show notification create form
     */
    public function create(User $user = null)
    {
        return view('notifications.create', [
            'user' => $user
        ]);
    }


    /*
     * store new notification
     */
    public function store(User $user = null)
    {
        if (!$user) {
            $user = auth()->user();
        }

        request()->validate([
            'method' => 'required',
            'type' => 'required',
            'message' => 'required',
            'expiry_date' => 'nullable|date'
        ]);

        if (request('method') == 'all') {
            // if notify all users
            set_time_limit(0);
            $users = User::all()->chunk(100);

            foreach ($users->lazy() as $chunk) {
                foreach ($chunk as $user) {
                    $user->notify(new OneTimeNotification(
                        type: request('type'),
                        message: request('message'),
                        expiryDate: request('expiry_date')
                    ));
                }
            }
        } elseif (request('method') == 'specific') {
            // notify a specific user
            $user->notify(new OneTimeNotification(
                type: request('type'),
                message: request('message'),
                expiryDate: request('expiry_date')
            ));
        }

        session()->flash('message', 'Notification created successfully');

        return redirect(route('users.index'));
    }

    /*
     * mark notification as read
     */
    public function mark($id)
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
