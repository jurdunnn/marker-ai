@props(['active', 'icon' => null])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 font-semibold text-blue-600 transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 font-medium text-gray-500 hover:text-gray-700 focus:outline-none focus:text-gray-700 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    <span class="w-8 mr-3 text-center group-hover:block">
        <i class="fa-solid fa-{{ $icon }} fa-xl"></i>
    </span>

    <div class="block md:hidden lg:block">
        {{ $slot }}
    </div>
</a>
