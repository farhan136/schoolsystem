<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Employee;
use Faker\Factory as Faker;

class EmployeeSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');

        // insert data ke table employee menggunakan Faker
        for($i = 0; $i<=100; $i++){
            $newEmployee = new Employee;
            $newEmployee->name =$faker->name;
            $newEmployee->registration_number ='42443'.sprintf("%'.05d\n", $i);
            $newEmployee->phone_number = $faker->phoneNumber();
            $newEmployee->gender = $faker->randomElement(['male', 'female']);
            $newEmployee->religion = 'Islam';
            $newEmployee->marital_status = $faker->randomElement(['single', 'married', 'widow']);
            $newEmployee->email = $faker->email;
            $newEmployee->photo = "default.png";
            $newEmployee->address =$faker->address;
            $newEmployee->date_of_birth =$faker->dateTimeBetween('-60 years', '-30 years');
            $newEmployee->place_of_birth =$faker->numberBetween(1, 100);
            $newEmployee->save();
        }
    }
}
