<x-card>
    <x-h.2>Log Daily Score</x-h.2>

    @if ($status)
        <x-alert.success> {{ $status }}</x-alert.success>
    @endif

    <x-form wire:submit.prevent="save">
        <x-input.textarea name="data" label="Paste here your game result" />
        <x-input.text name="word" label="Word Of the Day" />
        <x-input.text name="word_confirmation" label="Confirm Word Of The Day" />
        <x-button>Submit</x-button>
    </x-form>

</x-card>
