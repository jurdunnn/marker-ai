<?php

namespace App\Livewire;

use App\Models\Transcription;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class VisionSandbox extends Component
{
    public string $url;
    public ?string $response = null;

    public function mount()
    {
        $this->url = auth()->user()->transcriptions()->latest()->first()?->url ?? "";
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
            'transcription' => $response->json()['choices'][0]['message']['content'],
            'tokens' => $response->json()['usage']['total_tokens'],
        ]);

        $this->response = $response->json()['choices'][0]['message']['content'];
    }

    public function analyse(Transcription $transcription)
    {
        $key = config('openai.api_key');

        $model = 'gpt-4';

        $request = [
            "model" => $model,
            "messages" => [
                (object) [
                    "role" => "system",
                    "content" => "Output JSON the grammatical errors of this transcription. Provide information such as the position (starting character and ending character position e.g 6-12) of each grammatical error. Provide a description of each error."
                ],
                (object) [
                    "role" => "user",
                    "content" => $transcription->transcription
                ]
            ],
            "max_tokens" => 4096,
        ];

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $key,
            'Content-Type' => 'application/json'
        ])->post('https://api.openai.com/v1/chat/completions', $request);
    }
}
