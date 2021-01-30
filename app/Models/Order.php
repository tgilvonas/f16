<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Order extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, SoftDeletes;

    protected $table = 'orders';

    protected $guarded = ['id'];

    protected $casts = [
        'districts' => 'object',
    ];

    public function registerMediaCollections(): void
    {
        // if design needed:
        $this->addMediaCollection('flyer_logo')->singleFile();
        $this->addMediaCollection('additional_files');

        // if design not needed:
        $this->addMediaCollection('flyer_layout_file')->singleFile();
    }
}
