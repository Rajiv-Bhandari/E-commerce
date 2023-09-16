<!DOCTYPE html>
<html lang="en">
<head>
    {{-- <base href="/public"> --}}
    @include('admin.css')
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container-scroller {
            margin: 0;
            padding: 0;
        }


        .main-panel {
            margin: 0 auto;
            max-width: 1250px;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .main-title {
            font-size: 28px;
            text-align: center;
            margin-top: 40px;
            margin-bottom: 20px;
        }

        .form-container {
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-label {
            display: block;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .form-input {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            color:black;
        }

        .form-select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px; 
            color:black;
        }

        .form-submit {
        background-color: blue; /* Blue background color */
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-weight: bold;
        }

        .form-submit:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }
        .img_size {
            width: 200px;
            height: 200px;
            object-fit: cover;
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
            <h1 class="main-title">Add Product</h1>
            <div class="form-container">
                <form action="{{url('/update_product_confirm', $product->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label class="form-label">Title:</label>
                    <input class="form-input" type="text" name="title" value="{{$product->title}}" required>
                    
                    <label class="form-label">Description:</label>
                    <input class="form-input" type="text" name="description" placeholder="Enter Description" value="{{$product->description}}" required>
                    
                    <label class="form-label">Price:</label>
                    <input class="form-input" type="number" name="price" placeholder="Enter Price" value="{{$product->price}}" required>
                    
                    <label class="form-label">Discount Price:</label>
                    <input class="form-input" type="number" name="dis_price" placeholder="Enter Discount Price" value="{{$product->discount_price}}">
                    
                    <label class="form-label">Quantity:</label>
                    <input class="form-input" type="number" min="0" name="quantity" placeholder="Enter Quantity" value="{{$product->quantity}}" required>
                    
                    <label class="form-label">Category:</label>
                    <select class="form-select" name="category" required>
                        <option value="{{$product->category}}" selected>{{$product->category}}</option>
                        @foreach($category as $cat)
                            <option value="{{$cat->category_name}}">{{$cat->category_name}}</option>
                        @endforeach
                    </select>
                    
                    <label class="form-label">Image:</label>
                    <img class="img_size" src="/productimg/{{$product->image}}"><br>

                    <label class="form-label">Change Product Image:</label>
                    <input type="file" name="image">

                    <button type="submit" class="form-submit">Update</button>
                </form>
            </div>
        </div>
    </div>
    <!-- container-scroller -->
    @include('admin.script')
    <!-- End custom js for this page -->
</body>
</html>
