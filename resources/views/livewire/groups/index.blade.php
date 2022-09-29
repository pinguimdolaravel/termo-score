<div>
    <x-header>{{ __('My Groups') }}</x-header>

    <x-container>
        @foreach($this->groups as $group)
            <x-card>
                <x-h.2 class=" flex justify-between items-center">
                    <span>
                        {{ $group->name }}
                    </span>
                    <span
                        class="text-xs tracking-wider text-gray-800 bg-gray-50 px-2 rounded-lg">
                        total points :: 20
                    </span>
                </x-h.2>
                <div class="p-4 flex items-end space-x-2 justify-center">
                    <div class="text-5xl font-bold">2</div>
                    <div class="text-3xl -mb-1 text-gray-400">/</div>
                    <div class="text-2xl -mb-2">20</div>
                </div>
            </x-card>
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
