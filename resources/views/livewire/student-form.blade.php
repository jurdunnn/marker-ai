<x-slot name="header">
    {{ __('Student Form') }}
</x-slot>

<x-container outerClasses="mt-12">
    <form wire:submit.prevent="save" class="flex flex-col max-w-sm mx-auto gap-y-5">
        <div>
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Name</label>

            <input type="name" id="name" wire:model="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>

            @error('name')
                <div class="text-sm text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>

            <input type="email" id="email" wire:model="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="email@email.co.uk" required>

            @error('email')
                <div class="text-sm text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="date" class="block mb-2 text-sm font-medium text-gray-900">Date of Birth</label>

            <input type="date" id="date" wire:model="date_of_birth" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>

            @error('date_of_birth')
                <div class="text-sm text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Create</button>
    </form>
</x-container>
