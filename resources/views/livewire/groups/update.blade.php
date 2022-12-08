<x-card>
    <x-h.2 class=" flex justify-between items-center">
        @unless($editing)
            <span wire:click="$set('editing', 1)" class="cursor-pointer group flex items-center">
                {{ $group->name }}
                <span class="hidden group-hover:block ml-2">✍️</span>
            </span>
        @else
            <form wire:submit.prevent="save" class="flex space-x-2 items-start">
                <x-input.text name="group.name"/>
                <x-button>✔</x-button>
            </form>
        @endunless
        <livewire:groups.destroy :group="$group" wire:key="{{ $group->id }}-destroy"/>
    </x-h.2>

    <livewire:groups.invite :group="$group" wire:key="{{ $group->id }}-invite"/>

    <div>
        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
            <table class="min-w-full divide-y divide-gray-300 w-full">
                <tbody class="divide-y divide-gray-200 bg-white">
                @foreach($this->scores as $item)
                    <tr>
                        <x-table.td>{{ $item->game_month }}</x-table.td>
                        <x-table.td>{{ $item->rank }}/{{ $item->group_size }}</x-table.td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>
</x-card>
