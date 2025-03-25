<?php

namespace App\Services\Hostel_Admin;

use App\Repositories\Hostel_Admin\BillRepository;

class BillService
{
    protected $BillRepository;

    public function __construct(BillRepository $billStatusService)
    {
        $this->BillRepository = $billStatusService;
    }

    public function getData($data){
        return $this->BillRepository->getAll($data);
    }

    public function createOrUpdate($data){
        return $this->BillRepository->userUpdateOrCreate($data);
    }

    public function editData($id){
        return $this->BillRepository->edit($id);
    }

}