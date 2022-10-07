<x-card>
    <x-h.2>Invite someone</x-h.2>
    <x-form wire:submit.prevent="save">
        <x-input.text name="email" label="Email"/>

        <x-button>Save</x-button>
    </x-form>
</x-card>
