<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use PDF;
use Notification;
use App\Notifications\SendEmailNotification;

class AdminController extends Controller
{
    public function view_category()
    {
        $data = Category::all();
        return view('admin.category',compact('data'));
    }
    public function add_category(Request $request)
    {
        $data = new Category;
        $data->category_name = $request->category;
        $data->save();
        return redirect()->back()->with('message','Category Added Successfully');
    }
    public function delete_category($id)
    {
        $data= Category::find($id);
        $data->delete();
        return redirect()->back()->with('message','Category Deleted Successfully');
    }
    public function view_product()
    {
        $category = Category::all();
        // $category = new Category;
        return view('admin.product',compact('category'));
    }
    public function add_product(Request $request)
    {
       $product = new Product;
       $product->title = $request->title;
       $product->description = $request->description;
    
       $product->category = $request->category;
       $product->quantity = $request->quantity;
       $product->price = $request->price;
       $product->discount_price = $request->dis_price;
       $image = $request->image;
       $imagename = time() . '.' . $image->getClientOriginalExtension();
       $request->image->move('productimg',$imagename);
       $product->image = $imagename;
       $product->save();

       return redirect()->back()->with('message','Product Added Successfully');
    }
    public function show_product()
    {
        $product = Product::all();
        return view('admin.show_product',compact('product'));
    }
    public function delete_product($id)
    {
        $data= Product::find($id);
        $data->delete();
        return redirect()->back()->with('message','Product Deleted Successfully');
    }
    public function update_product($id)
    {
        $category = Category::all();
        $product = Product::find($id);
        return view('admin.update_product',compact('product','category'));
    }
    public function update_product_confirm(Request $request,$id)
    {
        $product = Product::find($id);
        $product->title = $request->title;
        $product->description = $request->description;
        
        $product->category = $request->category;
        $product->quantity = $request->quantity;
        $product->price = $request->price;
        $product->discount_price = $request->dis_price;

        $image = $request->image;
        if($image)
        {
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $request->image->move('productimg',$imagename);
            $product->image = $imagename;
        }
        

        $product->save();
        return redirect()->back()->with('message','Product Updated Successfully');
    }
    public function order()
    {
        $order = Order::all();
        return view('admin.order',compact('order'));
    }
    public function delivered($id)
    {
        $order = Order::find($id);
        $order->delivery_status = "Delivered";
        $order->payment_status = "Paid";
        $order->save();
        return redirect()->back();
    }
    public function print_pdf($id)
    {
        $order = Order::find($id);
        $pdf = PDF::loadView('admin.pdf',compact('order'));
        return $pdf->download('order_details.pdf');
    }
    public function send_mail($id)
    {
        $order = Order::find($id);
        return view('admin.email_info', compact('order'));
    }
    public function send_user_email(Request $request, $id)
    {
        $order= Order::find($id);
        $details = [
            'title'=> $request->title,
            'body'=> $request->body,
        ];
        Notification::send($order, new SendEmailNotification($details));
        return redirect()->back()->with('message','Mail Sent Successfully');
    }
    public function search(Request $request)
    {
        $searchtext = $request->search;
        $order = Order::where('name','LIKE',"%$searchtext%")->
                        orWhere('phone','LIKE',"%$searchtext%")->
                        orWhere('email','LIKE',"%$searchtext%")->
                        orWhere('product_title','LIKE',"%$searchtext%")->
                        orWhere('delivery_status','LIKE',"%$searchtext%")->
                        orWhere('address','LIKE',"%$searchtext%")->
                        orWhere('price','LIKE',"%$searchtext%")->
                        orWhere('payment_status','LIKE',"%$searchtext%")->get();
        
        return view('admin.order',compact('order'));
    }
}
