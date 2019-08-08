<?php

namespace App\Entities;

use Jenssegers\Mongodb\Eloquent\Model;

class Book extends Model
{
    
     protected $hidden = ['_id'];
     protected $collection = 'books';
     protected $connection = 'mongodb';
}
