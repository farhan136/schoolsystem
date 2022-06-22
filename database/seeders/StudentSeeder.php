<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Student;
use Faker\Factory as Faker;

class StudentSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');

        // insert data ke table student menggunakan Faker
        for($i = 0; $i<=1100; $i++){
            $newStudent = new Student;
            $newStudent->name =$faker->name;
            $newStudent->registration_number ='24434'.sprintf("%'.05d\n", $i);
            $newStudent->phone_number = $faker->phoneNumber();
            $newStudent->gender = $faker->randomElement(['male', 'female']);
            $newStudent->religion = 'Islam';
            $newStudent->email = $faker->email;
            $newStudent->photo = "default.png";
            $newStudent->address =$faker->address;
            $newStudent->date_of_birth =$faker->dateTimeBetween('-21 years', '-14 years');
            $newStudent->place_of_birth =$faker->numberBetween(0, 100);
            $newStudent->parent_id =$i;
            $newStudent->class_id =$faker->numberBetween(0, 30);
            $newStudent->save();
        }
    }
}
