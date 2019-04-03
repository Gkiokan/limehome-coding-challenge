<?php

use Illuminate\Database\Seeder;
use App\User;


class DatabaseSeeder extends Seeder
{


    public function run()
    {
        // User::truncate();
        User::query()->delete();

        User::create($this->user('gkiokan', 'Gkiokan', 'Sali', 'me@gkiokan.net'));
        User::create($this->user('demo', 'John', 'Doe', 'example@gkiokan.net'));
    }


    public function user($name='', $fn='', $ln='', $email='', $pass='test'){
        $user = [
          'name'      => $name,
          'email'     => $email,
          'role'      => 'admin',
          'active'    => 1,
          'password'  => bcrypt($pass),
          'valid'     => 1,
          'gain_access' => 1,
        ];

        return $user;
    }
}
