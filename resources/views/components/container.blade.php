@props(['outerClasses' => '', 'padded' => true])

<div class="mx-auto max-w-7xl sm:px-6 lg:px-8 {{ $outerClasses }}">
    <div class="overflow-hidden bg-white shadow-sm sm:rounded-md">
        <div class="text-gray-900 @if ($padded) p-6 @else p-0 @endif">
            {{ $slot }}
        </div>
    </div>
</div>
