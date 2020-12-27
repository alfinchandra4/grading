<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SqQuestion extends Model
{
    use HasFactory;

    protected $table = 'sq_questions';
    protected $guarded = [];

    public function sq_category() {
        return $this->belongsTo(SqCategory::class, 'id');
    }
}
