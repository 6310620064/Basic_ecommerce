<!DOCTYPE html>
<html>

   <head>
      <!-- Basic -->
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="shortcut icon" href="images/favicon.png" type="">
      <title>Shopping - Product</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="home/css/bootstrap.css" />
      <!-- font awesome style -->
      <link href="{{ asset('home/css/font-awesome.min.css') }}" rel="stylesheet" />
      <!-- Custom home/styles for this template -->
      <link href="{{ asset('home/css/style.css') }}" rel="stylesheet" />
      <!-- responshome/ive style -->
      <link href="{{ asset('home/css/responsive.css') }}" rel="stylesheet" />
      <link href="{{ asset('css/users.css') }}" rel="stylesheet" />
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.min.css">
      <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/jquery.slick/1.6.0/slick.css" />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   </head>
   <body>
   <div class ="hero_area">

        <!-- header section strats -->
    @include('home.header')
        <!-- end header section -->
        <!-- slider section -->
    <!-- @include('home.slider') -->
        <!-- end slider section -->
    @if($orders->isEmpty())
    <div class ="hero_area">

        <div class ="div_empty_center">
            <h1>You Don't Have Any Orders.</h1>
        </div>
  
        <div class ="proceed">
            <a href= "{{route('index')}}" class ="btn btn-dark">Back to shopping</a>
        </div>    
    </div>
    @else
        <div class="div_center">
            <h2 class ="h2_font">My Orders</h2>
        </div>
            <table class ="table_address" >
            <thead>
                <tr>
                    <th>Order No.</th>
                    <th>Total Price</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Payment Status</th>
                    <th>Delivery Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            @foreach ($orders as $order)
                <tbody>
                    <tr>
                        <td>{{$order->order_no}}</td>
                        <td> ฿ {{number_format($order->total_price,2)}}</td>
                        <td>{{$order->shipping_address->address}}</td>
                        <td>{{substr($order->shipping_address->Phone,0,3) . '-' . substr($order->shipping_address->Phone,3,3). '-' . substr($order->shipping_address->Phone, 6)}}</td>
                        <td>{{$order->payment_status}}</td>
                        <td>{{$order->delivery_status}}</td>
                        <td>
                            <a style="margin-bottom:10px; margin-top:10px;"class ="btn btn-primary" href="{{route('order_item' , $order->id)}}">Detail <span class="iconify" data-icon="tabler:list-details" data-rotate="180deg"></span></a><br>
                        </td>
                    </tr>
                </tbody>
            @endforeach
            </table>

            <span style="margin-left: 100px; margin-top:-50px;">       
                {{ $orders ->links() }}
            </span>          
        </div>
    @endif
      <!-- footer start -->
      @include('home.footer')
      <!-- footer end -->
      <div class="cpy_">
         <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>
         
            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
         
         </p>
      </div>
    
      <!-- jQery -->
      <script src="home/js/jquery-3.4.1.min.js"></script>
      <!-- popper jhome/s -->
      <script src="home/js/popper.min.js"></script>
      <!-- bootstrahome/p js -->
      <script src="home/js/bootstrap.js"></script>
      <!-- custom jhome/s -->
      <script src="home/js/custom.js"></script>
      <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <script src="https://cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js" integrity="sha512-fD9DI5bZwQxOi7MhYWnnNPlvXdp/2Pj3XSTRrFs5FQa4mizyGLnJcN6tuvUS6LbmgN1ut+XGSABKvjN0H6Aoow==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    </body>
</html>