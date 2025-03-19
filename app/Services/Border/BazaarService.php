<?php

namespace App\Services\Border;

use App\Repositories\Border\BazaarRepository;

class BazaarService {

    protected $bazaarService;

    public function __construct(BazaarRepository $bazaarRepository)
    {
        $this->bazaarService = $bazaarRepository;
    }

    public function getData($data){
        return $this->bazaarService->getAllUsers($data);
    }

    public function bazaarStore($data){
        return $this->bazaarService->store($data);
    }

}