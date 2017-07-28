<?php

namespace Tests\Feature;

use App\Domains\Video\Video;
use Tests\Support\CrudMethods;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class VideoTest extends TestCase
{
    use CrudMethods, DatabaseMigrations;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->modelClass = Video::class;
        $this->endpoint = 'videos';
    }

    public function testUpdate()
    {
        $model = factory($this->modelClass)->create();
        $model->title = 'Teste';
        $response = $this->json('PUT', $this->endpoint . '/' . $model->id, $model->toArray());
        $response->assertStatus(200)->assertJson($model->toArray());
    }
}
