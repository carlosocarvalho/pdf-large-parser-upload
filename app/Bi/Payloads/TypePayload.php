<?php 

namespace App\Bi\Payloads;


use Exception;
use App\Bi\Traits\ElasticSearchable as Searchable;
use Illuminate\Database\Eloquent\Model;


class TypePayload extends IndexPayload
{
    /**
     * The model.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;
    /**
     * TypePayload constructor.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     * @throws \Exception
     * @return void
     */
    public function __construct(Model $model)
    {
        if (! in_array(Searchable::class, class_uses_recursive($model))) {
            throw new Exception(sprintf(
                'The %s model must use the %s trait.',
                get_class($model),
                Searchable::class
            ));
        }
        $this->model = $model;
        parent::__construct($model->getIndexConfigurator());
        $this->payload['type'] = $model->searchableAs();
        $this->protectedKeys[] = 'type';
    }
}