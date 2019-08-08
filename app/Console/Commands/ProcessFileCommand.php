<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ProcessFileCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pl:next {file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $parser = new \Smalot\PdfParser\Parser();
        $file = public_path('files/1565060173.pdf');
        //$file = public_path('files/1565059831.pdf');

        $pdf = $parser->parseFile($file);

        //echo $pdf->getText();


        // $pages  = $pdf->getPages();
        // foreach($pages as $p){

        //     dump($p->getText());
        // }
        // Loop over each page to extract text.
        // foreach ($pages as $page) {
        //     echo $page->getText();
        // }
        // foreach($pdf->getPages() as $p){
        //     $this->info($p->getText());
        // }

        $details  = $pdf->getDetails();

        // // Loop over each property to extract values (string or array).
        foreach ($details as $property => $value) {
            if (is_array($value)) {
                $value = implode(', ', $value);
            }
            echo $property . ' => ' . $value . "\n";
        }
    }
}
