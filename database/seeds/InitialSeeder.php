<?php

use AnaliseF\User;
use Illuminate\Database\Seeder;

class InitialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userModel = new User();

        $super_admin_data = [
            'email' => 'superadmin@novelis.com.br',
            'user' => 'Superadmin',
            'password' => bcrypt('123456'),
            'name' => 'Superadmin',
            'role' => 'superadmin',
            'status' => 1,
        ];

        $userModel->saveUser($super_admin_data);
    }
}
