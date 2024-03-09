<?php

namespace App\Models;

use App\Models\Enrollment;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'enrollment_id',
        'date',
        'status'
    ];

    //relationship definition
    public function enrollment()
    {
        return $this->belongsTo(Enrollment::class);
    }
}
