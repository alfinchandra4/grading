<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SqCategory extends Model
{
    use HasFactory;

    protected $table = 'sq_categories';
    protected $guarded = [];

    public function sq_question () {
        return $this->hasMany(SqQuestion::class, 'sq_category_id', 'id');
    }
}
