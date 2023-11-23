<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->truncate();

        $user_data = [
            [
                'name'=>'Hitesh Rajput',
                'role'=>'admin',
                'is_approved'=>0,
                'is_disapproved'=>0,
                'email'=>'hitesh@gmail.com',
                'number'=>4423422421,
                'email_verified_at'=>null,
                'password'=>'$2y$12$UFqxcCRwI5KWIraCsTlI5.uTxwxNh0u5dW64EN1fnJbVkI20bGDdu',
                'remember_token'=>null,
                'created_at'=>'2023-11-20 05:14:52',
                'updated_at'=>'2023-11-20 05:14:52',
            ],
            [
                'name'=>'Vansh Rajput',
                'role'=>'designer',
                'is_approved'=>true,
                'is_disapproved'=>false,
                'email'=>'vanshrana3204@gmail.com',
                'number'=>4423422333,
                'email_verified_at'=>null,
                'password'=>'$2y$12$9.cBHGPerhjhHe.3PtvBWORv/cBENt6pCRQJqGtTro06pP70f8xxG',
                'remember_token'=>null,
                'created_at'=>'2023-11-20 05:14:52',
                'updated_at'=>'2023-11-20 05:14:52',
            ]

        ];
    }
}
