<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Jobs\FileLargeIndexJob;
use App\Entities\Chapter;
use Elasticsearch\ClientBuilder;

class FileController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('files.form');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request)
    {
        try {
            $request->validate([
                'file' => 'required',
            ]);
            $name = request()->file->getClientOriginalName();
            $name = substr($name, 0, strlen($name)-4);
            $fileName =  sprintf(
                '%s.%s',
                str_slug($name),
                //time(),
                request()->file->getClientOriginalExtension()
            );
            request()->file->storeAs('files', $fileName, 'local');
            dispatch(new FileLargeIndexJob($fileName));
            return response()->json(['success' => 'Seu arquivo foi enviado com successo, aguarde iremos processar os dados']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Ops houve um ero', 'code' => $e->getMessage()], 400);
        }
    }

    public function index()
    {
        $chapters = Chapter::orderBy('updated_at','desc')->all();
        
        return view('book.chapter', compact('chapters'));
    }
}
