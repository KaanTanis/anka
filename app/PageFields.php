<?php

namespace App;

use App\Fields\Hr;
use App\Fields\Input;
use App\Fields\Page;
use App\Fields\PageFieldMaster;
use App\Fields\Textarea;
use Faker\Provider\Text;
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
            Input::make(__('Görsel'), 'cover')->type('file'),
            Input::make(__('Kısa açıklama'), 'description'),
            Input::make(__('Buton Adı'), 'button_text')->col(6),
            Input::make(__('Button URL'), 'button_url')->col(6)
        ]);
    }

    public function homePage()
    {
        return Page::make(__('Sayfa Elemanları'), [
            Input::make(__('Özellik 1'), 'feature_1'),
            Input::make(__('Özellik 2'), 'feature_2'),
            Input::make(__('Özellik 3'), 'feature_3'),
            Input::make(__('Özellik 4'), 'feature_4'),

            Hr::make(),

            Input::make('Orta Yazı Başlık 1', 'middle_title_1'),
            Input::make('Orta Yazı Başlık 2', 'middle_title_2'),
            Input::make('Orta Yazı Açıklama', 'middle_description'),

            Hr::make(),

            Textarea::make('Hakkımızda Sayfası', 'about_page_content')->tinymce(),
            Input::make('Hakkımızda Galerisi', 'about_gallery')->type('file')->multiple()
        ], 1);
    }

    public function services()
    {
        return Page::make('Servisler', [
            Input::make('Kapak', 'cover')->type('file'),
            Input::make('Banner', 'banner')->type('file'),
            Input::make('Açıklama', 'description'),
            Textarea::make('İçerik', 'content')->tinymce()
        ]);
    }

    public function pages()
    {
        return Page::make('Sayfalar', [
            Textarea::make('İçerik', 'content')->tinymce(),
            Input::make('Banner Görseli', 'banner')->type('file')
        ]);
    }

    public function yachts()
    {
        return Page::make('Yatlar', [
            Textarea::make('Açıklama', 'description'),
            Textarea::make('İçerik', 'content')->tinymce(),
            Input::make('Uzunluk', 'length')->col(6),
            Input::make('Max Kişi', 'max_people')->col(6),
            Input::make('Fiyat', 'price')->col(6),

        ]);
    }

    /*public function blog()
    {
        return Page::make('Blog', [
            Textarea::make('Kısa Açıklama', 'description')->tinymce(),
            Textarea::make('İçerik', 'content')->tinymce(),
            Input::make('Kapak Görseli', 'cover')->type('file'),
            Input::make('Banner Görseli', 'banner')->type('file')
        ]);
    }*/

}
