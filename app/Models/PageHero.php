<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageHero extends Model
{
    protected $fillable = ['key', 'label', 'eyebrow', 'title', 'highlight', 'intro', 'image_path'];
}
