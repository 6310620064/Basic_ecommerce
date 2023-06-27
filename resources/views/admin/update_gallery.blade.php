<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <base href ="/public">
    @include('admin.css')
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.min.css">
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
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
                <h2 class ="h2_font">Update Gallery</h2>

                <form id="update_gallery" action ="{{url('/update_gallery_confirm',$gallery->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class = "div_design">

                    <div class = "div_img" style="margin-left: -50px;">
                        <label>Currect Image :</label>
                        <img  height="150" width="150" src="{{ \Storage::url($gallery->image)}}" alt="">
                    </div>

                    <div class = "div_img">
                        <label>Change Image :</label>
                        <input type="file" name="image" placeholder="Image" >
                    </div>

                    <div class = "div_design">
                        <label > Order :</label>
                        <input class="input_form" type="number" name="order"min="0" placeholder="Order" required="" value="{{$gallery->order}}">
                    </div>

                        <input type="hidden" class="input_form" name="is_active" value="1">

                    @if($gallery->is_active == '1')
                        <input type="checkbox" class="input_form" name="is_active" value="0">
                        <label for="active">Inactive</label><br>
                    @else
                        <input type="checkbox" class="input_form" name="is_active" value="0" checked>
                        <label for="active">Inactive</label><br>
                    @endif

                    <input type="submit" name="submit" value="Update" class="btn btn-primary">
                    <a  href="{{url('show_gallery', $gallery->product_id)}}" class="btn btn-outline-warning">Back</a>
                </form>

                <script>
                document.addEventListener('DOMContentLoaded', function () {
                document.getElementById('update_gallery').addEventListener('submit', function (event) {
                    event.preventDefault(); // Prevent the default form submission

                    Swal.fire({
                        title: 'Do you want to save the changes?',
                        showDenyButton: true,
                        showCancelButton: true,
                        confirmButtonText: 'Save',
                        denyButtonText: `Don't save`,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // If the user confirms, submit the form
                            Swal.fire('Edit Success!', '', 'success')
                            
                            var form = event.target;
                            var formData = new FormData(form);

                            var xhr = new XMLHttpRequest();
                            xhr.open('POST', form.action, true);
                            xhr.onreadystatechange = function () {
                                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                                    // ส่งคำขอเสร็จสมบูรณ์
                                    console.log('Form submitted successfully');
                                    // โหลดหน้าเว็บใหม่
                                    location.reload();
                                }
                            };
                            xhr.send(formData);
                        } else if (result.isDenied) {
                            Swal.fire('Changes are not saved', '', 'info');
                        }
                    });
                });
            });

            </script>

                
            </div>
        </div>
    </div>

    @include('admin.script')
  </body>
</html>