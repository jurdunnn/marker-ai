<x-slot name="header">
    {{ __('Exam Form') }}
</x-slot>

<x-container outerClasses="mt-12">
    <form wire:submit.prevent="save" class="flex flex-col max-w-sm mx-auto gap-y-5">
        <div>
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900">{{ __('Name') }}</label>

            <input type="name" id="name" wire:model="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5" required>

            @error('name')
                <div class="text-sm text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="description" class="block mb-2 text-sm font-medium text-gray-900">{{ __('Description') }}</label>

            <textarea id="description" wire:model="description" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5" required></textarea>

            @error('description')
                <div class="text-sm text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="subject" class="block mb-2 text-sm font-medium text-gray-900">{{ __('Subject') }}</label>

            <input type="text" id="subject" wire:model="subject_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5" required>

            @error('subject_id')
                <div class="text-sm text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="status" class="block mb-2 text-sm font-medium text-gray-900">{{ __('Status') }}</label>

            <input type="text" id="status" wire:model="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5" required>

            @error('status')
                <div class="text-sm text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="start_at" class="block mb-2 text-sm font-medium text-gray-900">{{ __('Start at') }}</label>

            <input type="datetime-local" id="start_at" wire:model="start_at" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5" required>

            @error('start_at')
                <div class="text-sm text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="end_at" class="block mb-2 text-sm font-medium text-gray-900">{{ __('End at') }}</label>

            <input type="datetime-local" id="end_at" wire:model="end_at" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5" required>

            @error('end_at')
                <div class="text-sm text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="total_marks" class="block mb-2 text-sm font-medium text-gray-900">{{ __('Total Marks') }}</label>

            <input type="number" id="total_marks" wire:model="total_marks" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5" required>

            @error('total_marks')
                <div class="text-sm text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="passing_marks" class="block mb-2 text-sm font-medium text-gray-900">{{ __('Passing Marks') }}</label>

            <input type="number" id="passing_marks" wire:model="passing_marks" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5" required>

            @error('total_marks')
                <div class="text-sm text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="text-white bg-primary hover:bg-primary-dark focus:ring-4 focus:outline-none focus:ring-primary-light font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">{{ __('Create') }}</button>
    </form>
</x-container>
