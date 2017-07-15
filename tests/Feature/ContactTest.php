<?php

namespace Tests\Feature;

use App\Domains\Contact\Contact;
use Tests\Support\CrudMethods;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ContactTest extends TestCase
{
    use CrudMethods, DatabaseMigrations;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->modelClass = Contact::class;
        $this->endpoint = 'contacts';
    }

    public function testUpdate()
    {
        $model = factory($this->modelClass)->create();
        $model->name = 'Ricardo Pires';
        $response = $this->json('PUT', $this->endpoint . '/' . $model->id, $model->toArray());
        $response->assertStatus(200)->assertJson($model->toArray());
    }
}
