<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserManager extends Component
{
    use WithPagination;

    public $isEdit = false;
    public $user_id, $nickname, $first_name, $last_name, $mobile, $email, $password;
    protected $rules = [
        'nickname' => 'required|string|max:255',
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'mobile' => 'required|string|max:11',
        'email' => 'required|email|max:255',
    ];

    public function render()
    {
        $users = User::orderBy('id', 'desc')->paginate(50);

        return view('livewire.user-manager', [
            'users' => $users,
        ]);
    }

    public function create()
    {
        $this->validate();

        User::create([
            'nickname' => $this->nickname,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'mobile' => $this->mobile,
            'email' => $this->email,
            'password' => bcrypt($this->password),
        ]);

        $this->resetForm();
        session()->flash('message', 'User created successfully.');
        return route('user-manager');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->user_id = $user->id;
        $this->nickname = $user->nickname;
        $this->first_name = $user->first_name;
        $this->last_name = $user->last_name;
        $this->mobile = $user->mobile;
        $this->email = $user->email;
        $this->isEdit = true;
    }

    public function update()
    {
        $user = User::findOrFail($this->user_id);

        $this->validate([
            'nickname' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'string|max:255|unique:users,email,' . $this->user_id,
            'mobile' => 'required|string|max:20|unique:users,mobile,' . $this->user_id,
        ]);

        $user->update([
            'nickname' => $this->nickname,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'mobile' => $this->mobile,
            'email' => $this->email,
        ]);

        $this->resetForm();
        session()->flash('message', 'User updated successfully.');
        return route('user-manager');
    }

    public function delete($id)
    {
        User::findOrFail($id)->delete();
        session()->flash('message', 'User deleted successfully.');
        return route('user-manager');
    }

    public function resetForm()
    {
        $this->reset(['user_id', 'nickname', 'first_name', 'last_name', 'mobile', 'email', 'password', 'isEdit']);
    }
}
