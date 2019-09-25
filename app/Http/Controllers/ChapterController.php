<?php

namespace App\Http\Controllers;

use App\Entities\Book;
use Illuminate\Http\Request;
use App\Entities\Chapter;
use App\Entities\Document;
use App\Http\Resources\DocumentResource;

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
        $search = strlen($search) == 0 || $search == null ? '*' : $search;
        $rawSearch = [
            'aggs' => [
                'parent_id' => [
                    'terms' => [
                        'field' => 'parent_id',
                        'size'  => 40
                    ]
                ]
            ],
            'size' => 1
        ];

        if ($search && $search != '*') {
            $queryArray = [
                'query' =>   [
                    'bool' => [
                        'must' => [
                            'query_string' => [
                                'fields' => ['book.title', 'body'],
                                'query' => sprintf('%s*', $search),
                                'default_operator' => 'AND'
                            ]

                        ]
                    ]
                ]
            ];
            $rawSearch = array_merge($rawSearch, $queryArray);
        }

        //dump($rawSearch);
        $data = Chapter::searchRaw($rawSearch);
        $itens = [];

        foreach($data['aggregations']['parent_id']['buckets'] as $row)
        {
            $itens[] = $row['key'];
        }

        return  DocumentResource::collection(Document::whereIn('name', $itens)->paginate(20));
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
