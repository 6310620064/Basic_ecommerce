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
                <h2 class ="h2_font">Update Brand</h2>

                <form id="update_brand"action ="{{route('update_brand_confirm',$brand->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class = "div_design">
                        <input type="hidden" class="input_form" name="is_active" value="0">

                        <label> Name :</label>
                        <input class="input_form" type="text" name="name" placeholder="Name" required="" value="{{$brand->name}}">
                    </div>

                    <input class="input_form" type="hidden" name="amount" value="0">

                    <div class = "div_img" style="margin-left:auto;">
                        <label>Currect Image :</label>
                        <img  style="max-width: 150px; max-height: 150px;" src="{{ \Storage::url($brand->image)}}" alt=""  onclick="showFullImage(this)">
                    </div>

                    <div class = "div_img" style="margin-left:200px;">
                        <label>Change Image :</label>
                        <input type="file" name="image" placeholder="Image" >
                    </div>

                    <input class="input_form" type="hidden" name="order" placeholder="Order" required="" value="{{$brand->order}}">

                    @if($brand->is_active == '1')
                        <input type="checkbox" class="input_form" name="is_active" value="1" checked>
                        <label for="active">Active</label><br>
                    @else
                        <input type="checkbox" class="input_form" name="is_active" value="1">
                        <label for="active">Active</label><br>
                    @endif
                    
                    <input type="submit" class ="btn btn-primary" name="submit" value="Update">  
                    <a  href="{{url('/view_brand')}}" class="btn btn-outline-warning">Back</a>

                </form>
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                document.getElementById('update_brand').addEventListener('submit', function (event) {
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

        </div>
    </div>
    
    @include('admin.script')
  </body>
</html>