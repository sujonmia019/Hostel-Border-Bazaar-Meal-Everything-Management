<?php

namespace App\Interfaces\Hostel_Admin;

interface BillStatusInterface {

    public function getAllUsers($data);
    public function userUpdateOrCreate($data);
    public function edit(int $id);

}
