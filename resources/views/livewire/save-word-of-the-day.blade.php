<div>
    <x-header> Save Word Of The Day</x-header>

    <main>

        <x-container>
            <x-card>
                @if ($status)
                    <x-alert.success> {{ $status }}</x-alert.success>
                @endif

                <x-form wire:submit.prevent="save">
                    <x-input.text name="word" label="Word Of the Day"/>
                    <x-input.text name="word_confirmation" label="Confirm Word Of The Day"/>
                    <x-input.text name="game_id" label="Game Id"/>

                    <x-button>Submit</x-button>
                </x-form>
            </x-card>
        </x-container>
    </main>
</div>

