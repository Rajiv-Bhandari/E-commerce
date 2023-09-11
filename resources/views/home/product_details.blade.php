<!DOCTYPE html>
<html>
<head>
    <base href="/public">
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
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" type="text/css" href="home/css/bootstrap.css" />
    <!-- Font Awesome style -->
    <link href="home/css/font-awesome.min.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="home/css/style.css" rel="stylesheet" />
    <!-- Responsive style -->
    <link href="home/css/responsive.css" rel="stylesheet" />
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
                    <a class="btn btn-primary add-to-cart-btn">Add to Cart</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer section -->
@include('home.footer')
<!-- End footer section -->

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
