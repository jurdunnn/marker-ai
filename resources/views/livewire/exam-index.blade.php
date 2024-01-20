<x-slot name="header">
    {{ __('Exam List') }}
</x-slot>

<x-slot name="headerButtons">
    <button onclick="location.href='{{ route('exam.create') }}'"  class="header-button">
        {{ __('Add Exam') }}
    </button>
</x-slot>

<x-container>
    @if ($exams)
        <table class="w-full">
            <thead>
                <tr class="text-left">
                    <th>{{ __('Subject') }}</th>
                    <th>{{ __('Exam') }}</th>
                    <th>{{ __('Description') }}</th>
                    <th>{{ __('Duration') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($exams as $exam)
                    <tr class="text-gray-500 bg-white border-b cursor-pointer hover:scale-[101%] hover:font-semibold ease-in-out duration-75">
                        <td class="py-4 text-sm whitespace-nowrap">{{ $exam->subject->name }}</td>
                        <td class="py-4 text-sm whitespace-nowrap">{{ $exam->name }}</td>
                        <td class="py-4 text-sm whitespace-nowrap">{{ $exam->description }}</td>
                        <td class="py-4 text-sm whitespace-nowrap">{{ $exam->formatted_duration }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</x-container>
