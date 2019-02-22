<?php

namespace laravel\Services\User;

use laravel\Contracts\Dao\User\UserDaoInterface;
use laravel\Contracts\Services\User\UserServiceInterface;

class UserService implements UserServiceInterface
{
  private $userDao;

  /**
   * Class Constructor
   * @param OperatorUserDaoInterface
   * @return
   */
  public function __construct(UserDaoInterface $userDao)
  {
    $this->userDao = $userDao;
  }

  /**
   * Get User List
   * @param Object
   * @return $userList
   */
  public function getUserList()
  {
    return $this->userDao->getUserList();
  }
}
