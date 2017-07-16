<?php

namespace Tests\Feature;

use App\Domains\Contact\Contact;
use App\Domains\Form\Form;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class FormContactTest extends TestCase
{
    use DatabaseMigrations;

    protected $modelClass;

    protected $endpoint;

    protected $resource;

    protected $resource_id;

    protected $sub_resource;

    protected $sub_resource_id;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->modelClass = Form::class;
        $this->resource = 'forms';
        $this->sub_resource = 'contacts';
    }

    public function testList()
    {
        // create form
        $model = factory($this->modelClass)->create();
        $this->resource_id = $model->id;

        // create contact
        $contact = factory(Contact::class)->make();
        $this->json('POST', $this->prepareEndpoint(), $contact->toArray());

        $response = $this->json('GET', $this->prepareEndpoint());
        $response->assertStatus(200)->assertJson([$contact->toArray()]);
    }

    public function testView()
    {
        // create form
        $model = factory($this->modelClass)->create();
        $this->resource_id = $model->id;

        // create contact
        $contact = factory(Contact::class)->make();
        $response = $this->json('POST', $this->prepareEndpoint(), $contact->toArray());

        // check contact
        $this->sub_resource_id = $response->json()['id'];
        $response = $this->json('GET', $this->prepareEndpoint());
        $response->assertStatus(200)->assertJson($contact->toArray());
    }

    public function testUpdate()
    {
        // create form
        $model = factory($this->modelClass)->create();
        $this->resource_id = $model->id;

        // create contact
        $contact = factory(Contact::class)->make();
        $response = $this->json('POST', $this->prepareEndpoint(), $contact->toArray());

        // check contact created
        $this->sub_resource_id = $response->json()['id'];
        $contact->name = 'Teste';
        $response = $this->json('PUT', $this->prepareEndpoint(), $contact->toArray());
        $response->assertStatus(200)->assertJson($contact->toArray());
    }

    public function testDelete()
    {
        // create form
        $model = factory($this->modelClass)->create();
        $this->resource_id = $model->id;

        // create contact
        $contact = factory(Contact::class)->make();
        $response = $this->json('POST', $this->prepareEndpoint(), $contact->toArray());

        // check contact created
        $this->sub_resource_id = $response->json()['id'];
        $response = $this->json('DELETE', $this->prepareEndpoint());
        $response->assertStatus(200)->assertJson($contact->toArray());
    }

    public function prepareEndpoint()
    {
        $endpoint[] = $this->resource;
        if ((int) $this->resource_id) {
            $endpoint[] = $this->resource_id;
        }
        $endpoint[] = $this->sub_resource;
        if ((int) $this->sub_resource_id) {
            $endpoint[] = $this->sub_resource_id;
        }
        return implode('/', $endpoint);
    }
}