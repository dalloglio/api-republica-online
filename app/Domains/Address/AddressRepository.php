<?php

namespace App\Domains\Address;

use App\Support\BaseRepository;
use App\Support\Traits\CrudMethods;
use Illuminate\Database\Eloquent\Model;

class AddressRepository extends BaseRepository
{
    use CrudMethods;

    /**
     * @var string
     */
    protected $modelClass = Address::class;

    /**
     * @param array $data
     * @param $id
     * @return Model
     */
    public function edit(array $data = [], $id)
    {
        $model = $this->findById($id);
        return $this->update($model, $data);
    }

    /**
     * @param $id
     * @return Model
     */
    public function destroy($id)
    {
        $model = $this->findById($id);
        return $this->delete($model);
    }
}