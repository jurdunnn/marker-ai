<?php

namespace App\Jobs;

use App\Models\Analysis;
use App\Models\Transcription;
use App\Models\TranscriptionStatusType;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AnalyseTranscript implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(protected Transcription $transcript)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $key = config('openai.api_key');

        $model = 'gpt-4';

        $this->transcript->update([
            'status_id' => TranscriptionStatusType::where('name', 'Analysing')->first()->id
        ]);

        if ($this->transcript->text === null) {
            Log::info('Transcript ' . $this->transcript->id . ' has no text to analyse');

            $this->updateStatus(TranscriptionStatusType::where('name', 'Error')->first()->name);

            return;
        } elseif (str_word_count($this->transcript->text) > 400) {
            Log::info('Transcript ' . $this->transcript->id . ' has too many words to analyse');

            $this->updateStatus(TranscriptionStatusType::where('name', 'Error')->first()->name);

            return;
        }

        Log::info('Analyzing transcript ' . $this->transcript->id . ' with ' . $model . ' model');

        $request = [
            "model" => $model,
            "messages" => [
                (object) [
                    "role" => "system",
                    "content" => "Output a JSON object (Which, I will use with PHP to convert to an array) of the grammatical and spelling errors of this transcription. Provide each word relevant to the grammatical error as a sentence, so that I may identify where the grammatical error is. Provide a description of each error. Be sure to look out for the capitalization of words. Strictly do not report that there are no grammatical errors. If there are no errors, then skip. Try to avoid reporting on errors within quotation marks, such as 'everything was in vicks', as this is a quote from a book. The JSON keys returned should be strictly followed: sentence, description"
                ],
                (object) [
                    "role" => "user",
                    "content" => $this->transcript->text
                ]
            ],
            "max_tokens" => 4096,
        ];

        $response = Http::withHeaders([ // Send the request
            'Authorization' => 'Bearer ' . $key,
            'Content-Type' => 'application/json'
        ])->post('https://api.openai.com/v1/chat/completions', $request);


        $content = (array) json_decode($response->json()['choices'][0]['message']['content'], true);

        $errorsCount = count($content);

        if ($errorsCount === 0) {
            $this->updateStatus(TranscriptionStatusType::where('name', 'Error')->first()->name);

            Log::info('No errors found in transcript ' . $this->transcript->id . ', failing job');

            $this->fail(new \Exception('No errors found'));
        }

        Log::info("Transcript {$this->transcript->id} has " . $errorsCount . " errors");

        $normalizeErrorsArray = $this->normalizeErrorsArray($content);

        $jsonText = json_encode($normalizeErrorsArray);

        Analysis::updateOrCreate(
            [
                'transcription_id' => $this->transcript->id,
            ],
            [
                'transcription_id' => $this->transcript->id,
                'text' => $jsonText,
                'tokens' => (int) $response->json()['usage']['total_tokens'],
            ]
        );

        $this->updateStatus(TranscriptionStatusType::where('name', 'Complete')->first()->name);

        Log::info('Finished analysing transcript ' . $this->transcript->id . ' with ' . $model . ' model');
    }

    private function normalizeErrorsArray($array)
    {
        $normalized = [];

        foreach ($array as $key => $value) {
            if (is_array($value) && isset($value['description']) && isset($value['sentence'])) {
                $normalized[] = $value;
            } elseif ($key === 'sentence' && is_array($value)) {
                $normalized = array_merge($normalized, $value);
            } elseif (strpos($key, 'sentence') === 0 && is_array($value)) {
                $normalized[] = $value;
            }
        }

        return $normalized;
    }

    private function updateStatus($status)
    {
        $this->transcript->update([
            'status_id' => TranscriptionStatusType::where('name', $status)->first()->id
        ]);
    }
}
