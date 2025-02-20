<?php

namespace Database\Seeders;

use App\Models\Hostel;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hostel = Hostel::updateOrCreate(['name'=>'মাহদী মেস হোস্টেল'],['name'=>'মাহদী মেস হোস্টেল','address'=>'B/A, H/25, R/7 Mirpur-1, Dhaka-1216']);
        User::updateOrCreate(['username'=>'m-hostel'],[
            'name'      => 'Sujon Mia',
            'hostel_id' => $hostel->id,
            'role'      => 2,
            'username'  => 'm-hostel',
            'email'     => 'sujon@gmail.com',
            'password'  => Hash::make('12345678')
        ]);
    }

}
