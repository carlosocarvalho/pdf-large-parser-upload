<?php

namespace App\Orchid\Layouts\Document;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Layouts\Rows;

class DocumentFormLayout extends Rows
{
    /**
     * Views.
     *
     * @return Field[]
     */
    public function fields(): array
    {
        return [
            Upload::make('file')
            ->acceptedFiles('application/pdf')
        ];
    }
}
