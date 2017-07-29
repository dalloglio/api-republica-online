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
        $contacts = factory(\App\Domains\Contact\Contact::class, 15)->make();
        $formContact->contacts()->saveMany($contacts);

        // Newsletters
        $formNewsletter = \App\Domains\Form\Form::find(2);
        $contacts = factory(\App\Domains\Contact\Contact::class, 10)->make();
        $formNewsletter->contacts()->saveMany($contacts);

        // Resumes
        $formResume = \App\Domains\Form\Form::find(3);
        $contacts = factory(\App\Domains\Contact\Contact::class, 5)->make();
        $formResume->contacts()->saveMany($contacts);
    }
}
