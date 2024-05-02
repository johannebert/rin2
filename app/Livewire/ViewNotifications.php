<?php

namespace App\Livewire;

use Livewire\Component;

class ViewNotifications extends Component
{
    public function render()
    {
        // unread notifications with expired date
        $unreadNotifications = auth()->user()->unreadNotifications->filter(function ($notification) {
            return $notification->data['expiry_date'] >= now();
        });

        return view('livewire.view-notifications', [
            'unreadNotifications' => $unreadNotifications
        ]);
    }
}
