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
        $faker = Faker\Factory::create();

        factory(\App\Domains\Banner\Banner::class, 10)
            ->create()
            ->each(function ($banner) use ($faker) {
                $url = '';
                if ($banner->size === '336x280') {
                    $url = $faker->imageUrl(336, 280);
                } else if ($banner->size === '300x600') {
                    $url = $faker->imageUrl(300, 600);
                } else if ($banner->size === '970x250') {
                    $url = $faker->imageUrl(850, 250);
                }
                if ($url) {
                    $photo = factory(\App\Domains\Photo\Photo::class)->make(['photo' => $url, 'url' => $url]);    
                } else {
                    $photo = factory(\App\Domains\Photo\Photo::class)->make();
                }
                $photo = factory(\App\Domains\Photo\Photo::class)->make(['photo' => $url, 'url' => $url]);
                $banner->photo()->save($photo);
            });
    }
}
