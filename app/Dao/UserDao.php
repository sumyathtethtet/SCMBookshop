<?php

namespace App\Dao;

use App\Contracts\Dao\UserDaoInterface;
use App\User;

class UserDao implements UserDaoInterface
{

  public function create(array $data)
  {
    $user = User::create([
      'name' => $data['name'],
      'email' => $data['email'],
      'password' => bcrypt($data['password']),
      'phone'=> $data['phone'],
      'dob'=> $data['dob'],
      'profile'=> $data['profile'],
      'create_user_id' => 1,
      'updated_user_id'=> 1,
  ]);
  $profile = time().'.'.request()->profile->getClientOriginalExtension();
  request()->profile->move(public_path($user->id), $profile);
  }
}
