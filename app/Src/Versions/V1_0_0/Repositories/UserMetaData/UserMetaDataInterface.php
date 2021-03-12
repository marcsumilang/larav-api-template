<?php

namespace Api\V1_0_0\Repositories\UserMetaData;

interface UserMetaDataInterface {

    /**
     * Update by user id and  key
     * @param int $userId
     * @param string $key
     * @param string $value
     * @return bool
     */
    public function updateByUserIdAndKey(int $userId, string $key, string $value) : bool ;

}