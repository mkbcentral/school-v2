<?php

namespace Database\Seeders;
use App\Models\AppSetting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $appAdmin=User::factory()->create([
            'name' => config('app.name'),
             'email' => 'app-admin@school-app.app',
             'school_id' => null
         ]);
        $admin=User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'superadmin@school-app.app',
            'school_id' => null
        ]);
        $role1=Role::create(['name'=>'App-Admin']);
        $role2=Role::create(['name'=>'Super-Admin']);
        $appAdmin->assignRole($role1);
        $admin->assignRole($role2);
        AppSetting::create(['app_name'=>config('app.name')]);
    }
}
