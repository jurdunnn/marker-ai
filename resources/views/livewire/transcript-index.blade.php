<x-slot name="header">
    {{ __('Transcript List') }}
</x-slot>

<x-slot name="headerButtons">
    <button onclick="location.href='{{ route('transcript.create') }}'"  class="header-button">
        {{ __('Add Transcript') }}
    </button>
</x-slot>

<x-table.index :headings="['Student', 'Subject', 'Status']" :padded="false">
    @foreach ($transcripts as $transcript)
        <x-table.tr onclick="window.location='{{ route('transcript.show', ['transcript' => $transcript->id]) }}'">
            <x-table.td>{{ $transcript->student->name }}</x-table.td>
            <x-table.td>{{ $transcript->subject->name }}</x-table.td>
            <x-table.td>{{ $transcript->status->name }}</x-table.td>
        </x-table.tr>
    @endforeach
</x-table.index>
