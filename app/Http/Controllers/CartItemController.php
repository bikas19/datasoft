<?php

namespace App\Http\Controllers;

use App\CartItem;
use App\Food;
use Illuminate\Http\Request;

class CartItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        //
        $items = CartItem::with('food')->where('user_id', auth()->user()->id)->get();
        return view('cart', compact('items'));
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
    public function store(Request $request, $id)
    {
        $user = auth()->user();
        $food = Food::findOrFail($id);
        //
        $item = CartItem::where('user_id', $user->id)->where('food_id', $id)->first();

        if ($item) {
            $item->rate = $food->price;
            $item->quantity += 1;
            $item->total = round($item->rate * $item->quantity, 3);
            $item->save();
        } else {
            $item = new CartItem;
            $item->user_id = $user->id;
            $item->food_id = $food->id;
            $item->rate = $food->price;
            $item->quantity = 1;
            $item->total = $item->rate * $item->quantity;
            $item->save();
        }

        return back()->with('message', 'Successfully added item to the cart');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CartItem  $cartItem
     * @return \Illuminate\Http\Response
     */
    public function show(CartItem $cartItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CartItem  $cartItem
     * @return \Illuminate\Http\Response
     */
    public function edit(CartItem $cartItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CartItem  $cartItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $item)
    {
        $this->validate(
            $request,
            [
                'qty' => 'integer|min:0|required'
            ]
        );
        $cartItem = CartItem::with('food')->where('user_id', auth()->user()->id)->where('id', $item)->firstOrFail();

        if ($request->qty == 0) {
            $cartItem->delete();
        } else {

            $cartItem->quantity = $request->qty;
            $cartItem->rate = $cartItem->food->price;
            $cartItem->total = round($cartItem->rate * $cartItem->quantity, 3);
            $cartItem->save();
        }
        return back()->with('message', 'Successfully updated your cart');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CartItem  $cartItem
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $item = CartItem::where(['id'=>$id],['user_id',auth()->user()->id])->firstOrFail();
        $item->delete();
        return back()->with('message', 'Successfully updated your cart');

    }
}
