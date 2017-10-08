<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    private $tables = [
        'users',
        'password_resets'
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->cleanDataBase();

        $this->call(UsersSeeder::class);
        $this->call(ChallengesSeeder::class);
    }

    public function cleanDataBase()
    {
        //disable foreign key check for this connection before truncating tables
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        foreach ($this->tables as $tableName){
            DB::table($tableName)->truncate();
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
