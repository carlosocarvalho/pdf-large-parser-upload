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

class FileLargeIndexJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

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
        $content = Storage::get(sprintf('files/%s', $this->filename));
        $parser = new \Smalot\PdfParser\Parser();
        $pdf = $parser->parseFile(sprintf('%s/%s', storage_path('app/files'),$this->filename));

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
        
        $book = array_merge($book, ['title' => $title ]);

        $doc = (new BookDocument((object) $book))->get();
        $i  = 1;
        foreach ($pdf->getPages() as $k => $p) {
            $content = preg_replace('#(\r|\n|\t)+#',' ',$p->getText());
            if( empty(trim($content)) ) continue;
            $chapter = new Chapter();
            $chapter->body =  $content;
            $chapter->raw  = $p->getText();
            $chapter->page = $i;
            $chapter->parent_id = $doc->_id;
            $chapter->book = $doc->toArray();
            $chapter->save();
            $i +=1;

           
        }

        //Storage::disk('azure')->put($this->filename, $content);
        Storage::disk('local')->delete('files/'. $this->filename );

    }
}
