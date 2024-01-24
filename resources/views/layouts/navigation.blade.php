<nav x-data="{ open: false }" class="fixed inset-0 z-10 bg-white md:relative md:w-1/5">
    <!-- Primary Navigation Menu -->
    <div class="fixed h-full sm:px-6 lg:px-8">
        <div class="flex flex-col justify-between h-full">
            <div class="w-full">
                <!-- Logo -->
                <div class="flex items-center mt-4 shrink-0">
                    <a href="{{ route('dashboard') }}" class="mx-auto">
                        <x-application-logo class="block w-auto text-gray-800 fill-current h-9" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden w-full py-8 mt-12 gap-y-8 sm:flex-col sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        <span class="w-8 mr-3 text-center group-hover:block">
                            <i class="fa-solid fa-gauge fa-xl"></i>
                        </span>

                        {{ __('Dashboard') }}
                    </x-nav-link>

                    <x-nav-link :href="route('marker-bot')" :active="request()->routeIs('marker-bot')">
                        <span class="w-8 mr-3 text-center group-hover:block">
                            <i class="fa-solid fa-robot fa-xl"></i>
                        </span>

                        {{ __('Robot') }}
                    </x-nav-link>

                    <x-nav-link :href="route('student.index')" :active="request()->routeIs('student.*')">
                        <span class="w-8 mr-3 text-center group-hover:block">
                            <i class="fa-solid fa-user fa-xl"></i>
                        </span>

                        {{ __('Students') }}
                    </x-nav-link>

                    <x-nav-link :href="route('exam.index')" :active="request()->routeIs('exam.*')">
                        <span class="w-8 mr-3 text-center group-hover:block">
                            <i class="fa-solid fa-school fa-xl"></i>
                        </span>

                        {{ __('Exams') }}
                    </x-nav-link>

                    <x-nav-link :href="route('subject.index')" :active="request()->routeIs('subject.*')">
                        <span class="w-8 mr-3 text-center group-hover:block">
                            <i class="fa-solid fa-flask fa-xl"></i>
                        </span>

                        {{ __('Subjects') }}
                    </x-nav-link>

                    <x-nav-link :href="route('transcript.index')" :active="request()->routeIs('transcript.*')">
                        <span class="w-8 mr-3 text-center group-hover:block">
                            <i class="fa-solid fa-file fa-xl"></i>
                        </span>

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
