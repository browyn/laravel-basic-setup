<?php

namespace Database\Seeders;

use App\Enums\UserRoleEnum;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => UserRoleEnum::USER->value]);
        Role::create(['name' => UserRoleEnum::ADMIN->value]);
        Role::create(['name' => UserRoleEnum::CREATOR->value]);
        Role::create(['name' => UserRoleEnum::SUPER_ADMIN->value]);
    }
}
