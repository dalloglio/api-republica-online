<?php

use Illuminate\Database\Seeder;

class UsersTestTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Domains\User\User::class, 10)->create()->each(function ($user) {
            $address = factory(\App\Domains\Address\Address::class)->make();
            $user->address()->save($address);

            $photo = factory(\App\Domains\Photo\Photo::class)->make();
            $user->photo()->save($photo);
        });
    }
}
