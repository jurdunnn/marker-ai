@props(['outerClasses' => ''])

<div class="mx-auto max-w-7xl sm:px-6 lg:px-8 {{ $outerClasses }}">
    <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            {{ $slot }}
        </div>
    </div>
</div>
