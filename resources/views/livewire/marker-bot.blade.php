<div x-data="robotsData">
    <ol class="flex items-center justify-center px-20">
        <li class="flex w-full items-center text-blue-600 after:content-[''] after:w-full after:h-1 after:border-b after:border-blue-200 after:border-4 after:inline-block">
            <span class="flex items-center justify-center w-10 h-10 bg-blue-200 rounded-full lg:h-12 lg:w-12 shrink-0">
                <span class="text-blue-400">
                    <i class="fa-solid fa-flask fa-lg"></i>
                </span>
            </span>
        </li>
        <li class="flex w-full items-center after:content-[''] after:w-full after:h-1 after:border-b after:border-4 after:inline-block" :class="subject.complete ? 'text-blue-600 after:border-blue-200' : 'after:border-gray-400'">
            <span class="flex items-center justify-center w-10 h-10 rounded-full cursor-pointer hover:scale-105 lg:h-12 lg:w-12 shrink-0" :class="subject.complete ? 'bg-blue-200' : 'bg-gray-400'">
                <span :class="subject.complete ? 'text-blue-400' : 'text-gray-100'">
                    <i class="fa-solid fa-school fa-lg"></i>
                </span>
            </span>
        </li>
        <li class="flex w-full items-center after:content-[''] after:w-full after:h-1 after:border-b after:border-4 after:inline-block" :class="exam.complete ? 'text-blue-600 after:border-blue-200' : 'after:border-gray-400'">
            <span class="flex items-center justify-center w-10 h-10 rounded-full cursor-pointer hover:scale-105 lg:h-12 lg:w-12 shrink-0" :class="exam.complete ? 'bg-blue-200' : 'bg-gray-400'">
                <span :class="exam.complete ? 'text-blue-400' : 'text-gray-100'">
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

    <!-- Subject -->
    <div id="view-0" class="mx-12 mt-20 grid gap-y-8 grid-cols-4">
        @foreach ($subjects as $subject)
            <button @click="setProperty('subject', '{{ $subject->id}}');" class="w-[300px] text-left select-none flex cursor-pointer hover:shadow-xl flex-col gap-y-4 bg-white rounded-lg px-3 py-4">
                <div class="flex gap-x-4">
                    <span class="text-blue-300">
                        <i class="fa-solid fa-{{ $subject->icon ?? 'circle-dot' }} fa-xl"></i>
                    </span>

                    <p class="font-semibold text-gray-600">
                        {{ __($subject->name) }}
                    </p>
                </div>

                <p class="text-gray-400">
                    {{ __($subject->description) }}
                </p>
            </button>
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

    <!-- Exam -->
    <div id="view-1" style="display: none;" class="mx-12 mt-20 grid gap-y-8 grid-cols-4">
        @foreach ($exams as $exam)
            <button @click="setProperty('exam', '{{ $exam->id}}');" class="w-[300px] text-left select-none flex cursor-pointer hover:shadow-xl flex-col gap-y-4 bg-white rounded-lg px-3 py-4">
                <div class="flex gap-x-4">
                    <span class="text-blue-300">
                        <i class="fa-solid fa-{{ $exam->icon ?? 'circle-dot' }} fa-xl"></i>
                    </span>

                    <p class="font-semibold text-gray-600">
                        {{ __($exam->name) }}
                    </p>
                </div>

                <p class="text-gray-400">
                    {{ __($exam->description) }}
                </p>
            </button>
        @endforeach

        <div onclick="location.href='{{ route('exam.create') }}'" class="w-[300px] select-none cursor-pointer hover:shadow-xl flex flex-col gap-y-4 bg-white rounded-lg px-3 py-4">
            <div class="flex gap-x-4">
                <span class="text-blue-300">
                    <i class="fa-solid fa-square-plus fa-xl"></i>
                </span>

                <p class="font-semibold text-gray-600">
                    {{ __('New Exam') }}
                </p>
            </div>

            <p class="text-gray-400">
                {{ __('Create a new subject to for robot to process.') }}
            </p>
        </div>
    </div>

    <!-- Student -->
    <div id="view-2" style="display: none;" class="mx-12 mt-20 grid gap-y-8 grid-cols-4">
        @foreach ($students as $student)
            <button @click="setProperty('exam', '{{ $student->id}}');" class="w-[300px] text-left select-none flex cursor-pointer hover:shadow-xl flex-col gap-y-4 bg-white rounded-lg px-3 py-4">
                <div class="flex gap-x-4">
                    <span class="text-blue-300">
                        <i class="fa-solid fa-{{ $student->icon ?? 'circle-dot' }} fa-xl"></i>
                    </span>

                    <p class="font-semibold text-gray-600">
                        {{ __($student->name) }}
                    </p>
                </div>

                <p class="text-gray-400">
                    {{ __($student->email) }}
                </p>
            </button>
        @endforeach

        <div onclick="location.href='{{ route('student.create') }}'" class="w-[300px] select-none cursor-pointer hover:shadow-xl flex flex-col gap-y-4 bg-white rounded-lg px-3 py-4">
            <div class="flex gap-x-4">
                <span class="text-blue-300">
                    <i class="fa-solid fa-square-plus fa-xl"></i>
                </span>

                <p class="font-semibold text-gray-600">
                    {{ __('New Student') }}
                </p>
            </div>

            <p class="text-gray-400">
                {{ __('Create a new subject to for robot to process.') }}
            </p>
        </div>
    </div>

    <script>
        robotsData = {
            'subject': {
                'complete': false,
                'id': null,
            },
            'exam': {
                'complete': false,
                'id': null,
            },
            'student': {
                'complete': false,
                'id': null,
            },

            'setProperty': function (property, value) {
                this[property]['complete'] = true;
                this[property]['id'] = value;

                this.showNextView();
            },

            'showNextView': function () {
                const data = [this.subject, this.exam, this.student];

                for (let i = 0; i < data.length; i++) {
                    if (data[i]['complete'] === false) {
                        // Hide all other views
                        document.querySelectorAll('[id^="view-"]').forEach(function (element) {
                            element.style.display = 'none';
                        });

                        document.getElementById('view-' + i).style.display = 'grid';

                        return;
                    }

                }
            }
        }
    </script>
</div>
