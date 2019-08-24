<?php

namespace App\Jobs;

use App\Entities\Chapter;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;


class UnSearchableJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * hash id document
     *
     * @var string
     */
    protected $id;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct( $id )
    {
        $this->id = $id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {  
       
        Chapter::where('parent_id', $this->id)->unsearchable();;
        Chapter::where('parent_id', $this->id)->delete();
    }
}
