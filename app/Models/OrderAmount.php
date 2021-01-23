<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderAmount extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'order_amounts';

    protected $guarded = ['id'];
}
