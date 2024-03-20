@props(['headings' => null])

<table class="w-full">
    <thead class="border-b border-slate-200 bg-slate-100 text-primary">
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
