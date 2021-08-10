<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;
use App\Models\User;
use Carbon\Carbon;
use DB;

class SpatieRolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Role::count() == 0) {
            Role::create([
                'name' => 'Super Admin',
                'guard_name' => 'web',
            ]);
            Role::create([
                'name' => 'Admin',
                'guard_name' => 'web',
            ]);
            Role::create([
                'name' => 'Guest',
                'guard_name' => 'web',
            ]);
            Role::create([
                'name' => 'Visitor',
                'guard_name' => 'web',
            ]);
            Role::create([
                'name' => 'Member',
                'guard_name' => 'web',
            ]);
            Role::create([
                'name' => 'Employee',
                'guard_name' => 'web',
            ]);
            Role::create([
                'name' => 'Km Staff',
                'guard_name' => 'web',
            ]);
            Role::create([
                'name' => 'Librarian',
                'guard_name' => 'web',
            ]);
            Role::create([
                'name' => 'Gym Trainer',
                'guard_name' => 'web',
            ]);
            Role::create([
                'name' => 'Cafe Staff',
                'guard_name' => 'web',
            ]);
        }

        if (Permission::count() == 0) {
            Permission::create([
                'name' => 'browse_dashboard',
                'guard_name' => 'web',
            ]);
            Permission::create([
                'name' => 'browse_users',
                'guard_name' => 'web',
            ]);
        }

        if (DB::table('role_has_permissions')->count() == 0) {
            DB::table('role_has_permissions')->insert([
                'permission_id' => '1',
                'role_id' => '1',
            ]);
            DB::table('role_has_permissions')->insert([
                'permission_id' => '2',
                'role_id' => '1',
            ]);
        }

        if (DB::table('model_has_roles')->count() == 0) {
            DB::table('model_has_roles')->insert([
                'role_id' => '1',
                'model_type' => 'App\Models\User',
                'model_id' => '1',
            ]);
        }
    }
}
