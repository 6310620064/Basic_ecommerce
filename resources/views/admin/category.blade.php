<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    @include('admin.css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.min.css">
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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
                <h2 class ="h2_font">All Categories</h2>
            </div>

            <div class="add-button-container">
                <a class="btn btn-info" href="{{route('add_category_page')}}">Add</a>
            </div>  

                <table class="center">
                    <tr>
                        <th>Name</th>
                        <th>Amount</th>
                        <th>Image</th>
                        <th>Display_Homepage</th>
                        <th>Active</th>
                        <th>Action</th>
                    </tr>

                    @foreach($data as $datas)
                    <tr>
                        <td>{{$datas->name}}</td>
                        <td>{{$datas->products->count() ?? 0 }} </td>

                        <td class="show_img">
                            <img  class ="img_center" src="{{ \Storage::url( $datas->image ) }}" alt="" onclick="showFullImage(this)" style="max-width: 150px; max-height: 150px;" >
                        </td>
                        <td>
                            @if( $datas->is_display_homepage == 1 )
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
                            @if($datas->is_active == 1)
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
                            <a style="margin-bottom:10px;" href="{{route('update_category', $datas->id)}}" class="btn btn-primary"><i class="fa-solid fa-pen-to-square"></i> Edit</a><br>
                            <a onclick="confirmation(event)" class ="btn btn-danger" href="{{route('delete_category', $datas->id)}}"><i class="fas fa-trash-alt"></i> Delete</a>
                        </td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="6">
                            @if($data->count() == '0')
                                <p>Total catogories : {{ $data->count() }}</p>
                            @else
                                <p>Total catogories : {{ $datas->count() }}</p>
                            @endif
                        </td>
                    </tr>
                </table>
                <div class="pagination">
                {{ $data->links() }}
                </div>

        </div>
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
    <!-- End custom js for this page -->
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js" integrity="sha512-fD9DI5bZwQxOi7MhYWnnNPlvXdp/2Pj3XSTRrFs5FQa4mizyGLnJcN6tuvUS6LbmgN1ut+XGSABKvjN0H6Aoow==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


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

    <script>
        function showFullImage(image) {
            const imageUrl = image.src;
            Swal.fire({
                imageUrl,
                imageAlt: 'Full Image',
                width: '500px',
                height: '500px',
                showConfirmButton: false,
                showCloseButton: true
            });
        }
    </script>

  </body>
        
</html>