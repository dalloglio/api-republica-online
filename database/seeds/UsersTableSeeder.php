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
            'password' => 123456,
            'admin' => true,
            'status' => true
        ])->each(function ($user) {
            $address = factory(\App\Domains\Address\Address::class)->make([
                'zip_code' => 88337300,
                'street' => 'Quinta Avenida',
                'number' => 970,
                'sub_address' => 'Apto 03',
                'neighborhood' => 'Municípios',
                'country' => 'Brasil',
                'state' => 'SC',
                'city' => 'Balneário Camboriú'
            ]);
            $user->address()->save($address);

            $photo = factory(\App\Domains\Photo\Photo::class)->make();
            $user->photo()->save($photo);
        });

        factory(\App\Domains\User\User::class)->create([
            'name' => 'Francisco',
            'first_name' => 'Francisco',
            'last_name' => 'Souza',
            'birthday' => '2017-01-01',
            'gender' => \App\Domains\User\User::GENDER_MALE,
            'email' => 'francisco@inove.online',
            'password' => 123456,
            'admin' => true,
            'status' => true
        ])->each(function ($user) {
            $address = factory(\App\Domains\Address\Address::class)->make([
                'zip_code' => 88337300,
                'street' => 'Quinta Avenida',
                'number' => 970,
                'sub_address' => 'Apto 03',
                'neighborhood' => 'Municípios',
                'country' => 'Brasil',
                'state' => 'SC',
                'city' => 'Balneário Camboriú'
            ]);
            $user->address()->save($address);

            $photo = factory(\App\Domains\Photo\Photo::class)->make();
            $user->photo()->save($photo);
        });
    }
}
