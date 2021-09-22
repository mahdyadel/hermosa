<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class Repository implements RepositoryInterface
{
    // model property on class instances
    protected $model;

    // Constructor to bind model to repo
    public function __construct(Model $model)
    {
        $this->model = $model;
    }
    public function show ($id){
        return $this->model->findOrFail($id);
    }
    // Get all instances of model
    public function all()
    {
        return $this->model->all();
    }

    public function get()
    {
        return $this->model->get();
    }

    // create a new record in the database
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function insert(array $data) {
        return $this->model->insert($data);
    }

    // update record in the database
    public function update(array $data, $id)
    {
        $record = $this->model->findOrFail($id);
        $record->update($data);
        return $record;
    }

    // remove record from the database
    public function destroy($id)
    {
        return $this->model->destroy($id);
    }

    // show the record with the given id
    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    // update record or create it if not exist
    public function updateOrCreate($data, $data2)
    {
        return $this->model->updateOrCreate($data, $data2);
    }

    // Get the associated model
    public function getModel()
    {
        return $this->model;
    }

    // Set the associated model
    public function setModel($model)
    {
        $this->model = $model;
        return $this;
    }

    // Eager load database relationships
    public function with($relations)
    {
        return $this->model->with($relations);
    }


    public function where( $key, $value )
    {
        return $this->model->where($key, $value);
    }

    public function whereDate($column, $operator, $value = null)
    {
        return $this->model->whereDate($column, $operator, $value = null);
    }
}
