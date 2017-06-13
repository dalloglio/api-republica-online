<?php

namespace App\Support\Contracts\Segregated;

use Illuminate\Database\Eloquent\Model;

interface CrudRepository
{
    /**
     * @param array $data
     * @return Model
     */
    public function create(array $data = []);

    /**
     * @param Model $model
     * @param array $data
     * @return bool
     */
    public function update(Model $model, array $data = []);

    /**
     * @param Model $model
     * @return bool
     */
    public function save(Model $model);

    /**
     * @param Model $model
     * @return bool
     */
    public function delete(Model $model);

    /**
     * @param array $data
     * @return Model
     */
    public function factory(array $data = []);
}