<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;

class ShopController extends Controller
{
    
    public function index()
    {
        $pagination = 6;
        $categories = Category::all();
        if(request()->category){
            $products = Product::with('categories')->whereHas('categories', function ($query){
                $query->where('slug', request()->category);
            });
            $categoryName = optional($categories->where('slug', request()->category)->first())->name;

        }else{

            $products = Product::where('facture', true);
            $categoryName = 'Facture';
        }

        if( request()->sort == 'low_high' ){
            $products = $products->orderBy('price', 'asc')->paginate($pagination);
        }elseif( request()->sort == 'high_low' ){
            $products = $products->orderBy('price', 'desc')->paginate($pagination);
        }else{ 
            $products = $products->paginate($pagination);
        }

        return view('shop')->with([
            'products' => $products,
            'categories' => $categories,
            'categoryName' => $categoryName,
        ]);
    }

    
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        $mightAlsolike = Product::where('slug', '!=', $slug)->inRandomOrder()->take(4)->get();
        return view('product')->with([
            'product' => $product,
            'mightAlsolike' => $mightAlsolike
            ]);
    }

}
