<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SqCategory extends Model
{
    use HasFactory;

    protected $table = 'sq_categories';
    protected $guarded = [];
}
