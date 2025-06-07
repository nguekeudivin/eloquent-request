<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use App\Models\UserRole;
use App\Models\Role;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        DB::table("admins")->delete();

        $admins = [
            [
                'role' => 'super_admin',
                'user' =>  [
                    'email' => 'superadmin@example.com',
                    'password' => Hash::make('password'),
                    'email_verified_at' => Carbon::now(),
                ],
                'admin' => [
                    'name' => 'Super Admin',
                ]
            ],
        ];

        foreach ($admins as $item) {

            $user = User::firstOrCreate(['email' => $item['user']['email']], $item['user']);

            // UserRole::firstOrCreate([
            //     'user_id' => $user->id,
            //     'role_id' => Role::where('code', $item['role'])->first()->id
            // ]);

            Admin::create([
                "id" => $user->id,
                "name" => $item['admin']['name']
            ]);
        }
    }
}
