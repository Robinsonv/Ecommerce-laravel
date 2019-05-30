<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Gloudemans\Shoppingcart\Facades\Cart;

class SaveForLaterController extends Controller
{
    
    public function destroy($id)
    {
        Cart::instance('saveForLater')->remove($id);

        return back()->with('success_message', 'El producto se ha removido de guardado para mas tarde!');
    }

    /**
     * switch item To  cart
     */

    public function switchToCart($id)
    {
        $item = Cart::instance('saveForLater')->get($id);

        Cart::instance('saveForLater')->remove($id);

        $duplicates = Cart::instance('default')->search(function ($cartItem, $rowId) use ($id){
            return $rowId === $id;
        });

        if ( $duplicates->isNotEmpty() ) {
            return redirect()->route('cart.index')->with('success_message', 'El producto ya está en carrito !');
        }

        Cart::instance('default')->add($item->id, $item->name, 1, $item->price)
            ->associate('App\Product');
        return redirect()->route('cart.index')->with('success_message', 'El producto se ha movido a carrito!');

    }
}
