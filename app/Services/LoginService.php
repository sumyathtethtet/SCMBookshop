<?php

namespace App\Services;

use App\Contracts\Dao\LoginDaoInterface;
use App\Contracts\Services\LoginServiceInterface;
use App\User;

class LoginService implements LoginServiceInterface
{
    private $loginDao;

    /**
     * Class Constructor
     * @param OperatorUserDaoInterface
     * @return
     */
    public function __construct(LoginDaoInterface $loginDao)
    {
        $this->loginDao = $loginDao;
    }

    /**
     * Get User List
     * @param Object
     * @return $userList
     */
    public function googleLogin()
    {
        return $this->loginDao->googleLogin();
    }
}
