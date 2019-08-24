<?php

namespace App\Orchid\Screens\Document;

use App\Entities\Document;
use App\Orchid\Layouts\Documents\DocumentsListLayout;
use Orchid\Attachment\Models\Attachment;
use Orchid\Screen\Link;
use Orchid\Screen\Screen;

class ListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Documentos';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'documentos indexados';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'data' => Document::paginate()
        ];
    }

    /**
     * Button commands.
     *
     * @return Link[]
     */
    public function commandBar(): array
    {
        return [
            Link::name('Adicionar')
            ->title('Adicionar Documento')
            ->icon('icon-open')
            ->link(  route('documents.upload'))
        ];
    }

    /**
     * Views.
     *
     * @return Layout[]
     */
    public function layout(): array
    {
        return [
            DocumentsListLayout::class
        ];
    }
}
