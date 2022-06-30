<?php

namespace Tests\Feature\Livewire\Groups;

use App\Http\Livewire\Groups\Index;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class IndexTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(Index::class);

        $component->assertStatus(200);
    }
}
