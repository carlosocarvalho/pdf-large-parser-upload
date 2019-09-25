<?php

namespace App\Jobs;

use App\Entities\Chapter;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Entities\Book;
use App\Bi\BookDocument;
use stdClass;
use App\Bi\ChapterDocument;
use App\Bi\Parser\PdfParser;

class FileLargeIndexJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;

    private $filename;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($filename)
    {
        $this->filename = $filename;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //try {
            //$content = Storage::get(sprintf('files/%s', $this->filename));
            //$parser = new \Smalot\PdfParser\Parser();
            $pdf = (new PdfParser($this->filename))->parserInstance();
            $details  = $pdf->getDetails();
            $book = [];
            $bookCreate = new Book();
            $title = substr($this->filename, 0, strlen($this->filename) - 4);
            foreach ($details as $key => $value) {
                if (is_array($value)) {
                    $value = implode(', ', $value);
                }
                $book[$key] = $value;
                $bookCreate->{$key} = $value;
            }
            $book = array_merge($book, ['title' => $title]);
            $doc = (new BookDocument((object) $book))->get();
            
            $i  = 1;
            
            // foreach ($pdf->getPages() as $k => $p) {
            //     $content = preg_replace('#(\r|\n)+#', ' ', $p->getText());
            //     $content = preg_replace('#(\t)+#', '', $content);
            //     if (empty(trim($content))) continue;
            //     $chapter = new stdClass;
            //     $chapter->body =  $content;
            //     $chapter->raw  = $p->getText();
            //     $chapter->page = $i;
            //     $chapter->parent_id = $doc->_id;
            //     $chapter->book = $doc->toArray();
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
            if (config('app.backup_file')) {
                $content = Storage::get(sprintf('files/%s', $this->filename));
                Storage::disk(config('app.backup_store'))->put($this->filename, $content);
            }
            //if( )
            //Storage::disk('local')->delete('files/' . $this->filename);
            $doc->increment('version', 1);
        // } catch (\Exception $e) { 
        //     logger($e->getMessage());
        // }
    }
}
