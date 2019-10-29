<?php

namespace App\Http\Controllers;

use App\Cart;
use Illuminate\Http\Request;
use App\Order;
use Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('frontend.pages.cart');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'product_id' => 'required'
        ],
        [
            'product_id.required' => 'Please choose your product'
        ]);
        $cart = new Cart();
        if ( Auth::check() ){
            $cart = Cart::where('user_id', Auth::id())->where('product_id', $request->product_id)->first();
        }
        else{
            $cart = Cart::where('ip_address', request()->ip() )->where('product_id', $request->product_id)->first();
        }
        if ( !is_null($cart) ){
            $cart->increment('product_quantity');
        }
        else{
            $cart = new Cart();

            if ( Auth::check() ){
                $cart->user_id = Auth::id(); 
            }
            $cart->ip_address = $request->ip();
            $cart->product_id = $request->product_id;
            // $cart->order_id = $request->order_id;
            // $cart->product_quantity = $request->product_quantity;
            $cart->save();
        }  

        
        
        session()->flash('success', 'Product Add to Cart');
        return back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        //
    }
}
