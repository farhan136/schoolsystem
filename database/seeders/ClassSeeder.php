<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Schoolclass;
use Faker\Factory as Faker;

class ClassSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');

        // insert data ke table Schoolclass menggunakan Faker
        for($i = 0; $i<=26; $i++){
            $newSchoolclass = new Schoolclass;
            $newSchoolclass->name =$faker->city();
            $newSchoolclass->teacher_id =$faker->numberBetween(1, 100);
            $newSchoolclass->isaktif =1;
            $newSchoolclass->save();
        }
    }
}
