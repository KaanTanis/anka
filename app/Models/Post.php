<?php

namespace App\Models;

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

    public function field($field)
    {
        return $this->fields[$field] ?? null;
    }

    public function _lang($lang)
    {
        return $this->where('lang', $lang)->where('parent_id', $this->id)->first();
    }
}
