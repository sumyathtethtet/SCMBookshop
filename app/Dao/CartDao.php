<?php

namespace App\Dao;

use App\Book;
use App\Contracts\Dao\CartDaoInterface;
use App\User;

class CartDao implements CartDaoInterface
{
    public function getAdd($id)
    {
        return Book::where('id', $id)->first();
    }

    public function getConfirm()
    {
        return User::select('email')->where('type', 0)->first();
    }
}
