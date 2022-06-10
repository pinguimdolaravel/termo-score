<?php

namespace App\Http\Livewire;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Notifications extends Component
{
    public function render(): Factory|View|Application
    {
        $notifications = auth()->user()->unreadNotifications()->get();
        $notifications->each->markAsRead();

        return view('livewire.notifications', compact('notifications'));
    }
}
