<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class About extends Model implements HasMedia
{
    use HasTranslations, InteractsWithMedia;

    protected $guarded = ['id'];
    public $translatable = ['name', 'description', 'meta_title', 'meta_description'];
}
