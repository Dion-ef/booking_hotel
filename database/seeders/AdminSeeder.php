<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user=[
            [
                'name'=>'Dion EKa Fahrezi',
                'email'=>'admin1@gmail.com',
                'password'=>bcrypt('admin1')
            ],
            [
                'name'=>'Bayu Tri Prabowo',
                'email'=>'admin2@gmail.com',
                'password'=>bcrypt('admin2')
            ],
        ];

        foreach($user as $key => $val){
            Admin::create($val);
        }
    }
}
