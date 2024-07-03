<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'clock_in_time', 'clock_out_time', 'date','type', 'timestamp'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
