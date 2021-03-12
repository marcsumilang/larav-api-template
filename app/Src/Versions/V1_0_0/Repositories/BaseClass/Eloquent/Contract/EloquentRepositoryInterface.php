<?php

namespace Api\V1_0_0\Repositories\BaseClass\Eloquent\Contract;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;


interface EloquentRepositoryInterface {


    /**
    * @param array $attributes
    * @return Model
    */
   public function create(array $attributes): Model;

    /**
     * Get all the data
     * @return Collection
     */
    public function get() : Collection ; 

    /**
     * Get data by id
     * @param int $id
     * @return Model|null
     */
    public function find(int $id) : ?Model;

    /**
     * Update data by id 
     * @param int $id
     * @param array $attributes
     * @return Model
     */
    public function update(int $id, array $attributes) : Model;

    /**
     * Delete data by id
     * @param int $id
     * @return void
     */
    public function delete(int $id) : void;

}