<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;

use function PHPSTORM_META\type;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $adminRecords = [
        //    ['id' =>2, 'name' => 'john', 'type' => 'vendor',
        //    'vendor_id' =>1, 'mobile' => 9700000000, 'email' =>'john@gmail.com',
        //    'password' =>'$2y$12$hh7mLubNoYkFq4IPDD1yg.AIeSMZVi137VwCG3zgmKuAOdT4nAF2a','image' =>'',
        //    'status' =>0],
        // ];
        // Admin::insert($adminRecords);
    }
}
