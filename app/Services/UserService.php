<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService
{

    protected $userRepository;

    public function __construct(UserRepository $userService)
    {
        $this->userRepository = $userService;
    }

    public function getData($data){
        return $this->userRepository->getAllUsers($data);
    }

    public function createOrUpdate($data){
        return $this->userRepository->userUpdateOrCreate($data);
    }

    public function editUser($id){
        return $this->userRepository->edit($id);
    }

    public function deleteUser($data){
        return $this->userRepository->delete($data);
    }

}

