<?php

namespace App\Interface;

interface UserInterface {

    public function getAllUsers($data);
    public function userUpdateOrCreate(array $data);
    public function edit(int $id);
    public function delete($data);

}
