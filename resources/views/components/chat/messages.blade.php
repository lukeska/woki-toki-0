<div x-ref="scroller" class="divide-y h-full overflow-y-scroll"
     x-init="() => { $refs.scroller.scroll(0, $refs.scroller.scrollHeight); }">
    @foreach($messages as $message)
        <div class="flex space-x-4 px-4 py-2 sm:[overflow-anchor:none]">
            <div
                class="flex-shrink-0 w-8 h-8 flex items-center justify-center rounded-full">
                <img class="h-8 w-8 rounded-full object-cover"
                     src="{{ $message->user->profile_photo_url }}" alt="{{ $message->user->name }}"/>
            </div>
            <div>
                <div class="flex space-x-4 items-center">
                    <div class="font-semibold">{{ $message->user->name }}</div>
                    <div class="text-sm">{{ $message->created_at }}</div>
                </div>
                <div>{{ $message->content }}</div>
            </div>
        </div>
    @endforeach
    <div class="h-px sm:[overflow-anchor:auto]"></div>
</div>
