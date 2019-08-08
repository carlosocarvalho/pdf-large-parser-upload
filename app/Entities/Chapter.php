<?php

namespace App\Entities;

use App\Bi\Traits\ElasticSearchable as Searchable;
use ScoutElastic\Searchable as SS;
use Jenssegers\Mongodb\Eloquent\Model;
use App\Bi\ChapterIndexConfigurator;

class Chapter extends Model
{
     use SS;
     protected $indexConfigurator = ChapterIndexConfigurator::class;
     protected $mapping = [
          'properties' => [
               'body' => [
                    'type' => 'text',
                    'analyzer' => 'pt_bra',
                    'fielddata' => true
                    // Also you can configure multi-fields, more details you can find here https://www.elastic.co/guide/en/elasticsearch/reference/current/multi-fields.html
               ],
               'page' => [
                    'type' => 'text'
               ],
               'info' => [
                    'type' => 'text',
                    'analyzer' => 'pt_bra',
               ],
               'created_at' => [
                    'type' => 'date',
                    'format' => "yyyy-MM-dd HH:mm:ss"
               ],
               'deleted_at' => [
                    'type' => 'date',
                    'format' => "yyyy-MM-dd HH:mm:ss"
               ],
               'parent_id' => [
                    "type" =>       "keyword",
                    "null_value" => "NULL"
               ],
               'updated_at' => [
                    'type' => 'date',
                    'format' => "yyyy-MM-dd HH:mm:ss"
               ],
               'book' => [
                    'type' => 'nested',
                    
               ]
          ]
     ];
     protected $hidden = ['_id'];
     protected $collection = 'chapters';
     protected $connection = 'mongodb';

     public function getScoutKey()
     {
          return $this->_id;
     }

     public function searchableAs()
     {
          return '_doc';
     }


     public function buildQueryPayload()
     {
          return [
               'must' => [
                    'query_string' => [
                         'fields' => ['book.title', 'body'],
                         'query' => $this->builder->query
                    ]
               ]
          ];
     }
}
