<?php

namespace laravel\Services\Auth;

use laravel\Contracts\Dao\Auth\AuthDaoInterface;
use laravel\Contracts\Services\Auth\AuthServiceInterface;

class AuthService implements AuthServiceInterface
{
  private $authDao;

  /**
   * Class Constructor
   * @param AuthDaoInterface
   * @return
   */
  public function __construct(AuthDaoInterface $authDao)
  {
    $this->authDao = $authDao;
  }
}
