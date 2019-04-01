<?php

namespace App\Dao;

use App\Contracts\Dao\LoginDaoInterface;
use App\User;

class LoginDao implements LoginDaoInterface
{

    public function googleLogin()
    {
        $newUser = new User;
        $newUser->name = $user->name;
        $newUser->email = $user->email;
        $newUser->google_id = $user->id;
        $newUser->create_user_id = 1;
        $newUser->updated_user_id = 1;
        $newUser->save();
        auth()->login($newUser, true);

    }
}
