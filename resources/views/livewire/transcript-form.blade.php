<x-slot name="header">
    {{ __('Transcript Form') }}
</x-slot>

<x-container outerClasses="mt-12">
    <form wire:submit.prevent="save" class="flex flex-col max-w-sm mx-auto gap-y-5">
        <div>
            <label for="url" class="block mb-2 text-sm font-medium text-gray-900">{{ __('Url') }}</label>

            <input type="url" id="url" wire:model="url" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>

            @error('url')
                <div class="text-sm text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="student_id" class="block mb-2 text-sm font-medium text-gray-900">{{ __('Student') }}</label>

            <input type="text" id="student_id" wire:model="student_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>

            @error('student_id')
                <div class="text-sm text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="subject_id" class="block mb-2 text-sm font-medium text-gray-900">{{ __('Subject') }}</label>

            <input type="text" id="subject_id" wire:model="subject_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>

            @error('subject_id')
                <div class="text-sm text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="exam_id" class="block mb-2 text-sm font-medium text-gray-900">{{ __('Exam') }}</label>

            <input type="text" id="exam_id" wire:model="exam_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>

            @error('exam_id')
                <div class="text-sm text-red-500">{{ $message }}</div>
            @enderror
        </div>


        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">{{ __('Create') }}</button>
    </form>
</x-container>
