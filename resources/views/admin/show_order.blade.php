<!DOCTYPE html>
<html lang="en">
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

            <div class="div_center">
                <h2 class ="h2_font">All Order</h2>

            </div>

                <table class="table-order">
                <thead>
                     <tr>
                        <th>Order No.</th>
                        <th>Total Price</th>
                        <th>User</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Payment Status</th>
                        <th>Delivery Status</th>
                        <th>Tracking No.</th>
                        <th>PDF</th>
                    </tr>      
                </thead>

                @foreach ($orders as $order)
                <tbody>
                    <tr>
                        <td>
                            <br>{{$order->order_no}}
                            <br><a class ="btn btn-outline-primary" href="{{route('all_order_item' , $order->id)}}" style="margin:10px 0 10px 0"> Detail</a>
                        </td>
                        <td> {{number_format($order->total_price,2)}} ฿</td>
                        <td>{{$order->user->name}}</td>
                        <td>{{$order->shipping_address->address}}</td>
                        <td>{{substr($order->shipping_address->Phone,0,3) . '-' . substr($order->shipping_address->Phone,3,3). '-' . substr($order->shipping_address->Phone, 6)}}</td>                        
                        <td>
                            @if($order->payment_status == 'Pay With Qrcode')
                                <br>{{$order->payment_status}}
                                <br><a class ="btn btn-warning" href="{{route('view_slip' , $order->id)}}"style="margin:10px 0 10px 0"> Slip</a><br>
                            @elseif($order->payment_status == 'Cash On Delivery')
                                {{$order->payment_status}}
                            @elseif($order->payment_status == 'Payment verified')
                                <br>{{$order->payment_status}}
                                <br><a class ="btn btn-outline-warning" href="{{route('view_slip' , $order->id)}}"style="margin:10px 0 10px 0"> Evidence</a><br>
                            @else
                                {{$order->payment_status}}
                            @endif

                        </td>
                        <td>
                            <div class="dropdown">
                                @if($order->delivery_status == 'Cancelled')
                                    <span style="color:#e51c23">{{$order->delivery_status}}
                                @elseif($order->delivery_status == 'Returned')
                                    <span style="color:#ffa000;">{{$order->delivery_status}}
                                @elseif($order->delivery_status == 'Delivered')
                                    <span style="color:#42db41;;">{{$order->delivery_status}}
                                @elseif($order->delivery_status == 'Out of delivery')
                                    <span style="color:#03a9f4;">{{$order->delivery_status}}
                                @else
                                    <span style="color:white;">{{$order->delivery_status}}
                                @endif
                                <span class="iconify" data-icon="ri:more-2-line" style="color: white;"></span></span>
                                <div class="dropdown-content">
                                    <a class ="a2" href="{{route('delivered' , $order->id)}}">Delivered</a>
                                    <a class ="a3" href="{{route('returned' , $order->id)}}">Returned</a>
                                    <a class ="a4" href="{{route('cancelled' , $order->id)}}">Cancelled</a>
                                </div>
                            </div>
                        </td>
                        <td>
                            @if($order->tracking_no == null)
                                <form  action ="{{route('add_tracking_no' ,$order->id)}}" method="POST">
                                    @csrf
                                    <div class = "div_design">
                                        <input class="tracking_no" type="text" name="tracking_no" placeholder="Tracking No." required="">
                                        <input type="submit" class ="btn btn-primary" name="submit" value ="submit">  
                                    </div>
                                </form>
                            @else
                                {{$order->tracking_no}}
                            @endif
                        </td>
                        <td><a href="{{route('print_pdf' ,$order->id)}}" class="btn btn-secondary">Download</a></td>
                    </tr>
                </tbody>
            @endforeach   
            </table>

            <span style="margin-left: 100px; margin-top:-50px;">       
                {{ $orders ->links() }}
            </span>
        </div>
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
    <!-- End custom js for this page -->
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js" integrity="sha512-fD9DI5bZwQxOi7MhYWnnNPlvXdp/2Pj3XSTRrFs5FQa4mizyGLnJcN6tuvUS6LbmgN1ut+XGSABKvjN0H6Aoow==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  </body>
        
</html>