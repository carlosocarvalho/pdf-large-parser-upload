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

    protected $exists;


    /**
     * get Document Created or First
     */
    public function get()
    {
        $document = $this->findOrCreate();
        //$document->increment('version', 1);
        return $document;
    }

    public function exists()
    {   $has = false;
        if ($this->filters) {
            $document = $this->model->newQuery();
            foreach ($this->filters as $k => $v) {
                $document->where($k, $v);
            }
            $data = $document->get();
            $count = $data->count();
            if ($count > 0) {
                $this->exists = $data->first();
                $has = true;
            }
        }
        return $has;
    }

    public function create(){
        $document = $this->model;
        $this->fill($document, $this->data);
        $document->save();
    }
    public function update(){
        $document = $this->exists;
        $this->fill($document, $this->data);
        $document->save();
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

        
        return $this->create();
    }

    private function fill(&$model, $data)
    {
        foreach ((array) $data  as $k => $v) {
            $model->{$k} = $v;
        }
    }
}
