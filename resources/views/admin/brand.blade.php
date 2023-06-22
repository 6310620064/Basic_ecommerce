<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    @include('admin.css')
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

</head>
  <body>
    <div class="container-scroller">
    @include('admin.sidebar')

    @include('admin.header')
    <div class="main-panel">
        <div class="content-wrapper">

            @if(session()->has('message'))

            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                {{session()->get('message')}}
            </div>

            @endif

            <div class="div_center">
                <h2 class ="h2_font">Add Brand</h2>

                <form id = "create_brand" action ="{{url('/add_brand')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class = "div_design">
                        <input type="hidden" class="input_form" name="is_active" value="1">

                        <label> Name :</label>
                        <input class="input_form" type="text" name="name" placeholder="Name" required="">
                    </div>
                    <input class="input_form" type="hidden" name="amount" value="0">
                    <div class = "div_img">
                        <label> Image :</label>
                        <input type="file" name="image" >
                    </div>
                    <div class = "div_design">
                        <label > Order :</label>
                        <input class="input_form" type="number" name="order"min="0" placeholder="Order" required="">
                    </div>
                    <input type="checkbox" class="input_form" name="is_active" value="0">
                    <label for="active">Inactive</label><br>

                    <input type="submit" class ="btn btn-primary" name="submit" value="Add Brand">  
                </form>
            </div>
            <table class="center">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Amount</th>
                        <th>Image</th>
                        <th>Order</th>
                        <th>Active</th>
                        <th>Action</th>
                    </tr>

                    @foreach($brand as $brand)
                    <tr>
                        <td>{{$brand->id}}</td>
                        <td>{{$brand->name}}</td>
                        <td>{{$brand->amount}}</td>
                        <td class = "show_img">
                            <img src="{{ \Storage::url( $brand->image ) }}" alt=""/>
                        </td>
                        <td>{{$brand->order}}</td>
                        <td>
                            @if($brand->is_active == 1)
                                <span class="icon-center">
                                    <span class="iconify" data-icon="fa6-solid:check" style="color: green;"data-width="20" data-height="20"></span>
                                </span>
                            @else
                                <span class="icon-center">
                                    <span class="iconify" data-icon="charm:cross" style="color: red;"data-width="25" data-height="25"></span>
                                </span>
                            @endif
                        <td>
                            <a onclick ="return confirm('Are you sure to delete this?')" class ="btn btn-danger" href="{{url('delete_brand', $brand->id)}}">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="7">
                            <p>Total Brands : {{ $brand->count() }}</p>
                        </td>
                    </tr>
                </table>
        </div>
    </div>
    
    @include('admin.script')
  </body>
</html>