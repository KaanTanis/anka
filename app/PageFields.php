<?php

namespace App;

use App\Fields\Input;
use App\Fields\Page;
use App\Fields\PageFieldMaster;
use App\Fields\Textarea;
use Illuminate\Support\Arr;

/**
 * Class PageFields
 * @package App
 */
class PageFields extends PageFieldMaster
{
    /**
     * @return array
     */
    public function gallery(): array
    {
        return Page::make('Galeri', [
            Input::make('Görseller', 'images[]')
                ->multiple()
                ->type('file'),

            Input::make('Kapak', 'cover')
                ->type('file'),
        ]);
    }
}
