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
      <link href="home/css/font-awesome.min.css" rel="stylesheet" />
      <!-- Custom home/styles for this template -->
      <link href="home/css/style.css" rel="stylesheet" />
      <!-- responshome/ive style -->
      <link href="home/css/responsive.css" rel="stylesheet" />
      <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />

      <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/jquery.slick/1.6.0/slick.css" />


   </head>
   <body>
         <!-- header section strats -->
        @include('home.header')
         <!-- end header section -->
         <!-- slider section -->
        <!-- @include('home.slider') -->
         <!-- end slider section -->
         <section class="image-section">
            <div class="container">
               <div class="image-grid">
                  @foreach($category as $categories)
                  @if($categories->is_display_homepage == '1' && $categories->is_active == '1')
                     <div class="slide">
                        <div class="image-item">
                           <a href="{{route('category_product', $categories->id )}} ">
                              <img style="width:250px; height:250px;" src="{{ \Storage::url($categories->image)}}" alt="">
                           </a>
                        <a href="{{route('category_product', $categories->id )}}" class="image-link">{{$categories->name}}</a>
                        </div>
                     </div>
                  @endif
                  @endforeach
               </div>
               <div>
               <button class="prev-button">&lt;</button>
               <button class="next-button">&gt;</button>
               </div>
            </div>
         </section>


      <!-- product section -->
      @include('home.popular_product')
      <!-- end product section -->

      <!-- why section -->
      @include('home.why')
      <!-- end why section -->
      

      <!-- subscribe section -->
      @include('home.subscribe')
      <!-- end subscribe section -->
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
      <script src="https://cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js"></script>
      <script>
      $(document).ready(function(){
         $('.image-grid').slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            infinite: true,
            prevArrow: $('.prev-button'),
            nextArrow: $('.next-button'),
         });
      });
   </script>
   </body>
</html>