<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImagesUser extends Model
{
    protected $fillable = [
        'images_id', 'user_id',
    ];

    public $timestamp = false;
}
