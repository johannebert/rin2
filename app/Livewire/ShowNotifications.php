<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class ShowNotifications extends Component
{
    use WithPagination;

    #[Url(as: 'q')]
    public $query = '';

    public function updatingQuery()
    {
        $this->resetPage();
    }

    public function render()
    {
        $notifications = auth()->user()->notifications()
            ->when($this->query, function ($query) {
                $query->where(DB::raw('lower(data)'), 'like', '%' . strtolower($this->query) . '%')
                    ->orWhere(DB::raw('lower(type)'), 'like', '%' . strtolower($this->query) . '%');
            })->simplePaginate(10);


        return view('livewire.show-notifications', [
            'notifications' => $notifications
        ]);
    }
}
