<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class userseeder extends Seeder
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
                'email'=>'hit8708542@gmail.com',
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
            ],
            [
                'name'=>'Test',
                'role'=>'user',
                'is_approved'=>true,
                'is_disapproved'=>false,
                'email'=>'test@gmail.com',
                'number'=>1122112221,
                'email_verified_at'=>null,
                'password'=>'$2y$12$NmUqxHpNnjMSKKbDCQQwueICcHhYhQ6T6EunG6TewqlAwV9wzgefS',
                'remember_token'=>null,
                'created_at'=>'2023-11-20 05:14:52',
                'updated_at'=>'2023-11-20 05:14:52',
            ]

        ];

        foreach ($user_data as $data) {
            DB::table('users')->insert([
                'name' => $data['name'],
                'role' => $data['role'],
                'is_approved' => $data['is_approved'],
                'is_disapproved' => $data['is_disapproved'],
                'email' => $data['email'],
                'number' => $data['number'],
                'email_verified_at' => $data['email_verified_at'],
                'password' => $data['password'],
                'remember_token' => $data['remember_token'],
                'created_at' => $data['created_at'],
                'updated_at' => $data['updated_at'],
            ]);
        }
    }
}
