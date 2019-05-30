<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coupon;
use Gloudemans\Shoppingcart\Facades\Cart;

class CouponController extends Controller
{
    
    public function store(Request $request)
    {
        $coupon = Coupon::where('code', $request->coupon_code)->first();

        if(! $coupon ){
            return redirect()->route('checkout.index')->withErrors('Cupon invalido. Por favor intente de nuevo !');
        }

        session()->put('coupon',[
            'name' => $coupon->code,
            'discount' => $coupon->discount( Cart::subtotal() ),
        ]);

        return redirect()->route('checkout.index')->with('success_message','Se ha usado el cupo con éxito !');

    }

    public function destroy()
    {
        session()->forget('coupon');
        return redirect()->route('checkout.index')->with('success_message','El cupo se ha removido con éxito !');

    }
}
