<?php

namespace App\Support\Traits;

use Illuminate\Database\Eloquent\Model;

trait CrudMethods
{
    /**
     * @param array $data
     * @return Model
     */
    public function factory(array $data = [])
    {
        $model = $this->newQuery()->getModel()->newInstance();
        $this->setModelData($model, $data);
        return $model;
    }

    /**
     * @param Model $model
     * @param array $data
     */
    public function setModelData(Model $model, array $data)
    {
        $model->fill($data);
    }

    /**
     * @param array $data
     * @param int $id
     * @return bool
     */
    public function update(array $data = [], $id)
    {
        $model = $this->findById($id);
        $this->setModelData($model, $data);
        $this->save($model);
        return $model;
    }

    /**
     * @param array $data
     * @return Model
     */
    public function create(array $data = [])
    {
        $model = $this->factory($data);
        $this->save($model);
        return $model;
    }

    /**
     * @param Model $model
     * @return bool
     */
    public function save(Model $model)
    {
        return $model->save();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        $model = $this->findById($id);
        $model->delete();
        return $model;
    }
}
