<?php

namespace App\Services\Hostel_Admin;

use App\Repositories\Hostel_Admin\BillStatusRepository;

class BillStatusService
{
    protected $BillStatusRepository;

    public function __construct(BillStatusRepository $billStatusService)
    {
        $this->BillStatusRepository = $billStatusService;
    }

    public function getData($data){
        return $this->BillStatusRepository->getAllUsers($data);
    }

    public function createOrUpdate($data){
        return $this->BillStatusRepository->userUpdateOrCreate($data);
    }

    public function editData($id){
        return $this->BillStatusRepository->edit($id);
    }

}