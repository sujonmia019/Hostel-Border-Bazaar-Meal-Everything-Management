<?php

namespace App\Interfaces\Hostel_Admin;

interface BilllInterface {

    public function getAll($data);
    public function userUpdateOrCreate($data);
    public function edit(int $id);

}
