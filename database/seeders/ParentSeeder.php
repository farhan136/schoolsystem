<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ortu;
use Faker\Factory as Faker;

class ParentSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');

        // insert data ke table parent menggunakan Faker
        for($i = 0; $i<=100; $i++){
            $newParent = new Ortu;
            $newParent->name =$faker->name;
            $newParent->registration_number ='34244'.sprintf("%'.05d\n", $i);
            $newParent->phone_number = $faker->phoneNumber();
            $newParent->gender = $faker->randomElement(['male', 'female']);
            $newParent->religion = 'Islam';
            $newParent->marital_status = $faker->randomElement(['single', 'married', 'widow']);
            $newParent->email = $faker->email;
            $newParent->photo = "default.png";
            $newParent->address =$faker->address;
            $newParent->date_of_birth =$faker->dateTimeBetween('-60 years', '-30 years');
            $newParent->place_of_birth =$faker->numberBetween(1, 100);
            $newParent->job = $faker->jobTitle();
            $newParent->save();
        }
    }
}
