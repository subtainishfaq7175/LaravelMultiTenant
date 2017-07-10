<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'MultiTenant',
            'email' => 'admin@multitenant.com',
            'password' => bcrypt('admin'),
        ]);

    }
}
