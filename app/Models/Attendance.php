<?php

namespace App\Models;

use App\Traits\Uuids;
use App\Models\Enrollment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attendance extends Model
{
    use HasFactory, Uuids;
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
