<?php

use Illuminate\Database\Seeder;

class BannersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Domains\Banner\Banner::class, 10)
            ->create()
            ->each(function ($banner) {
                $photo = factory(\App\Domains\Photo\Photo::class)->make();
                $banner->photo()->save($photo);
            });
    }
}
