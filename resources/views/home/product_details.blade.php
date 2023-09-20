<!DOCTYPE html>
<html>
<head>
    {{-- <base href="/public"> --}}
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="images/Our_logo.png" type="">
    <title>Infinite Innovation</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('home/css/bootstrap.css')}}" />
    <!-- Font Awesome style -->
    <link href="{{asset('home/css/font-awesome.min.css')}}" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="{{asset('home/css/style.css')}}" rel="stylesheet" />
    <!-- Responsive style -->
    <link href="{{asset('home/css/responsive.css')}}" rel="stylesheet" />
    <!-- Add your custom CSS styles here -->
    <style>
        /* Styles for the product details section */
        .hero_area {
            background-image: url('home/images/your-background-image.jpg'); /* Add your background image URL here */
            background-size: cover;
            background-position: center;
            padding: 80px 0;
        }

        .product-details {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
            text-align: center;
        }

        .product-image img {
            max-width: 100%; /* Ensure the image does not exceed the container's width */
            max-height: 300px; /* Set a maximum height for the image */
            display: block; /* Remove extra space below inline images */
            margin: 0 auto; /* Center the image horizontally */
        }

        .product-title {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .product-price {
            font-size: 18px;
            color: blue;
        }

        .original-price {
            text-decoration: line-through;
            color: red;
        }

        .product-category {
            font-size: 16px;
        }

        .product-description {
            font-size: 16px;
            margin-top: 20px;
        }

        .product-quantity {
            font-size: 16px;
            margin-top: 20px;
        }

        .add-to-cart-btn {
            margin-top: 20px;
        }

    </style>
</head>
<body>
<!-- Header section starts -->
@include('home.header')
<!-- End header section -->

<div class="hero_area">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-4 col-lg-4 mx-auto">
                <div class="product-details">
                    <div class="product-image">
                        <img src="/productimg/{{$products->image}}" alt="Product Image">
                    </div>
                    <div class="product-title">
                        {{$products->title}}
                    </div>
                    <div class="product-price">
                        @if($products->discount_price != null)
                            Discounted Price: Rs. {{$products->discount_price}}
                        @else
                            Price: Rs. {{$products->price}}
                        @endif
                    </div>
                    @if($products->discount_price != null)
                        <div class="original-price">
                            Original Price: Rs. {{$products->price}}
                        </div>
                    @endif
                    <div class="product-category">
                        Category: {{$products->category}}
                    </div>
                    <div class="product-description">
                        Description: {{$products->description}}
                    </div>
                    <div class="product-quantity">
                        Available Quantity: {{$products->quantity}}
                    </div>
                    <form action="{{url('add_cart',$products->id)}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                            <input type="number" name="Quantity" value="1" min="1" style="width: 100px;">
                            </div>
                            <div class="col-md-4">
                            <input type="submit" value="Add To Cart">
                            </div>
                        </div> 
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- comment and reply section starts -->
    <div style="text-align:center; padding-bottom:30px;">
        <h1 style="font-size:30px; text-align:center; padding-bottom:20px;">Comments</h1>
        
        <form action="{{ route('product-comment.store') }}" method="POST">
            @csrf
            <input type="hidden" name="product_id" value="{{ $products->id }}">
            <textarea style="height:150px; width:600px;" placeholder="Express Your Thought!" name="comment"></textarea><br>
            <input type="submit" name="Comment" value="Comment">
        </form>
    </div>
    <div style="padding-left:20%;">
        <h3 style="font-size:30px; padding-bottom:20px;">All Comments</h3>
        @foreach ($products->comments as $comment)
        <div>
            <b>{{$comment->name}}</b>
            <p>{{$comment->comment}}</p>
            <div style="display:none;" class="replyDiv">
            <form class="reply-form" action="{{ route('product-reply.store') }}" method="POST">
            @csrf

                <input type="hidden" name="product_comment_id" id="product_comment_id" value="{{ $comment->id }}">
               <textarea style="height:80px; width:500px;" placeholder="Write something here" name="reply"></textarea><br>
               <!-- <a href="javascript::void(0);" class="btn btn-primary">Reply</a> -->
               <!-- <input type="submit" value="Reply" class="btn btn-primary"> -->
               <button type="submit" class="btn btn-warning">Reply</button>
               <a href="javascript::void(0);" class="btn btn-danger" onClick="reply_close(this)">Close</a>
            </form>
            
        </div><br>
            <a style="color:blue;" href="javascript::void(0);" onclick="reply(this)" data-Commentid="{{$comment->id}}"><b>Reply</b></a>
            @foreach ($comment->replies as $reply)
            @if($reply->product_comment_id==$comment->id)
            <div style="padding-left:3%; padding-bottom:10px;">
               <b>{{$reply->user->name }}</b>
               <p>{{$reply->reply}}</p>
               <!-- <a style="color:blue;" href="javascript::void(0);" onclick="reply(this)" data-Commentid="{{$comment->id}}"><b>Reply</b></a> -->
               <a style="color: blue; cursor: pointer;" class="reply-link" data-commentid="{{ $comment->id }}" onclick="reply(this)"><b>Reply</b></a>


            </div>
            @endif
            @endforeach
            
        </div><br>
        @endforeach
        
        
    </div>

<!-- Footer section -->
@include('home.footer')
<!-- End footer section -->

<div class="cpy_">
    <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>
        Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
    </p>
</div>

<script type="text/javascript">

// function reply(caller) {
//    document.getElementById('product_comment_id').value=$(caller).attr('data-Commentid');
//    $('.replyDiv').insertAfter($(caller));
//    $('.replyDiv').show();
// }
// function reply_close(caller) {
//    $('.replyDiv').hide();
// }
// </script>
//   <script>
//   document.addEventListener("DOMContentLoaded", function(event) { 
//       var scrollpos = localStorage.getItem('scrollpos');
//       if (scrollpos) window.scrollTo(0, scrollpos);
//   });

//   window.onbeforeunload = function(e) {
//       localStorage.setItem('scrollpos', window.scrollY);
//   };
$(document).on('click', '.reply-link', function(e) {
    e.preventDefault();
    var commentId = $(this).data('commentid');
    $('#product_comment_id').val(commentId);
    $('.replyDiv').insertAfter($(this));
    $('.replyDiv').show();
});

</script>
<!-- jQuery -->
<script src="home/js/jquery-3.4.1.min.js"></script>
<!-- Popper.js -->
<script src="home/js/popper.min.js"></script>
<!-- Bootstrap.js -->
<script src="home/js/bootstrap.js"></script>
<!-- Custom JavaScript -->
<script src="home/js/custom.js"></script>



</body>
</html>
