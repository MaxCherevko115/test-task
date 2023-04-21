<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class CreateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [];

        for($i = 0; $i < 40; $i++)
        {
            array_push($users, [
                'name'=>'User_' . $i,
                'email'=>'user'. $i . '@cambotutorial.com',
                'role'=> random_int(0,1),
                'img' => "none",
                'password'=> bcrypt('123456'),
            ]);
        }

        foreach ($users as $key => $user) 
        {
            User::create($user);
        }
    }
}
