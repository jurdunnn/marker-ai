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

    <div class="mt-8">
        <x-container>
            <h2 class="text-xl font-semibold">{{ __('Students') }}</h2>

            <table class="w-full">
                <tbody>
                    @foreach ($exam->students() as $student)
                        <tr class="cursor-pointer" onclick="window.location='{{ route('student.show', ['student' => $student->id]) }}'">
                            <td class="py-4 text-sm whitespace-nowrap">{{ $loop->index + 1 }}</td>
                            <td class="py-4 text-sm whitespace-nowrap">{{ $student->name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </x-container>
    </div>

    <div class="mt-8">
        <x-container>
            <h2 class="text-xl font-semibold">{{ __('Transcripts') }}</h2>

            <table class="w-full">
                <tbody>
                    @foreach ($exam->transcriptions as $transcript)
                        <tr class="cursor-pointer" onclick="window.location='{{ route('transcript.show', ['transcript' => $transcript->id]) }}'">
                            <td class="py-4 text-sm whitespace-nowrap">{{ $loop->index + 1 }}</td>
                            <td class="py-4 text-sm whitespace-nowrap">{{ $student->name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </x-container>
    </div>
</div>
