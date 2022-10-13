<x-card>
    <x-h.2>{{ $group->name }} </x-h.2>
    <div class="p-4 flex items-end space-x-2 justify-center">
        <div class="text-5xl font-bold">
            2
        </div>
        <div class="text-3xl -mb-1 text-gray-400">/</div>
        <div class="text-2xl -mb-2">{{ $group->users()->count() }}</div>
    </div>
</x-card>
