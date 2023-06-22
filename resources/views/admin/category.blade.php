<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    @include('admin.css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

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
                <h2 class ="h2_font">Add Category</h2>

                <form id = "create_category" action ="{{url('/add_category')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class = "div_design">
                        <input class="input_form" type="hidden" name="amount" value="0">
                        <input type="hidden" class="input_form" name="is_display_homepage" value="1">
                        <input type="hidden" class="input_form" name="is_active" value="1">
                        <label> Name :</label>
                        <input class="input_form" type="text" name="name" placeholder="Name" required="">
                    </div>
                    <div class = "div_img">
                        <label > Image :</label>
                        <input type="file" name="image" style="margin-bottom:5px;">
                    </div>
                    <input type="checkbox" class="input_form" name="is_display_homepage" value="0">
                    <label style ="display:inline; padding-left:30px;"for="display">Hide for Homepage</label><br>
                    <input style ="margin-left:28px;"type="checkbox" class="input_form" name="is_active" value="0">
                    <label style = "padding-top:30px; padding-right:80px;" for="active">Inactive</label><br>

                    <input type="submit" class ="btn btn-primary" name="submit" value="Add Category">  
                </form>

            </div>

                <table class="center">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Amount</th>
                        <th>Image</th>
                        <th>Display_Homepage</th>
                        <th>Active</th>
                        <th>Action</th>
                    </tr>

                    @foreach($data as $data)
                    <tr>
                        <td>{{$data->id}}</td>
                        <td>{{$data->name}}</td>
                        <td>{{$data->amount}}</td>
                        <td>
                            <img src="{{ \Storage::url( $data->image ) }}" alt="" />
                        </td>
                        <td>
                            @if( $data->is_display_homepage == 1 )
                                <span class="icon-center">
                                    <span class="iconify" data-icon="fa6-solid:check" style="color: green;"data-width="20" data-height="20"></span>
                                </span>
                            @else
                                <span class="icon-center">
                                    <span class="iconify" data-icon="charm:cross" style="color: red;"data-width="25" data-height="25"></span>
                                </span>
                            @endif
                        </td>
                        <td>
                            @if($data->is_active == 1)
                                <span class="icon-center">
                                    <span class="iconify" data-icon="fa6-solid:check" style="color: green;"data-width="20" data-height="20"></span>
                                </span>
                            @else
                                <span class="icon-center">
                                    <span class="iconify" data-icon="charm:cross" style="color: red;"data-width="25" data-height="25"></span>
                                </span>
                            @endif
                        </td>
                        <td>
                            <a onclick ="return confirm('Are you sure to delete this?')" class ="btn btn-danger" href="{{url('delete_category', $data->id)}}">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="7">
                            <p>Total catogories : {{ $data->count() }}</p>
                        </td>
                    </tr>
                </table>

        </div>
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
    <!-- End custom js for this page -->
  </body>
        
</html>