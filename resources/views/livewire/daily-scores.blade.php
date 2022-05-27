<div class="w-full">
    <div>
        Total Points: {{ $this->total }}
    </div>

    <div>
        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
            <table class="min-w-full divide-y divide-gray-300 w-full">
                <thead class="bg-gray-50">
                <tr>
                    <x-table.th>Game | Word</x-table.th>
                    <x-table.th>Score</x-table.th>
                    <x-table.th>Points</x-table.th>
                    <x-table.th>Status</x-table.th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                @foreach($this->scores as $item)
                    <tr>
                        <x-table.td>{{ $item->game_id }} | {{ $item->word }}</x-table.td>
                        <x-table.td>{{ $item->score }}</x-table.td>
                        <x-table.td>{{ $item->points }}</x-table.td>
                        <x-table.td>{{ $item->status }}</x-table.td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>
