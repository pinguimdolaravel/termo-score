<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-2 gap-6">

            <ul>
                @foreach ($users as $user)
                    <li>
                        <a href="{{ route('user.show', $user) }}">
                            {{ $user->name }}
                        </a>
                    </li>
                @endforeach
            </ul>

        </div>
    </div>
</x-app-layout>
