<?php

use Illuminate\Database\Seeder;

class FormsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Domains\Form\Form::class)
            ->create([
                'slug' => 'contacts',
                'title' => 'Contatos',
                'description' => 'Formulário de contatos',
                'email' => 'contato@republica.online',
                'type' => 'contact'
            ]);

        factory(\App\Domains\Form\Form::class)
            ->create([
                'slug' => 'newsletters',
                'title' => 'Newsletters',
                'description' => 'Formulário para receber assinaturas de newsletters.',
                'email' => 'contato@republica.online',
                'type' => 'newsletter'
            ]);

        factory(\App\Domains\Form\Form::class)->create([
                'slug' => 'resumes',
                'title' => 'Trabalhe Conosco',
                'description' => 'Formulário para receber currículos.',
                'email' => 'contato@republica.online',
                'type' => 'resume'
            ]);
    }
}
