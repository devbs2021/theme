<?php

namespace DevbShrestha\Theme\Seeders;

use Illuminate\Database\Seeder;
use Theme;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = Theme::getPermission();
        $role = \Spatie\Permission\Models\Role::create([
            'name' => 'superadmin']);
        $role->syncPermissions($permissions);
        $user = \App\Models\User::create([
            'name' => 'superadmin',
            'email' => 'super@super.com',
            'password' => \Hash::make('P@ssword'),
        ]);
        $user->assignRole($role);
    }
}
