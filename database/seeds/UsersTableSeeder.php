<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Domains\Users\User::class)->create([
            'name' => 'Ricardo Pires',
            'first_name' => 'Ricardo',
            'last_name' => 'Pires Dall`Oglio',
            'birthday' => '1989-05-22',
            'gender' => 'male',
            'email' => 'ricardo.tech@live.com',
            'password' => bcrypt('123456'),
            'status' => 1
        ]);
    }
}
