<div>
    <x-header>{{ __('My Groups') }}</x-header>

    <x-container>
        @if($this->hasInvitations)
            <livewire:groups.accept-invitation/>
        @endif

        @foreach($this->groups as $group)
            <div>
                @can('update', $group)
                    <livewire:groups.update
                        wire:key="{{ now()->timestamp }}-group"
                        :group="$group"
                    />
                @else
                    <livewire:groups.show
                        wire:key="{{ now()->timestamp }}-group"
                        :group="$group"
                    />
                @endcan
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
