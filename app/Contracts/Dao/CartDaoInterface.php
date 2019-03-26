<?php

namespace App\Contracts\Dao;

interface CartDaoInterface
{
    public function getAdd($id);
    public function getConfirm();

}
