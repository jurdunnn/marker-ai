<x-slot name="header">
    {{ __('Transcript for ' . $transcript->student->name . ' - ' . $transcript->status->name) }}
</x-slot>

<x-slot name="headerButtons">
    <button onclick="location.href='{{ route('transcript.edit', ['transcript' => $transcript->id]) }}'"  class="header-button">
        {{ __('Edit Transcript') }}
    </button>

    <div>
        <button onclick="Livewire.dispatch('rerunTranscribe')" class="header-button" {{ $transcript->text ? 'disabled' : '' }}>
        {{ __('Retry Transcribe') }}
        </button>
    </div>

    <div>
        <button onclick="Livewire.dispatch('rerunAnalysis')" class="header-button">
        {{ __('Retry Analysis') }}
        </button>
    </div>
</x-slot>

<script>
    function openErrorModal() {
        setTimeout(function() {
            const selection = window.getSelection();
            const selectedText = selection.toString().trim();

            if (selectedText.length > 0) {
                Livewire.dispatch('openErrorModal', { text: selectedText });

                const errorModal = document.getElementById('error-modal');

                // Set errorModal.style.top and left to be above the selected text
                const range = selection.getRangeAt(0);

                const rect = range.getBoundingClientRect();

                // Function to calculate the total offset of an element
                function getTotalOffset(elem) {
                    let top = 0, left = 0;
                    do {
                        top += elem.offsetTop || 0;
                        left += elem.offsetLeft || 0;
                        elem = elem.offsetParent;
                    } while (elem);
                    return { top, left };
                }

                // Get the total offset of the range's common ancestor container
                const commonAncestor = range.commonAncestorContainer.nodeType === Node.TEXT_NODE
                    ? range.commonAncestorContainer.parentNode
                    : range.commonAncestorContainer;

                const totalOffset = getTotalOffset(commonAncestor);

                // Calculate the top and left positions, including the total offset
                const modalTop = rect.top + window.scrollY - totalOffset.top - errorModal.offsetHeight - 10;

                const modalLeft = rect.left + window.scrollX + 20% - totalOffset.left + (rect.width / 2) - (errorModal.offsetWidth / 2);

                // Apply the calculated positions to the modal
                errorModal.style.top = `${modalTop}px`;

                errorModal.style.left = `${modalLeft}px`;

                errorModal.classList.remove('invisible');

                // Focus the input
                errorModal.querySelector('input').focus();

                // Add background colour of light grey to the selected text
                const span = document.createElement('span');

                span.style.backgroundColor = '#f3f4f6';

                span.appendChild(range.extractContents());

                span.id = 'selected-text';

                range.insertNode(span);
            }
        }, 10);
    }

    function hideErrorModal() {
        // Hide the modal
        const errorModal = document.getElementById('error-modal');

        errorModal.classList.add('invisible');

        // Remove the background colour of light grey from the selected text
        const span = document.getElementById('selected-text');

        span.style.backgroundColor = 'transparent';

        // Clear the input
        errorModal.querySelector('input').value = '';

        // Reset the errorModalText property
        Livewire.dispatch('resetErrorModalText');
    }

    document.addEventListener('mouseup', openErrorModal);

    document.addEventListener('touchend', openErrorModal);

    document.addEventListener('keyup', function(event) {
        if (event.key === 'Shift' || event.key === 'Control' || event.key === 'Meta' || event.key.startsWith('Arrow')) {
            openErrorModal();
        }
    });

    document.addEventListener('keyup', function(event) {
        if (event.key === 'Escape') {
            hideErrorModal();
        }
    });
</script>

<div>
    <div>
        <x-container>
            <h2 class="text-xl font-semibold">{{ __('Transcript Information') }}</h2>

            <table class="w-full">
                <tbody>
                    <tr>
                        <td class="py-4 text-sm whitespace-nowrap">{{ __('URL') }}</td>
                        <td class="py-4 text-sm whitespace-nowrap">{{ $transcript->url }}</td>
                    </tr>
                    <tr>
                        <td class="py-4 text-sm whitespace-nowrap">{{ __('Student') }}</td>
                        <td class="py-4 text-sm whitespace-nowrap">{{ $transcript->student->name }}</td>
                    </tr>

                    <tr>
                        <td class="py-4 text-sm whitespace-nowrap">{{ __('Subject') }}</td>
                        <td class="py-4 text-sm whitespace-nowrap">{{ $transcript->subject->name }}</td>
                    </tr>

                    <tr>
                        <td class="py-4 text-sm whitespace-nowrap">{{ __('Status') }}</td>
                        <td class="py-4 text-sm whitespace-nowrap">{{ $transcript->status->name }}</td>
                    </tr>

                    <tr>
                        <td class="py-4 text-sm whitespace-nowrap">{{ __('Exam') }}</td>
                        <td class="py-4 text-sm whitespace-nowrap">{{ $transcript->exam->name }}</td>
                    </tr>
                </tbody>
            </table>
        </x-container>
    </div>

    <div class="relative mt-8">
        <x-image-and-container image="{{ $transcript->url }}">
            <div id="error-modal" class="absolute invisible w-1/4 shadow-xl">
                <form id="error-form" class="z-10 relative flex flex-row bg-white shadow-xl rounded-md">
                    <input
                        type="text"
                        id="error-modal-input"
                        class="w-full px-4 text-sm border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                        placeholder="{{ __('Write a new error for this sentence') }}"
                        >
                        <button type="submit" class="absolute top-0 right-0 px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-r-md hover:bg-blue-500">
                            {{ __('Add Error') }}
                        </button>
                </form>

                <script>
                    // This script handles the form submission for the error modal
                    document.getElementById('error-form').addEventListener('submit', function(event) {
                        event.preventDefault();

                        var inputValue = document.getElementById('error-modal-input').value;

                        Livewire.dispatch('addToAnalysis', { text: inputValue });

                        hideErrorModal();

                        setTimeout(function() {
                            window.location.reload(true);
                        }, 500);
                    });

                </script>

                <script>
                    // This script handles the click event on sentences to remove them from the analysis
                    document.addEventListener('DOMContentLoaded', function() {
                        const sentenceErrors = document.querySelectorAll('[id^="sentence-error"]');
                        sentenceErrors.forEach(function(element) {
                            const sentence = element.textContent;
                            element.addEventListener('click', function() {
                                var deleteButtons = document.querySelectorAll('.delete-btn');

                                if ((!this.nextElementSibling || !this.nextElementSibling.classList.contains('delete-btn')) && deleteButtons.length == 0) {
                                    var deleteButton = document.createElement('button');

                                    deleteButton.textContent = 'Delete';

                                    deleteButton.className = 'delete-btn';

                                    element.appendChild(deleteButton);
                                }

                                if (deleteButtons.length > 0) {
                                    deleteButtons[0].addEventListener('click', function(event) {
                                        event.stopPropagation();

                                        removeDeleteButtons();

                                        Livewire.dispatch('deleteSentence', { sentenceToDelete: sentence });

                                        setTimeout(function() {
                                            window.location.reload(true);
                                        }, 500);
                                    });
                                }
                            });
                        });
                    });

                    function removeDeleteButtons() {
                        var deleteButtons = document.querySelectorAll('.delete-btn');

                        deleteButtons.forEach(function(element) {
                            element.remove();
                        });
                    }
                </script>
            </div>

            @if ($transcript->text)
                <div class="prose">
                    {!! nl2br($transcript->analysed_transcript) !!}
                </div>
            @else
                <div class="p-6 text-gray-900">
                    {{ __('No transcript text available.') }}
                </div>
            @endif
        </x-image-and-container>
    </div>
</div>
