<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class HomeController extends Controller
{
    public function index()
    {
        $product = Product::paginate(9 );
        // $product = Product::all();
        return view('home.userpage',compact('product'));
    }
    public function redirect()
    {
        $usertype = Auth::user()->usertype;
        $product = Product::paginate(9);
        if($usertype == '1')
        {
            return view('admin.home',compact('product'));
        }
        else 
        {
            return view('home.userpage',compact('product'));
        }
    }
    public function product_details($id)
    {
        $products = Product::find($id);
        return view('home.product_details',compact('products'));
    }
}
