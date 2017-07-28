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
        factory(\App\Domains\User\User::class)->create([
            'name' => 'Ricardo Pires',
            'first_name' => 'Ricardo',
            'last_name' => 'Pires Dall`Oglio',
            'birthday' => '1989-05-22',
            'gender' => \App\Domains\User\User::GENDER_MALE,
            'email' => 'ricardo.tech@live.com',
            'password' => '123456',
            'status' => 1
        ])->each(function ($user) {
            $address = factory(\App\Domains\Address\Address::class)->make();
            $user->address()->save($address);

            $photo = factory(\App\Domains\Photo\Photo::class)->make();
            $user->photo()->save($photo);
        });
    }
}
