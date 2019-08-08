<?php

namespace App\Bi;

use App\Bi\Contracts\IndexConfigurator;
use ScoutElastic\Migratable;
use ScoutElastic\IndexConfigurator as C;

class ChapterIndexConfigurator extends C
{
    use Migratable;

    protected $name = 'books';
    /**
     * @var array
     */
    protected $settings = [
        'analysis' => [
            'analyzer' => [
                'pt_bra' => [
                    'type' => 'custom',
                    "tokenizer" => "standard",
                    'stopwords' => '_brazilian_',
                    'filter' => [
                        'asciifolding',
                        'lowercase',
                        'trim'
                    ]
                ]
            ]
        ]
    ];
}
