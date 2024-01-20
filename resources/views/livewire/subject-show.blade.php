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

    <div class="mt-8">
        <x-container>
            <h2 class="text-xl font-semibold">{{ __('Students') }}</h2>

            <table class="w-full">
                <tbody>
                    @foreach ($subject->students() as $student)
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
            <h2 class="text-xl font-semibold">{{ __('Transcripts') }}</h2>

            <table class="w-full">
                <tbody>
                    @foreach ($subject->transcriptions as $transcript)
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
