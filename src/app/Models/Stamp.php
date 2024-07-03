<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stamp extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'type', 'timestamp'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function workBreaks()
    {
        return $this->hasMany(workBreak::class, 'attendance_id','id');
    }
}
