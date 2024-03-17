@props(['subject' => null, 'click' => null])
<button x-on.click="{{ $click }}" class="w-[300px] text-left select-none flex cursor-pointer hover:shadow-xl flex-col gap-y-4 bg-white rounded-lg px-3 py-4">
    <div class="flex gap-x-4">
        <span class="text-primary-light">
            <i class="fa-solid fa-{{ $subject->icon ?? 'circle-dot' }} fa-xl"></i>
        </span>

        <p class="font-semibold text-gray-600">
            {{ __($subject->name) }}
        </p>
    </div>

    <p class="text-gray-400">
        {{ __($subject->description) }}
    </p>
</button>
