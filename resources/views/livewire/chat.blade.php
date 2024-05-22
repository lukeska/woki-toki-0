<div id="chat" class="absolute inset-0 m-4 overflow-hidden shadow-xl rounded-lg bg-white">
    <div class="flex divide-x h-full">
        {{-- list of channels --}}
        <div class="w-1/5 overflow-y-scroll">
            <x-chat.channels :channels="$channels" :currentChannel="$form->channel"/>
        </div>
        {{-- list of messages and message editor --}}
        <div class="w-4/5 flex flex-col">
            <x-chat.channel-header :channel="$form->channel"/>

            <div class="flex-1 overflow-hidden">
                <x-chat.messages :messages="$messages"/>
            </div>

            <div class="p-4 pt-0">
                <x-chat.message-editor/>
            </div>
        </div>
    </div>

    @teleport('body')
    <x-dialog-modal wire:model.live="currentlyManagingSettings" :padding="false">
        <x-slot name="title">
            <div class="px-6 pt-4 font-semibold flex items-center">
                <x-chat.channel-icon :channel="$form->channel"/>
                <span>{{ $form->channel->name }}</span>
            </div>
        </x-slot>

        <x-slot name="content">

            <x-chat.settings :membersCount="$membersCount"
                             :members="$members"
                             :notMembers="$notMembers"/>

        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="stopManagingSettings" wire:loading.attr="disabled">
                Close
            </x-secondary-button>
        </x-slot>
    </x-dialog-modal>
    @endteleport

    <livewire:chat.create-channel/>
</div>
