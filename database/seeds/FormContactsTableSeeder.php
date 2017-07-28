<?php

use Illuminate\Database\Seeder;
use Faker\Factory;

class FormContactsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create(env('FAKER_LANGUAGE'));

        // Contatos
        $formContact = \App\Domains\Form\Form::find(1);
        $contacts = factory(\App\Domains\Contact\Contact::class, 10)->make([
            'name' => $faker->firstName,
            'email' => $faker->freeEmail,
            'phone' => $faker->phoneNumberCleared,
            'city' => $faker->city,
            'state' => $faker->stateAbbr,
            'subject' => $faker->words(3, true),
            'message' => $faker->paragraph
        ]);
        $formContact->contacts()->saveMany($contacts);

        // Newsletters
        $formNewsletter = \App\Domains\Form\Form::find(2);
        $contacts = factory(\App\Domains\Contact\Contact::class, 10)->make([
            'name' => $faker->firstName,
            'email' => $faker->freeEmail
        ]);
        $formNewsletter->contacts()->saveMany($contacts);

        // Resumes
        $formResume = \App\Domains\Form\Form::find(3);
        $contacts = factory(\App\Domains\Contact\Contact::class, 10)->make([
            'name' => $faker->firstName,
            'email' => $faker->freeEmail,
            'phone' => $faker->phoneNumberCleared,
            'city' => $faker->city,
            'state' => $faker->stateAbbr,
            'role' => $faker->words(1, true),
            'about' => $faker->paragraph
        ]);
        $formResume->contacts()->saveMany($contacts);
    }
}
