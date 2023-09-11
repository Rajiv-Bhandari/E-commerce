<!DOCTYPE html>
<html>
   <head>
      <!-- Basic -->
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="shortcut icon" href="images/favicon.png" type="">
      <title>Famms - Fashion HTML Template</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="home/css/bootstrap.css" />
      <!-- font awesome style -->
      <link href="home/css/font-awesome.min.css" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="home/css/style.css" rel="stylesheet" />
      <!-- responsive style -->
      <link href="home/css/responsive.css" rel="stylesheet" />
      <style>
        .center{
            margin: auto;
            width: 60%;
            text-align: center;
            padding: 30px;
        }
        table,th,td{
            border : 1px solid grey;
        }
        .img_des{
            height:250px;
            width:250px;
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
      
       <div class="center">
            <table>
                <tr>
                    <th>Product Title</th>
                    <th>Product Quantity</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
                <?php $totalprice=0; ?>
                @foreach($cart as $cart)
                <tr>
                    <td>{{$cart->product_title}}</td>
                    <td>{{$cart->quantity}}</td>
                    <td>Rs. {{$cart->price}}</td>
                    <td><img class="img_des" src="/productimg/{{$cart->image}}"></td>
                    <td><a class="btn btn-danger" href="{{url('remove_cart',$cart->id)}}">Remove</a></td>
                </tr>
                <?php $totalprice = $totalprice + $cart->price;?>
                @endforeach
                
            </table>
            <div>
                <h1 class="total_price">Total Price: Rs. {{$totalprice}}</h1>
            </div>
            
       </div>
      <!-- @include('home.footer') -->
      <!-- footer end -->
      <div class="cpy_">
         <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>
         
            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
         
         </p>
      </div>
      <!-- jQery -->
      <script src="home/js/jquery-3.4.1.min.js"></script>
      <!-- popper js -->
      <script src="home/js/popper.min.js"></script>
      <!-- bootstrap js -->
      <script src="home/js/bootstrap.js"></script>
      <!-- custom js -->
      <script src="home/js/custom.js"></script>
   </body>
</html>