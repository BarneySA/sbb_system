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
        $user->name = 'User 1';
        $user->username = 'user1';
        $user->password = \Hash::make('123456789');
        $user->birthdate = '1994-09-14';
        $user->contry = 'VE';
        $user->email = 'user1@gmail.com';
        $user->city = 'Bolivar';
        $user->wallet_public_key = '1d1baeecd50735c4a8379b5ee32a2b53d94a212944a8000a147daf6b0374fcc9';
        $user->wallet_address = 'AJ4GYU9cnaZithFq61fhdLmKsjZgn4dNkG';
        $user->role = 0;
        $user->status = '1';
        $user->save();

        $user = new App\User;
        $user->name = 'User 2';
        $user->username = 'user2';
        $user->password = \Hash::make('123456789');
        $user->birthdate = '1994-09-14';
        $user->contry = 'AR';
        $user->email = 'user2@gmail.com';
        $user->city = 'Bolivar';
        $user->wallet_public_key = '06566cfdd22266a1d0666f1332f57863a0874ba63142cc00d1357548c83ce122';
        $user->wallet_address = 'ATGTs52AgHMGrzNcoffSzJpma1VtGP7aPs';
        $user->role = 0;
        $user->status = '1';
        $user->save();

        $user = new App\User;
        $user->name = 'User 3 - Smart contract test';
        $user->username = 'user3';
        $user->password = \Hash::make('123456789');
        $user->birthdate = '1994-09-14';
        $user->contry = 'AR';
        $user->email = 'user3@gmail.com';
        $user->city = 'Bolivar';
        $user->wallet_public_key = '32d9777bab6671ea3d31fd9630beb3c8c7d9e7478d6d1abe416c96722ff507ae';
        $user->wallet_address = 'AXSZcS5pxHexZMhuoLvLQMDjLoepNRJdtA';
        $user->role = 0;
        $user->status = '1';
        $user->save();

        $user = new App\User;
        $user->name = 'Administrator';
        $user->username = 'administrator';
        $user->password = \Hash::make('123456789');
        $user->birthdate = '1994-09-14';
        $user->contry = 'AR';
        $user->email = 'admin@gmail.com';
        $user->city = 'Buenos Aires';
        $user->wallet_public_key = '0e56e4901bcb64a8193c5ca60939c346a2d2149c0f23e1af6c97f4c93ae176e1';
        $user->wallet_address = 'Ae9ZE9y3g2yJSX2kLwMx8PT24V68jNX9Ms';
        // Wallet miannet
        // $user->wallet_public_key = '3d14095d029c7452f4ce4039294bdd4e0ced5f20521bfe22d1dc0aa4df22f234';
        // $user->wallet_address = 'AKhqz1wdB7Yru8QShS6CXVqUF9oDKrZyn4';
        $user->role = 1;
        $user->status = '1';
        $user->save();


        // $user = new App\User;
        // $user->name = 'Admin Contract';
        // $user->username = 'admin';
        // $user->password = \Hash::make('123456789');
        // $user->birthdate = '1994-09-14';
        // $user->contry = 'AR';
        // $user->email = 'admin@gmail.com';
        // $user->city = 'Buenos Aires';
        // $user->wallet_public_key = '0e56e4901bcb64a8193c5ca60939c346a2d2149c0f23e1af6c97f4c93ae176e1';
        // $user->wallet_address = 'Ae9ZE9y3g2yJSX2kLwMx8PT24V68jNX9Ms';
        // $user->role = 1;
        // $user->status = '1';
        // $user->save();

    }
}
