<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name='admin';
        $user->password=Hash::make('admin');
        $user->email='admin@admin.com';
        $user->rol='admin';
        $user->dni = '87654321Q';
        $user->save();


        $empleat = new User();
        $empleat->name='empleat1';
        $empleat->password=Hash::make('123456');
        $empleat->email='empleat1@empleat1.com';
        $empleat->rol='empleat';
        $empleat->dni='12345678Q';
        $empleat->save();
    }
}
