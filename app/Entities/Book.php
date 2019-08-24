<?php

namespace App\Entities;

use Jenssegers\Mongodb\Eloquent\Model;

class Book extends Model
{
    
     protected $hidden = ['_id'];
     protected $collection = 'documents';
     protected $connection = 'mongodb';


     public function fillable($data){

          foreach($data as $k => $v){
               $this->{$k} = $v;
          }

          return $this;
     }
}
