<x-slot name="header">
    {{ __('Student List') }}
</x-slot>

<x-slot name="headerButtons">
    <button onclick="location.href='{{ route('student.create') }}'"  class="header-button">
        {{ __('Add Student') }}
    </button>

    <button class="header-button" disabled>
        {{ __('Edit Student') }}
    </button>

    <button class="header-button" disabled>
        {{ __('Delete Student') }}
    </button>
</x-slot>

<x-container>
    @if ($students)
        <table class="table">
            <thead>
                <tr>
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('Email') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)
                    <tr>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->email }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</x-container>
