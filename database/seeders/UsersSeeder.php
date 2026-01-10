<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
       $admin = User::create([ 'name' => 'Admin', 'email' => 'admin@app.com', 'Phone_number' => '0791111111', 'password' => bcrypt('password'), 'region_id' => 1, ]);
         $admin->addRole('admin');

         $driver = User::create([
             'name' => 'Driver', 'email' => 'driver@app.com', 'Phone_number' => '0792222222', 'password' => bcrypt('password'), 'region_id' => 2,
              ]);
               $driver->addRole('driver');

  
     $student = User::create([ 
        'name' => 'Student User', 'email' => 'student@app.com', 'Phone_number' => '0793333333', 'password' => bcrypt('password'), 'region_id' => 3, 
    ]);
   
    $student->addRole('student');
    $student = User::create([ 
        'name' => 'ali ali', 'email' => 'ali@student.com', 'Phone_number' => '0793333333', 'password' => bcrypt('password'), 'region_id' => 5, 
    ]);
   
    $student->addRole('student');
    $student = User::create([ 
        'name' => 'hashem', 'email' => 'hashem@student.com', 'Phone_number' => '0793333333', 'password' => bcrypt('password'), 'region_id' => 4, 
    ]);
   
    $student->addRole('student');

     $driver2 = User::create([ 
    'name' => 'Mohammad Driver', 'email' => 'mohammad.driver@app.com', 'Phone_number' => '0794444444', 'password' => bcrypt('password'), 'region_id' => 4, ]); 
    $driver2->addRole('driver');
     $driver3 = User::create([
         'name' => 'Khaled Driver', 'email' => 'khaled.driver@app.com', 'Phone_number' => '0795555555', 'password' => bcrypt('password'), 'region_id' => 5, ]); 
         $driver3->addRole('driver');
          $driver4 = User::create([ 'name' => 'Omar Driver', 'email' => 'omar.driver@app.com', 'Phone_number' => '0796666666', 'password' => bcrypt('password'), 'region_id' => 1, ]);
           $driver4->addRole('driver');



}  
 }
