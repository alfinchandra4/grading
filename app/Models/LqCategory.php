<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LqCategory extends Model
{
    use HasFactory;

    protected $table = 'lq_categories';
    protected $guarded = [];

    public function lq_question () {
        return $this->hasMany(LqQuestion::class, 'lq_category_id', 'id');
    }
}
