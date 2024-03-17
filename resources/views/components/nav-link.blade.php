@props(['active', 'icon' => null])

@php
$classes = 'shadow cursor-pointer rounded-md inline-flex items-center px-4 h-12 relative justify-center py-4';
$classes .= ($active ?? false)
            ? 'font-semibold text-white bg-primary hover:bg-primary-dark transition duration-150 ease-in-out'
            : 'font-medium bg-gray-100 hover:bg-gray-200 text-gray-600 hover:text-gray-700 focus:outline-none focus:text-gray-700 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    <span class="absolute w-8 mr-3 text-center {{ $active ? 'text-' : 'text-primary' }} group-hover:block left-2">
        <i class="fa-solid fa-{{ $icon }} fa-xl"></i>
    </span>

    <div class="block {{ $active ? 'text-white' : 'text-primary' }} md:hidden lg:block">
        {{ $slot }}
    </div>
</a>
