<?php

namespace App\Models;

use App\Models\Enrollment;
use Illuminate\Database\Eloquent\Model;

class School_Class extends Model
{

    protected $table = 'classes';

    //access modifiers :
    //1. Public - property or method is accessible from anywhere within the class and from the external code.
    //2. Protected - property or method is accessible within the class and its subclasses.
    //3. Private - property or method is accessible within the class and cannot be accessed from outside the class or its subclasses.

    //protected means that the property can only be accessed within its class or its sub classes
    protected $fillable = [
        'name',
        'description'
    ];

    //one to many relationship
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }
}
