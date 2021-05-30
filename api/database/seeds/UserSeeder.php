<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Ilham Balebat',
            'email' => 'ilhambalebat@gmail.com',
            'password' => bcrypt('password')
        ]);
    }
}
