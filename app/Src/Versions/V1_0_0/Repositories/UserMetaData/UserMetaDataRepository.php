<?php

namespace Api\V1_0_0\Repositories\UserMetaData;


use Api\V1_0_0\Models\UserMetaData;
use Api\V1_0_0\Repositories\BaseClass\Eloquent\EloquentRepository;

class UserMetaDataRepository extends EloquentRepository implements UserMetaDataInterface{
    
    public function __construct(UserMetaData $userMetaData)
    {   
        parent::__construct($userMetaData);
    }

    /**
     * Update the value by user id and key
     * @param int $userId
     * @param string $key
     * @param string $value
     * @return bool
     */
    public function updateByUserIdAndKey(int $id, string $key, string $value) : bool 
    {
        return $this->model->where("id", $id)->where("key", $key)->update([
            "value" => $value
        ]);

    }

}