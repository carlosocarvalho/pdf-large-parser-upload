<?php

namespace App\Http\Controllers;

use App\Entities\Document;
use Illuminate\Http\Request;
use Orchid\Attachment\Models\Attachment;

class AttachmentOrchidController extends Controller
{
    //



    public function destroy(int $id, Request $request)
    {
        
       $storage = $request->get('storage', 'public');
       Attachment::findOrFail($id)->delete($storage);

       return back();
    }
}
