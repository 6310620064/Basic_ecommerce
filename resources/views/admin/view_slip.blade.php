<!DOCTYPE html>
<html lang="en">
    <base href="/public">
  <head>
    <!-- Required meta tags -->
    @include('admin.css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.min.css">
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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

            @if($slip->isEmpty())

                <div class ="empty_log">
                    <h1>Sorry, You haven't paid yet.</h1>
                </div>

                <div>
                <a style="margin-left:300px; margin-top:50px;" href="{{route('show_order')}}" class="btn btn-primary">Back</a>
                </div>
                
            @else
                <div class="div_center">
                    <h2 class ="h2_font">Order No. {{$order->order_no}} </h2>
                </div>

                <table class ="table-item" >
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Total Price</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                @foreach ($slip as $slip)
                    <tbody>
                        <tr>
                            <td>{{$slip->name}}</td>
                            <td>{{substr($slip->phone,0,3) . '-' . substr($slip->phone,3,3). '-' . substr($slip->phone, 6)}}</td>    
                            <td> ฿ {{number_format($slip->total_price,2)}}</td>
                            <td>
                                <img src="{{ \Storage::url( $slip->image ) }}" alt="slip" onclick="showFullImage(this)">
                            </td>
                            </td>
                            <td>
                                @if($order->payment_status == 'Pay With Qrcode')
                                    <a href="{{route('approved', $order->id)}}" class="btn btn-outline-success" onclick="confirmApprove(event)">Approve</a>
                                @elseif($order->payment_status == 'Cash On Delivery')
                                    <a href="{{route('approved', $order->id)}}" class="btn btn-outline-success" onclick="confirmApprove(event)">Approve</a>
                                @else
                                    <p>Approved</p>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                @endforeach
                </table>
            <div>
                <a style="margin-left:200px; margin-top:50px;" href="{{route('show_order')}}" class="btn btn-primary">Back</a>
            </div>
            @endif
        </div>
            
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
    <!-- End custom js for this page -->
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js" integrity="sha512-fD9DI5bZwQxOi7MhYWnnNPlvXdp/2Pj3XSTRrFs5FQa4mizyGLnJcN6tuvUS6LbmgN1ut+XGSABKvjN0H6Aoow==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        function showFullImage(image) {
            const imageUrl = image.src;
            Swal.fire({
                imageUrl,
                imageAlt: 'Full Image',
                width: 'auto',
                showConfirmButton: false,
                showCloseButton: true
            });
        }
    </script>
    <script>
        function confirmApprove(event) {
            event.preventDefault();

            Swal.fire({
                title: 'Do you want to approve the order?',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'Approve',
                denyButtonText: `Don't approve`,
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire('Order approved!', '', 'success').then(() => {
                        window.location.href = event.target.href;
                    });
                } else if (result.isDenied) {
                    Swal.fire('Order not approved', '', 'info');
                }
            });
        }
    </script>




  </body>
        
</html>