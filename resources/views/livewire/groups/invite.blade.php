<div>
    <x-button wire:click="invite" class="w-full text-center rounded-none inline-grid bg-slate-700">
        Invite someone to this group
    </x-button>

    @if($show)
        <x-modal>
            <x-form wire:submit.prevent="save" id="invitation-form">
                <x-input.text name="email" label="Invite a little fella" placeholder="email@mail.com"/>
            </x-form>

            <x-slot:actions>
                <x-button type="button" wire:click="save">Invite</x-button>
                <x-button type="button" wire:click="$set('show', 0)" >hummmm, no</x-button>
            </x-slot:actions>
        </x-modal>
    @endif
</div>
