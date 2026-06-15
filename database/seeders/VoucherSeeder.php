<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VoucherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vouchers = [
            ['code' => 'CHATIMEHEMAT', 'discount_value' => 10000, 'is_used' => 0],
            ['code' => 'GRATISTOPPING', 'discount_value' => 5000, 'is_used' => 0],
            ['code' => 'B1G1WEEKEND', 'discount_value' => 25000, 'is_used' => 0],
            ['code' => 'PAYDAYPROMO', 'discount_value' => 15000, 'is_used' => 0],
            ['code' => 'NEWMEMBER', 'discount_value' => 20000, 'is_used' => 0],
        ];

        foreach ($vouchers as $voucher) {
            Voucher::create($voucher);
        }
    }
}
