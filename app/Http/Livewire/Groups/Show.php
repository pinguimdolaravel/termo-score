<?php

namespace App\Http\Livewire\Groups;

use App\Models\Group;
use Livewire\Component;

class Show extends Component
{
    public Group $group;

    public function render()
    {
        return view('livewire.groups.show');
    }
}
