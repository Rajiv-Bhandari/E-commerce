<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductReply;

class ProductReplyController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request data here if needed

        $reply = new ProductReply;
        $reply->product_comment_id = $request->product_comment_id;
        $reply->user_id = auth()->id(); // Use the authenticated user's ID
        $reply->name = auth()->user()->name; // Use the authenticated user's name
        $reply->reply = $request->reply;
        $reply->save();

        return redirect()->back()->with('message','Reply Posted Successful');
    }
}
