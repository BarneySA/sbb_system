<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UsersTableSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker::create();

        $user = new App\User;
        $user->name = 'Pedro Carvajal';
        $user->username = 'pedrocarvajal';
        $user->password = \Hash::make('123456789');
        $user->birthdate = '1994-09-14';
        $user->contry = 'Venezuela';
        $user->email = 'xd.peter73@gmail.com';
        $user->city = 'Bolivar';
        $user->wallet_public_key = '1d1baeecd50735c4a8379b5ee32a2b53d94a212944a8000a147daf6b0374fcc9';
        $user->wallet_address = 'AJ4GYU9cnaZithFq61fhdLmKsjZgn4dNkG';
        $user->role = 1;
        $user->status = '1';
        $user->save();

        $user = new App\User;
        $user->name = 'Nicolas Cane';
        $user->username = 'nicolascane';
        $user->password = \Hash::make('123456789');
        $user->birthdate = '1994-09-14';
        $user->contry = 'Argentina';
        $user->email = 'nicolascane@gmail.com';
        $user->city = 'Buenos Aires';
        $user->wallet_public_key = '3d14095d029c7452f4ce4039294bdd4e0ced5f20521bfe22d1dc0aa4df22f234';
        $user->wallet_address = 'AKhqz1wdB7Yru8QShS6CXVqUF9oDKrZyn4';
        $user->role = 1;
        $user->status = '1';
        $user->save();

    }
}
