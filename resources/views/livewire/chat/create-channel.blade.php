<div>
    @teleport('body')
    <x-dialog-modal wire:model.live="currentlyCreatingChannel" :padding="false">
        <x-slot name="title">
            <div class="px-6 pt-4 flex justify-between items-top">
                @if(! $form->channel)
                    <div class="font-semibold">
                        Create a new channel
                    </div>
                @else
                    <div>
                        <div class="font-semibold flex items-center">
                            <x-chat.channel-icon :channel="$form->channel"/>
                            <span>{{ $form->channel->name }}</span>
                        </div>
                        <div class="text-sm text-gray-400">
                            Add members
                        </div>
                    </div>
                @endif

                <div class="text-sm text-gray-400">Step {{ $this->stepNumber }} of 2</div>
            </div>
        </x-slot>

        <x-slot name="content">
            @if(! $form->channel)
                <form wire:submit="create" class="px-4 py-6">
                    <div class="mb-4">
                        <x-input wire:model.blur="name" type="text" class="mt-1 block w-full"
                                 placeholder="Channel name"/>
                        <div
                            class="min-h-8 text-red-600 text-sm pt-1 px-px">@error('name') {{ $message }} @enderror</div>
                    </div>

                    <div>
                        <textarea wire:model.blur="topic" rows="3" name="topic" id="topic"
                                  class="block border border-gray-300 w-full resize-none bg-transparent py-1.5 text-gray-900 placeholder:text-gray-400 sm:text-sm sm:leading-6 focus:border-indigo-500 focus:ring-indigo-500 rounded-md"
                                  placeholder="Topic"></textarea>
                        <div
                            class="min-h-8 text-red-600 text-sm pt-1 px-px">@error('topic') {{ $message }} @enderror</div>
                    </div>

                    <div>
                        <div class="mt-4 grid grid-cols-2 gap-y-6 gap-x-4">
                            <x-chat.check-option wire:click="setAsPublic" :selected="! $private">
                                <div class="flex items-center space-x-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M13.5 10.5V6.75a4.5 4.5 0 1 1 9 0v3.75M3.75 21.75h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H3.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z"/>
                                    </svg>
                                    <span>Public</span>
                                </div>
                            </x-chat.check-option>
                            <x-chat.check-option wire:click="setAsPrivate" :selected="$private">
                                <div class="flex items-center space-x-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z"/>
                                    </svg>

                                    <span>Private</span>
                                </div>
                            </x-chat.check-option>
                        </div>
                    </div>
                </form>
            @else
                <x-chat.manage-members
                    wire:model.live="form.searchMembers"
                    :members="$members"
                    :notMembers="$notMembers"
                />
            @endif
        </x-slot>

        <x-slot name="footer">
            <div class="space-x-2">
                @if(! $form->channel)
                    <x-secondary-button wire:click="stopCreatingChannel" wire:loading.attr="disabled">
                        Close
                    </x-secondary-button>

                    <x-button wire:click="create" wire:loading.attr="disabled">
                        Create
                    </x-button>
                @else
                    <x-button wire:click="stopCreatingChannel" wire:loading.attr="disabled">
                        Done
                    </x-button>
                @endif
            </div>
        </x-slot>
    </x-dialog-modal>
    @endteleport
</div>
