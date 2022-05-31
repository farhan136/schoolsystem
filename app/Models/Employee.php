<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'registration_number',
        'name',
        'email',
        'phone_number',
        'religion',
        'marital_status',
        'photo',
        'gender',
        'place_of_birth',
        'date_of_birth',
        'address',
    ];
}
