<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        // create permissions
        Permission::create(['name' => 'edit articles']);
        Permission::create(['name' => 'delete articles']);
        Permission::create(['name' => 'publish articles']);
        Permission::create(['name' => 'unpublish articles']);

        // create roles and assign created permissions



        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo(Permission::all());

        $role = Role::create(['name' => 'moderator']);
        $role->givePermissionTo(Permission::all());

        $role = Role::create(['name' => 'contributor']);
        $role->givePermissionTo(Permission::all());

        $role = Role::create(['name' => 'user']);
        $role->givePermissionTo(Permission::all());

        $user1 = new User;
        $user1->name = 'Admin';
        $user1->profession = 'Musician';
        $user1->agree_on_terms =true;
        $user1->email = 'admin@gmail.com';
        $user1->password = Hash::make('admin');
        $user1->save();
        $user1->assignRole('admin');


        $user3 = new User;
        $user3->name = 'Contributor';
        $user3->profession = 'Musician';
        $user3->agree_on_terms =true;
        $user3->email = 'contributor@gmail.com';
        $user3->password= Hash::make('contributor');
        $user3->save();
        $user3->assignRole('contributor');

        $user4 = new User;
        $user4->name = 'Moderator';
        $user4->profession = 'Musician';
        $user4->agree_on_terms =true;
        $user4->email = 'moderator@gmail.com';
        $user4->password = Hash::make('moderator');
        $user4->save();
        $user4->assignRole('moderator');

        $user5 = new User;
        $user5->name = 'User';
        $user5->profession = 'Musician';
        $user5->agree_on_terms =true;
        $user5->email = 'user@gmail.com';
        $user5->password= Hash::make('user');
        $user5->save();
        $user5->assignRole('user');
    }
}
