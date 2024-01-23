<x-slot name="header">
    {{ __($subject->name) }}
</x-slot>

<x-slot name="headerButtons">
    <button onclick="location.href='{{ route('subject.edit', ['subject' => $subject->id]) }}'"  class="header-button">
        {{ __('Edit Subject') }}
    </button>
</x-slot>

<div>
    <div>
        <x-container>
            <h2 class="text-xl font-semibold">{{ __('Subject Information') }}</h2>

            <table class="w-full">
                <tbody>
                    <tr>
                        <td class="py-4 text-sm whitespace-nowrap">{{ __('Name') }}</td>
                        <td class="py-4 text-sm whitespace-nowrap">{{ $subject->name }}</td>
                    </tr>

                    <tr>
                        <td class="py-4 text-sm whitespace-nowrap">{{ __('Description') }}</td>
                        <td class="py-4 text-sm whitespace-nowrap">{{ $subject->description }}</td>
                    </tr>
                </tbody>
            </table>
        </x-container>
    </div>

    <x-table.contained-index :headings="['Name', 'Email', 'Date of Birth']" title="Students">
        @foreach ($subject->students() as $student)
            <x-table.tr onclick="window.location='{{ route('student.show', ['student' => $student->id]) }}'">
                <x-table.td>{{ $student->name }}</x-table.td>
                <x-table.td>{{ $student->email }}</x-table.td>
                <x-table.td>{{ $student->date_of_birth->format('F d, Y') }}</x-table.td>
            </x-table.tr>
        @endforeach
    </x-table.contained-index>

    <x-table.contained-index :headings="['Subject', 'Exam', 'Description', 'Duration']" title="Exams">
        @foreach ($subject->exams as $exam)
            <x-table.tr onclick="window.location='{{ route('exam.show', ['exam' => $exam->id]) }}'">
                <x-table.td>{{ $exam->subject->name }}</x-table.td>
                <x-table.td>{{ $exam->name }}</x-table.td>
                <x-table.td>{{ $exam->description }}</x-table.td>
                <x-table.td>{{ $exam->formatted_duration }}</x-table.td>
            </x-table.tr>
        @endforeach
    </x-table.contained-index>

    <x-table.contained-index :headings="['Student', 'Subject', 'Status']" title="Transcripts">
        @foreach ($subject->transcriptions as $transcript)
            <x-table.tr onclick="window.location='{{ route('transcript.show', ['transcript' => $transcript->id]) }}'">
                <x-table.td>{{ $transcript->student->name }}</x-table.td>
                <x-table.td>{{ $transcript->subject->name }}</x-table.td>
                <x-table.td>{{ $transcript->status->name }}</x-table.td>
            </x-table.tr>
        @endforeach
    </x-table.contained-index>
</div>
