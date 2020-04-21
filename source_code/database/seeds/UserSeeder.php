<?php

use Illuminate\Database\Seeder;
use Modules\User\Repositories\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        $admin = [
//            "email" => "admin@webbase.xyz",
//            "password" => bcrypt("12345678"),
//            "name" => "Admin",
//            "nickname" => "Black Bear",
//            "phone" => "0901452368",
//            "address" => "HN",
//            "gender" => 1,
//            "active" => 1
//        ];
//
//        $root = [
//            "email" => "root@webbase.xyz",
//            "password" => bcrypt("12345678"),
//            "name" => "Root",
//            "nickname" => "Root",
//            "phone" => "0901452368",
//            "address" => "HN",
//            "gender" => 1,
//            "active" => 1
//        ];
//
//        $roles = [
//            "root" => [
//                "name" => "root",
//                "display_name" => "Root",
//                "description" => "Root",
//                "created_at" => date("Y-m-d H:i:s"),
//                "updated_at" => date("Y-m-d H:i:s")
//            ],
//            "admin" => [
//                "name" => "admin",
//                "display_name" => "Super Admin",
//                "description" => "Super Admin",
//                "created_at" => date("Y-m-d H:i:s"),
//                "updated_at" => date("Y-m-d H:i:s")
//            ]
//        ];
//
//        // Tạo admin user
//        $adminUser = User::where('email', $admin['email'])->first();
//        if(!$adminUser) {
//            $adminUser = new User($admin);
//            $adminUser->save();
//        }
//
//        $rootUser = User::where('email', $root['email'])->first();
//        if(!$rootUser) {
//            $rootUser = new User($root);
//            $rootUser->save();
//        }
//
//        // Create root role
//        $roleRoot = Role::where('name', $roles['root']['name'])->first();
//        if(!$roleRoot) {
//            $roleRoot = new Role($roles['root']);
//            $roleRoot->save();
//        }
//        // Create admin role
//        $roleAdmin = Role::where('name', $roles['admin']['name'])->first();
//        if(!$roleAdmin) {
//            $roleAdmin = new Role($roles['admin']);
//            $roleAdmin->save();
//        }
//
//        // Phân role cho user
//        $rootUser->roles()->attach($roleRoot);
//        $adminUser->roles()->attach($roleAdmin);
    }
}
