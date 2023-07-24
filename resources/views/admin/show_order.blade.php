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
                <h2 class ="h2_font">All Orders</h2>
            </div>

            

            <div class ="search-box">
                <form action="{{route('search_order')}}" method="GET">
                    @csrf
                        <input class ="input_color"type ="text" name="search" placeholder="Search">
                        <input type="submit" value="Search" class="btn btn-outline-success">
                </form>
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

                @foreach ($order as $orders)
                <tbody>
                    <tr>
                        <td>
                            <br>{{$orders->order_no}}
                            <br><a class ="btn btn-outline-primary" href="{{route('all_order_item' , $orders->id)}}" style="margin:10px 0 10px 0"> Detail</a>
                        </td>
                        <td> {{number_format($orders->total_price,2)}} ฿</td>
                        <td>{{$orders->user->name}}</td>
                        <td>{{$orders->shipping_address->address}}</td>
                        <td>{{substr($orders->shipping_address->Phone,0,3) . '-' . substr($orders->shipping_address->Phone,3,3). '-' . substr($orders->shipping_address->Phone, 6)}}</td>                        
                        <td>
                            @if($orders->payment_status == 'Pay With Qrcode')
                                <br>{{$orders->payment_status}}
                                <br><a class ="btn btn-warning" href="{{route('view_slip' , $orders->id)}}"style="margin:10px 0 10px 0"> Slip</a><br>
                            @elseif($orders->payment_status == 'Cash On Delivery')
                                {{$orders->payment_status}}
                            @elseif($orders->payment_status == 'Payment verified')
                                <br>{{$orders->payment_status}}
                                <br><a class ="btn btn-outline-warning" href="{{route('view_slip' , $orders->id)}}"style="margin:10px 0 10px 0"> Evidence</a><br>
                            @else
                                {{$orders->payment_status}}
                            @endif

                        </td>
                        <td>
                            <div class="dropdown">
                                @if($orders->delivery_status == 'Cancelled')
                                    <span style="color:#e51c23">{{$orders->delivery_status}}
                                @elseif($orders->delivery_status == 'Returned')
                                    <span style="color:#ffa000;">{{$orders->delivery_status}}
                                @elseif($orders->delivery_status == 'Delivered')
                                    <span style="color:#42db41;;">{{$orders->delivery_status}}
                                @elseif($orders->delivery_status == 'Out of delivery')
                                    <span style="color:#03a9f4;">{{$orders->delivery_status}}
                                @else
                                    <span style="color:white;">{{$orders->delivery_status}}
                                @endif
                                <span class="iconify" data-icon="ri:more-2-line" style="color: white;"></span></span>
                                <div class="dropdown-content">
                                    <a class ="a2" href="{{route('delivered' , $orders->id)}}">Delivered</a>
                                    <a class ="a3" href="{{route('returned' , $orders->id)}}">Returned</a>
                                    <a class ="a4" href="{{route('cancelled' , $orders->id)}}">Cancelled</a>
                                </div>
                            </div>
                        </td>
                        <td>
                            @if($orders->tracking_no == null)
                                <form  action ="{{route('add_tracking_no' ,$orders->id)}}" method="POST">
                                    @csrf
                                    <div class = "div_design">
                                        <input class="tracking_no" type="text" name="tracking_no" placeholder="Tracking No." required="">
                                        <input type="submit" class ="btn btn-primary" name="submit" value ="submit">  
                                    </div>
                                </form>
                            @else
                                {{$orders->tracking_no}}
                            @endif
                        </td>
                        <td><a href="{{route('print_pdf' ,$orders->id)}}" class="btn btn-secondary">Download</a></td>
                    </tr>
                </tbody>
            @endforeach   
            </table>

            <span style="margin-left: 100px; margin-top:-50px;">       
                {{ $order ->links() }}
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