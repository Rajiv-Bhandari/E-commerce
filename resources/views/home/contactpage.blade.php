<!DOCTYPE html>
<html>
   <head>
    <style>
        /* Add this CSS to style the contact-details section */
.contact-details {
    padding: 20px;
    background-color: #f8f8f8;
    border: 1px solid #ddd;
    border-radius: 5px;
    margin: 20px auto;
    max-width: 800px;
    text-align: center;
    font-size: 18px;
    line-height: 1.5;
}

.contact-details a {
    color: #007bff; /* Link color */
    text-decoration: none;
    font-weight: bold;
}

.contact-details a:hover {
    text-decoration: underline;
}

/* Additional styles as needed */

/* Media query for responsiveness */
@media (max-width: 768px) {
    .contact-details {
        font-size: 16px;
    }
}

    </style>
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
    <link rel="stylesheet" type="text/css" href="{{ asset('home/css/bootstrap.css') }}" />
    <!-- Font Awesome style -->
    <link href="{{ asset('home/css/font-awesome.min.css') }}" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="{{ asset('home/css/style.css') }}" rel="stylesheet" />
    <!-- Responsive style -->
    <link href="{{ asset('home/css/responsive.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   </head>
   <body>
    @include('sweetalert::alert')
    <div class="hero_area">
        <!-- header section strats -->
        @include('home.header')
        <div class="contact-details">
            <p>
                Infinite Innovation is not a registered company but will be registered in the future. This projet is  created by Rajiv Bhandari, a 20-year-old student.
                <br>
                You can contact me through the social media profiles:
                <br>
                <a href="https://www.instagram.com/rajiv.bhandari_/" target="_blank">Instagram</a>
                <i class="fab fa-instagram"></i> 
                <br>
                <a href="https://www.facebook.com/rajiv.bhandari.7505" target="_blank">Facebook</a>
                <i class="fab fa-facebook"></i> 
                <br>
                I am currently studying in Islington, has completed 2 years, and now final year is starting soon.
            </p>
        </div>
    </div>
 
    <!-- footer end -->
    <div class="cpy_">
        <p class="mx-auto">© 2023 All Rights Reserved By <a href="https://html.design/">Infinite Innovation</a><br>
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
