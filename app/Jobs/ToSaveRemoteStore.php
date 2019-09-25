<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Storage;
use Orchid\Attachment\Models\Attachment;

class ToSaveRemoteStore implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    public $timeout = 0;

    private $attachment;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Attachment $attachment)
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
        $attachment = $this->attachment;
        if (config('app.backup_file')) {
            $filename = sprintf(
                '%s/%s.%s',
                $attachment->path,
                $attachment->name,
                $attachment->extension
            );
            $content = Storage::disk($attachment->disk)->get($filename);
            Storage::disk(config('app.backup_store'))->put(sprintf('%s/%s',config('app.backup_file_client_name') ,$filename), $content);
        }
    }
}
