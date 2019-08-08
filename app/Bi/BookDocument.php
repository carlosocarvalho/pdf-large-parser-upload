<?php

namespace App\Bi;

use stdClass;
use App\Entities\Book;

class BookDocument extends  AbstractDocument
{

    

    public function __construct(stdClass $data)
    {
        $this->data = (array) $data;
        $this->model = new Book;
        $this->filters = [
            'ModDate' => $data->ModDate,
            'title'   => $data->title
        ];
    }

    // /**
    //  * get Document Created or First
    //  */
    // public function get(): Book
    // { 
    //       $book = $this->findOrCreate();
    //       //$book->increment('version', 1);
    //       return $book;
    // }
    
    // /**
    //  * Undocumented function
    //  *
    //  * @return Book
    //  */
    // private function  findOrCreate(): Book
    // {
    //      $has = Book::where('ModDate',  $this->detail->ModDate)
    //          ->where('title', $this->detail->title) 
    //          ->get()->first();
    //       if( $has) return $has;

    //       $book = new Book;
    //       foreach((array) $this->detail  as $k => $v)
    //       {
    //           $book->{$k} = $v;
    //       }   
    //       $book->save();
    //       return $book;

    // }
}
