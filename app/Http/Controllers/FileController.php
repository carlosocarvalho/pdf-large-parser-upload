<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
 
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
        try{ 
            $request->validate([
                'file' => 'required',
            ]);
     
            $fileName = time().'.'.request()->file->getClientOriginalExtension();
     
            request()->file->move(public_path('files'), $fileName);
            return response()->json(['success'=>'Seu arquivo foi enviado com successo']);

        }catch(\Exception $e){
           return response()->json(['message' => 'Ops houve um ero', 'code'=>$e->getCode()], 400);
        }
        
 
        
    }
}