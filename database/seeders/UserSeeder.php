<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        $newUser = new User;
        $newUser->username = "pangeranirawan";
        $newUser->registration_number ='4244300030';
        $newUser->email = "prabu.fujiati@yahoo.co.id";
        $newUser->password = bcrypt('pangeranirawan');
        $newUser->role_id =3;
        $newUser->save();
    }
}
