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
                <h2 class ="h2_font">Update Detail</h2>

                <form id="update_detail" action ="{{route('update_detail_confirm',$detail->id)}}" method="POST">
                    @csrf
                    <div class = "div_design">

                        <input type="hidden" class="input_form" name="is_active" value="0">

                        <label> Type :</label>
                        <select name="type" id="type" style="color: black;">
                            @if($detail->type == 'Title')
                                <option value="{{$detail->type}}" selected="" required="" >{{$detail->type}}</option>
                                <option class = "input_color" value="Description">Description</option>
                            @else
                                <option value="{{$detail->type}}" selected="" required="" >{{$detail->type}}</option>
                                <option class = "input_color" value="Title">Title</option>
                            @endif
                        </select>
            
                    </div>

                    <div class = "div_text">
                        <label style="margin-left:210px;"> Value :</label>
                        <input class ="input_text" type="text"  name="value" placeholder="Value" required="" value="{{$detail->value}}">
                    </div>

                    <div class = "div_design">
                        <label>Language :</label>
                        <select name="language" id="language" style="color: black;">
                        @if($detail->language == 'English')
                            <option value="{{$detail->language}}" selected="" required="" >{{$detail->language}}</option>
                            <option class = "input_color" value="Thai">Thai</option>
                        @else
                            <option value="{{$detail->language}}" selected="" required="" >{{$detail->language}}</option>
                            <option class = "input_color" value="English">English</option>
                        @endif
                        </select>
                    </div>

                    @if($detail->is_active == '1')
                        <input style="margin-left:120px;" type="checkbox" class="input_form" name="is_active" value="1" checked>
                    @else
                        <input style="margin-left:120px;" type="checkbox" class="input_form" name="is_active" value="1">
                    @endif
                    <label style="padding-right:8em;"for="active">Active</label><br>


                    <input type="submit" name="submit" value="Update" class="btn btn-primary">
                    <a  href="{{route('show_detail', $detail->product_id)}}" class="btn btn-outline-warning">Back</a>
                </form>

                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                    document.getElementById('update_detail').addEventListener('submit', function (event) {
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