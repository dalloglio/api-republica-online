<?php

namespace App\Domains;

use App\Support\BaseRepository;
use App\Support\Traits\CrudMethods;
use Illuminate\Database\Eloquent\Model;

class UsersRepository extends BaseRepository
{
    use CrudMethods;

    /**
     * @var string $modelClass
     */
    protected $modelClass = User::class;

    /**
     * @param int $limit
     * @param bool $paginate
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Pagination\AbstractPaginator
     */
    public function getInactive($limit = 15, $paginate = true)
    {
        $query = $this->newQuery();
        $query->where('status', 0);
        $query->orderBy('name');
        return $this->doQuery($query, $limit, $paginate);
    }

    /**
     * @param array $data
     * @return Model
     */
    public function create(array $data = [])
    {
        if (array_key_exists('password', $data)) {
            $data['password'] = bcrypt($data['password']);
        }

        $model = $this->factory($data);
        $this->save($model);
        return $model;
    }

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