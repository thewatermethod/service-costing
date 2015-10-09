<?php

class UserTableSeeder extends Seeder
{

public function run()
{
    DB::table('users')->delete();
    User::create(array(
        'name'     => 'Matt Bevilacqua',
        'username' => 'matt',
        'email'    => 'thewatermethod@gmail.com',
        'password' => Hash::make('watergate'),
        'access' => '1',
    ));
    User::create(array(
        'name'     => 'Chris Baillie',
        'username' => 'chris',
        'email'    => 'matt@wash-safe.com',
        'password' => Hash::make('watergate'),
        'access' => '2',
    ));

}

}