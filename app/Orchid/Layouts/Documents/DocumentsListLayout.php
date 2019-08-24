<?php

namespace App\Orchid\Layouts\Documents;

use App\Entities\Document;
use Orchid\Screen\TD;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\Link;

class DocumentsListLayout extends Table
{
    /**
     * Data source.
     *
     * @var string
     */
    public $data = 'data';

    /**
     * @return TD[]
     */
    public function fields(): array
    {
        return [
            TD::set('original_name', 'Nome'),
            TD::set('created_at', 'Enviado'),
            TD::set('id', '#')->render(function (Document $document) {
                // Please use view('path')
                $route = route('documents.delete', $document);
                
                return "<a href='{$route}'>Remove</a>";
            })
        ];
    }
}
