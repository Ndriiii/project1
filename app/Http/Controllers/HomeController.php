<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function main(){
        $clothingProducts = Product::where('Kategori_Produk', 'Clothing')->take(4)->get();
        $gamingProducts = Product::where('Kategori_Produk', 'Gaming')->take(4)->get();
        $otherProducts = Product::whereNotIn('Kategori_Produk', ['Clothing', 'Gaming'])->take(4)->get();
        $discountedProducts = Product::where('Diskon', '>', 0)->take(4)->get();
        $cart = session()->get('cart', []);  
        return view('main', compact('clothingProducts','gamingProducts','otherProducts','discountedProducts', 'cart'));
    }


    public function offers(){
        $discountedProducts = Product::where('Diskon', '>', 0)->get();
        return view('offers', compact('discountedProducts'));
    }

    public function other(){
        $otherProducts = Product::whereNotIn('Kategori_Produk', ['Clothing', 'Gaming'])->get();
        return view('other', compact('otherProducts'));
    }

    public function profile(){
        return view('profile');
    }

    public function gaming(){
        $gamingProducts = Product::where('Kategori_Produk', 'Gaming')->get();
        return view('gaming', compact('gamingProducts'));
    }
    
    public function cart(){
        return view('cart');
    }
    
    public function clothing(){
        $clothingProducts = Product::where('Kategori_Produk', 'Clothing')->get();
        return view('clothing', compact('clothingProducts'));
    }

    public function admin(){
        return view('admin');
    }

    public function aboutus(){
        return view('aboutus');
    }

}

