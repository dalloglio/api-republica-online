<?php

use Illuminate\Database\Seeder;

class PartnersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Domains\Partner\Partner::class, 10)
            ->create()
            ->each(function ($partner) {
                $photo = factory(\App\Domains\Photo\Photo::class)->make();
                $partner->photo()->save($photo);
            });
    }
}
