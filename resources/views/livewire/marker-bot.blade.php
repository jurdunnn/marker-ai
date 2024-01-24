<div>
    <ol class="flex items-center justify-center px-20">
        <li class="flex w-full items-center text-blue-600 after:content-[''] after:w-full after:h-1 after:border-b @if (true) after:border-blue-200 @else after:border-gray-400 @endif after:border-4 after:inline-block">
            @if (true)
                <span class="flex items-center justify-center w-10 h-10 bg-blue-200 rounded-full lg:h-12 lg:w-12 shrink-0">
                    <span class="text-blue-400">
                        <i class="fa-solid fa-flask fa-lg"></i>
                    </span>
                </span>
            @else
                <span class="flex items-center justify-center w-10 h-10 bg-gray-400 rounded-full cursor-pointer hover:scale-105 lg:h-12 lg:w-12 shrink-0">
                    <span class="text-gray-100">
                        <i class="fa-solid fa-flask fa-lg"></i>
                    </span>
                </span>
            @endif
        </li>
        <li class="flex w-full items-center after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-400 after:border-4 after:inline-block">
            <span class="flex items-center justify-center w-10 h-10 bg-gray-400 rounded-full cursor-pointer hover:scale-105 lg:h-12 lg:w-12 shrink-0">
                <span class="text-gray-100">
                    <i class="fa-solid fa-school fa-lg"></i>
                </span>
            </span>
        </li>
        <li class="flex w-full items-center after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-400 after:border-4 after:inline-block">
            <span class="flex items-center justify-center w-10 h-10 bg-gray-400 rounded-full cursor-pointer hover:scale-105 lg:h-12 lg:w-12 shrink-0">
                <span class="text-gray-100">
                    <i class="fa-solid fa-user fa-lg"></i>
                </span>
            </span>
        </li>
        <li class="flex items-center">
            <span class="flex items-center justify-center w-10 h-10 bg-gray-400 rounded-full cursor-pointer hover:scale-105 lg:h-12 lg:w-12 shrink-0">
                <span class="text-gray-100">
                    <i class="fa-solid fa-file fa-lg"></i>
                </span>
            </span>
        </li>
    </ol>

    <div class="mx-12 mt-20 grid gap-y-8 grid-cols-4">
        @foreach ($subjects as $subject)
            <x-card.subject :subject="$subject" />
        @endforeach

        <div onclick="location.href='{{ route('subject.create') }}'" class="w-[300px] select-none cursor-pointer hover:shadow-xl flex flex-col gap-y-4 bg-white rounded-lg px-3 py-4">
            <div class="flex gap-x-4">
                <span class="text-blue-300">
                    <i class="fa-solid fa-square-plus fa-xl"></i>
                </span>

                <p class="font-semibold text-gray-600">
                    {{ __('New Subject') }}
                </p>
            </div>

            <p class="text-gray-400">
                {{ __('Create a new subject to for robot to process.') }}
            </p>
        </div>
    </div>
</div>
