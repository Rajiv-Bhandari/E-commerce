<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.css')
    <style>
        .img_size {
            width: 100px;
            height: 100px;
            object-fit: cover;
        }

        .center {
            margin: auto;
            width: 80%;
            text-align: center;
            margin-top: 20px;
        }

        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #4d3d00;
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #0000ff;
        }

        tr:hover {
            background-color: #333300;
        }

        .action-buttons {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .btn-danger {
            background-color: #dc3545;
            color: #fff;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
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
            <h1>All Product</h1>
            <div class="table-container">
                <table class="center">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Category</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Discount Price</th>
                            <th>Image</th>
                            <!-- <th>Action</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($product as $data)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$data->title}}</td>
                                <td>{{$data->description}}</td>
                                <td>{{$data->category}}</td>
                                <td>{{$data->quantity}}</td>
                                <td>{{$data->price}}</td>
                                <td>{{$data->discount_price}}</td>
                                <td>
                                    <img class="img_size" src="/productimg/{{$data->image}}">
                                </td>
                                <!-- <td class="action-buttons">
                                    <a onclick="return confirm('Are you sure to delete this?')" class="btn btn-danger" href="{{url('delete_product',$data->id)}}">Delete</a>
                                </td> -->
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- container-scroller -->
    @include('admin.script')
    <!-- End custom js for this page -->
</body>
</html>
