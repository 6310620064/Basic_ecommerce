<!DOCTYPE html>
<html>

   <base href ="/public">

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
      <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" type="">
      <title>Success</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="{{ asset('home/css/bootstrap.css') }}" />
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
         <div class ="div-success">
            <h3 style="text-align:center;">{{$order_info['message']}} </h3>
            <div class="icon-container">
                <iconify-icon icon="ep:success-filled" style="color: green;" width="150" height="150"></iconify-icon>
            </div>
            <h4 style="text-align:center; margin-top:20px;">Order No : {{$order_info['order_no']}}</h4>
            <a style="margin-top:20px;"class ="btn btn-outline-primary"href="{{route('all_orders')}}">See all order</a>
        </div>
    </div>
      <!-- footer start -->
      @include('home.footer')
      <!-- footer end -->
      <div class="cpy_">
         <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>
         
            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
         
         </p>
      </div>
    
      <!-- jQery -->
      <script src="{{ asset('home/js/jquery-3.4.1.min.js') }}"></script>
      <!-- popper jhome/s -->
      <script src="{{ asset('home/js/popper.min.js') }}"></script>
      <!-- bootstrahome/p js -->
      <script src="{{ asset('home/js/bootstrap.js') }}"></script>
      <!-- custom jhome/s -->
      <script src="{{ asset('home/js/custom.js') }}"></script>
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

      <script src="https://cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js"></script>
      <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js" integrity="sha512-fD9DI5bZwQxOi7MhYWnnNPlvXdp/2Pj3XSTRrFs5FQa4mizyGLnJcN6tuvUS6LbmgN1ut+XGSABKvjN0H6Aoow==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <!-- ... -->
   </body>
</html>