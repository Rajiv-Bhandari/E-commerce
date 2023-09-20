<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductComment;

class ProductCommentController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request data here if needed
       
        $comment = new ProductComment;
        $comment->product_id = $request->product_id;
        $comment->user_id = auth()->id(); // Use the authenticated user's ID
        $comment->name = auth()->user()->name; // Use the authenticated user's name
        $comment->comment = $request->comment;
        $comment->save();

        return redirect()->back()->with('message','Comment Posted Successful');
    }
}
