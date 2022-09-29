<x-card>
    <x-h.2>Create a new group</x-h.2>
    <x-form wire:submit.prevent="save">
        <x-input.text name="group.name" label="Group Name"/>

        <x-button>Save</x-button>
    </x-form>
</x-card>
