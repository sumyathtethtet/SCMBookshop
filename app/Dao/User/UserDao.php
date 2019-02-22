<?php

namespace laravel\Dao\User;

use laravel\Contracts\Dao\User\UserDaoInterface;
use laravel\Models\User;

class UserDao implements UserDaoInterface
{
  /**
   * Get Operator List
   * @param Object
   * @return $operatorList
   */
  public function getUserList()
  {
    return User::get();
  }
}
