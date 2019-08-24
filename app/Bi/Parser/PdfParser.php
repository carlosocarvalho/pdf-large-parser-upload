<?php

namespace App\Bi\Parser;

use Smalot\PdfParser\Parser;

class PdfParser
{

    protected  $filename;
    protected $pdf;
    public function __construct($filename)
    {
        $parser = new Parser();
        $this->pdf = $parser->parseFile(sprintf('%s', $filename));
    }

    public function parserInstance()
    {
        return $this->pdf;
    }
    public function data()
    {
       
    }
}
