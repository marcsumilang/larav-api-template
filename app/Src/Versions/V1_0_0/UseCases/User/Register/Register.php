<?php

namespace Api\V1_0_0\UseCases\User\Register;

use Api\V1_0_0\Repositories\User\UserInterface;
class Register {
    
    /**
     * @var array $data
     */
    private $data;

    /**
     * @var \Api\V1_0_0\Repositories\User\UserInterface $userInterface
     */

    /**
     * Create new instance
     * @param array $data
     */
    public function __construct(array $data, UserInterface $userInterface){

        $this->data = $data;
        $this->userInterface = $userInterface;
    }

    /**
     * Create a new User
     * @return \Api\V1_0_0\Models\User
     */
    public function __invoke() : \Api\V1_0_0\Models\User
    {
        
        $this->data["password"] = bcrypt($this->data["password"]);
        $user = $this->userInterface->create($this->data); 

        return $user;
    }

}