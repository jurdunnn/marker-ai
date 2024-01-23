<x-slot name="header">
    {{ __($exam->name) }}
</x-slot>

<x-slot name="headerButtons">
    <button onclick="location.href='{{ route('exam.edit', ['exam' => $exam->id]) }}'"  class="header-button">
        {{ __('Edit Exam') }}
    </button>
</x-slot>

<div>
    <div>
        <x-container>
            <h2 class="text-xl font-semibold">{{ __('Exam Information') }}</h2>

            <table class="w-full">
                <tbody>
                    <tr>
                        <td class="py-4 text-sm whitespace-nowrap">{{ __('Name') }}</td>
                        <td class="py-4 text-sm whitespace-nowrap">{{ $exam->name }}</td>
                    </tr>

                    <tr>
                        <td class="py-4 text-sm whitespace-nowrap">{{ __('Subject') }}</td>
                        <td class="py-4 text-sm whitespace-nowrap">{{ $exam->subject->name }}</td>
                    </tr>

                    <tr>
                        <td class="py-4 text-sm whitespace-nowrap">{{ __('Description') }}</td>
                        <td class="py-4 text-sm whitespace-nowrap">{{ $exam->description }}</td>
                    </tr>

                    <tr>
                        <td class="py-4 text-sm whitespace-nowrap">{{ __('Start Time') }}</td>
                        <td class="py-4 text-sm whitespace-nowrap">{{ $exam->formatted_start_at }}</td>
                    </tr>

                    <tr>
                        <td class="py-4 text-sm whitespace-nowrap">{{ __('End Time') }}</td>
                        <td class="py-4 text-sm whitespace-nowrap">{{ $exam->formatted_end_at }}</td>
                    </tr>

                    <tr>
                        <td class="py-4 text-sm whitespace-nowrap">{{ __('Total Marks') }}</td>
                        <td class="py-4 text-sm whitespace-nowrap">{{ $exam->total_marks }}</td>
                    </tr>

                    <tr>
                        <td class="py-4 text-sm whitespace-nowrap">{{ __('Passing Marks') }}</td>
                        <td class="py-4 text-sm whitespace-nowrap">{{ $exam->passing_marks }}</td>

                    <tr>
                        <td class="py-4 text-sm whitespace-nowrap">{{ __('Status') }}</td>
                        <td class="py-4 text-sm whitespace-nowrap">{{ $exam->status }}</td>
                    </tr>

                    <tr>
                        <td class="py-4 text-sm whitespace-nowrap">{{ __('Number of Students') }}</td>
                        <td class="py-4 text-sm whitespace-nowrap">{{ $exam->number_of_students }}</td>
                    </tr>

                    <tr>
                        <td class="py-4 text-sm whitespace-nowrap">{{ __('Number of Transcripts') }}</td>
                        <td class="py-4 text-sm whitespace-nowrap">{{ $exam->number_of_transcripts }}</td>
                    </tr>
                </tbody>
            </table>
        </x-container>
    </div>

    <x-table.contained-index :headings="['Name', 'Email', 'Date of Birth']" title="Students">
        @foreach ($exam->students() as $student)
            <x-table.tr onclick="window.location='{{ route('student.show', ['student' => $student->id]) }}'">
                <x-table.td>{{ $student->name }}</x-table.td>
                <x-table.td>{{ $student->email }}</x-table.td>
                <x-table.td>{{ $student->date_of_birth->format('F d, Y') }}</x-table.td>
            </x-table.tr>
        @endforeach
    </x-table.contained-index>

    <x-table.contained-index :headings="['Student', 'Subject', 'Status']" title="Transcripts">
        @foreach ($exam->transcriptions as $transcript)
            <x-table.tr onclick="window.location='{{ route('transcript.show', ['transcript' => $transcript->id]) }}'">
                <x-table.td>{{ $transcript->student->name }}</x-table.td>
                <x-table.td>{{ $transcript->subject->name }}</x-table.td>
                <x-table.td>{{ $transcript->status->name }}</x-table.td>
            </x-table.tr>
        @endforeach
    </x-table.contained-index>
</div>
