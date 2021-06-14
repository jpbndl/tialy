<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();  
        DB::table('users')->insert([
            [
                'username' => 'admin',
                'password' => bcrypt('m1ddl300t'),
                'email' => ''
            ]
        ]);
    }
}
