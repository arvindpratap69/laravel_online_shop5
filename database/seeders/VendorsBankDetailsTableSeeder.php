<?php

namespace Database\Seeders;

use App\Models\VendorsBankDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VendorsBankDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vendorRecords = [
            ['id'=>1, 'vendor_id'=>1,'account_holder_name'=>'john Cena', 'bank_name'=>'ICICI',
              'account_number'=>'0242530500022','bank_ifsc_code'=>'24353563'
             ]
        ];
        VendorsBankDetail::insert($vendorRecords);
    }
}
