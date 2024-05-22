<div>
    <div class="border-b px-6">
        <div class="py-1 inline-block border-b-2 border-black -mb-px">
            <span class="font-semibold">Members</span> <span>{{ $membersCount }}</span>
        </div>
    </div>

    <x-chat.manage-members
        wire:model.live="form.searchMembers"
        :members="$members"
        :notMembers="$notMembers"
    />
</div>
