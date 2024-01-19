<x-slot name="header">
    {{ __('Transcript List') }}
</x-slot>

<x-slot name="headerButtons">
    <button onclick="location.href='{{ route('transcript.create') }}'"  class="header-button">
        {{ __('Add Transcript') }}
    </button>
</x-slot>

<x-container>
    @if ($transcripts)
        <table class="w-full">
            <thead>
                <tr class="text-left">
                    <th>{{ __('Student') }}</th>
                    <th>{{ __('Class') }}</th>
                    <th>{{ __('Status') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transcripts as $transcript)
                    <tr class="text-gray-500 bg-white border-b cursor-pointer hover:scale-[101%] hover:font-semibold ease-in-out duration-75">
                        <td class="py-4 text-sm whitespace-nowrap">{{ $transcript->student->name }}</td>
                        <td class="py-4 text-sm whitespace-nowrap">{{ $transcript->subject->name }}</td>
                        <td class="py-4 text-sm whitespace-nowrap">{{ $transcript->status->name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</x-container>
