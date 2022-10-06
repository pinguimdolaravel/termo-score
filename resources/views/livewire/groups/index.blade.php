<div>
    <x-header>{{ __('My Groups') }}</x-header>

    <x-container>
        @foreach($this->groups as $group)
            <div>
                <livewire:groups.update
                    wire:key="{{ now()->timestamp }}-group"
                    :group="$group"
                />
            </div>
        @endforeach

        @unless($create)
            <x-card class="text-[100px] text-center opacity-25 hover:opacity-100
            cursor-pointer" wire:click="$set('create', 1)">
                +
            </x-card>
        @else
            <livewire:groups.create/>
        @endunless
    </x-container>
</div>
