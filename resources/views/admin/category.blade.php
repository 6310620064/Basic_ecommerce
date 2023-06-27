<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    @include('admin.css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.min.css">
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">

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
                        <td>{{$data->products->count() ?? 0 }} </td>

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
                            <a style="margin-bottom:10px;" href="{{url('update_category', $data->id)}}" class="btn btn-primary">Edit</a>
                            <a onclick="confirmation(event)" class ="btn btn-danger" href="{{url('delete_category', $data->id)}}">Delete</a>
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

    <script>
        document.getElementById('create_category').addEventListener('submit', function (event) {
            event.preventDefault(); // ยกเลิกการส่งฟอร์มแบบปกติ

            Swal.fire({
            icon: 'success',
            title: 'Category created successfully',
            showConfirmButton: false,
            timer: 1500
            }).then(() => {
            // ส่งข้อมูลฟอร์มโดยใช้ XMLHttpRequest
            var form = event.target;
            var formData = new FormData(form);

            var xhr = new XMLHttpRequest();
            xhr.open('POST', form.action, true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                // ส่งคำขอเสร็จสมบูรณ์
                console.log('Category submitted successfully');
                // โหลดหน้าเว็บใหม่
                location.reload();
                }
            };
            xhr.send(formData);
            });
        });
    </script>

    <script>
        function confirmation(event) {
            event.preventDefault();
            var urlToRedirect = event.currentTarget.getAttribute('href');
            Swal.fire({

                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'No, cancel!',
                confirmButtonText: 'Yes, delete it!',
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Deleted!',
                        'Your category has been deleted.',
                        'success'
                    )
                    // Redirect to the URL
                    window.location.href = urlToRedirect;
                }
            });
        }
    </script>
  </body>
        
</html>