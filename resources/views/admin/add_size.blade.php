<!DOCTYPE html>
<html lang="en">
  <head>

    <!-- Required meta tags -->
    @include('admin.css')
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.min.css">
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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

                <form id="create_size" action ="{{route('add_size')}}" method="POST">
                    @csrf
                    <div class = "div_design">
                        <label> Size :</label>
                        <input class="input_form" type="text" name="size" placeholder="Size" required="">
                    </div>                
                    <input type="hidden" class="input_form" name="is_active" value="0">
                    <input type="checkbox" class="input_form" name="is_active" value="1" checked>
                    <label for="active">Active</label><br>

                    <input style= "margin-top:20px; margin-left:180px;" type="submit" class ="btn btn-outline-success" name="submit" value="Add Size">  
                </form>

                <a style="margin-right:100px; margin-top:-55px;" href="{{route('view_size')}}" class="btn btn-outline-primary">Back</a>


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
            
        </div>
    </div>

    @include('admin.script')
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js" integrity="sha512-fD9DI5bZwQxOi7MhYWnnNPlvXdp/2Pj3XSTRrFs5FQa4mizyGLnJcN6tuvUS6LbmgN1ut+XGSABKvjN0H6Aoow==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


  </body>
</html>