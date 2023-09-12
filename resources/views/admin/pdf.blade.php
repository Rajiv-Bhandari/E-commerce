<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Order Details</title>
    <style>
        /* Add your custom CSS styles for the PDF here */
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 80%;
            margin: 0 auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Order Details</h1>
        <table>
            <tr>
                <th>Name</th>
                <td>{{ $order->name }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $order->email }}</td>
            </tr>
            <tr>
                <th>Address</th>
                <td>{{ $order->address }}</td>
            </tr>
            <tr>
                <th>Phone</th>
                <td>{{ $order->phone }}</td>
            </tr>
            <tr>
                <th>Product Title</th>
                <td>{{ $order->product_title }}</td>
            </tr>
            <tr>
                <th>Quantity</th>
                <td>{{ $order->quantity }}</td>
            </tr>
            <tr>
                <th>Price</th>
                <td>Rs. {{ $order->price }}</td>
            </tr>
            <tr>
                <th>Payment Status</th>
                <td>{{ $order->payment_status }}</td>
            </tr>
            <tr>
                <th>Delivery Status</th>
                <td>{{ $order->delivery_status }}</td>
            </tr>
           
        </table>
        <!-- <img height='250' width='400' src="{{ asset('productimg/' . $order->image) }}" alt="Product Image"> -->

    </div>
</body>
</html>
