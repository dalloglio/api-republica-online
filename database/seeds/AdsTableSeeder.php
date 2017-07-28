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
        factory(\App\Domains\Ad\Ad::class, 5)
            ->create()
            ->each(function ($ad) {
                $address = factory(\App\Domains\Address\Address::class)->make();
                $ad->address()->save($address);

                $photo = factory(\App\Domains\Photo\Photo::class)->make();
                $ad->photo()->save($photo);

                $photos = factory(\App\Domains\Photo\Photo::class, 2)->make();
                $ad->photos()->saveMany($photos);

                $video = factory(\App\Domains\Video\Video::class)->make();
                $ad->video()->save($video);

                $videos = factory(\App\Domains\Video\Video::class, 2)->make();
                $ad->videos()->saveMany($videos);

                $details = factory(\App\Domains\Ad\Detail::class, 2)->make();
                $ad->details()->saveMany($details);

                $contact = factory(\App\Domains\Contact\Contact::class)->make();
                $ad->contact()->save($contact);
            });
    }
}
