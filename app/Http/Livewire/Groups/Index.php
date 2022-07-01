<?php

namespace App\Http\Livewire\Groups;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Index extends Component
{
    public string $nome = 'Eduardo';

    protected $listeners = [
        'group::refresh-list' => '$refresh',
    ];

    public function render(): Factory|View|Application
    {
        return view('livewire.groups.index');
    }

    public function getGroupsProperty()
    {
        return auth()->user()->groups;
    }
}
