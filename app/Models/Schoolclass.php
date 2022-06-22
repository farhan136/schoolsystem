<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schoolclass extends Model
{
    use HasFactory;

    public function teacher()
    {
        return $this->hasOne(Employee::class, 'id', 'teacher_id');
    }
}
