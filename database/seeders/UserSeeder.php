<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $newUser = new User;
        $newUser->username = "admin123";
        $newUser->registration_number ='424434244342443';
        $newUser->email = "admin123@school.dev";
        $newUser->password = bcrypt('admin123');
        $newUser->role_id =1;
        $newUser->save();
    }
}
