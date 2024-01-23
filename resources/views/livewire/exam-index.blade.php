<x-slot name="header">
    {{ __('Exam List') }}
</x-slot>

<x-slot name="headerButtons">
    <button onclick="location.href='{{ route('exam.create') }}'"  class="header-button">
        {{ __('Add Exam') }}
    </button>
</x-slot>

<x-table.index :headings="['Subject', 'Exam', 'Description', 'Duration']" :padded="false">
    @foreach ($exams as $exam)
        <x-table.tr onclick="window.location='{{ route('exam.show', ['exam' => $exam->id]) }}'">
            <x-table.td>{{ $exam->subject->name }}</x-table.td>
            <x-table.td>{{ $exam->name }}</x-table.td>
            <x-table.td>{{ $exam->description }}</x-table.td>
            <x-table.td>{{ $exam->formatted_duration }}</x-table.td>
        </x-table.tr>
    @endforeach
</x-table.index>
