<div>
    <div class="divide-y">
        @foreach($messages as $message)
            <div class="flex space-x-4 px-4 py-2">
                <div
                    class="flex-shrink-0 w-10 h-10 flex items-center justify-center text-lg font-semibold rounded-full bg-gray-200">
                    {{ str($message->user->name)->upper()->limit(2, null) }}
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
    </div>
    <div class="p-4">
        <div class="flex items-start space-x-4">
            <div class="min-w-0 flex-1">
                <form wire:submit="send" class="relative">
                    <div class="overflow-hidden rounded-lg shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-indigo-600">
                        <label for="comment" class="sr-only">Send a message</label>
                        <textarea wire:model="message" rows="3" name="message" id="message" class="block w-full resize-none border-0 bg-transparent py-1.5 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="Send a message..."></textarea>

                        <div class="py-2" aria-hidden="true">
                            <div class="py-px">
                                <div class="h-9"></div>
                            </div>
                        </div>
                    </div>

                    <div class="absolute inset-x-0 bottom-0 flex justify-between py-2 pl-3 pr-2">
                        <div class="flex-shrink-0">
                            <button type="submit" class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Post</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
