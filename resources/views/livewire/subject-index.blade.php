<x-slot name="header">
    {{ __('Subject List') }}
</x-slot>

<x-slot name="headerButtons">
    <button onclick="location.href='{{ route('subject.create') }}'"  class="header-button">
        {{ __('Add Subject') }}
    </button>
</x-slot>

<x-container :padded="false">
    <x-table.index :headings="['Subject', 'Description']">
        @foreach ($subjects as $subject)
            <x-table.tr onclick="window.location='{{ route('subject.show', ['subject' => $subject->id]) }}'">
                <x-table.td><p class="font-bold text-primary">{{ $subject->name }}</p></x-table.td>
                <x-table.td>{{ $subject->description }}</x-table.td>
            </x-table.tr>
        @endforeach
    </x-table.index>
</x-container>
