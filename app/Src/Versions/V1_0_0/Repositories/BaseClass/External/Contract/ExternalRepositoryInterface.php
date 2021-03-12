<?php

namespace Api\V1_0_0\Repositories\BaseClass\External\Contract;

interface ExternalRepositoryInterface {


    /**
    * @param array $attributes
    * @return mixed
    */
   public function create(array $attributes);

    /**
     * Get all the data
     * @return array
     */
    public function get() : array ; 

    /**
     * Get data by id
     * @param int $id
     * @return mixed
     */
    public function find(int $id);

    /**
     * Update data by id 
     * @param int $id
     * @param array $attributes
     * @return mixed
     */
    public function update(int $id, array $attributes);

    /**
     * Delete data by id
     * @param int $id
     * @return void
     */
    public function delete(int $id) : void;

}