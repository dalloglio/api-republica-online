<?php

use Illuminate\Database\Seeder;

class AdsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create(env('FAKER_LANGUAGE'));

        factory(\App\Domains\Ad\Ad::class, 6)
            ->create(['user_id' => 1, 'status' => true])
            ->each(function ($ad) use ($faker) {
                $address = factory(\App\Domains\Address\Address::class)->make();
                $ad->address()->save($address);

                $url = $faker->imageUrl(720, 405);
                $photos = factory(\App\Domains\Photo\Photo::class, 8)->make(['url' => $url, 'photo' => $url]);
                $ad->photos()->saveMany($photos);

                $details = factory(\App\Domains\Ad\Detail::class, 2)->make();
                $ad->details()->saveMany($details);

                $contacts = factory(\App\Domains\Contact\Contact::class, 4)->make();
                $ad->contacts()->saveMany($contacts);
            });
    }
}
