@props(['title', 'headings'])

<div class="mt-8">
    <h2 class="pb-4 mx-auto text-xl text-primary font-semibold max-w-7xl sm:px-6 lg:px-8">{{ __($title) }}</h2>

    <x-container :padded="false">
        <x-table.index :headings="$headings">
            {{ $slot }}
        </x-table.index>
    </x-container>
</div>
