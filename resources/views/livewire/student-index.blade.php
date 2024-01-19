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
    hello
</x-container>
