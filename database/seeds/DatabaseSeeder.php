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
    		['role_id' => 1, 'name' => 'Admin Vertical', 'email' => 'contacto@verticalfit.mx', 'phone' => null, 'password' => bcrypt('Vertical1234'), 'img' => 'placeholder.png', 'pole_lessons' => 0, 'regular_lessons' => 0, 'regular_expire' => date('r'), 'pole_expire' => date('r'), 'created_at' => date('r'), 'updated_at' => date('r')],
    		['role_id' => 2, 'name' => 'Maestra Vertical', 'email' => 'maestra@verticalfit.mx', 'phone' => null, 'password' => bcrypt('Vertical1234'), 'img' => 'placeholder.png', 'pole_lessons' => 0, 'regular_lessons' => 0, 'regular_expire' => date('r'), 'pole_expire' => date('r'), 'created_at' => date('r'), 'updated_at' => date('r')],
    		['role_id' => 3, 'name' => 'Nutrióloga Vertical', 'email' => 'nutriologa@verticalfit.mx', 'phone' => null, 'password' => bcrypt('Vertical1234'), 'img' => 'placeholder.png', 'pole_lessons' => 0, 'regular_lessons' => 0, 'regular_expire' => date('r'), 'pole_expire' => date('r'), 'created_at' => date('r'), 'updated_at' => date('r')],
    		['role_id' => 4, 'name' => 'Alumna Vertical', 'email' => 'alumna@verticalfit.mx', 'phone' => null, 'password' => bcrypt('Vertical1234'), 'img' => 'placeholder.png', 'pole_lessons' => 0, 'regular_lessons' => 0, 'regular_expire' => date('r'), 'pole_expire' => date('r'), 'created_at' => date('r'), 'updated_at' => date('r')],
    	]);

    	DB::table('roles')->insert([
    		['title' => 'Admin', 'created_at' => date('r'), 'updated_at' => date('r')],
    		['title' => 'Maestra', 'created_at' => date('r'), 'updated_at' => date('r')],
    		['title' => 'Notrióloga', 'created_at' => date('r'), 'updated_at' => date('r')],
    		['title' => 'Alumna', 'created_at' => date('r'), 'updated_at' => date('r')],
    	]);

    }
}
