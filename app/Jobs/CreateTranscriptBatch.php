<?php

namespace App\Jobs;

use App\Models\Transcription;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class CreateTranscriptBatch implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(protected Collection $filePaths, protected array $properties)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info('Creating new transcript batch');

        foreach ($this->filePaths as $path) {
            Log::info('Creating new transcript for file: ' . $path);

            Transcription::create([
                'user_id' => auth()->id(),
                'subject_id' => $this->properties['subject'],
                'exam_id' => $this->properties['exam'],
                'student_id' => $this->properties['student'],
                'url' => $path,
                'tokens' => 0,
            ]);
        }

        Log::info('Finished creating new transcript batch');
    }
}
