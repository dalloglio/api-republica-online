<?php

namespace Tests\Feature;

use App\Domains\Ad\Ad;
use App\Domains\Contact\Contact;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AdContactTest extends TestCase
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
        $this->modelClass = Ad::class;
        $this->resource = 'ads';
        $this->sub_resource = 'contacts';
    }

    public function testList()
    {
        $ad = factory($this->modelClass)->create();
        $contacts = factory(Contact::class, 5)->make();
        foreach ($contacts as $contact) {
            $ad->contacts()->save($contact);
        }
        $this->resource_id = $ad->id;
        $response = $this->json('GET', $this->prepareEndpoint());
        $response->assertStatus(200)->assertJson($contacts->toArray());
    }

    // public function testView()
    // {
    //     $ad = factory($this->modelClass)->create();
    //     $contact = factory(Contact::class)->make();
    //     $this->resource_id = $ad->id;

    //     $response = $this->json('POST', $this->prepareEndpoint(), $contact->toArray());
    //     $contact = $response->json();
    //     $this->sub_resource_id = $contact['id'];

    //     $response = $this->json('GET', $this->prepareEndpoint());
    //     $response->assertStatus(200)->assertJson($contact);
    // }

    // public function testCreate()
    // {
    //     $ad = factory($this->modelClass)->create();
    //     $contact = factory(Contact::class)->make();
    //     $this->resource_id = $ad->id;
    //     $response = $this->json('POST', $this->prepareEndpoint(), $contact->toArray());
    //     $response->assertStatus(200)->assertJson($contact->toArray());
    // }

    // public function testUpdate()
    // {
    //     $ad = factory($this->modelClass)->create();
    //     $contact = factory(Contact::class)->make();
    //     $this->resource_id = $ad->id;

    //     $response = $this->json('POST', $this->prepareEndpoint(), $contact->toArray());
    //     $contact = $response->json();
    //     $this->sub_resource_id = $contact['id'];

    //     $contact['name'] = 'Teste';
    //     $response = $this->json('PUT', $this->prepareEndpoint(), $contact);
    //     $response->assertStatus(200)->assertJson($contact);
    // }

    // public function testDelete()
    // {
    //     $ad = factory($this->modelClass)->create();
    //     $contact = factory(Contact::class)->make();
    //     $this->resource_id = $ad->id;

    //     $response = $this->json('POST', $this->prepareEndpoint(), $contact->toArray());
    //     $contact = $response->json();
    //     $this->sub_resource_id = $contact['id'];

    //     $response = $this->json('DELETE', $this->prepareEndpoint());
    //     $response->assertStatus(200)->assertJson($contact);
    // }

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
