<x-slot name="header">
    {{ __($student->name . ' - ' . $exam->subject->name . ' ' . $exam->name) }}
</x-slot>

<div class="py-4">
    <x-container>
        <div class="prose">
            {!! nl2br($test) !!}
        </div>
    </x-container>
</div>
