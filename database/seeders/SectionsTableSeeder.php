<?php

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $SectionRecords = [
             ['id'=>1,'name'=>'clothing','status'=>1],
             ['id'=>2,'name'=>'electronics','status'=>1],
             ['id'=>3,'name'=>'appliances','status'=>1],
        ];
        Section::insert($SectionRecords);
    }
}
