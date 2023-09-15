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

class HomeController extends Controller
{
    public function index()
    {
        $product = Product::paginate(9);
        // $product = Product::all();
        $comment = Comment::orderby('id','desc')->get();
        $reply = Reply::all();
        return view('home.userpage',compact('product','comment','reply'));
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
            $comment = Comment::orderby('id','desc')->get();
            $reply = Reply::all();
            return view('home.userpage',compact('product','comment','reply'));
        }
    }
    public function product_details($id)
    {
        $products = Product::find($id);
        return view('home.product_details',compact('products'));
    }
    public function add_cart(Request $request, $id)
    {
        if(Auth::id())
        {
            $user = Auth::user();
            $product = Product::find($id);

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
            
            return redirect()->back();
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
            $id = Auth::user()->id;
            $cart = Cart::where('user_id', '=', $id)->get();
            return view('home.showcart',compact('cart'));
        }
        else{
            return redirect('login');
        }
        
    }
    public function remove_cart($id)
    {
        $cart = Cart::find($id);
        $cart->delete();
        return redirect()->back()->with('message','Removed Product From Cart');
    }
    public function cash_order()
    {
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
            $order->payment_status = 'cash on delivery';
            $order->delivery_status = 'processing';
            $order->save();

            $cart_id = $data->id;
            $cart = Cart::find($cart_id);
            $cart->delete();
        }
        return redirect()->back()->with('message','We Have Received Your Order');
    }
    public function stripe($totalprice)
    {
        return view('home.stripe',compact('totalprice'));
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
            return view('home.order',compact('order'));
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
}
