<?php

namespace Tests\Feature\Livewire\Groups;

use App\Http\Livewire\Groups\Update;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class UpdateTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(Update::class);

        $component->assertStatus(200);
    }
}
