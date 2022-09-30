<div>
    @if($confirming)
        <x-modal>
            <div>
                Are you sure jetete????
                <x-slot name="actions">
                    <x-button class="w-full sm:w-auto" wire:click="destroy">
                        YES 👍
                    </x-button>
                    <x-button class="w-full sm:w-auto mt-2 sm:mt-0 sm:mr-4" wire:click="$set('confirming', 0)">
                        NO 😑
                    </x-button>
                </x-slot>
            </div>
        </x-modal>
    @endif
    <button wire:click="$set('confirming', 1)" class="cursor-pointer opacity-25 hover:opacity-100">
        🗑
    </button>
</div>
