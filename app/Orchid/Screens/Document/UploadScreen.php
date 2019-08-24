<?php

namespace App\Orchid\Screens\Document;

use App\Orchid\Layouts\Document\DocumentFormLayout;
use App\Orchid\Layouts\User\UserEditLayout;
use Illuminate\Http\Request;
use Orchid\Attachment\Models\Attachment;
use Orchid\Screen\Link;
use Orchid\Screen\Screen;

class UploadScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Adicionando Documento';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'Por favor adicione o seu documento';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [];
    }

    /**
     * Button commands.
     *
     * @return Link[]
     */
    public function commandBar(): array
    {
        return [
             Link::name('Voltar')
                    ->link(route('documents.index'))
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
            DocumentFormLayout::class
        ];
    }

    public function destroy($id)
    {
        //$storage = $request->get('storage', 'public');
       // Attachment::findOrFail($id)->delete();

        //return back();
    }
}
