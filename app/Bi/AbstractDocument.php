<?php

namespace App\Bi;

use Jenssegers\Mongodb\Eloquent\Model;

abstract class AbstractDocument
{


    protected $data = [];

    protected $filters = [];
    /**
     * Undocumented variable
     *
     * @var Model
     */
    protected $model;


    /**
     * get Document Created or First
     */
    public function get(): Model
    {
        $document = $this->findOrCreate();
        //$document->increment('version', 1);
        return $document;
    }

    /**
     * Undocumented function
     *
     * @return Book
     */
    private function  findOrCreate()
    {
        if ($this->filters) {
            $document = $this->model->newQuery();
            foreach ($this->filters as $k => $v) {
                $document->where($k, $v);
            }
            $has = $document->get()->first();
            if ($has) return $has;
           
        }
        if( !$this->data) return;

        $document = $this->model;
        foreach ((array) $this->data  as $k => $v) {
            $document->{$k} = $v;
        }
        $document->save();
        return $document;
    }
}
