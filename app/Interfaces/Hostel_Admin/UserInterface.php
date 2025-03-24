<?php

namespace App\Interfaces\Hostel_Admin;

interface UserInterface {

    public function getAllUsers($data);
    public function userUpdateOrCreate(array $data);
    public function edit(int $id);
    public function delete($data);

}



