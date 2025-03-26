<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Setting extends Model implements HasMedia
{

    use HasTranslations, InteractsWithMedia;

    // public function registerMediaCollections(): void
    // {
    //     $this->addMediaCollection('logo')->singleFile();
    //     $this->addMediaCollection('logo2')->singleFile();
    // }

    protected $guarded = ['id'];
    public $translatable = ['name', 'description', 'notes_and_suggestions', 'footer_description', 'footer_description2'];
}
