@props(['outerClasses' => '', 'image' => ''])

<div class="mx-auto flex pb-4 flex-col sm:flex-row gap-4 max-w-7xl sm:px-6 lg:px-8 {{ $outerClasses }}">
    <img src="{{ $image }}" class="object-cover w-full sm:w-1/2 mb-4 sm:mb-0 sm:rounded-lg" style="height: 100%;">

    <div class="w-full overflow-hidden bg-white sm:w-1/2 shadow-sm sm:rounded-lg" style="height: 100%;">
        <div class="p-6 text-gray-900">
            {{ $slot }}
        </div>
    </div>
</div>
