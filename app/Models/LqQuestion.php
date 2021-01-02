<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LqQuestion extends Model
{
    use HasFactory;

    protected $table = 'lq_questions';
    protected $guarded = [];

    public function lq_category() {
        return $this->belongsTo(LqCategory::class, 'id');
    }
}
