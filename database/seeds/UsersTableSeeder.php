<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        User::create([
            'name'     => 'admin',
            'email'    => 'admin@gmail.com',
            'password' => bcrypt('123123')
        ]);

        User::create([
            'name'     => 'client',
            'email'    => 'client@gmail.com',
            'password' => bcrypt('123123')
        ]);

        User::create([
            'name'     => 'ravuthz',
            'email'    => 'ravuthz@gmail.com',
            'password' => bcrypt('123123')
        ]);
    }
}
