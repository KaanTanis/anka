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
        return Page::make('Slider', [
            Input::make('Görsel', 'cover')->type('file'),
            Textarea::make('Açıklama', 'description')->tinymce(),
            Input::make('Buton Yazı', 'button_text'),
            Input::make('Buton Link', 'button_action'),
        ]);
    }

    public function pages()
    {
        return Page::make('Sayfalar', [
            Textarea::make('İçerik', 'content')->tinymce(),
            Textarea::make('Açıklama', 'description'),
            Input::make('Kapak', 'cover')->type('file'),
        ]);
    }

    /**
     * @return array
     */
    public function projects(): array
    {
        return Page::make('Projeler', [
            Input::make('Kapak', 'cover')
                ->type('file'),

            Input::make('Banner', 'banner')
                ->type('file'),

            Textarea::make('Açıklama', 'description'),

            Input::make('Proje başlama tarihi', 'start_date')->col(3),
            Input::make('Proje tahmini bitiş', 'end_date')->col(3),
            Input::make('Daire sayısı', 'apartments')->col(3),
            Input::make('Blok Sayısı', 'blok')->col(3),
            Input::make('Kat', 'floor')->col(3),
            Input::make('Aprtman Tipi', 'apartment_type')->col(3),
            Input::make('Aprtman m2', 'apartment_square')->col(3),
            Input::make('Ticari Alan', 'trade')->col(3),
            Input::make('Arsa Alanı m2', 'landsquare')->col(3),
            Input::make('Adres', 'address')->col(9),
            Input::make('Proje Logosu', 'project_logo')->type('file')->col(6),
            Input::make('Logo Boyutu', 'logo_size')->col(6),
            Input::make('Proje Tipi', 'project_type'),

            Input::make('Görseller', 'images')
                ->multiple()
                ->type('file'),
        ]);
    }
}
