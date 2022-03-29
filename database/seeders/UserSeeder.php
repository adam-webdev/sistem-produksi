<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin1234')
        ]);
        $user->assignRole('Admin');

        $direktur = User::create([
            'name' => 'direktur',
            'email' => 'direktur@gmail.com',
            'password' => Hash::make('direktur1234')
        ]);
        $direktur->assignRole('Direktur');

        $produksi = User::create([
            'name' => 'produksi',
            'email' => 'produksi@gmail.com',
            'password' => Hash::make('produksi1234')
        ]);
        $produksi->assignRole('Produksi');

        $gudang = User::create([
            'name' => 'gudang',
            'email' => 'gudang@gmail.com',
            'password' => Hash::make('gudang1234')
        ]);
        $gudang->assignRole('Gudang');
    }
}