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
        factory(\App\User::class)->states('test')->create();
        factory(\App\User::class)->states('test')->create([
            'name' => 'TestUser2',
            'email' => 'mail2@mail.com'
        ]);
        factory(\App\User::class)->states('test')->create([
            'name' => 'TestUser3',
            'email' => 'mail3@mail.com'
        ]);
        factory(\App\User::class, 10)->create();
    }
}
