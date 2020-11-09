<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'id' => Str::uuid(),
                'name' => 'Arif',
                'email' => 'Arif@mail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'role_id' => '8b7715ba-0ac7-41e6-9238-9be628ebe9ac',
                'otp_id' => null
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Arief',
                'email' => 'arief@mail.com',
                'email_verified_at' => null,
                'password' => Hash::make('123456'),
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'role_id' => '8b7715ba-0ac7-41e6-9238-9be628ebe9ac',
                'otp_id' => null

            ],
        ]);
    }
}
