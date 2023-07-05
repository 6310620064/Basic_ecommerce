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
      <title>Famms - Fashion HTML Template</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="home/css/bootstrap.css" />
      <!-- font awesome style -->
      <link href="home/css/font-awesome.min.css" rel="stylesheet" />
      <!-- Custom home/styles for this template -->
      <link href="home/css/style.css" rel="stylesheet" />
      <!-- responshome/ive style -->
      <link href="home/css/responsive.css" rel="stylesheet" />
   </head>
   <body>
        <div style ="margin-top:10px;">
         <!-- header section strats -->
        @include('home.header')
         <!-- end header section -->
        </div>


        <section class="product_section layout_padding">
            <div class="container">
               <div class="heading_container heading_center">
                  <h2>
                     All <span>products</span>
                  </h2>
               </div>
               <div class="row">

                  @foreach($product as $products)
                     <div class="col-sm-6 col-md-4 col-lg-4">
                        <div class="box">
                           <div class="option_container">
                              <div class="options">
                                 <a href="{{route('product_detail', $products->id)}}" class="option1">
                                 Detail
                                 </a>
                              </div>
                           </div>
                           <div class="img-box">
                              <img src="{{ \Storage::url($products->image)}}"alt="">
                           </div>
                           <div class="detail-box">
                              <h5>
                                 {{$products->name}}
                              </h5>

                              <h6 style ="text-decoration: line-through;">
                                 Price <br>
                                 ฿ {{$products->price_normal}} 
                              </h6>

                              <h6 style="color:red;">
                                 Member Price <br>
                                 ฿ {{$products->price_member}} 
                              </h6>            
                           </div>
                        </div>
                     </div>
                  @endforeach

               <span style="padding-top: 20px;">       
                  {{ $product ->links() }}
               </span>     
            </div>
         </section>
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
   </body>
</html>