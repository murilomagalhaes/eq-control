<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if (config('super.super_nome') && config('super.super_login') && ('super.super_pwd')) {
            $user = new User();
            $user->nome = config('super.super_nome');
            $user->login = config('super.super_login');
            $user->password = Hash::make(config('super.super_pwd'));
            $user->save();
        }
    }
}
