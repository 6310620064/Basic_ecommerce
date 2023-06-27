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
                <h2 class ="h2_font">Update Category</h2>

                <form id="update_category" action="{{url('/update_category_confirm',$data->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class = "div_design">
                        <input class="input_form" type="hidden" name="amount" value="0">
                        <input type="hidden" class="input_form" name="is_display_homepage" value="1">
                        <input type="hidden" class="input_form" name="is_active" value="1">
                        <label> Name :</label>
                        <input class="input_form" type="text" name="name" placeholder="Name" required="" value="{{$data->name}}">
                    </div>

                    <div class = "div_img" style="margin-left:auto;">
                        <label>Currect Image :</label>
                        <img  height="150" width="150" src="{{ \Storage::url($data->image)}}" alt="">
                    </div>

                    <div class = "div_img" style="margin-left:200px;">
                        <label>Change Image :</label>
                        <input type="file" name="image" placeholder="Image" >
                    </div>

                    @if($data->is_display_homepage == '1')
                        <input type="checkbox" class="input_form" name="is_display_homepage" value="0">
                        <label style ="display:inline; padding-left:30px;"for="display">Hide for Homepage</label><br>
                    @else
                        <input type="checkbox" class="input_form" name="is_display_homepage" value="0" checked>
                        <label style ="display:inline; padding-left:30px;"for="display">Hide for Homepage</label><br>
                    @endif

                    @if($data->is_active == '1')
                        <input style ="margin-left:28px;"type="checkbox" class="input_form" name="is_active" value="0">
                        <label style = "padding-top:30px; padding-right:80px;" for="active">Inactive</label><br>
                    @else
                        <input style ="margin-left:28px;"type="checkbox" class="input_form" name="is_active" value="0" checked>
                        <label style = "padding-top:30px; padding-right:80px;" for="active">Inactive</label><br>
                    @endif
                    <input type="submit" class ="btn btn-primary" name="submit" value="Update">  
                    <a  href="{{url('/view_category')}}" class="btn btn-outline-warning">Back</a>

                </form>
              </div>
              <script>
                document.addEventListener('DOMContentLoaded', function () {
                document.getElementById('update_category').addEventListener('submit', function (event) {
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

    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
    <!-- End custom js for this page -->


  </body>
        
</html>
