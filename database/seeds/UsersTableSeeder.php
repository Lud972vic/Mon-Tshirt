<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
//        $user = new User();
//        $user->name = "ludo";
//        $user->email = "ludo@localhost.fr";
//        $user->password = Hash::make('123456789');
//        $user->save();
//        $user->roles()->attach(1);

        $user = new User();
        $user->name = "Bob l'éponge";
        $user->email = "bobeponge@gmail.com";
        $user->password = Hash::make('123456789');
        $user->save();
        $user->roles()->attach(2);
    }
}
