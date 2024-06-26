<x-slot name="header">
    {{ __('Student List') }}
</x-slot>

<x-slot name="headerButtons">
    <button onclick="location.href='{{ route('student.create') }}'"  class="header-button">
        {{ __('Add Student') }}
    </button>
</x-slot>

<x-container :padded="false">
    <x-table.index :headings="['Name', 'Email', 'Date of Birth']" :padded="false">
                @foreach ($students as $student)
            <x-table.tr onclick="window.location='{{ route('student.show', ['student' => $student->id]) }}'">
                <x-table.td><p class="font-bold text-primary">{{ $student->name }}</p></x-table.td>
                <x-table.td>{{ $student->email }}</x-table.td>
                <x-table.td>{{ $student->date_of_birth->format('F d, Y') }}</x-table.td>
            </x-table.tr>
        @endforeach
    </x-table.index>
</x-container>
