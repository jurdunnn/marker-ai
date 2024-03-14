<nav x-data="{ open: false }" class="fixed inset-0 z-10 w-full bg-white md:relative md:w-1/6">
    <!-- Primary Navigation Menu -->
    <div class="h-full">
        <div class="flex flex-col justify-between h-full">
            <div class="w-full">
                <!-- Logo -->
                <div class="flex mt-4 shrink-0">
                    <a href="{{ route('dashboard') }}" class="mx-auto">
                        <x-application-logo />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="flex flex-col justify-center px-4 py-8 mt-12 gap-y-5">
                    <x-nav-link icon="gauge" :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    <x-nav-link icon="robot" :href="route('marker-bot')" :active="request()->routeIs('marker-bot')">
                        {{ __('Marker AI') }}
                    </x-nav-link>

                    <x-nav-link icon="user" :href="route('student.index')" :active="request()->routeIs('student.*')">
                        {{ __('Students') }}
                    </x-nav-link>

                    <x-nav-link icon="school" :href="route('exam.index')" :active="request()->routeIs('exam.*')">
                        {{ __('Exams') }}
                    </x-nav-link>

                    <x-nav-link icon="flask" :href="route('subject.index')" :active="request()->routeIs('subject.*')">
                        {{ __('Subjects') }}
                    </x-nav-link>

                    <x-nav-link icon="file" :href="route('transcript.index')" :active="request()->routeIs('transcript.*')">
                        {{ __('Transcripts') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <button onclick="location.href='{{ route('profile.edit') }}'" class="flex flex-row items-center p-1 mb-8 hover:border-2 hover:shadow-xl hover:rounded-lg hover:border-gray-400 gap-x-4">
                <div class="flex items-center justify-center my-auto rounded-full bg-slate-400 size-12">
                    <span class="w-8 text-center text-white group-hover:block">
                        <i class="fa-solid fa-user fa-xl"></i>
                    </span>
                </div>

                <div>
                    <p class="font-medium text-gray-800">{{ Auth()->user()->name }}</p>

                    <div class="flex gap-x-1">
                        <div class="flex items-center justify-center my-auto bg-yellow-500 rounded-full size-4">
                            <span class="text-white">
                                <i class="fa-solid fa-crown fa-2xs"></i>
                            </span>
                        </div>
                        <p class="my-auto text-sm text-left text-gray-500">Premium User</p>
                    </div>
                </div>
            </button>
        </div>
    </div>
</nav>
