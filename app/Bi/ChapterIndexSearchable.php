<?php

namespace App\Bi;

use Orchid\Attachment\Models\Attachment;
use stdClass;
use App\Bi\ChapterDocument;
use App\Bi\Parser\PdfParser;
use Orchid\Alert\Alert;
use App\User;
use Orchid\Platform\Notifications\DashboardNotification;

class ChapterIndexSearchable
{


    public static function index(Attachment $attachment)
    {


        $filename = storage_path(sprintf(
            'app/%s/%s/%s.%s',
            $attachment->disk,
            $attachment->path,
            $attachment->name,
            $attachment->extension
        ));
        $pdf = (new PdfParser($filename))->parserInstance();
        $i  = 1;
        $indexed = false;
        foreach ($pdf->getPages() as $k => $p) {
            $content = preg_replace('#(\r|\n)+#', ' ', $p->getText());
            $content = preg_replace('#(\t)+#', '', $content);
            if (empty(trim($content))) continue;
            $chapter = new stdClass;
            $chapter->body =  $content;
            $chapter->raw  = $p->getText();
            $chapter->page = $i;
            $chapter->parent_id = $attachment->name;
            $chapter->book = (object) $attachment->toArray();
            $document = (new ChapterDocument($chapter));
            $exists = $document->exists();
            if ($exists) {
                $document->update();
                $i += 1;
                //$indexed = true;
            } else {
                $document->create();
                $indexed = true;
                $i += 1;
            }
            
        }

        if ($indexed) {
            $user = User::find($attachment->user_id);
            $user->notify(new DashboardNotification([
                'title'   => 'Documento indexado',
                'message' => sprintf('O documento %s foi importado com sucesso %s paginas indexados', $attachment->original_name, $i),
                'type'    =>  DashboardNotification::SUCCESS,
            ]));

        }
        //$attachment->pages = $i;

        //$attachment->save();
    }
}
