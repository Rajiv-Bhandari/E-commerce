<!DOCTYPE html>
<html lang="en">
<head>
    <base href="/public">
    @include('admin.css')
    <style>
        .container-scroller {
            padding: 20px;
        }

        .email-form {
            background-color: #ffffff; /* White background */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .btn-primary {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }
        .heading{
            text-align: center;
            padding-bottom: 20px;
            font-size: 30px;
        }
    </style>
</head>
<body>
<div class="container-scroller">
    <!-- partial:partials/_sidebar.html -->
    @include('admin.sidebar')
    <!-- partial -->
    @include('admin.header')
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                        {{session()->get('message')}}
                    </div>
                @endif
                <h1 class="heading">Send Email To: {{$order->email}}</h1>
                <form action="{{url('send_user_email',$order->id)}}" method="POST" class="email-form">
                    @csrf
                    <div class="form-group">
                        <label for="title">Greeting:</label>
                        <input style="color:black;" type="text" id="title" name="title" placeholder="Enter greeting" required>
                    </div>
                    <div class="form-group">
                        <label for="body">Email Body:</label>
                        <input style="color:black;" type="text" id="body" name="body" placeholder="Enter email body" required>
                    </div>
                    <div class="form-group">
                        <input style="color:black; background-color:green;" type="submit" value="Send Mail" class="btn btn-primary">
                    </div>
                </form>
                
            </div>
        </div>
   
    <!-- container-scroller -->
    @include('admin.script')
    <!-- End custom js for this page -->
  </body>
</html>
