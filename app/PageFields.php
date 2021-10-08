<?php

namespace App;

use App\Fields\Hr;
use App\Fields\Input;
use App\Fields\Page;
use App\Fields\PageFieldMaster;
use App\Fields\Select;
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

    public function product()
    {
        return Page::make('Ürünler', [
            Select::make('Kategori', 'categories')->model('categories'),
            Input::make('Görsel', 'cover')->type('file'),
            Textarea::make('Açıklama', 'description')->tinymce(),
            Textarea::make('İçerik', 'content')->tinymce(),
            Input::make('Gram', 'gram')->col(3),
            Input::make('Adet', 'piece')->col(3),
            Input::make('Ambalaj Türü', 'amb_type')->col(3),
            Input::make('Ürün Grubu', 'prod_group')->col(3),
            Input::make('Ürün Kodu', 'prod_code')->col(3),
            Input::make('Ağırlık', 'weight')->col(3),
            Input::make('Renk Kodu', 'color'),
            Input::make('Galeri', 'images')->type('file')->multiple(),

        ]);
    }

    public function categories()
    {
        return Page::make('Ürün Kategorileri', [
            Input::make('Renk Kodu', 'color'),
        ]);
    }

    public function field()
    {
        return Page::make('Alanlar', [
            Input::make('Hakkımızda Başlık', 'about_title'),
            Textarea::make('Hakkımızda', 'about_content'),
            Input::make('Buton Adı', 'about_button'),
            Input::make('Buton URL', 'about_button_url'),
            Input::make('Hakkımızda Cover', 'about_cover')->type('file'),
            Hr::make()
        ]);
    }

    public function blog()
    {
        return Page::make('Blog', [
            Input::make('Açıklama', 'description'),
            Input::make('Kapak', 'cover')->type('file'),
            Input::make('Banner', 'banner')->type('file'),
            Textarea::make('İçerik', 'content')->tinymce(),
        ]);
    }

    public function page()
    {
        return Page::make('Sayfalar', [
            Input::make('Kapak', 'cover')->type('file'),
            Input::make('Banner', 'banner')->type('file'),
            Textarea::make('İçerik', 'content')->tinymce(),
        ]);
    }


}
