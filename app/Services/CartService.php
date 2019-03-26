<?php

namespace App\Services;

use App\Book;
use App\Contracts\Dao\CartDaoInterface;
use App\Contracts\Services\CartServiceInterface;

class CartService implements CartServiceInterface
{
    private $cartDao;

    /**
     * Class Constructor
     * @param BookDaoInterface
     * @return
     */
    public function __construct(CartDaoInterface $cartDao)
    {
        $this->cartDao = $cartDao;
    }

    public function getAdd($id)
    {
        return $this->cartDao->getAdd($id);
    }

    public function getConfirm()
    {
        return $this->cartDao->getConfirm();
    }
}
