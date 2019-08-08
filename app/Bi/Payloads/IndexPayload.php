<?php 

namespace App\Bi\Payloads;


use Exception;

use Illuminate\Database\Eloquent\Model;
use App\Bi\Contracts\IndexConfigurator;


class IndexPayload extends BasePayload {

    /**
     * The index configurator.
     *
     * @var \ScoutElastic\IndexConfigurator
     */
    protected $indexConfigurator;
    /**
     * IndexPayload constructor.
     *
     * @param App\Bi\Contracts\IndexConfiguratorr $indexConfigurator
     * @return void
     */
    public function __construct(IndexConfigurator $indexConfigurator)
    {
        $this->indexConfigurator = $indexConfigurator;
        $this->payload['index'] = $indexConfigurator->getName();
    }

}