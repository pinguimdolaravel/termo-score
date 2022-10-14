<x-app-layout>
    <x-header>
        Dashboard
    </x-header>

    <x-container>
        <div class="space-y-10">
            <livewire:groups.accept-invitation/>
            <livewire:daily-chart/>
            <livewire:daily-scores/>
        </div>

        <livewire:log-daily-score/>
    </x-container>
</x-app-layout>
