<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AqCategory extends Model
{
    use HasFactory;

    protected $table = 'aq_categories';
    protected $guarded = [];

    public function aq_question () {
        return $this->hasMany(AqQuestion::class, 'aq_category_id', 'id');
    }
}
