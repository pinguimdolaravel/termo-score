<div>
    @foreach($notifications as $notification)
        <div class="bg-blue-50 text-blue-700 font-bold tracking-wider text-lg p-4">
            {{ $notification->data['message'] }}
        </div>
    @endforeach
</div>
