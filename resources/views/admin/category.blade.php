<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.css')
    <style>
        /* Add custom table styles */
        .table-container {
            margin: 20px auto;
            width: 80%;
        }

        .table-container table {
            width: 100%;
            border-collapse: collapse;
        }

        .table-container th,
        .table-container td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .table-container th {
            background-color: #1a1aff;
        }

        .table-container tr:hover {
            background-color: #333300;
        }

        .table-container .action-buttons {
            display: flex;
            justify-content: space-between;
        }
        .input_color{
            color: black;
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
            <div class="div_center">
                <h2 class="h2_font">Add Category</h2>
                <form action="{{url('/add_category')}}" method="post">
                    @csrf
                    <input type="text" class="input_color" name="category" placeholder="Write category name">
                    <input type="submit" class="btn btn-primary" name="submit" value="Add Category">
                </form>
            </div>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Category Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $data)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$data->category_name}}</td>
                                <td class="action-buttons">
                                    <a onclick="return confirm('Are you sure to delete this?')" class="btn btn-danger" href="{{url('delete_category',$data->id)}}">Delete</a>
                                </td>
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
