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
    public function slider()
    {
        return Page::make('Galeri', [
            Input::make('Test', 'test'),
            Input::make('Galeri', 'gallery')->multiple()->type('file')
        ]);
    }

}
