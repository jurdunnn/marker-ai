<div>
    <form wire:submit.prevent="run">
        <div class="form-group">
            <label for="request">Request:</label>
            <input type="text" class="form-control" id="request" wire:model="url">
        </div>
        <div class="form-group">
            <label for="response">Response:</label>
            <p>
                {{ $response }}
            </p>
        </div>
        <button type="submit" class="btn btn-primary">
            @if ($response)
                Run Again
            @else
                Run
            @endif
        </button>
    </form>

    @if (auth()->user()?->transcriptions)
        <div class="mt-5">
            <h1 class="text-3xl font-bold underline">Transcriptions</h1>

            <div class="mt-5">
                @foreach (auth()->user()->transcriptions as $transcription)
                    <div class="px-4 mb-5">
                        <div class="flex justify-between">
                            <div>
                                <h2 class="font-bold">{{ $transcription->id }} - Tokens: {{ $transcription->tokens }}</h2>

                                <h3 class="font-bold">{{ $transcription->url }}</h3>
                            </div>

                            <button class="px-4 py-2 text-white bg-blue-600 shadow-xl border-1 rounded-xl" wire:click="analyse({{ $transcription->id }})">
                                Analyse
                            </button>
                        </div>

                        <div class="flex flex-row gap-x-4 mt-4">
                            <img src="{{ $transcription->url }}" alt="">

                            <div class="flex flex-col gap-y-8">
                                <div class="p-4 bg-gray-300 shadow-xl">
                                    <h3 class="font-bold">Transcript</h3>

                                    <p>
                                        {{ $transcription->text }}
                                    </p>
                                </div>

                                @if ($transcription->analysis)
                                    <div class="p-4 bg-gray-300 shadow-xl">
                                        <h3 class="font-bold">Analysis</h3>

                                        @foreach ($transcription->analysis->errors as $error)
                                            <p>
                                                {{ $error['error_position'] }}: {{ $error['description'] }}
                                            </p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
