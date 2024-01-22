<nav x-data="{ open: false }" class="w-1/4 bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="h-full fixed sm:px-6 lg:px-8">
        <div class="flex flex-col justify-between h-full">
            <div class="w-full">
                <!-- Logo -->
                <div class="flex items-center shrink-0">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block w-auto text-gray-800 fill-current h-9" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden w-full py-8 mt-12 gap-y-8 sm:flex-col sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    <x-nav-link :href="route('student.index')" :active="request()->routeIs('student.*')">
                        {{ __('Students') }}
                    </x-nav-link>

                    <x-nav-link :href="route('exam.index')" :active="request()->routeIs('exam.*')">
                        {{ __('Exams') }}
                    </x-nav-link>

                    <x-nav-link :href="route('subject.index')" :active="request()->routeIs('subject.*')">
                        {{ __('Subjects') }}
                    </x-nav-link>

                    <x-nav-link :href="route('transcript.index')" :active="request()->routeIs('transcript.*')">
                        {{ __('Transcripts') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <button onclick="location.href='{{ route('profile.edit') }}'" class="flex flex-row items-center p-1 mb-8 hover:border-2 hover:shadow-xl hover:rounded-lg hover:border-gray-400 gap-x-4">
                <div class="my-auto bg-red-500 rounded-full size-12"></div>

                <div>
                    <p class="font-medium text-gray-800">{{ Auth()->user()->name }}</p>

                    <div class="flex gap-x-1">
                        <div class="my-auto bg-yellow-500 rounded-full size-4"></div>
                        <p class="my-auto text-sm text-left text-gray-500">Premium User</p>
                    </div>
                </div>
            </button>

            <!-- Hamburger -->
            <div class="flex items-center -me-2 sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 text-gray-400 rounded-md hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('student.index')" :active="request()->routeIs('student.*')">
                {{ __('Students') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('exam.index')" :active="request()->routeIs('exam.*')">
                {{ __('Exams') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('subject.index')" :active="request()->routeIs('subject.*')">
                {{ __('Subjects') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('transcript.index')" :active="request()->routeIs('transcript.*')">
                {{ __('Transcripts') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="text-base font-medium text-gray-800">{{ Auth::user()->name }}</div>
                <div class="text-sm font-medium text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
