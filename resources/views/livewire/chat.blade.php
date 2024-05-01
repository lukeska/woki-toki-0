<div id="chat" class="absolute inset-0 m-4 overflow-hidden shadow-xl rounded-lg bg-white">
    <div class="flex divide-x h-full">
        {{-- list of channels --}}
        <div class="w-1/5 overflow-y-scroll">
            <x-chat.channels :channels="$channels" :currentChannel="$channel"/>
        </div>
        {{-- list of messages and message editor --}}
        <div class="w-4/5 flex flex-col">
            <div class="flex-1 overflow-hidden">
                <x-chat.messages :messages="$messages"/>
            </div>
            <div class="p-4 pt-0">
                <x-chat.message-editor/>
            </div>
        </div>
    </div>
</div>
