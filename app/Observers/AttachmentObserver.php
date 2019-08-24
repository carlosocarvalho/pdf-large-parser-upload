<?php

namespace App\Observers;


use App\Jobs\UnSearchableJob;
use App\Jobs\UpdateSearchAttachment;
use Orchid\Attachment\Models\Attachment;

class AttachmentObserver
{
    //x

    /**
     * Handle the User "deleted" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function deleted(Attachment $attachment)
    {
        
        UnSearchableJob::dispatch($attachment->name);
        
    }

    public function updated(Attachment $attachment)
    {
           UpdateSearchAttachment::dispatch($attachment);
    }
}
