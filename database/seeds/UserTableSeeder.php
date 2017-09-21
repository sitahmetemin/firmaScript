<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $add = App\User::create([
            'name' => 'Ahmet Emin',
            'lastname' => 'ŞİT',
            'tc_no' => '17180939450',
            'email'=>'sitahmetemin@hotmail.com',
            'password'=>bcrypt('123654'),
            ]);
    }
}
