<x-slot name="header">
    {{ __('Student List') }}
</x-slot>

<x-slot name="headerButtons">
    <button onclick="location.href='{{ route('student.create') }}'"  class="header-button">
        {{ __('Add Student') }}
    </button>
</x-slot>

<x-container>
    @if ($students)
        <table class="w-full">
            <thead>
                <tr class="text-left">
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('Email') }}</th>
                    <th>{{ __('Date of Birth') }}</th>
                </tr>
            </thead>
            @foreach ($students as $student)
                <tr class="text-gray-500 bg-white border-b cursor-pointer hover:scale-[101%] hover:font-semibold ease-in-out duration-75" onclick="window.location='{{ route('student.show', ['student' => $student->id]) }}'">
                    <td class="py-4 text-sm whitespace-nowrap">{{ $student->name }}</td>
                    <td class="py-4 text-sm whitespace-nowrap">{{ $student->email }}</td>
                    <td class="py-4 text-sm whitespace-nowrap">{{ $student->date_of_birth->format('F d, Y') }}</td>
                </tr>
            @endforeach
        </table>
    @endif
</x-container>
