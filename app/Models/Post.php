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
        'order'
    ];

    protected $casts = [
        'options' => 'array',
        'images' => 'array',
        'fields' => 'array'
    ];

    public function fields($field)
    {
        return $this->fields[$field] ?? null;
    }
}
