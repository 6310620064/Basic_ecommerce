<!DOCTYPE html>
<html lang="en">
  <head>
    <base href ="/public">
    @include('admin.css')
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
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


        <div class ="div_center">

            <h2 class ="h2_font"> Add Detail</h2>


            <form id="create_detail"action="{{url('/add_detail')}}" method="POST">

            @csrf

            <div class = "div_design">

                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <label style="font-size:25px;"> {{$product->name}} </label><br>
                <input type="hidden" class="input_form" name="is_active" value="1">

                <label> Type :</label>
                <select name="type" id="type" style="color: black;">
                    <option class = "input_color" value="Title">Title</option>
                    <option class = "input_color" value="Description">Description</option>
                </select>
    
            </div>

            <div class = "div_text">
                <label style="margin-left:210px;"> Value :</label>
                <input class ="input_text" type="text"  name="value" placeholder="Value" required="">
            </div>

            <div class = "div_design">
                <label>Language :</label>
                <select name="language" id="language" style="color: black;">
                    <option class = "input_color" value="English">English</option>
                    <option class = "input_color" value="Thai">Thai</option>
                </select>
            </div>

            <input style="margin-left:120px;" type="checkbox" class="input_form" name="is_active" value="0">
            <label style="padding-right:8em;"for="active">Inactive</label><br>

            <input type="submit" name="submit" value="Add Detail" class="btn btn-primary">
            <a  href="{{url('show_detail', $detail->product_id)}}" class="btn btn-outline-warning">Back</a>

            </form>
            <script>
                document.getElementById('create_detail').addEventListener('submit', function (event) {
                    event.preventDefault(); // ยกเลิกการส่งฟอร์มแบบปกติ

                    Swal.fire({
                    icon: 'success',
                    title: 'Detail created successfully',
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
                        console.log('Detail submitted successfully');
                        // โหลดหน้าเว็บใหม่
                        location.reload();
                        }
                    };
                    xhr.send(formData);
                    });
                });
            </script>
        </div>
    </div>
</div>

    @include('admin.script')
  </body>
</html>