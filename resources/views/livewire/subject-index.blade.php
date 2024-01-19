<x-slot name="header">
    {{ __('Subject List') }}
</x-slot>

<x-slot name="headerButtons">
    <button onclick="location.href='{{ route('subject.create') }}'"  class="header-button">
        {{ __('Add Subject') }}
    </button>
</x-slot>

<x-container>
    @if ($subjects)
        <table class="w-full">
            <thead>
                <tr class="text-left">
                    <th>{{ __('Subject') }}</th>
                    <th>{{ __('Description') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($subjects as $subject)
                    <tr class="text-gray-500 bg-white border-b cursor-pointer hover:scale-[101%] hover:font-semibold ease-in-out duration-75">
                        <td class="py-4 text-sm whitespace-nowrap">{{ $subject->name }}</td>
                        <td class="py-4 text-sm whitespace-nowrap">{{ $subject->description }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</x-container>
