<?php

namespace App\Listeners\Documents;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Orchid\Platform\Events\UploadFileEvent;
use Illuminate\Queue\SerializesModels;
use App\Entities\Book;
use App\Bi\BookDocument;
use stdClass;
use App\Bi\ChapterDocument;
use App\Bi\ChapterIndexSearchable;
use App\Bi\Parser\PdfParser;
use Orchid\Support\Facades\Alert;

class UploadListener  implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;
    /*
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $attachment = $event->attachment;
        ChapterIndexSearchable::index($attachment);
    }
}
