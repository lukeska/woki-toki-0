@props(['selected' => false])

<button
    type="button"
    {{ $attributes }}
    class="relative flex cursor-pointer rounded-lg border bg-white p-4 shadow-sm focus:outline-none">
    <span class="text-left flex-1 block text-sm font-medium text-gray-900">
        {{ $slot }}
    </span>

    @if($selected)
        <svg class="h-5 w-5 text-indigo-600" viewBox="0 0 20 20" fill="currentColor"
             aria-hidden="true">
            <path fill-rule="evenodd"
                  d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                  clip-rule="evenodd"/>
        </svg>
    @endif

    <span
        class="{{ $selected ? 'border-indigo-600' : '' }} pointer-events-none absolute -inset-px rounded-lg border-2"
        aria-hidden="true"></span>
</button>
