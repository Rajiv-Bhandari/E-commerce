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
      <style>
        .center{
            margin: auto;
            width: 80%;
            padding: 30px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #ddd;
        }
        th, td {
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        .img_des{
            max-height: 150px;
            max-width: 150px;
        }
        .total_price{
            font-size: 20px;
            padding: 25px;
        }
      </style>
   </head>
   <body>
      <div class="hero_area">
         <!-- header section strats -->
         @include('home.header')
         @if(session()->has('message'))
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    {{session()->get('message')}}
                </div>
        @endif
       <div class="center">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Product Title</th>
                        <th>Product Quantity</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $totalprice = 0; ?>
                    @foreach($cart as $cart)
                    <tr>
                        <td>{{$cart->product_title}}</td>
                        <td>{{$cart->quantity}}</td>
                        <td>Rs. {{$cart->price}}</td>
                        <td><img class="img_des" src="/productimg/{{$cart->image}}" alt="Product Image"></td>
                        <td><a class="btn btn-danger" href="{{url('remove_cart',$cart->id)}}">Remove</a></td>
                    </tr>
                    <?php $totalprice = $totalprice + $cart->price;?>
                    @endforeach
                </tbody>
            </table>
            <div>
                <h1 class="total_price">Total Price: Rs. {{$totalprice}}</h1>
            </div>
            <div>
                <h1 style="font-size:25px; padding-bottom:15px;">Proceed To Order: </h1>
                <a href="{{url('cash_order')}}" class="btn btn-primary">Cash On Delivery</a>
                <a href="{{url('stripe',$totalprice)}}" class="btn btn-primary">Pay Online</a>
            </div>
       </div>
      <!-- @include('home.footer') -->
      <!-- footer end -->
      <div class="cpy_">
         <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>
            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
         </p>
      </div>
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
