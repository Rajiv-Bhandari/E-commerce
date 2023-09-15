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
      <link rel="shortcut icon" href="images/Our_logo.png" type="">
      <title>Infinite Innovation</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="home/css/bootstrap.css" />
      <!-- font awesome style -->
      <link href="home/css/font-awesome.min.css" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="home/css/style.css" rel="stylesheet" />
      <!-- responsive style -->
      <link href="home/css/responsive.css" rel="stylesheet" />
   </head>
   <body>
    <div class="hero_area">
        <!-- header section strats -->
        @include('home.header')
        <!-- end header section -->
        @include('home.slider')
    </div>
    @include('home.why')

    @include('home.new_arival')

    <!-- product section -->
    @include('home.product')
    <!-- end product section -->

    <!-- comment and reply section starts -->
    <div style="text-align:center; padding-bottom:30px;">
        <h1 style="font-size:30px; text-align:center; padding-bottom:20px;">Comments</h1>
        <form action="{{url('add_comment')}}" method="POST">
            @csrf
            <textarea style="height:150px; width:600px;" placeholder="Express Your Thought!" name="comment"></textarea><br>
            <input type="submit" name="Comment" value="Comment">
        </form>
    </div>
    <div style="padding-left:20%;">
        <h3 style="font-size:30px; padding-bottom:20px;">All Comments</h3>
        @foreach($comment as $comment)
        <div>
            <b>{{$comment->name}}</b>
            <p>{{$comment->comment}}</p>
            <a href="javascript::void(0);" onclick="reply(this)"><b>Reply</b></a>
        </div>
        @endforeach
        <div style="display:none;" class="replyDiv">
            <textarea style="height:80px; width:500px;" placeholder="Write something here" ></textarea><br>
            <a href="javascript::void(0);" class="btn btn-primary">Reply</a>
            <a href="javascript::void(0);" class="btn btn-danger" onClick="reply_close(this)">Close</a>
        </div><br>
        
    </div>

    <!-- comment and reply section ends -->

    <!-- subscribe section -->
    @include('home.subscribe')
    <!-- end subscribe section -->
    <!-- client section -->
    @include('home.client')
    <!-- end client section -->
    <!-- footer start -->
    @include('home.footer')
    <!-- footer end -->
    <div class="cpy_">
        <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>
            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
        </p>
    </div>
    <script type="text/javascript">

      function reply(caller) {
         $('.replyDiv').insertAfter($(caller));
         $('.replyDiv').show();
      }
      function reply_close(caller) {
         $('.replyDiv').hide();
      }
    </script>
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