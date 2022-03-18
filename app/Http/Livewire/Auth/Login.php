<?php

namespace App\Http\Livewire\Auth;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public ?string $email = null;

    public ?string $password = null;

    public function render(): Factory|View|Application
    {
        return view('livewire.auth.login');
    }

    public function login()
    {
        if (Auth::attempt([
            'email' => $this->email,
            'password' => $this->password,
        ])) {
            $this->redirect('/');
        }
    }
}
