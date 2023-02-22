<?php


namespace App\Repositories;


use App\UseCases\BaseUseCase;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

abstract class BaseRepository
{
    protected $model;

    public function __construct($model){

        $this->model = $model;
    }

    public function find($id, array $with = null, array $order = null, $columns = ['*'])
    {

        $query = $this->model->newQuery();

        $this->prepareQuery($query,$with,$order);

        $result = $query->find($id, $columns);

        BaseUseCase::isObject( $result , NotFoundHttpException::class , 'model not found');

        return $result;

    }

    public function findAttributes(array $attributes, array $with = null, array $order = null, $columns = ['*'],$throwError = true)
    {

        $query = $this->prepareQueryByAttributes($attributes);

        $this->prepareQuery($query,$with,$order);

        $result = $query->first($columns);
        if($throwError)
            BaseUseCase::isObject( $result , NotFoundHttpException::class , 'model not found',404);

        return $result;
    }

    public function all($columns = ['*'], $with = null )
    {
        $query = $this->model->newQuery();

        $this->prepareQuery($query,$with);

        return $query->orderBy('id', 'DESC')->get($columns);
    }

    public function withAttributes(array $attributes, array $with = null, array $columns = ['*'],  $orderBy = null,  $sortOrder = 'asc')
    {
        $query = $this->prepareQueryByAttributes($attributes, $orderBy, $sortOrder);

        $this->prepareQuery($query,$with);

        return $query->get($columns);
    }

    public function paginate( $perPage = 15,  $conditions = null,  $with = null, $columns = ['*'],$order = null)
    {
        $query = $this->model->newQuery();

        $this->prepareQuery($query,$with);

        if ($conditions) {
            $query = $query->where($conditions);
        }

        if ($order) {
            $this->addSortToQuery($query , $order);
        }

        return $query->paginate($perPage, $columns);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function insert(array $data)
    {
        return $this->model->insert($data);
    }

    public function upsert(array $data , array $uniqueColumns = [] , array $updatedColumns = [] )
    {
        return $this->model->upsert($data,$uniqueColumns, $updatedColumns);
    }

    public function update(array $data, array $conditions)
    {
        return $this->model->where($conditions)->update($data);
    }

    public function updateWithModel(array $data, array $conditions )
    {
        return tap($this->model->where($conditions))->update($data)->first();

    }

    public function updateByModel(array $data, $model)
    {
        return tap($model)->update($data);
    }

    public function updateOrCreate(array $conditions, array $data)
    {
        return $this->model->updateOrCreate($conditions, $data);
    }

    public function destroy(array $conditions)
    {
        return $this->model->where($conditions)->delete();
    }

    protected function prepareQuery(&$query,$with=null,$order=null){
        if ($with) {
            $query->with($with);
        }

        if ($order) {
            $this->addSortToQuery($query , $order);
        }
    }

    protected function prepareQueryByAttributes(array $attributes,  $orderBy = null,  $sortOrder = 'asc')
    {
        $query = $this->model->query();

        foreach ($attributes as $field => $value) {
            $query = $query->where($field, $value);
        }

        if (null !== $orderBy) {
            $query->orderBy($orderBy, $sortOrder);
        }

        return $query;
    }

    protected function addSortToQuery(&$query , $order){
        foreach ($order as $key => $sort) {
            $query->orderBy($key, $sort);
        }
        return $query;
    }

}
