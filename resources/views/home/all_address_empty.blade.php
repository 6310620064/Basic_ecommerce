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
      <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" type="">
      <title>Shopping - Product</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="{{ asset('home/css/bootstrap.css')}}" />
      <!-- font awesome style -->
      <link href="{{ asset('home/css/font-awesome.min.css')}}" rel="stylesheet" />
      <!-- Custom home/styles for this template -->
      <link href="{{ asset('home/css/style.css')}}" rel="stylesheet" />
      <!-- responshome/ive style -->
      <link href="{{ asset('home/css/responsive.css" rel="stylesheet')}}" />
      <link href="{{ asset('css/users.css') }}" rel="stylesheet" />
   </head>
   <body>
   <div class ="hero_area">

         <!-- header section strats -->
        @include('home.header')
         <!-- end header section -->
         <!-- slider section -->
        <!-- @include('home.slider') -->
         <!-- end slider section -->
         <div class ="div_empty_center">
            <h1>You don't have any address</h1>
            <a class ="btn btn-success" href="{{route('shipping_address')}}">Add</a>
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
      <script src="{{ asset('home/js/jquery-3.4.1.min.js')}}"></script>
      <!-- popper jhome/s -->
      <script src="{{ asset('home/js/popper.min.js')}}"></script>
      <!-- bootstrahome/p js -->
      <script src="{{ asset('home/js/bootstrap.js')}}"></script>
      <!-- custom jhome/s -->
      <script src="{{ asset('home/js/custom.js')}}"></script>
    </body>
</html>