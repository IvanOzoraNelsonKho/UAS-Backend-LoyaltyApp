<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Tier;
use App\Models\Mission;
use App\Models\Merchant;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Buat Tier
        $silver = \App\Models\Tier::create(['name' => 'Silver Member', 'min_points' => 0]);

        // 1. Buat User sebagai CUSTOMER (is_admin = false)
        \App\Models\User::create([
            'name' => 'Aditya Customer',
            'email' => 'customer@example.com',
            'password' => bcrypt('password'),
            'point_balance' => 150,
            'tier_id' => $silver->id,
            'is_admin' => false, // Customer biasa
        ]);
    
        // 2. Buat User sebagai ADMIN (is_admin = true)
        \App\Models\User::create([
            'name' => 'Ilo Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'point_balance' => 0,
            'tier_id' => null,
            'is_admin' => true, // Akses Admin
        ]);
    
        // Buat Sampel Misi Aktif
        \App\Models\Mission::create([
            'title' => 'Misi Pertama Chatime',
            'description' => 'Beli minuman apa saja lewat online order',
            'reward_points' => 100,
            'status' => true
        ]);

        \App\Models\Merchant::create([
            'name' => 'Chatime Grand Indonesia',
            'location' => 'Mall Grand Indonesia Lt. LG, Jakarta Pusat',
            'contact_info' => '02112345678',
        ]);

        \App\Models\Merchant::create([
            'name' => 'Chatime Central Park',
            'location' => 'Mall Central Park Lt. 2, Jakarta Barat',
            'contact_info' => '02187654321',
        ]);
        
    }
}