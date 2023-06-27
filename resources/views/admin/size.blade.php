<!DOCTYPE html>
<html lang="en">
  <head>

    <!-- Required meta tags -->
    @include('admin.css')
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.min.css">
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">

  </head>
  <body>
    @include('sweetalert::alert')
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

                <form id="create_size" action ="{{url('/add_size')}}" method="POST">
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

                <script>
                    document.getElementById('create_size').addEventListener('submit', function (event) {
                        event.preventDefault(); // ยกเลิกการส่งฟอร์มแบบปกติ

                        Swal.fire({
                        icon: 'success',
                        title: 'Size created successfully',
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
                            console.log('Size submitted successfully');
                            // โหลดหน้าเว็บใหม่
                            location.reload();
                            }
                        };
                        xhr.send(formData);
                        });
                    });
                </script>
                
            </div>
            <table class="center">
                <tr>
                    <th>ID</th>
                    <th>Size</th>
                    <th>Active</th>
                    <th>Action</th>
                </tr>
                @foreach($sizes as $size)
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
                        <a style="margin-bottom:10px;" href="{{url('update_size', $size->id)}}" class="btn btn-primary">Edit</a><br>
                        <a class="btn btn-danger" onclick="confirmation(event)" href="{{url('delete_size', $size->id)}}">Delete</a>
                    </td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="4">
                        <p>Total Sizes : {{ $size->count() }}</p>
                    </td>
                </tr>
            </table>
            <div class="pagination">
                {{ $sizes->links() }}
            </div>
        </div>
    </div>

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
                        'Your size has been deleted.',
                        'success'
                    )
                    // Redirect to the URL
                    window.location.href = urlToRedirect;
                }
            });
        }
    </script>

    @include('admin.script')

  </body>
</html>