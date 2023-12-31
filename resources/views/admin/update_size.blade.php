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

            <div class="div_center">
                <h2 class ="h2_font">Update Size</h2>

                <form id="update_size" action ="{{route('update_size_confirm',$size->id)}}" method="POST">
                    @csrf
                    <div class = "div_design">
                        <label> Size :</label>
                        <input class="input_form" type="text" name="size" placeholder="Size" required="" value="{{$size->size}}">
                    </div>
                    
                    <input type="hidden" class="input_form" name="is_active" value="0">
                    @if($size->is_active == '1')
                        <input type="checkbox" class="input_form" name="is_active" value="1" checked>
                        <label for="active">Active</label><br>
                    @else
                        <input type="checkbox" class="input_form" name="is_active" value="1" >
                        <label for="active">Active</label><br>
                    @endif

                    <input type="submit" class ="btn btn-primary" name="submit" value="Update">  
                    <a  href="{{route('view_size')}}" class="btn btn-outline-warning">Back</a>
                </form>
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                document.getElementById('update_size').addEventListener('submit', function (event) {
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

    @include('admin.script')
  </body>
</html>