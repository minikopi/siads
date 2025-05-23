<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => Role::Admin,
                'display_name' => 'Administrator',
                'description' => 'The system administrator',
            ],
            [
                'name' => Role::Mahasantri,
                'display_name' => 'Mahasantri',
                'description' => 'Mahasantri of Darus-Sunnah',
            ],
            [
                'name' => Role::Dosen,
                'display_name' => 'Dosen',
                'description' => 'Lecturer of Darus-Sunnah',
            ],
            [
                'name' => Role::Musyrif,
                'display_name' => 'Musyrif',
                'description' => 'Lecturer of Darus-Sunnah',
            ],
            [
                'name' => Role::PanitiaTakhrij,
                'display_name' => 'Panitia Takhrij',
                'description' => 'Takhrij Committee of Darus-Sunnah',
            ],
        ];

        foreach ($roles as $role) {
            Role::updateOrCreate(
                [
                    'name' => $role['name']
                ],
                [
                    'display_name' => $role['display_name'],
                    'description' => $role['description'],
                ]
            );
        }
    }
}
