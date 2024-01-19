<?php

namespace App\Livewire;

use App\Models\Analysis;
use App\Models\Transcription;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class VisionSandbox extends Component
{
    public string $url;
    public ?string $response = null;

    public function mount()
    {
        $this->url = auth()->user()?->transcriptions()->latest()->first()?->url ?? "";
    }

    public function render()
    {
        return view('livewire.vision-sandbox');
    }

    public function run()
    {
        $key = config('openai.api_key');

        $model = 'gpt-4-vision-preview';

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
                                "url" => $this->url
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

        Transcription::create([
            'url' => $this->url,
            'user_id' => auth()->id(),
            'text' => $response->json()['choices'][0]['message']['content'],
            'tokens' => $response->json()['usage']['total_tokens'],
        ]);

        $this->response = $response->json()['choices'][0]['message']['content'];
    }

    public function analyse(Transcription $transcription)
    {
        $key = config('openai.api_key');

        $model = 'gpt-4';

        return collect(explode('.', $transcription->text)) // Split the text into sentences
            ->filter() // Remove empty sentences
            ->each(function ($item) use ($transcription, $model, $key) { // For each sentence
                $request = [
                    "model" => $model,
                    "messages" => [
                        (object) [
                            "role" => "system",
                            "content" => "Output JSON the grammatical errors of this transcription. Provide information such as the position (starting character and ending character position e.g 6-12) of each grammatical error. Provide a description of each error. The JSON keys returned should be strictly followed: description, error_position."
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

                $analysis = Analysis::where('transcription_id', $transcription->id)->first();

                if (!$analysis) {
                    $analysis = Analysis::create([
                        'transcription_id' => $transcription->id,
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
            });
    }

    function normalizeErrorsArray($array)
    {
        $normalized = [];

        foreach ($array as $key => $value) {
            if (is_array($value) && isset($value['description']) && isset($value['error_position'])) {
                $normalized[] = $value;
            } elseif ($key === 'errors' && is_array($value)) {
                $normalized = array_merge($normalized, $value);
            } elseif (strpos($key, 'error_') === 0 && is_array($value)) {
                $normalized[] = $value;
            }
        }

        return $normalized;
    }
}
