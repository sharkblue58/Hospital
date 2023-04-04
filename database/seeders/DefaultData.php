<?php

namespace Database\Seeders;

use App\Models\Admin;
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
        $data['first_name']='mo';
        $data['last_name']='essam';
        $data['email']='admin@gmail.com'; 
        $data['gender']='male';
        $data['role']='admin';
        $data['password']=Hash::make('test123!');
        User::create($data);

        $cdata['first_name']='adham';
        $cdata['last_name']='adam';
        $cdata['email']='user@gmail.com';
        $cdata['gender']='male';
        $data['role']='user';
        $cdata['password']=Hash::make('test123!');
        User::create($cdata);
    }
}
