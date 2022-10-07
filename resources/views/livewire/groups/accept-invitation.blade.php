<x-card>
    <x-h.2>group Invitations</x-h.2>

    <div>
        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
            <table class="min-w-full divide-y divide-gray-300 w-full">
                <tbody class="divide-y divide-gray-200 bg-white">
                @foreach($this->invitations as $item)
                    <tr>
                        <x-table.td>{{ $item->group->name }}</x-table.td>
                        <x-table.td class="text-right">
                            <x-button wire:click="accept({{ $item->id }})">
                                Accept
                            </x-button>

                            <x-button wire:click="reject({{ $item->id }})">
                                Reject
                            </x-button>
                        </x-table.td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>
</x-card>
