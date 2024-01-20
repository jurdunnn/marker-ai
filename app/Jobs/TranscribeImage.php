<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Transcription;
use Illuminate\Support\Facades\Http;
use App\Models\TranscriptionStatusType;
use Illuminate\Support\Facades\Log;

class TranscribeImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        protected Transcription $transcription
    ) {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $key = config('openai.api_key');

        $model = 'gpt-4-vision-preview';

        Log::info('Running Transcribe Job for Transcription ID: ' . $this->transcription->id . ' with model: ' . $model);

        if ($this->transcription->text) {
            $this->transcription->update([
                'status_id' => TranscriptionStatusType::where('name', 'Complete')->first()->id,
            ]);

            Log::info('Transcript already has text, skipping transcription job for Transcription ID: ' . $this->transcription->id);

            return;
        }

        $this->transcription->update([
            'status_id' => TranscriptionStatusType::where('name', 'Processing')->first()->id,
        ]);

        $request = [
            "model" => $model,
            "messages" => [
                (object) [
                    "role" => "user",
                    "content" => [
                        (object) [
                            "type" => "text",
                            "text" => "Transcribe this handwritten text. Try to maintain any spelling or grammatical errors that are present, do not try to fix any errors. Do not respond with text which is not handwritten. Do not respond with any text acknowledging this prompt. Remove text which is scribbled out, or has a line through it. Do not correct anything which is incorrect."
                        ],
                        (object) [
                            "type" => "image_url",
                            "image_url" => (object) [
                                "url" => $this->transcription->url
                            ]
                        ]
                    ]
                ]
            ],
            "max_tokens" => 4096,
        ];

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $key,
            'Content-Type' => 'application/json'
        ])->post('https://api.openai.com/v1/chat/completions', $request);

        Log::info('Transcription ID: ' . $this->transcription->id . ' Response: ' . $response->body());

        if (key_exists('errors', json_decode($response->body(), true))) {
            $this->transcription->update([
                'status_id' => TranscriptionStatusType::where('name', 'Error')->first()->id,
            ]);
        }

        $this->transcription->update([
            'status_id' => TranscriptionStatusType::where('name', 'Processed')->first()->id,
            'text' => $response->json()['choices'][0]['message']['content'],
            'tokens' => $response->json()['usage']['total_tokens'],
        ]);

        Log::info('Transcription ID: ' . $this->transcription->id . ' Completed');
    }
}
