<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class ShowUsers extends Component
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
        $users = User::query()->with('unreadNotifications')->when($this->query, function ($query) {
                $query->where(DB::raw('lower(name)'), 'like', '%' . strtolower($this->query) . '%')
                    ->orWhere(DB::raw('lower(email)'), 'like', '%' . strtolower($this->query) . '%');
            })->simplePaginate(10);

        return view('livewire.show-users', [
            'users' => $users
        ]);
    }
}
