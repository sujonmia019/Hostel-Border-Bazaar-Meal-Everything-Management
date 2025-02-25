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

    public function createOrUpdate($data){
        return $this->userRepository->userUpdateOrCreate($data);
    }
}

