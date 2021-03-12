<?php

namespace Api\V1_0_0\Repositories\User;


use Api\V1_0_0\Models\User;
use Api\V1_0_0\Repositories\BaseClass\Eloquent\EloquentRepository;
use Api\V1_0_0\Repositories\UserMetaData\UserMetaDataRepository;
use Illuminate\Support\Facades\DB;

class UserRepository extends EloquentRepository implements UserInterface{
    
    /** 
     * @var \Api\V1_0_0\Repositories\UserMetaData\UserMetaDataRepository $userMetaData
     * */ 
    protected  $userMetaData;

    /**
     * Create new instance
     * @param \Api\V1_0_0\Models\User $user
     */
    public function __construct(User $user, UserMetaDataRepository $userMetaData)
    {   
        $this->userMetaData = $userMetaData;

        parent::__construct($user);
    }

    /**
     * Create user
     * @param array $attributes
     * @return void
     */
    public function create(array $attributes) : User 
    {
        return DB::transaction(function() use ($attributes) {

            $user = parent::create($attributes);

            $this->createMetaData($user->id, $attributes);
            
            return $user;
        });

    }

    /**
     * Update user
     * @param array $attributes
     */
    public function update(int $id, array $attributes): User
    { 
        return DB::transaction(function() use ($id, $attributes){

            $user = [
                "email" => $attributes["email"],
                "name" => $attributes["name"],
            ];
    
            $user = parent::update($id, $user);
    
            $this->updateMetaData($user->id, $attributes);
    
            return $user;

        });

    }


    /**
     * Save the meta data
     * @param array $attributes
     * @param int $userId
     * @return void
     */
    private function createMetaData(int $userId, array $attributes) : void
    {
        $metaData = $this->retrieveMetaData($attributes);

        foreach($metaData as $key => $value) 
        {
            $this->userMetaData->create([
                "user_id" => $userId, 
                "key" => $key,
                "value" => $value
            ]);
        }
    }

    /**
     * update user meta data
     * @param int $userId
     * @param array $attributes
     * @return void
     */
    private function updateMetaData(int $userId, array $attributes) : void 
    {
        $metaData = $this->retrieveMetaData($attributes);

        foreach ($metaData as $key => $value)
        {
            if(!$this->userMetaData->updateByUserIdAndKey($userId, $key, $value))
            {
                $this->userMetaData->create([
                    "user_id" => $userId,
                    "key" => $key,
                    "value" => $value
                ]);
            }

        }

    }

    /**
     * retrieve meta data
     * @param array $attributes
     * @return array
     */
    private function retrieveMetaData(array $attributes) : array
    {
        unset($attributes["name"]);

        unset($attributes["email"]);

        unset($attributes["password"]);

        return  $attributes;
    }

}