<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Comment;
use App\Models\Reply;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Session;
use Stripe;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    public function index()
    {
        $product = Product::paginate(9);
        // $product = Product::all();
        $comment = Comment::orderby('id','desc')->get();
        $reply = Reply::all();
        $cartItemCount = $this->getCartItemCount();
        return view('home.userpage',compact('product','comment','reply','cartItemCount'));
    }
    public function redirect()
    {
        $usertype = Auth::user()->usertype;
        $product = Product::paginate(9);
        if($usertype == '1')
        {
            $total_product = Product::all()->count();
            $total_order = Order::all()->count();
            $total_user = User::all()->count();
            $order = Order::all();
            $total_revenue = 0;
            foreach($order as $order)
            {
                $total_revenue = $total_revenue + $order->price;
            }
            $order_delivered = Order::where('delivery_status','=','Delivered')->get()->count();
            $order_processing = Order::where('delivery_status','=','processing')->get()->count();
            return view('admin.home',compact('product','total_product','total_order','total_user','total_revenue','order_delivered','order_processing'));
        }
        else 
        {
            $cartItemCount = $this->getCartItemCount();
            $comment = Comment::orderby('id','desc')->get();
            $reply = Reply::all();
            return view('home.userpage',compact('product','comment','reply','cartItemCount'));
        }
    }
    public function product_details($id)
    {
        $products = Product::find($id);
        $cartItemCount = $this->getCartItemCount();
        return view('home.product_details',compact('products','cartItemCount'));
    }
    public function add_cart(Request $request, $id)
    {
        if(Auth::id())
        {
            $user = Auth::user();
            $user_id = $user->id;
            $product = Product::find($id);
            $product_exist_id = Cart::where('Product_id','=',$id)->where('user_id','=',$user_id)->get('id')->first();
            if($product_exist_id)
            {
                $cart = Cart::find($product_exist_id)->first();
                $quantity = $cart->quantity;
                $cart->quantity = $quantity + $request->Quantity;

                if($product->discount_price != null)
                {
                    $cart->price = $product->discount_price * $cart->quantity;
                }
                else{
                    $cart->price = $product->price * $cart->quantity;
                }
                $cart->save();
                Alert::success('Product Added Successfully','We have added product to the cart');
                return redirect()->back();
            }
            else
            {
                $cart = new Cart;
                $cart->name = $user->name;
                $cart->email = $user->email;
                $cart->phone = $user->phone;
                $cart->address = $user->address;
                $cart->user_id = $user->id;

                $cart->product_title = $product->title;
                if($product->discount_price != null)
                {
                    $cart->price = $product->discount_price * $request->Quantity;
                }
                else{
                    $cart->price = $product->price * $request->Quantity;
                }
                $cart->image = $product->image;
                $cart->Product_id = $product->id;
                $cart->quantity = $request->Quantity;
                $cart->save();
                Alert::success('Product Added Successfully','We have added product to the cart');
                return redirect()->back();
            }
            
        }
        else
        {
            return redirect('login');
        }
    }
    public function show_cart()
    {
        if(Auth()->id())
        {
            $cartItemCount = $this->getCartItemCount();
            $id = Auth::user()->id;
            $cart = Cart::where('user_id', '=', $id)->get();
            return view('home.showcart',compact('cart','cartItemCount'));
        }
        else{
            return redirect('login');
        }
        
    }
    public function remove_cart($id)
    {
        $cart = Cart::find($id);
        $cart->delete();
        Alert::warning('Removed From Cart Successfully','You have removed a product from cart');
        return redirect()->back();
    }
    public function cash_order()
    {
        $user = Auth::user();
        $user_id = $user->id;
        $data = Cart::where('user_id', '=',$user_id)->get();
        if($data->count() == 0)
        {
            Alert::warning('Please add items in Cart!','You need to add product in cart in order to checkout');
            return redirect()->back();
        }
        else{
            foreach($data as $data)
        {
            $order=  new Order;
            $order->name = $data->name;
            $order->email = $data->email;
            $order->phone = $data->phone;
            $order->address = $data->address;
            $order->user_id = $data->user_id;

            $order->product_title = $data->product_title;
            $order->price = $data->price;
            $order->quantity = $data->quantity;
            $order->image = $data->image;
            $order->product_id = $data->Product_id;
            $order->image = $data->image;
            $order->payment_status = 'cash on delivery';
            $order->delivery_status = 'processing';
            $order->save();

            $cart_id = $data->id;
            $cart = Cart::find($cart_id);
            $cart->delete();
        }
        Alert::success('We Have Received Your Order','We will contact you shortly');
        return redirect()->back();
        }
        
    }
    public function stripe($totalprice)
    {
        $cartItemCount = $this->getCartItemCount();
        $user = Auth::user();
        $user_id = $user->id;
        $data = Cart::where('user_id', '=',$user_id)->get();
        if($data->count() == 0)
        {
            Alert::warning('Please add items in Cart!','You need to add product in cart in order to checkout');
            return redirect()->back();
        }
        return view('home.stripe',compact('totalprice','cartItemCount'));
    }
    public function stripePost(Request $request, $totalprice)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    
        Stripe\Charge::create([
            "amount" => number_format($totalprice / 132, 2, '.', '') * 100,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Thanks For Payment" 
        ]);
        $user = Auth::user();
        $user_id = $user->id;
        $data = Cart::where('user_id', '=',$user_id)->get();
        
        foreach($data as $data)
        {
            $order=  new Order;
            $order->name = $data->name;
            $order->email = $data->email;
            $order->phone = $data->phone;
            $order->address = $data->address;
            $order->user_id = $data->user_id;

            $order->product_title = $data->product_title;
            $order->price = $data->price;
            $order->quantity = $data->quantity;
            $order->image = $data->image;
            $order->product_id = $data->Product_id;
            $order->image = $data->image;
            $order->payment_status = 'paid';
            $order->delivery_status = 'processing';
            $order->save();

            $cart_id = $data->id;
            $cart = Cart::find($cart_id);
            $cart->delete();
        }
      
        Session::flash('success', 'Payment successful!');
              
        // return back();
        return redirect('redirect')->with('message','Payment Successful');
    }
    public function show_order()
    {
        if(Auth()->id())
        {
            $id = Auth::user()->id;
            $order = Order::where('user_id', '=', $id)->get();
            $cartItemCount = $this->getCartItemCount();
            return view('home.order',compact('order','cartItemCount'));
        }
        else{
            return redirect('login');
        }
        
    }
    public function cancel_order($id)
    {
        $order = Order::find($id);
        $order->delivery_status = 'Cancelled';
        $order->save();
        return redirect()->back()->with('message','Order Cancelled Successful');
    }
    public function add_comment(Request $request)
    {
        if(Auth()->id())
        {
            $comment = new Comment;
            $comment->name = Auth::user()->name;
            $comment->user_id = Auth::user()->id;
            $comment->comment = $request->comment;
            $comment->save();
            return redirect()->back()->with('message','Comment Posted Successful');
        }
        else{
            return redirect('login');
        }
    }
    public function add_reply(Request $request)
    {
        if(Auth()->id())
        {
            $reply = new Reply;
            $reply->name = Auth::user()->name;
            $reply->user_id = Auth::user()->id;
            $reply->comment_id = $request->commentId;
            $reply->reply = $request->reply;
            $reply->save();
            return redirect()->back();
        }
        else{
            return redirect('login');
        }
    }
    public function product_search(Request $request)
    {
        $cartItemCount = $this->getCartItemCount();
        $comment = Comment::orderby('id','desc')->get();
        $reply = Reply::all();
        $search_text = $request->search;
        $product = Product::where('title','LIKE',"%$search_text%")
        ->orWhere('category','LIKE',"%$search_text%")->paginate(9);
        return view('home.userpage', compact('product','comment','reply','cartItemCount'));
    }
    public function products()
    {
        $cartItemCount = $this->getCartItemCount();
        $product = Product::paginate(9);
        $comment = Comment::orderby('id','desc')->get();
        $reply = Reply::all();
        return view('home.all_product',compact('product','comment','reply','cartItemCount'));
    }
    public function search_product(Request $request)
    {
        $cartItemCount = $this->getCartItemCount();
        $comment = Comment::orderby('id','desc')->get();
        $reply = Reply::all();
        $search_text = $request->search;
        $product = Product::where('title','LIKE',"%$search_text%")
        ->orWhere('category','LIKE',"%$search_text%")->paginate(9);
        return view('home.all_product', compact('product','comment','reply','cartItemCount'));
    }
    public function contact()
    {
        $cartItemCount = $this->getCartItemCount();
        return view('home.contactpage',compact('cartItemCount'));
    }
    // doing this so that dont have to repeat code everytime
    public function getCartItemCount()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $cartItems = Cart::where('user_id', $user->id)->get();
            return $cartItems->count();
        } else {
            return 0;
        }
    }
}
