<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'type',
        'fields',
        'order',
        'lang',
        'parent_id'
    ];

    protected $casts = [
        'fields' => 'array'
    ];

    public function field($field, $forceLang = null)
    {
//        return $this->fields[$field] ?? null;

        return $this->where('lang', $forceLang ?? app()->getLocale())
                ->where('parent_id', $this->id)
                ->first()
                ->fields[$field]
            ?? ($this->fields[$field]  ?? null);
    }

    public function _lang($lang)
    {
        return $this->where('lang', $lang)->where('parent_id', $this->id)->first();
    }

    public function translate($field, $forceLang = null)
    {
        return $this->where('lang', $forceLang ?? app()->getLocale())
            ->where('parent_id', $this->id)
            ->first()
            ->$field
            ?? $this->$field;
    }
}
