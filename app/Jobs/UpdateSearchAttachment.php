<?php

namespace App\Jobs;

use App\Bi\ChapterIndexSearchable;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Orchid\Attachment\Models\Attachment;

class UpdateSearchAttachment implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    protected $attachment;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct( Attachment $attachment)
    {
        $this->attachment = $attachment;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
         ChapterIndexSearchable::index($this->attachment);
    }
}
