<?php

namespace Api\V1_0_0\Repositories\BaseClass\External;


use Api\V1_0_0\Repositories\BaseClass\External\Contract\ExternalRepositoryInterface;

abstract class ExternalRepository  implements ExternalRepositoryInterface{

    /**
     * @param array $attributes
     * @return mixed
     */
    abstract public function create(array $attributes);
    /**
     * Get all users
     * @return array
     */
    abstract public function get() : array;

    /**
     * Get user
     * @param int $id
     * @return mixed
     */
    abstract public function find(int $id);


    /**
     * Update user
     * @param int $id
     * @param array $attributes
     * @return mixed
     */
    abstract public function update(int $id, array $attributes);

    /**
     * Delete user
     * @param int $id
     * @return void
     */
    abstract public function delete(int $id) : void;
    
}