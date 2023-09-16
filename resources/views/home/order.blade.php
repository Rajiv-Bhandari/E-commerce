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

      <!-- Inline CSS for Table Styling -->
      <style>
         body {
            background-color: #f8f8f8;
            font-family: Arial, sans-serif;
            padding: 20px;
         }

         .hero_area {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
         }

         .hero_area table {
            width: 100%;
            border-collapse: collapse;
         }

         .hero_area th, .hero_area td {
            padding: 10px;
            text-align: center;
            vertical-align: middle;
         }

         .hero_area th {
            background-color: #f2f2f2;
         }

         .hero_area img {
            max-width: 100px;
            max-height: 100px;
         }

         .btn-danger {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            text-decoration: none;
         }

         .btn-danger:hover {
            background-color: #c82333;
         }
      </style>
   </head>
   <body>
      <div class="hero_area">
         <!-- Header Section -->
         @include('home.header')
         @if(session()->has('message'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                {{session()->get('message')}}
            </div>
        @endif
         <!-- End Header Section -->
         <div>
            <table>
                <tr>
                    <th>Product Title</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Payment Status</th>
                    <th>Delivery Status</th>
                    <th>Image</th>
                    <th>Cancel Order</th>
                </tr>
                @foreach($order as $order)
                <tr>
                    <td>{{$order->product_title}}</td>
                    <td>{{$order->quantity}}</td>
                    <td>{{$order->price}}</td>
                    <td>{{$order->payment_status}}</td>
                    <td>{{$order->delivery_status}}</td>
                    <td>
                        <img height="100px" width="100px" src="/productimg/{{$order->image}}">
                    </td>
                   
                    <td>
                        @if($order->delivery_status == "processing")
                        <a onclick="return confirm('Are you sure ? You want to cancel the order')" class="btn btn-danger" href="{{url('cancel_order',$order->id)}}">Cancel</a>
                        @else
                        <i class="fas fa-user-times"></i>

                        @endif
                    </td>
                </tr>
                @endforeach
            </table>
         </div>
      </div>
      <!-- jQuery -->
      <script src="home/js/jquery-3.4.1.min.js"></script>
      <!-- Popper.js -->
      <script src="home/js/popper.min.js"></script>
      <!-- Bootstrap.js -->
      <script src="home/js/bootstrap.js"></script>
      <!-- Custom.js -->
      <script src="home/js/custom.js"></script>
   </body>
</html>
