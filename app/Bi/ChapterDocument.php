<?php

namespace App\Bi;

use stdClass;

use App\Entities\Chapter;

class ChapterDocument extends  AbstractDocument
{

    

    public function __construct(stdClass $data)
    {
        $this->data = (array) $data;
        $this->model = new Chapter();
        $this->filters = [
            'page' => $data->page,
            'parent_id' => $data->parent_id
        ];
    }

}
