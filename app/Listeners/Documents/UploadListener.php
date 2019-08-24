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
        
        // $filename = storage_path(sprintf(
        //     'app/%s/%s/%s.%s',
        //     $attachment->disk,
        //     $attachment->path,
        //     $attachment->name,
        //     $attachment->extension
        // ));
        // $pdf = (new PdfParser($filename))->parserInstance();
        // $i  = 0;
        // foreach ($pdf->getPages() as $k => $p) {
        //     $content = preg_replace('#(\r|\n)+#', ' ', $p->getText());
        //     $content = preg_replace('#(\t)+#', '', $content);
        //     if (empty(trim($content))) continue;
        //     $chapter = new stdClass;
        //     $chapter->body =  $content;
        //     $chapter->raw  = $p->getText();
        //     $chapter->page = $i + 1;
        //     $chapter->parent_id = $attachment->hash;
        //     $chapter->book = (object) $attachment->toArray();
        //     $document = (new ChapterDocument($chapter));
        //     $exists = $document->exists();
        //     if ($exists) {
        //         $document->update();
        //     }
        //     if (!$exists) {
        //         $document->create();
        //     }
        //     $i += 1;
        // }
        // $attachment->pages = $i;
        // $attachment->save();
        //\Log::info($attachment->toArray());
        /*
            if (config('app.backup_file')) {
                $content = Storage::get(sprintf('files/%s', $this->filename));
                Storage::disk(config('app.backup_store'))->put($this->filename, $content);
            }*/
        //Storage::disk('local')->delete('files/' . $this->filename);
        //$doc->increment('version', 1);
    }
}
