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
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="images/favicon.png" type="">
    <title>Shopping - Product</title>
    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="home/css/bootstrap.css" />
    <!-- font awesome style -->
    <link href="home/css/font-awesome.min.css" rel="stylesheet" />
    <!-- Custom home/styles for this template -->
    <link href="home/css/style.css" rel="stylesheet" />
    <!-- responshome/ive style -->
    <link href="home/css/responsive.css" rel="stylesheet" />
    <link href="{{ asset('css/users.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

   </head>
   <body>
    <div class ="hero_area">
         <!-- header section strats -->
        @include('home.header')
         <!-- end header section -->

        <div class="promptpay-container">
            <div class ="thai-qr">
               <img src="images/thai_qr_payment.png" width="50%" alt="PromptPay">
            </div>
         <div class="promptpay-qrcode">
            <img src="{{ asset($qrCodeimg) }}" alt="PromptPay QR Code">
         </div>
         <h2 class="promptpay-title">Everything Shop</h2>
         <h3 class="promptpay-name">Bank Account : นางสาวภวิศา สิริโรจน์วรกุล</h3>
         <h3 class="total">Total : {{number_format($total_price,2)}} BAHT </h3>
         <a href="{{ asset($qrCodeimg) }}" class="btn btn-outline-info"target="_blank" download style="margin: 20px; 20px; ">DOWNLOAD QRCODE</a>  

         </div>

         <div class="divider-container">
            <div class="divider"></div>
         </div>

         <div class="member">
            <div>
               <h2 class="about-member">Member Name : {{$user->name}}</h2>
            </div>
            <div class="member">
               <div>
                     <div class="form-slip">
                        <form  id="paymentForm" action="{{route('payment_log')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                           <h2 class="about-member">
                              <label for="phone">Telephone:</label>
                              <input type="text" name="phone" value="{{$user->phone}}" class="input-phone">
                           </h2>
                              <input type="file" name="image" required>
                              <input type="submit" value="Submit" style="margin-top: 20px;">
                        </form>
                     </div>
               </div>
            </div>

         </div>
    </div>



      <!-- client section -->
      <!-- @include('home.client') -->
      <!-- end client section -->
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
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <script src="sweetalert2.all.min.js"></script>

      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js" integrity="sha512-fD9DI5bZwQxOi7MhYWnnNPlvXdp/2Pj3XSTRrFs5FQa4mizyGLnJcN6tuvUS6LbmgN1ut+XGSABKvjN0H6Aoow==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

   </body>
</html>