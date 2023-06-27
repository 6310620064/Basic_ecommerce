<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
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
                <h2 class ="h2_font">Add Brand</h2>

                <form id = "create_brand" action ="{{url('/add_brand')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class = "div_design">
                        <input type="hidden" class="input_form" name="is_active" value="1">

                        <label> Name :</label>
                        <input class="input_form" type="text" name="name" placeholder="Name" required="">
                    </div>
                    <input class="input_form" type="hidden" name="amount" value="0">
                    <div class = "div_img">
                        <label> Image :</label>
                        <input type="file" name="image" >
                    </div>
                    <div class = "div_design">
                        <label > Order :</label>
                        <input class="input_form" type="number" name="order"min="0" placeholder="Order" required="">
                    </div>
                    <input type="checkbox" class="input_form" name="is_active" value="0">
                    <label for="active">Inactive</label><br>

                    <input type="submit" class ="btn btn-primary" name="submit" value="Add Brand">  
                </form>
                <script>
                    document.getElementById('create_brand').addEventListener('submit', function (event) {
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
                    Swal.fire({
                        icon: 'success',
                        title: 'Brand created successfully',
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
                                console.log('Brand submitted successfully');
                                // โหลดหน้าเว็บใหม่
                                location.reload();
                            }
                        };
                        xhr.send(formData);
                    });
                });
                </script>
            </div>
            <table class="center">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Amount</th>
                        <th>Image</th>
                        <th>Order</th>
                        <th>Active</th>
                        <th>Action</th>
                    </tr>

                    @foreach($brand as $brand)
                    <tr>
                        <td>{{$brand->id}}</td>
                        <td>{{$brand->name}}</td>
                        <td>{{$brand->products->count() ?? 0}}</td>
                        <td class = "show_img">
                            <img src="{{ \Storage::url( $brand->image ) }}" alt=""/>
                        </td>
                        <td>{{$brand->order}}</td>
                        <td>
                            @if($brand->is_active == 1)
                                <span class="icon-center">
                                    <span class="iconify" data-icon="fa6-solid:check" style="color: green;"data-width="20" data-height="20"></span>
                                </span>
                            @else
                                <span class="icon-center">
                                    <span class="iconify" data-icon="charm:cross" style="color: red;"data-width="25" data-height="25"></span>
                                </span>
                            @endif
                        <td>
                            <a style="margin-bottom:10px;" href="{{url('update_brand', $brand->id)}}" class="btn btn-primary">Edit</a>
                            <a onclick="confirmation(event)" class ="btn btn-danger" href="{{url('delete_brand', $brand->id)}}">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="7">
                            <p>Total Brands : {{ $brand->count() }}</p>
                        </td>
                    </tr>
                </table>
        </div>
    </div>
    
    @include('admin.script')

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
                        'Your brand has been deleted.',
                        'success'
                    )
                    // Redirect to the URL
                    window.location.href = urlToRedirect;
                }
            });
        }
    </script>

  </body>
</html>