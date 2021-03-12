<?php

namespace Api\V1_0_0\Repositories\BaseClass\Eloquent;

use Api\Exceptions\CustomException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Api\V1_0_0\Repositories\BaseClass\Eloquent\Contract\EloquentRepositoryInterface;

class EloquentRepository  implements EloquentRepositoryInterface{

    /**
     * @var \Illuminate\Database\Eloquent\Model $model
     */
    protected $model;


    public function __construct(Model $model)
    {   
        $this->model = $model;
    }

    /**
     * @param array $attributes
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array $attributes) : Model
    {
        return $this->model->create($attributes);
    }

    /**
     * Get  Model
     * @return Collection
     */
    public function get() : Collection 
    {
        
        return $this->model->get();

    }

    /**
     * Get model by id
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function find(int $id) : ?Model
    {
        $model =  $this->model->find($id);

        if(!is_null($model))
            return $model;
        
        throw new CustomException(404, "User not found.");          
    } 


    /**
     * Update model by id
     * @param int $id
     * @param array $attributes
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update(int $id, array $attributes) : Model
    {
        $this->model->where("id",$id)->update($attributes);
        return $this->find($id);
    }

    /**
     * Delete model
     * @param int $id
     * @return void
     */
    public function delete(int $id): void
    {
        $this->model->where('id',$id)->delete();
    }
    
}