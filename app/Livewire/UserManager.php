<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserManager extends Component
{
    public $users;

    public function mount()
    {
        $this->users = User::latest()->take(1000)->get(); // Efficient initial load
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'users.*.nickname' => 'required|string|max:255',
            'users.*.first_name' => 'required|string|max:255',
            'users.*.last_name' => 'required|string|max:255',
            'users.*.mobile' => 'required|float|max:11',
            'users.*.email' => 'required|email|max:255',
        ]);
    }
    public function render()
    {
        return view('livewire.user-manager', [
            'users' => User::paginate(50), // Or 100 for better balance
        ]);
    }
}
