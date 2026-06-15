<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MerchantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $merchants = [
            [
                'name' => 'Chatime Grand Indonesia',
                'location' => 'Mall Grand Indonesia Lt. LG, Jakarta Pusat',
                'contact_info' => '021-23580001'
            ],
            [
                'name' => 'Chatime Central Park',
                'location' => 'Mall Central Park Lt. L, Jakarta Barat',
                'contact_info' => '021-56989999'
            ],
            [
                'name' => 'Chatime Kota Kasablanka',
                'location' => 'Kota Kasablanka Mall Lt. LG, Jakarta Selatan',
                'contact_info' => '021-29465000'
            ],
            [
                'name' => 'Chatime Senayan City',
                'location' => 'Senayan City Lt. 5, Jakarta Pusat',
                'contact_info' => '021-72781000'
            ],
            [
                'name' => 'Chatime Mall Kelapa Gading',
                'location' => 'Mall Kelapa Gading 3 Lt. Dasar, Jakarta Utara',
                'contact_info' => '021-45853999'
            ],
            [
                'name' => 'Chatime Pondok Indah Mall',
                'location' => 'Pondok Indah Mall 1 Lt. 2, Jakarta Selatan',
                'contact_info' => '021-75092777'
            ],
            [
                'name' => 'Chatime Gandaria City',
                'location' => 'Gandaria City Mall Lt. LG, Jakarta Selatan',
                'contact_info' => '021-29008000'
            ],
            [
                'name' => 'Chatime Plaza Senayan',
                'location' => 'Plaza Senayan Lt. Basement, Jakarta Pusat',
                'contact_info' => '021-57255550'
            ]
        ];
        foreach ($merchants as $merchant) {
            Merchant::create($merchant);
        }
    }
}
