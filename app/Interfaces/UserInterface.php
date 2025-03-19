<?php

namespace App\Interfaces;

interface UserInterface {

    public function getAllUsers($data);
    public function userUpdateOrCreate(array $data);
    public function edit(int $id);
    public function delete($data);

}
