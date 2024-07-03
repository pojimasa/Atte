<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkBreak extends Model
{
    use HasFactory;

    protected $fillable = [
        'attendance_id',
        'break_start_time',
        'break_end_time',
    ];

    public function stamp()
    {
        return $this->belongsTo(Stamp::class, 'attendance_id');
    }
}
