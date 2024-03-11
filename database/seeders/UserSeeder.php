<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $webmaster = User::create([
            'name' => 'Super Admin',
            'email' => 'admin@tes.com',
            'password' => Hash::make('adminrhs'),
            'photo' => 'default.jpg',
            'signature' => 'default.png',
        ]);
        $webmaster->assignRole('webmaster');
    }
}
