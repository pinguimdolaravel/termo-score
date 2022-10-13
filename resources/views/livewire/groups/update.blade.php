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
    <div class="p-4 flex items-end space-x-2 justify-center">
        <div class="text-5xl font-bold">2</div>
        <div class="text-3xl -mb-1 text-gray-400">/</div>
        <div class="text-2xl -mb-2">20</div>
    </div>
</x-card>
