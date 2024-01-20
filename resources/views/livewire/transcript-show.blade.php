<x-slot name="header">
    {{ __('Transcript for ' . $transcript->student->name . ' - ' . $transcript->status->name) }}
</x-slot>

<x-slot name="headerButtons">
    <button onclick="location.href='{{ route('transcript.edit', ['transcript' => $transcript->id]) }}'"  class="header-button">
        {{ __('Edit Transcript') }}
    </button>

    <div>
        <button onclick="Livewire.dispatch('rerunTranscribe')" class="header-button" {{ $transcript->text ? 'disabled' : '' }}>
        {{ __('Rerun Transcribe') }}
        </button>
    </div>
</x-slot>

<div>
    <div>
        <x-container>
            <h2 class="text-xl font-semibold">{{ __('Transcript Information') }}</h2>

            <table class="w-full">
                <tbody>
                    <tr>
                        <td class="py-4 text-sm whitespace-nowrap">{{ __('URL') }}</td>
                        <td class="py-4 text-sm whitespace-nowrap">{{ $transcript->url }}</td>
                    </tr>
                    <tr>
                        <td class="py-4 text-sm whitespace-nowrap">{{ __('Student') }}</td>
                        <td class="py-4 text-sm whitespace-nowrap">{{ $transcript->student->name }}</td>
                    </tr>

                    <tr>
                        <td class="py-4 text-sm whitespace-nowrap">{{ __('Subject') }}</td>
                        <td class="py-4 text-sm whitespace-nowrap">{{ $transcript->subject->name }}</td>
                    </tr>

                    <tr>
                        <td class="py-4 text-sm whitespace-nowrap">{{ __('Status') }}</td>
                        <td class="py-4 text-sm whitespace-nowrap">{{ $transcript->status->name }}</td>
                    </tr>

                    <tr>
                        <td class="py-4 text-sm whitespace-nowrap">{{ __('Exam') }}</td>
                        <td class="py-4 text-sm whitespace-nowrap">{{ $transcript->exam->name }}</td>
                    </tr>
                </tbody>
            </table>
        </x-container>
    </div>

    <div class="mt-8">
        <x-image-and-container image="{{ $transcript->url }}">
            @if ($transcript->text)
                <div class="prose">
                    {!! $transcript->text !!}
                </div>
            @else
                <div class="p-6 text-gray-900">
                    {{ __('No transcript text available.') }}
                </div>
            @endif

        </x-image-and-container>
    </div>
</div>

