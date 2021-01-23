<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PrintFormat extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'print_formats';

    protected $guarded = ['id'];
}
