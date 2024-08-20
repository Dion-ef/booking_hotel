<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            [
                'name' => 'Dion Eka Fahrezi',
                'email' => 'admin1@gmail.com',
                'password' => Hash::make('admin1'),
                'role'=>'admin'
            ],
            [
                'name' => 'Muhammad Riski',
                'email' => 'resepsionis1@gmail.com',
                'password' => Hash::make('resepsionis1'),
                'role'=>'resepsionis'
            ],
            // Tambahkan data admin lain jika diperlukan
        ]);

        // $user = [
        //     [
        //         'name' => 'Muhammad Riski',
        //         'email' => 'riski@gmail.com',
        //         'password' => Hash::make('riski45'),
        //         'role' => 'admin'
        //     ],
        // ];
        
        // foreach ($user as $val) {
        //     Admin::updateOrCreate(['email' => $val['email']], $val);
        // }
    }
}
