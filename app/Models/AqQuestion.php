<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AqQuestion extends Model
{
    use HasFactory;

    protected $table = 'aq_questions';
    protected $guarded = [];

    public function aq_category() {
        return $this->belongsTo(AqCategory::class, 'id');
    }
}
