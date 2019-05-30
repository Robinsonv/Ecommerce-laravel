<?php

// Route::view('/', 'landing-page');

Route::get('/', 'LandingPageController@index')->name('landing-page');
Route::get('/shop', 'ShopController@index')->name('shop.index');
Route::get('/shop/{product}', 'ShopController@show')->name('shop.show');
Route::view('/product', 'product');
// Route::view('/cart', 'cart');
Route::get('/cart', 'CartController@index')->name('cart.index');
Route::post('/cart', 'CartController@store')->name('cart.store');
Route::patch('/cart/{product}', 'CartController@update')->name('cart.update');
Route::delete('/cart/{product}', 'CartController@destroy')->name('cart.destroy');
Route::post('/cart/switchToSaveForLater/{producto}', 'CartController@switchToSaveForLater')->name('cart.switchToSaveForLater');

Route::delete('/saveForLater/{product}', 'SaveForLaterController@destroy')->name('saveForLater.destroy');
Route::post('/saveForLater/switchToCart/{producto}', 'SaveForLaterController@switchToCart')->name('saveForLater.switchToCart');


Route::get('empty', function (){
            
        Cart::destroy();
        return back();
})->name("empty");

Route::get('emptyinstance', function (){
            
    Cart::instance('saveForLater')->destroy();
    return back();
})->name("empty.instance");


Route::get('/checkout', 'CheckoutController@index')->name('checkout.index');
Route::post('/checkout', 'CheckoutController@store')->name('checkout.store');


Route::get('/thankyou', 'ConfirmationController@index')->name('confirmation.index');

Route::post('/coupon', 'CouponController@store')->name('coupon.store');
Route::delete('/coupon', 'CouponController@destroy')->name('coupon.destroy');


// Route::view('/checkout', 'checkout');
// Route::view('/thankyou', 'thankyou');
