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
        $faker = Faker\Factory::create();

        factory(\App\Domains\Partner\Partner::class, 10)
            ->create()
            ->each(function ($partner) use ($faker) {
                $url = $faker->imageUrl(200, 130);
                $photo = factory(\App\Domains\Photo\Photo::class)->make(['url' => $url, 'photo' => $url]);
                $partner->photo()->save($photo);
            });
    }
}
