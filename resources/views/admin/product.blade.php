<!DOCTYPE html>
<html lang="en">
  <head>
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


        <div class ="div_center">

            <h2 class ="h2_font"> Add Product</h2>

            <form id="create_product"action="{{route('add_product')}}" method="POST" enctype="multipart/form-data">

            @csrf

            <div class = "div_design">

                <input type="hidden" class="input_form" name="is_highlight" value="0">
                <input type="hidden" class="input_form" name="is_active" value="0">
                <label> Name :</label>
                <input class = "input_color" type="text" name="name" placeholder="Name" required="">
            </div>

            <div class = "div_design">
                <label>Price Normal :</label>
                <input class = "input_color" type="number" min="0" name="price_normal" placeholder="Price Normal" required="">
            </div>

            <div class = "div_design">
                <label>Price Member :</label>
                <input class = "input_color" type="number" min="0" name="price_member" placeholder="Price Member" required="">
            </div>

            <label>Brand :</label>
                <select class = "input_color" name="brand" style="margin-bottom:10px;">
                    <option value="" selected="" required="" >Add a brand here </option>
                    @foreach($brand as $brand)
                    <option value = "{{$brand->id}}">{{$brand->name}}</option>
                    @endforeach
                </select><br>

            <label>Category :</label>
                <select class = "input_color" name="category" style="margin-bottom:10px;">
                    <option value="" selected="" required="" >Add a category here </option>
                    @foreach($category as $category)
                    <option value = "{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select><br>

            <label>Size :</label>
                <select class = "input_color" name="size" style="margin-bottom:10px;">
                    <option value="" selected="" required="" >Add a size here </option>
                    @foreach($size as $size)
                    <option value = "{{$size->id}}">{{$size->size}}</option>
                    @endforeach
                </select>

            <div class = "div_design">
                <label> Amount :</label>
                <input class = "input_color" type="number" min="0" name="amount" placeholder="Amount" required="">
            </div>

            <div class = "div_img">
                <label> Image :</label>
                <input type="file" name="image" placeholder="Image" required="" >
            </div>

            <div class = "div_design">
                <label>Start_display :</label>
                <input class = "input_color" type="datetime-local" name="start_display" required="">
            </div>

            <div class = "div_design">
                <label>End_display :</label>
                <input class = "input_color" type="datetime-local" name="end_display">
            </div>

            <input type="checkbox" class="input_form" name="is_highlight" value="1" checked>
            <label for="is_highlight">Highlight</label><br>
            <input type="checkbox" class="input_form" name="is_active" value="1" checked>
            <label for="active">Active</label><br>

            <div class = "div_design">
                <input type="submit" value="Add Product" class="btn btn-primary">
            </div>
            </form>
        </div>
        <script>
                document.getElementById('create_product').addEventListener('submit', function (event) {
                    event.preventDefault(); // ยกเลิกการส่งฟอร์มแบบปกติ

                    Swal.fire({
                    icon: 'success',
                    title: 'Product created successfully',
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
                        console.log('Product submitted successfully');
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

    @include('admin.script')
  </body>
</html>