<?php

namespace App\Http\Controllers\Cart;

use App\Book;
use App\Cart;
use App\Contracts\Services\CartServiceInterface;
use App\Http\Controllers\Controller;
use App\Mail\BookMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Mail;

class CartController extends Controller
{

    private $cartInterface;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(CartServiceInterface $cartInterface)
    {
        $this->cartInterface = $cartInterface;
    }

    /**
     * Display a listing of the resource.
     *
     * @param
     * @return \Illuminate\Http\Response
     */
    public function getCart()
    {

        if (Session::has('cart')) {
            $cart = Session::get('cart');

            return view('list-cart')->with(['book' => $cart]);

        }
        return view('list-cart')->with(['book' => []]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function addToCart($id)
    {
        $bookCat = $this->cartInterface->getAdd($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : [];
        $oldCart[$id] = $bookCat;

        Session::put('cart', $oldCart);

        return redirect('list-book');
    }

    /**
     * Clear all data from session
     *
     * @param
     * @return \Illuminate\Http\Response
     */
    public function clearCart()
    {
        Session::forget('cart');
        return redirect('list-book');
    }

    /**
     * Display a listing of the resource.
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function removeCart($id)
    {
        $products = session('cart');

        foreach ($products as $key => $value) {

            if ($value->id == $id) {

                unset($products[$key]);
            }
        }
        Session::put('cart', $products);
        return redirect()->back();
    }

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function confirmBook(Request $request)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : [];
        foreach ($oldCart as $key => $cart) {

            $cart->quantity = $request->quantity[$key];
        }

        Session::put('cart', $oldCart);

        return redirect('list-order');
    }

    /**
     * Create a new controller instance to show order list.
     *
     */
    public function orderBook()
    {
        if (Session::has('cart')) {

            $cart = Session::get('cart');
            return view('list-order')->with(['book' => $cart]);
        }
        return view('list-order')->with(['book' => []]);
    }

    /**
     * Create a new controller instance to confirm book.
     *
     */
    public function confirm()
    {
        $users = $this->cartInterface->getConfirm();
        $this->sendMail($users);
        Session::forget('cart');
        return redirect('list-book');
    }

    /**
     * Create a new controller instance to send email after a confirm book.
     *
     * @param  $email
     */
    public static function sendmail($email)
    {
        Mail::to($email)->send(new BookMail());
    }

}
