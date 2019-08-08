<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entities\Chapter;

class ChapterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('q', '*');
        $search = strlen($search) == 0 || $search == null ? '*': $search;
      
        $chapter = Chapter::search($search)
                   ->orderBy('updated_at', 'desc');
        
        if ($search && $search != '*') {
            
            $chapter->rule(function ($builder) {
                return [
                    'must' => [
                        'query_string' => [
                            'fields' => ['book.title', 'body'],
                            'query' => $builder->query,
                            'default_operator' => 'AND'
                        ]
                    ]
                ];
            });
        }
        return $chapter->paginate($request->get('limit', 20));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
