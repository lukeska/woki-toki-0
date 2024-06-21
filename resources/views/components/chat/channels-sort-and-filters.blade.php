<div class="flex justify-between">
    <div class="flex space-x-2">
        <x-dropdown align="left">
            <x-slot name="trigger">
                <button type="button"
                        class="inline-flex items-center px-3 py-2 border text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                    {{ $channelMembershipStatus->label() }}

                    <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"/>
                    </svg>
                </button>
            </x-slot>

            <x-slot name="content">
                <div class="py-1">
                    @foreach(\App\Enums\ChannelsMembershipStatus::cases() as $membershipStatus)
                        <button
                            wire:click="setChannelMembershipStatus('{{ $membershipStatus->value }}')"
                            class="w-full text-left px-4 py-2 text-sm hover:bg-gray-100">
                            {{ $membershipStatus->label() }}
                        </button>
                    @endforeach
                </div>
            </x-slot>
        </x-dropdown>

        <x-dropdown align="left">
            <x-slot name="trigger">
                <button type="button"
                        class="inline-flex items-center px-3 py-2 border text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                    {{ $channelType->label() }}

                    <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"/>
                    </svg>
                </button>
            </x-slot>

            <x-slot name="content">
                <div class="py-1">
                    @foreach(\App\Enums\ChannelType::cases() as $channelType)
                        <button
                            wire:click="setChannelType('{{ $channelType->value }}')"
                            class="w-full text-left px-4 py-2 text-sm hover:bg-gray-100">
                            {{ $channelType->label() }}
                        </button>
                    @endforeach
                </div>
            </x-slot>
        </x-dropdown>
    </div>

    <div>
        <x-dropdown align="right">
            <x-slot name="trigger">
                <button type="button"
                        class="inline-flex items-center px-3 py-2 border text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                    {{ $channelSort->label() }}

                    <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"/>
                    </svg>
                </button>
            </x-slot>

            <x-slot name="content">
                <div class="py-1">
                    @foreach(\App\Enums\ChannelSort::cases() as $channelSort)
                        <button
                            wire:click="setChannelSort('{{ $channelSort->value }}')"
                            class="w-full text-left px-4 py-2 text-sm hover:bg-gray-100">
                            {{ $channelSort->label() }}
                        </button>
                    @endforeach
                </div>
            </x-slot>
        </x-dropdown>
    </div>
</div>
