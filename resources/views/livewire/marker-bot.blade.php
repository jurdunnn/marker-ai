<div x-data="robotsData" wire:ignore>
    <ol wire:key="navbar" class="flex items-center justify-center px-20">
        <li wire:key="subjectButton" class="flex w-full items-center text-primary-dark after:content-[''] after:w-full after:h-1 after:border-b after:border-primary-light after:border-4 after:inline-block">
            <span @click="gotoView('0')" class="flex items-center justify-center w-10 h-10 rounded-full cursor-pointer bg-primary-light hover:scale-105 lg:h-12 lg:w-12 shrink-0">
                <span class="text-primary">
                    <i class="fa-solid fa-flask fa-lg"></i>
                </span>
            </span>
        </li>
        <li wire:key="examButton" class="flex w-full items-center after:content-[''] after:w-full after:h-1 after:border-b after:border-4 after:inline-block" :class="subject.complete ? 'text-primary-dark after:border-primary-light' : 'after:border-gray-400'">
            <span @click="gotoView('1')" class="flex items-center justify-center w-10 h-10 rounded-full cursor-pointer hover:scale-105 lg:h-12 lg:w-12 shrink-0" :class="subject.complete ? 'bg-primary-light' : 'bg-gray-400'">
                <span :class="subject.complete ? 'text-primary' : 'text-gray-100'">
                    <i class="fa-solid fa-school fa-lg"></i>
                </span>
            </span>
        </li>
        <li wire:key="studentButton" class="flex w-full items-center after:content-[''] after:w-full after:h-1 after:border-b after:border-4 after:inline-block" :class="exam.complete ? 'text-primary-dark after:border-primary-light' : 'after:border-gray-400'">
            <span @click="gotoView('2')" class="flex items-center justify-center w-10 h-10 rounded-full cursor-pointer hover:scale-105 lg:h-12 lg:w-12 shrink-0" :class="exam.complete ? 'bg-primary-light' : 'bg-gray-400'">
                <span :class="exam.complete ? 'text-primary' : 'text-gray-100'">
                    <i class="fa-solid fa-user fa-lg"></i>
                </span>
            </span>
        </li>
        <li wire:key="transcriptsButton"class="flex w-full items-center after:content-[''] after:w-full after:h-1 after:border-b after:border-4 after:inline-block" :class="student.complete ? 'text-primary-dark after:border-primary-light' : 'after:border-gray-400'">
            <span @click="gotoView('3')" class="flex items-center justify-center w-10 h-10 rounded-full cursor-pointer hover:scale-105 lg:h-12 lg:w-12 shrink-0" :class="student.complete ? 'bg-primary-light' : 'bg-gray-400'">
                <span :class="student.complete ? 'text-primary' : 'text-gray-100'">
                    <i class="fa-solid fa-file fa-lg"></i>
                </span>
            </span>
        </li>
        <li wire:key="completeButton" class="flex items-center" :class="transcripts.complete ? 'text-green-600' : ''">
            <span @click="gotoView('4')" class="flex items-center justify-center w-10 h-10 rounded-full cursor-pointer hover:scale-105 lg:h-12 lg:w-12 shrink-0" :class="transcripts.complete ? 'bg-green-400' : 'bg-gray-400'">
                <span :class="transcripts.complete ? 'text-green-200' : 'text-gray-100'">
                    <i class="fa-solid fa-check fa-lg"></i>
                </span>
            </span>
        </li>
    </ol>

    <!-- Subject -->
    <div wire:key="view-0" id="view-0" class="mx-12 mt-20 grid gap-y-8 grid-cols-4">
        @foreach ($subjects as $subject)
            <button wire:key="{{ 'subject' . $subject->id }}" @click="setProperty('subject', '{{ $subject->id}}');" class="w-[300px] text-left select-none flex cursor-pointer hover:shadow-xl flex-col gap-y-4 bg-white rounded-lg px-3 py-4">
                <div class="flex gap-x-4">
                    <span class="text-primary">
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
                <span class="text-primary">
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
    <div wire:key="view-1" id="view-1" style="display: none;" class="mx-12 mt-20 grid gap-y-8 grid-cols-4">
        @foreach ($exams as $exam)
            <button @click="setProperty('exam', '{{ $exam->id}}');" class="w-[300px] text-left select-none flex cursor-pointer hover:shadow-xl flex-col gap-y-4 bg-white rounded-lg px-3 py-4">
                <div class="flex gap-x-4">
                    <span class="text-primary">
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
                <span class="text-primary">
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
    <div wire:key="view-2" id="view-2" style="display: none;" class="mx-12 mt-20 grid gap-y-8 grid-cols-4">
        @foreach ($students as $student)
            <button @click="setProperty('student', '{{ $student->id}}');" class="w-[300px] text-left select-none flex cursor-pointer hover:shadow-xl flex-col gap-y-4 bg-white rounded-lg px-3 py-4">
                <div class="flex gap-x-4">
                    <span class="text-primary">
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
                <span class="text-primary">
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

    <!-- Transcripts -->
    <div wire:key="view-3" id="view-3" style="display: none;">
        <div class="relative flex flex-col items-center h-screen py-12 mt-8 bg-slate-200"
             x-on:drop="isDropping = false"
             x-on:drop.prevent="handleFileDrop($event)"
             x-on:dragover.prevent="isDropping = true"
             x-on:dragleave.prevent="isDropping = false"
         >
             <div class="absolute top-0 bottom-0 left-0 right-0 z-30 flex items-center justify-center bg-primary opacity-90"
                  x-show="isDropping"
                  >
                  <span class="text-3xl text-white">Release file to upload!</span>
             </div>

             <label
                 class="flex flex-col items-center w-1/2 py-8 bg-white border shadow cursor-pointer text-primary rounded-2xl hover:bg-slate-50"
                 for="file-upload"
                 >
                 <h3 class="text-3xl text-primary">Click here to select files to upload</h3>

                 <em class="italic text-primary">Or drag files onto the page</em>

                 <div class="bg-gray-200 h-[2px] w-1/2 mt-3">
                     <div
                         class="bg-primary h-[2px]"
                         style="transition: width 1s"
                         :style="`width: ${progress}%;`"
                         x-show="isUploading"
                         >
                     </div>
                 </div>
             </label>


             <input type="file" id="file-upload" multiple @change="handleFileSelect" class="hidden" />
        </div>
    </div>

    <div wire:key="view-4" id="view-4" style="display: none;">
        <div class="flex flex-col items-center justify-center w-3/4 mx-auto mt-12 sm:px-6 lg:px-8">
            <div class="w-full overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="w-full">
                        <tbody>
                            <tr>
                                <td class="py-4 text-sm whitespace-nowrap">{{ __('Subject') }}</td>
                                <td class="py-4 text-sm whitespace-nowrap" x-text="subject.id"></td>
                            </tr>

                            <tr>
                                <td class="py-4 text-sm whitespace-nowrap">{{ __('Exam') }}</td>
                                <td class="py-4 text-sm whitespace-nowrap" x-text="exam.id"></td>
                            </tr>

                            <tr>
                                <td class="py-4 text-sm whitespace-nowrap">{{ __('Student') }}</td>
                                <td class="py-4 text-sm whitespace-nowrap" x-text="student.id"></td>
                            </tr>

                            <tr>
                                <td class="py-4 text-sm whitespace-nowrap">{{ __('Number of Transcripts') }}</td>
                                <td class="py-4 text-sm whitespace-nowrap" x-text="files.length"></td>
                            </tr>
                            <tr>
                                <td class="py-4 text-sm whitespace-nowrap">{{ __('Transcripts') }}</td>
                                <td>
                                    <ul>
                                        <template x-for="file in files">
                                            <li>
                                                <span x-text="file.name"></span>
                                            </li>
                                        </template>
                                    </ul>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <button @click="@this.dispatch('submit'); window.location.href = '/transcript/list'" class="w-1/2 py-2 mt-8 text-white rounded-lg bg-primary hover:bg-primary-dark">
                {{ __('Process Transcripts') }}
            </button>
        </div>
    </div>

    <script>
        robotsData = {
            isDropping: false,
            isUploading: false,
            files: [],
            progress: 0,
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
            'transcripts': {
                'complete': false,
                'id': null,
            },
            'finish': {
                'complete': false,
                'id': null,
            },

            'handleFileSelect': function (event) {
                if (event.target.files.length) {
                    this.uploadFiles(event.target.files)
                }
            },

            'handleFileDrop': function (event) {
                if (event.dataTransfer.files.length > 0) {
                    this.uploadFiles(event.dataTransfer.files)
                }
            },

            'uploadFiles': function (files) {
                const $this = this
                this.isUploading = true
                @this.uploadMultiple('files', files,
                    function (success) {
                        $this.isUploading = false
                        $this.progress = 0
                    },
                    function(error) {
                        console.log('error', error)
                    },
                    function (event) {
                        $this.progress = event.detail.progress
                    }
                )

                this.files = files;

                console.log(this.files);

                this.transcripts['complete'] = true;

                this.showNextView();
            },

            'removeUpload': function (filename) {
                @this.removeUpload('files', filename)
            },

            'setProperty': function (property, value) {
                this[property]['complete'] = true;
                this[property]['id'] = value;

                @this.dispatch('setProperty', {key: property, value: value});

                this.showNextView();
            },

            'showNextView': function () {
                const data = [this.subject, this.exam, this.student, this.transcripts, this.finish];

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
            },

            'gotoView': function (id) {
                const data = [this.subject, this.exam, this.student, this.transcripts];

                if (data[id]['complete'] === false) {
                    return;
                }

                // Set all views after the current view to incomplete
                const keys = ['subject', 'exam', 'student', 'transcripts'];

                id = parseInt(id, 10);

                // Set all views after the current view to incomplete
                for (let i = id; i < keys.length; i++) {
                    this[keys[i]]['complete'] = false;
                }

                // Hide all other views
                document.querySelectorAll('[id^="view-"]').forEach(function (element) {
                    element.style.display = 'none';
                });
                // Show the selected view
                const selectedView = document.getElementById('view-' + id);

                if (selectedView) {
                    selectedView.style.display = 'grid';
                }
            }
        }
    </script>
</div>
