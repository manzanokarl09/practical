<?php namespace App\Repositories\Rest;

use App\Repositories\Rest\Contracts\RestInterface;
use Illuminate\Database\Eloquent\Model;

class RestRepository implements RestInterface
{
    // model property on class instances
    protected $model;

    // Constructor to bind model to repo
    public function __construct(Model $model)
    {
        $this->model = $model;
    }


    // Get all instances of model
    public function all()
    {
        return $this->model->all();
    }

    // find a record in table
    public  function find($id){

        return $this->model->find($id);
    }

    // Get all instances of model
    public function paginate($limit)
    {
        return $this->model->paginate($limit);
    }


    // create a new record in the database
    public function create(array $data)
    {
        return $this->model->create($data);
    }
    // create a new record in the database

    public function createMany(array $data)
    {
        return $this->model->createMany($data);
    }

    // update record in the database
    public function update(array $data, $id)
    {
        $record = $this->model->find($id);

         $record->fill($data)->save();

         return $record;
    }

    // remove record from the database
    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    // show the record with the given id
    public function show($id)
    {
        return $this->model->find($id);
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

   // create a new record in the database
    public function updateOrCreate(array $condition, array $data)
    {
        return $this->model->updateOrCreate($condition, $data);
    }
}
