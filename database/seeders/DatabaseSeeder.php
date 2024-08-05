<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users=[
            [
                "id"=>1,
                "username"=>"younes",
                "name"=>"younes",
                "email"=>"younes@gmail.com",
                "password"=>Hash::make("12345678"),
            ]
        ];
        foreach ($users as $user) {
            User::firstOrCreate([
                "id"=>$user["id"],
            ],[
                "id"=>$user["id"],
                "username"=>$user["username"],
                'name'=>$user["name"],
                'email'=>$user["email"],
                'password'=>$user["password"],
            ]);
        }
    }
}
