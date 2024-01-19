<x-slot name="header">
    {{ __('Subject Form') }}
</x-slot>

<x-container outerClasses="mt-12">
    <form wire:submit.prevent="save" class="flex flex-col max-w-sm mx-auto gap-y-5">
        <div>
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900">{{ __('Name') }}</label>

            <input type="name" id="name" wire:model="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>

            @error('name')
                <div class="text-sm text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="description" class="block mb-2 text-sm font-medium text-gray-900">{{ __('Description') }}</label>

            <input type="description" id="description" wire:model="description" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>

            @error('description')
                <div class="text-sm text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">{{ __('Create') }}</button>
    </form>
</x-container>
