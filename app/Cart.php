<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    //
    public $items = null;
    public $totalQty = 0;
    public $totalAmount = 0;
    public function __construct($oldCart)
    {
        if ($oldCart) {
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalAmount = $oldCart->totalAmount;
        }
    }
    public function Add($item, $id)
    {
        $storeItem = ['item' => $item, 'price' => $item->price, 'qty' => 0];
        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                $storeItem = $this->items[$id];
            }
        }
        $storeItem['qty']++;
        $storeItem['price'] = $storeItem['qty'] * $item->price;
        $this->items[$id] = $storeItem;
        $this->totalQty++;
        $this->totalAmount += $item->price;
    }

}
