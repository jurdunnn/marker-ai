@props(['headings' => null, 'padded' => true])

<x-container :padded="$padded">
    <table class="w-full">
        <thead class="bg-gray-100 border-b border-gray-200">
            <tr class="text-left">
                @foreach ($headings as $heading)
                    <th class="py-3 pl-4">{{ __($heading) }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            {{ $slot }}
        </tbody>
    </table>
</x-container>
