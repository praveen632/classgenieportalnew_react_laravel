<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('cms_roles')->insert([
        'role_name' => 'admin',
        'module_list' => '1,2,3',
        ]);

     DB::table('cms_usermangs')->insert([
      'username' => 'admin',
      'password' => Hash::make('admin@321!'),
      'fname' => 'admin',
      'lname' => '',
      'email' => 'admin@gmail.com',
      'role_id' => '1'
      ]);
   }
 }
