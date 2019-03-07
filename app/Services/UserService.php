<?php

namespace App\Services;

use App\Contracts\Dao\UserDaoInterface;
use App\Contracts\Services\UserServiceInterface;
use App\User;

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
  public function create(array $data)
  {
    $this->userDao->create($data);
  }
}