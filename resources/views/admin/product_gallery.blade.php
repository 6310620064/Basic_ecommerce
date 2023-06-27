<!DOCTYPE html>
<html lang="en">
  <head>
    <base href="/public">
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

            <h2 class ="h2_font"> Add Galleries</h2>


            <form id="create_gallery" action="{{url('/add_gallery')}}" method="POST" enctype="multipart/form-data">

            @csrf

            <div class = "div_design">

            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <label style="font-size:25px;"> {{$product->name}} </label>
            <input type="hidden" class="input_form" name="is_active" value="1">     
            <div class = "div_img">
                <label style="margin-right:-50px;"> Image :</label>
                <input style="margin-bottom: 20px;" type="file" name="image" placeholder="Image" required="" >
            </div>

            <div class = "div_design">
                <label style="margin-right:-50px;"> Order :</label>
                <input class = "input_color" type="number" min="0" name="order" placeholder="Order" required="">
            </div>

            <input type="checkbox" class="input_form" name="is_active" value="0">
            <label style="padding-right:100px;"for="active">Inactive</label><br>

            <div class = "div_design">
                <input type="submit" value="Add Galleries" class="btn btn-primary">
                <a  href="{{url('show_gallery', $gallery->product_id)}}" class="btn btn-outline-warning">Back</a>
            </div>
            </form>
            <script>
                    document.getElementById('create_gallery').addEventListener('submit', function (event) {
                    event.preventDefault(); // ยกเลิกการส่งฟอร์มแบบปกติ

                    // ตรวจสอบค่า Order ที่ป้อนเข้ามา
                    var orderInput = document.querySelector('input[name="order"]');
                    var orderValue = orderInput.value;

                    // ตรวจสอบว่ามี Order ที่ซ้ำกันหรือไม่
                    var orders = document.querySelectorAll('.center td:nth-child(5)');
                    for (var i = 0; i < orders.length; i++) {
                        var order = orders[i].textContent;
                        if (order === orderValue) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Invalid Order',
                                text: 'Order is already taken. Please choose a different Order.'
                            });
                            return; // ยกเลิกการดำเนินการต่อ
                        }
                    }

                    // ส่งข้อมูลฟอร์ม
                    var form = event.target;
                    var formData = new FormData(form);
                    fetch(form.action, {
                        method: 'POST',
                        body: formData
                    })
                    .then(function (response) {
                        if (response.ok) {
                            // ส่งคำขอเสร็จสมบูรณ์
                            Swal.fire({
                                icon: 'success',
                                title: 'Gallery created successfully',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(function () {
                                // โหลดหน้าเว็บใหม่
                                location.reload();
                            });
                        } else {
                            // การส่งคำขอผิดพลาด
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'An error occurred while creating the gallery. Please try again.'
                            });
                        }
                    })
                    .catch(function (error) {
                        // การส่งคำขอผิดพลาด
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'An error occurred while creating the gallery. Please try again.'
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