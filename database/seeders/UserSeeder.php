<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'uuid' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
            'username'=>'Admin',
            'password'=>Hash::make('123'),
            'status'=>'Aktif',
        ]);
    }
}
