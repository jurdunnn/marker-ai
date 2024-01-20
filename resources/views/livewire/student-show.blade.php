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

    <div class="mt-8">
        <x-container>
            <h2 class="text-xl font-semibold">{{ __('Exams') }}</h2>

            <table class="w-full">
                <tbody>
                    <tr>
                        <th class="py-4 text-sm text-left whitespace-nowrap">{{ __('Subject') }}</th>
                        <th class="py-4 text-sm text-left whitespace-nowrap">{{ __('Exam') }}</th>
                        <th class="py-4 text-sm text-left whitespace-nowrap">{{ __('Duration') }}</th>
                    </tr>

                    @foreach ($student->exams() as $exam)
                        <tr class="cursor-pointer" onclick="window.location='{{ route('exam.show', ['exam' => $exam->id]) }}'">
                            <td class="py-4 text-sm whitespace-nowrap">{{ $exam->subject->name }}</td>
                            <td class="py-4 text-sm whitespace-nowrap">{{ $exam->name }}</td>
                            <td class="py-4 text-sm whitespace-nowrap">{{ $exam->formatted_duration }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </x-container>
    </div>

    <div class="mt-8">
        <x-container>
            <h2 class="text-xl font-semibold">{{ __('Subjects') }}</h2>

            <table class="w-full">
                <tbody>
                    <tr>
                        <th class="py-4 text-sm text-left whitespace-nowrap">{{ __('Subject') }}</th>
                        <th class="py-4 text-sm text-left whitespace-nowrap">{{ __('Description') }}</th>
                    </tr>

                    @foreach ($student->subjects() as $subject)
                        <tr class="cursor-pointer" onclick="window.location='{{ route('subject.show', ['subject' => $subject->id]) }}'">
                            <td class="py-4 text-sm whitespace-nowrap">{{ $subject->name }}</td>
                            <td class="py-4 text-sm whitespace-nowrap">{{ $subject->description }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </x-container>
    </div>

    <div class="mt-8">
        <x-container>
            <h2 class="text-xl font-semibold">{{ __('Transcriptions') }}</h2>

            <table class="w-full">
                <tbody>
                    <tr>
                        <th class="py-4 text-sm text-left whitespace-nowrap">{{ __('Subject') }}</th>
                        <th class="py-4 text-sm text-left whitespace-nowrap">{{ __('Exam') }}</th>
                        <th class="py-4 text-sm text-left whitespace-nowrap">{{ __('Status') }}</th>
                    </tr>
                    @foreach ($student->transcriptions as $transcription)
                        <tr class="cursor-pointer" onclick="window.location='{{ route('transcript.show', ['transcript' => $transcription->id]) }}'">
                            <td class="py-4 text-sm whitespace-nowrap">{{ $transcription->subject->name }}</td>
                            <td class="py-4 text-sm whitespace-nowrap">{{ $transcription->exam->name }}</td>
                            <td class="py-4 text-sm whitespace-nowrap">{{ $transcription->status->name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </x-container>
    </div>
</div>
