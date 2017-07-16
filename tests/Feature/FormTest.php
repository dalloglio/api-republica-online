<?php

namespace Tests\Feature;

use App\Domains\Form\Form;
use Tests\Support\CrudMethods;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class FormTest extends TestCase
{
    use CrudMethods, DatabaseMigrations;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->modelClass = Form::class;
        $this->endpoint = 'forms';
    }

    public function testUpdate()
    {
        $model = factory($this->modelClass)->create();
        $model->slug = 'test';
        $response = $this->json('PUT', $this->endpoint . '/' . $model->id, $model->toArray());
        $response->assertStatus(200)->assertJson($model->toArray());
    }
}
