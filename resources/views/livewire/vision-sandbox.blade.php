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

    <div class="mt-5">
        <h1 class="font-bold">Transcriptions</h1>

        <div class="mt-5">
            @foreach (auth()->user()->transcriptions as $transcription)
                <div class="mb-5">
                    <h2 class="font-bold">{{ $transcription->id }} - Tokens: {{ $transcription->tokens }}</h2>

                    <h3 class="font-bold">{{ $transcription->url }}</h3>

                    <div class="flex flex-row">
                        <img src="{{ $transcription->url }}" alt="">

                        <button class="ml-5 btn btn-primary" wire:click="analyse({{ $transcription->id }})">
                            Analyse
                        </button>
                        <p>
                            {{ $transcription->transcription }}
                        </p>
                        @if ($transcription->analysis)
                            <p>
                                {{ $transcription->analysis->analysis }}
                            </p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
