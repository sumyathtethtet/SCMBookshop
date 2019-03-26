<?php

namespace App\Contracts\Services;

interface CartServiceInterface
{
    public function getAdd($id);
    public function getConfirm();
}
