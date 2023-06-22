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
                <h2 class ="h2_font">Add Size</h2>

                <form id = "create_size" action ="{{url('/add_size')}}" method="POST">
                    @csrf
                    <div class = "div_design">
                        <label> Size :</label>
                        <input class="input_form" type="text" name="size" placeholder="Size" required="">
                    </div>
                    
                    <input type="hidden" class="input_form" name="is_active" value="1">
                    <input type="checkbox" class="input_form" name="is_active" value="0">
                    <label for="active">Inactive</label><br>

                    <input type="submit" class ="btn btn-primary" name="submit" value="Add Size">  
                </form>
            </div>
            <table class="center">
                <tr>
                    <th>ID</th>
                    <th>Size</th>
                    <th>Active</th>
                    <th>Action</th>
                </tr>
                @foreach($size as $size)
                <tr>
                    <td>{{$size->id}}</td>
                    <td>{{$size->size}}</td>
                    <td>
                        @if($size->is_active == 1)
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
                        <a onclick ="return confirm('Are you sure to delete this?')" class ="btn btn-danger"href="{{url('delete_size', $size->id)}}">Delete</a>
                    </td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="4">
                        <p>Total Sizes : {{ $size->count() }}</p>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    @include('admin.script')
  </body>
</html>