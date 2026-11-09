<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Demo accounts, one per role. LOCAL / DEMO USE ONLY:
     * change or delete these passwords before deploying to a public server.
     */
    public function run(): void
    {
        $accounts = [
            ['name' => 'Admin',  'email' => 'admin@example.com',  'role' => User::ROLE_ADMIN],
            ['name' => 'Staff',  'email' => 'staff@example.com',  'role' => User::ROLE_STAFF],
            ['name' => 'Viewer', 'email' => 'viewer@example.com', 'role' => User::ROLE_VIEWER],
        ];

        foreach ($accounts as $account) {
            $user = User::firstOrNew(['email' => $account['email']]);

            // role / is_active are not mass-assignable, so forceFill is used.
            $user->forceFill([
                'name' => $account['name'],
                'role' => $account['role'],
                'is_active' => true,
                'password' => 'Password123!', // hashed by the "hashed" cast
            ])->save();
        }
    }
}
