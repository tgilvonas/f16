<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'orders';

    protected $guarded = ['id'];

    protected $casts = [
        'districts' => 'object',
        'distribution_date' => 'date',
    ];

    public function uploads()
    {
        return $this->hasMany(Upload::class, 'order_id');
    }

    public function getFlyerLogos()
    {
        return $this->hasMany(Upload::class, 'order_id')->where('type', 'flyer_logo')->get();
    }

    public function getAdditionalFiles()
    {
        return $this->hasMany(Upload::class, 'order_id')->where('type', 'additional_files')->get();
    }

    public function getFlyerLayoutFiles()
    {
        return $this->hasMany(Upload::class, 'order_id')->where('type', 'flyer_layout_file')->get();
    }
}
