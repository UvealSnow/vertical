<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

    	DB::table('users')->insert([
    		['role_id' => 1, 'name' => 'Admin Vertical', 'email' => 'contacto@verticalfit.mx', 'phone' => null, 'password' => bcrypt('Vertical1234'), 'img' => 'placeholder.png', 'pole_lessons' => 0, 'regular_lessons' => 0, 'regular_expire' => date('Y-m-d H:i:s'), 'pole_expire' => date('Y-m-d H:i:s'), 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
    		['role_id' => 2, 'name' => 'Maestra Vertical', 'email' => 'maestra@verticalfit.mx', 'phone' => null, 'password' => bcrypt('Vertical1234'), 'img' => 'placeholder.png', 'pole_lessons' => 0, 'regular_lessons' => 0, 'regular_expire' => date('Y-m-d H:i:s'), 'pole_expire' => date('Y-m-d H:i:s'), 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
    		['role_id' => 3, 'name' => 'Nutrióloga Vertical', 'email' => 'nutriologa@verticalfit.mx', 'phone' => null, 'password' => bcrypt('Vertical1234'), 'img' => 'placeholder.png', 'pole_lessons' => 0, 'regular_lessons' => 0, 'regular_expire' => date('Y-m-d H:i:s'), 'pole_expire' => date('Y-m-d H:i:s'), 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
    		['role_id' => 4, 'name' => 'Alumna Vertical', 'email' => 'alumna@verticalfit.mx', 'phone' => null, 'password' => bcrypt('Vertical1234'), 'img' => 'placeholder.png', 'pole_lessons' => 0, 'regular_lessons' => 0, 'regular_expire' => date('Y-m-d H:i:s'), 'pole_expire' => date('Y-m-d H:i:s'), 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
    	]);

    	DB::table('roles')->insert([
    		['title' => 'Admin', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
    		['title' => 'Maestra', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
    		['title' => 'Notrióloga', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
    		['title' => 'Alumna', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
    	]);

    }
}
