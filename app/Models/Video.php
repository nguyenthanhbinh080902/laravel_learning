<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'videos';
    protected $filltable = [
        'title', 'description', 'slug', 'link', 'status', 'image'
    ];
}
