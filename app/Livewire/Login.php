<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class Login extends Component
{

    #[Validate('required|email|string|max:191|exists:users,email')]
    public $email;
    #[Validate('required|string|max:191')]
    public $password;
    public function login()
    {
        $credentials = $this->validate();

        if (Auth::attempt($credentials)) {
            return $this->redirectRoute('home');
        }

    }
    public function render()
    {
        return view('livewire.login');
    }
}
