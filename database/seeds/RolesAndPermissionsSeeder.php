<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::updateOrCreate(['name' => 'CREATE_USERS']);
        Permission::updateOrCreate(['name' => 'READ_USERS']);
        Permission::updateOrCreate(['name' => 'UPDATE_USERS']);
        Permission::updateOrCreate(['name' => 'DELETE_USERS']);

        Permission::updateOrCreate(['name' => 'CREATE_ADMINS']);
        Permission::updateOrCreate(['name' => 'READ_ADMINS']);
        Permission::updateOrCreate(['name' => 'UPDATE_ADMINS']);
        Permission::updateOrCreate(['name' => 'DELETE_ADMINS']);

        Permission::updateOrCreate(['name' => 'CREATE_COUNTRIES']);
        Permission::updateOrCreate(['name' => 'READ_COUNTRIES']);
        Permission::updateOrCreate(['name' => 'UPDATE_COUNTRIES']);
        Permission::updateOrCreate(['name' => 'DELETE_COUNTRIES']);

        Permission::updateOrCreate(['name' => 'CREATE_CITIES']);
        Permission::updateOrCreate(['name' => 'READ_CITIES']);
        Permission::updateOrCreate(['name' => 'UPDATE_CITIES']);
        Permission::updateOrCreate(['name' => 'DELETE_CITIES']);

        Permission::updateOrCreate(['name' => 'CREATE_SALONS']);
        Permission::updateOrCreate(['name' => 'READ_SALONS']);
        Permission::updateOrCreate(['name' => 'UPDATE_SALONS']);
        Permission::updateOrCreate(['name' => 'DELETE_SALONS']);

        Permission::updateOrCreate(['name' => 'CREATE_SERVICES']);
        Permission::updateOrCreate(['name' => 'READ_SERVICES']);
        Permission::updateOrCreate(['name' => 'UPDATE_SERVICES']);
        Permission::updateOrCreate(['name' => 'DELETE_SERVICES']);

        Permission::updateOrCreate(['name' => 'CREATE_SALON_SERVICES']);
        Permission::updateOrCreate(['name' => 'READ_SALON_SERVICES']);
        Permission::updateOrCreate(['name' => 'UPDATE_SALON_SERVICES']);
        Permission::updateOrCreate(['name' => 'DELETE_SALON_SERVICES']);

        Permission::updateOrCreate(['name' => 'CREATE_SALON_RATES']);
        Permission::updateOrCreate(['name' => 'READ_SALON_RATES']);
        Permission::updateOrCreate(['name' => 'UPDATE_SALON_RATES']);
        Permission::updateOrCreate(['name' => 'DELETE_SALON_RATES']);

        Permission::updateOrCreate(['name' => 'CREATE_EMPLOYEE_RATES']);
        Permission::updateOrCreate(['name' => 'READ_EMPLOYEE_RATES']);
        Permission::updateOrCreate(['name' => 'UPDATE_EMPLOYEE_RATES']);
        Permission::updateOrCreate(['name' => 'DELETE_EMPLOYEE_RATES']);

        Permission::updateOrCreate(['name' => 'CREATE_EMPLOYEES']);
        Permission::updateOrCreate(['name' => 'READ_EMPLOYEES']);
        Permission::updateOrCreate(['name' => 'UPDATE_EMPLOYEES']);
        Permission::updateOrCreate(['name' => 'DELETE_EMPLOYEES']);

        Permission::updateOrCreate(['name' => 'CREATE_RESERVATIONS']);
        Permission::updateOrCreate(['name' => 'READ_RESERVATIONS']);
        Permission::updateOrCreate(['name' => 'UPDATE_RESERVATIONS']);
        Permission::updateOrCreate(['name' => 'DELETE_RESERVATIONS']);

        Permission::updateOrCreate(['name' => 'CREATE_PROMOCODES']);
        Permission::updateOrCreate(['name' => 'READ_PROMOCODES']);
        Permission::updateOrCreate(['name' => 'UPDATE_PROMOCODES']);
        Permission::updateOrCreate(['name' => 'DELETE_PROMOCODES']);

        Permission::updateOrCreate(['name' => 'CREATE_PACKAGES']);
        Permission::updateOrCreate(['name' => 'READ_PACKAGES']);
        Permission::updateOrCreate(['name' => 'UPDATE_PACKAGES']);
        Permission::updateOrCreate(['name' => 'DELETE_PACKAGES']);

        Permission::updateOrCreate(['name' => 'CREATE_OFFERS']);
        Permission::updateOrCreate(['name' => 'READ_OFFERS']);
        Permission::updateOrCreate(['name' => 'UPDATE_OFFERS']);
        Permission::updateOrCreate(['name' => 'DELETE_OFFERS']);

        $permissions = Permission::pluck('name')->toArray();

        $user = User::updateOrCreate([
            'email'    => 'admin@hermosaapp.com',            
        ],
        [
            'name'     => 'Admin',
            'email'    => 'admin@hermosaapp.com',
            'type'     => 'ADMIN',
            'password' => '123456',
        ]);

        $user->syncPermissions($permissions);
    }
}