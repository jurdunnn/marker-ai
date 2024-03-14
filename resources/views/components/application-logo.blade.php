@props(['attributes' => [], 'size' => 150])

<div class="hover:scale-[{{ $size + 3 }}%] scale-[{{ $size }}%] flex -gap-x-1 hover:font-bold" {{ $attributes }}>
    <span class="text-4xl font-bold text-blue-600">
        M
    </span>
    <span class="mt-1 text-gray-700 leading-10">
        arker.ai
    </span>
</div>
