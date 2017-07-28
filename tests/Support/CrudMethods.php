<?php

namespace Tests\Support;

trait CrudMethods
{
    private $notFoundId = 0;

    protected $modelClass;

    protected $endpoint;

    public function testList()
    {
        $model = factory($this->modelClass, 10)->create();
        $response = $this->json('GET', $this->endpoint);
        $response->assertStatus(200)->assertJson(['data' => $model->toArray()]);
    }

    public function testView()
    {
        $model = factory($this->modelClass)->create();
        $response = $this->json('GET', $this->endpoint . '/' . $model->id);
        $response->assertStatus(200)->assertJson($model->toArray());
    }

    public function testViewNotFount()
    {
        $response = $this->json('GET', $this->endpoint . '/' . $this->notFoundId);
        $response->assertStatus(404);
    }

    public function testCreate()
    {
        $model = factory($this->modelClass)->make();
        $response = $this->json('POST', $this->endpoint, $model->getAttributes());
        $response->assertStatus(200)->assertJson($model->toArray());
    }

    public function testUpdate()
    {
        $model = factory($this->modelClass)->create();
        $model->status = 1;
        $response = $this->json('PUT', $this->endpoint . '/' . $model->id, $model->toArray());
        $response->assertStatus(200)->assertJson($model->toArray());
    }

    public function testUpdateNotFound()
    {
        $model = factory($this->modelClass)->create();
        $model->status = 1;
        $response = $this->json('PUT', $this->endpoint . '/' . $this->notFoundId, $model->toArray());
        $response->assertStatus(404);
    }

    public function testDelete()
    {
        $model = factory($this->modelClass)->create();
        $response = $this->json('DELETE', $this->endpoint . '/' . $model->id);
        $response->assertStatus(200)->assertJson($model->toArray());
    }

    public function testDeleteNotFound()
    {
        $response = $this->json('DELETE', $this->endpoint . '/' . $this->notFoundId);
        $response->assertStatus(404);
    }
}