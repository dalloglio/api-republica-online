<?php

namespace Tests\Feature;

use App\Domains\Photo\Photo;
use Tests\Support\CrudMethods;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PhotoTest extends TestCase
{
    use CrudMethods, DatabaseMigrations;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->modelClass = Photo::class;
        $this->endpoint = 'photos';
    }

    public function testUpdate()
    {
        $model = factory($this->modelClass)->create();
        $model->name = 'Teste';
        $response = $this->json('PUT', $this->endpoint . '/' . $model->id, $model->toArray());
        $response->assertStatus(200)->assertJson($model->toArray());
    }
}
