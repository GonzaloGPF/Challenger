<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\User::class, 10)->create();

        $user = \App\User::find(1);
        $user->email = 'mail@mail.com';
        $user->confirmed = true;
        $user->save();
    }
}
