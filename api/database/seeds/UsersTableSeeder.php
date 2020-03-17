<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 4)->create();
        // $user = new User();
        // $user->name = "Agustín";
        // $user->email = "peluso.agustin@gmail.com";
        // $user->password = Hash::make("contraseña");
        // $user->save();
    }
}
