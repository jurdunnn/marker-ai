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
                    <x-nav-link icon="table-columns" :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    <x-nav-link icon="brain" :href="route('marker-bot')" :active="request()->routeIs('marker-bot')">
                        {{ __('Marker AI') }}
                    </x-nav-link>

                    <x-nav-link icon="user-group" :href="route('student.index')" :active="request()->routeIs('student.*')">
                        {{ __('Students') }}
                    </x-nav-link>

                    <x-nav-link icon="file-lines" :href="route('exam.index')" :active="request()->routeIs('exam.*')">
                        {{ __('Exams') }}
                    </x-nav-link>

                    <x-nav-link icon="book" :href="route('subject.index')" :active="request()->routeIs('subject.*')">
                        {{ __('Subjects') }}
                    </x-nav-link>

                    <x-nav-link icon="images" :href="route('transcript.index')" :active="request()->routeIs('transcript.*')">
                        {{ __('Transcripts') }}
                    </x-nav-link>
                </div>
            </div>


            <div class="flex flex-col justify-center p-4 mt-12">
                <x-nav-link
                    icon="{{ Auth::user()->name === 'Jordan Downs' ? 'crown' : 'user-circle'}}"
                    onclick="location.href='{{ route('profile.edit') }}'"
                    :active="request()->routeIs('profile.edit')"
                >
                    <div>
                        {{ Auth::user()->name }}
                    </div>
                </x-nav-link>
            </div>
        </div>
    </div>
</nav>
