<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.css')
    <style>
        .table_deg{
            border: 2px solid white;
            width: 100%;
            margin: auto;
            padding-top: 50px;
            text-align: center;
        }
        .th_deg{
            background-color: skyblue;
        }
        .table_deg img {
            max-width: 100px;
            max-height: 100px;
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
            <h1>Order List</h1>
            <div style="padding-left:400px; padding-top:20px; padding-bottom:30px;">
                <form action="{{url('search')}}" method="get">
                    @csrf
                    <input style="color:black;" type="text" name="search" placeholder="Search">
                    <input type="submit" value="Search" class="btn btn-outline-primary" >
                </form>
            </div>

            <table class="table_deg">
                <tr class="th_deg">
                    <th>Name</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Product Title</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Payment Status</th>
                    <th>Delivery Status</th>
                    <th>Image</th>
                    <th>Delivered</th>
                    <th>Print PDF</th>
                    <th>Send Mail</th>
                </tr>
                @forelse($order as $order)
                    <tr>
                        <td>{{$order->name}}</td>
                        <td>{{$order->email}}</td>
                        <td>{{$order->address}}</td>
                        <td>{{$order->phone}}</td>
                        <td>{{$order->product_title}}</td>
                        <td>{{$order->quantity}}</td>
                        <td>{{$order->price}}</td>
                        <td>{{$order->payment_status}}</td>
                        <td>{{$order->delivery_status}}</td>
                        <td>
                            <img src="/productimg/{{$order->image}}" alt="Product Image">
                        </td>
                        @if($order->delivery_status == "processing")
                        <td>
                            <a href="{{url('delivered', $order->id)}}" onclick="return confirm('Are you sure this product is delivered')" class="btn btn-primary">Delivered</a>
                        </td>
                        @else
                        <td>
                            <!-- <a class="btn btn-primary">Delivered</a> -->
                            <p>Delivered</p>
                        </td>
                        @endif
                        <td>
                            <a class="btn btn-secondary" href="{{url('print_pdf', $order->id)}}" >Print PDF</a>
                        </td>
                        <td>
                            <a href="{{url('send_mail', $order->id)}}" class="btn btn-info">Send Mail</a>
                        </td>
                    </tr>
                @empty    
                <tr>
                    <td colspan="16">No Data Found</td>
                </tr>
                @endforelse
            </table>
        </div>
    </div>
</div>

<!-- container-scroller -->
@include('admin.script')
<!-- End custom js for this page -->
</body>
</html>
