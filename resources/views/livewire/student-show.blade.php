<x-slot name="header">
    {{ __($student->name) }}
</x-slot>

<x-slot name="headerButtons">
    <button onclick="location.href='{{ route('student.edit', ['student' => $student->id]) }}'"  class="header-button">
        {{ __('Edit Student') }}
    </button>
</x-slot>

<div>
    <div>
        <x-container>
            <h2 class="text-xl font-semibold">{{ __('Personal Information') }}</h2>

            <table class="w-full">
                <tbody>
                    <tr>
                        <td class="py-4 text-sm whitespace-nowrap">{{ __('Name') }}</td>
                        <td class="py-4 text-sm whitespace-nowrap">{{ $student->name }}</td>
                    </tr>
                    <tr>
                        <td class="py-4 text-sm whitespace-nowrap">{{ __('Email') }}</td>
                        <td class="py-4 text-sm whitespace-nowrap">{{ $student->email }}</td>
                    </tr>
                    <tr>
                        <td class="py-4 text-sm whitespace-nowrap">{{ __('Date of Birth') }}</td>
                        <td class="py-4 text-sm whitespace-nowrap">{{ $student->date_of_birth->format('F d, Y') }}</td>
                    </tr>
                </tbody>
            </table>
        </x-container>
    </div>

    <x-table.contained-index :headings="['Subject', 'Exam', 'Description', 'Duration']" title='Exams'>
        @foreach ($student->exams() as $exam)
            <x-table.tr onclick="window.location='{{ route('exam.show', ['exam' => $exam->id]) }}'">
                <x-table.td>{{ $exam->subject->name }}</x-table.td>
                <x-table.td>{{ $exam->name }}</x-table.td>
                <x-table.td>{{ $exam->description }}</x-table.td>
                <x-table.td>{{ $exam->formatted_duration }}</x-table.td>
            </x-table.tr>
        @endforeach
    </x-table.contained-index>

    <x-table.contained-index :headings="['Name', 'Description']" title="Subjects">
        @foreach ($student->subjects() as $subject)
            <x-table.tr onclick="window.location='{{ route('subject.show', ['subject' => $subject->id]) }}'">
                <x-table.td>{{ $subject->name }}</x-table.td>
                <x-table.td>{{ $subject->description }}</x-table.td>
            </x-table.tr>
        @endforeach
    </x-table.contained-index>

    <x-table.contained-index :headings="['Exam', 'Subject', 'Status']" title='Transcriptions'>
        @foreach ($student->transcriptions as $transcript)
            <x-table.tr onclick="window.location='{{ route('transcript.show', ['transcript' => $transcript->id]) }}'">
                <x-table.td>{{ $transcript->exam->name }}</x-table.td>
                <x-table.td>{{ $transcript->subject->name }}</x-table.td>
                <x-table.td>{{ $transcript->status->name }}</x-table.td>
            </x-table.tr>
        @endforeach
    </x-table.contained-index>
</div>
