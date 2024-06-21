<div>
    @if(auth()->user()->belongsToChannel($channel))
        <div class="flex items-start space-x-4">
            <div class="min-w-0 flex-1">
                <form wire:submit="send" class="relative">
                    <div
                        class="overflow-hidden rounded-lg shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-indigo-600">
                        <label for="comment" class="sr-only">Send a message</label>
                        <textarea wire:model="message" @keydown.enter="$wire.send" rows="3" name="message" id="message"
                                  class="block w-full resize-none border-0 bg-transparent py-1.5 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                  placeholder="Send a message..."></textarea>

                        <div class="py-2" aria-hidden="true">
                            <div class="py-px">
                                <div class="h-9"></div>
                            </div>
                        </div>
                    </div>

                    <div class="absolute inset-x-0 bottom-0 flex justify-between py-2 pl-3 pr-2">
                        <div class="flex-shrink-0">
                            <button type="submit"
                                    class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                Post
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @else
        <div
            class="pt-6 pb-2 mt-4 rounded-md border border-gray-300 bg-gray-100 flex flex-col items-center gap-y-3 justify-center">
            <div class="font-semibold text-lg flex items-center">
                <x-chat.channel-icon :channel="$channel"/>
                <span>{{ $channel->name }}</span>
            </div>

            <div>
                <x-button wire:click="addMember()" wire:loading.attr="disabled">
                    Join Channel
                </x-button>
            </div>

            <div>
                <a href="{{ route('browse') }}" class="underline hover:opacity-75">Back to all channels</a>
            </div>
        </div>
    @endif
</div>
