<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'text_1',
        'text_2',
        'button_text',
        'button_action',
        'cover',
        'order',
        'description'
    ];
}
