<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Doctor;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DefaultData extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminData['first_name']='mo';
        $adminData['last_name']='essam';
        $adminData['email']='admin@gmail.com'; 
        $adminData['gender']='male';
        $adminData['role']='admin';
        $adminData['password']=Hash::make('test123!');
        User::create($adminData);

        $adminData['first_name']='mo';
        $adminData['last_name']='essam';
        $adminData['email']='admin@gmail.com'; 
        $adminData['gender']='male';
        $adminData['password']=Hash::make('test123!');
        Admin::create($adminData);

        $userData['first_name']='adham';
        $userData['last_name']='adam';
        $userData['email']='user@gmail.com';
        $userData['gender']='male';
        $userData['role']='user';
        $userData['password']=Hash::make('test123!');
        User::create($userData);

        $doctorData['first_name']='mo';
        $doctorData['last_name']='essam';
        $doctorData['gender']='male';
        Doctor::create($doctorData);
    }
}
