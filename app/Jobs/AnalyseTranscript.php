<?php

namespace App\Jobs;

use App\Models\Analysis;
use App\Models\Transcription;
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

        Log::info('Analyzing transcript ' . $this->transcript->id . ' with ' . $model . ' model');

        collect(explode('.', $this->transcript->text)) // Split the text into sentences
            ->filter() // Remove empty sentences
            ->each(function ($item) use ($model, $key) { // For each sentence
                $request = [
                    "model" => $model,
                    "messages" => [
                        (object) [
                            "role" => "system",
                            "content" => "Output JSON the grammatical errors of this transcription. Provide each word relevant to the grammatical error as a sentence, so that I may identify where the grammatical error is. Provide a description of each error. The JSON keys returned should be strictly followed: sentence, description"
                        ],
                        (object) [
                            "role" => "user",
                            "content" => $item
                        ]
                    ],
                    "max_tokens" => 4096,
                ];

                $response = Http::withHeaders([ // Send the request
                    'Authorization' => 'Bearer ' . $key,
                    'Content-Type' => 'application/json'
                ])->post('https://api.openai.com/v1/chat/completions', $request);

                $analysis = Analysis::where('transcription_id', $this->transcript->id)->first();

                if (!$analysis) {
                    $analysis = Analysis::create([
                        'transcription_id' => $this->transcript->id,
                        'text' => json_encode($response->json()['choices'][0]['message']['content']),
                        'tokens' => $response->json()['usage']['total_tokens'],
                    ]);
                } else {
                    $analysisArray = (array) json_decode($analysis->text, true);

                    $additionalContent = (array) json_decode($response->json()['choices'][0]['message']['content'], true);

                    $mergedArray = array_merge($analysisArray, $additionalContent);

                    $normalizeErrorsArray = $this->normalizeErrorsArray($mergedArray);

                    $mergedJsonText = json_encode($normalizeErrorsArray);

                    $analysis->update([
                        'text' => $mergedJsonText,
                        'tokens' => $analysis->tokens + (int) $response->json()['usage']['total_tokens'],
                    ]);
                }

                Log::info('Analysed sentence: ' . $item);
            });

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
}
