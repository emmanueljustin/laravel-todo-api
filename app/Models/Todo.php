<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    protected $fillable = [
        'owner_id',
        'title',
        'content',
        'priority_level',
        'is_finished'
    ];

    public function getIsFinishedAttribute($value) {
        return (bool) $value;
    }
}
