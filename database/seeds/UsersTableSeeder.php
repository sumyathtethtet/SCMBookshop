<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'id' => '1',
            'name' => 'sumyat',
            'email' =>'sumyat@gmail.com',
            'password'=>bcrypt('123456'),
            'phone'=>'09787277927',
            'dob'=>'1997-06-10',
            'profile'=>'sumyat',
            'create_user_id'=>'1',
            'updated_user_id'=>'1'


        ]);
    }
}
