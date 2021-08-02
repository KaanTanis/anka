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
    public function projects(): array
    {
        return Page::make('Projeler', [
            Input::make('Görseller', 'images')
                ->multiple()
                ->type('file'),

            Input::make('Kapak', 'cover')
                ->type('file'),

            Input::make('Proje başlama tarihi', 'start_date'),
            Input::make('Proje tahmini bitiş', 'end_date'),
        ]);
    }
}
