<!DOCTYPE html>
<html>
   <head>
      <!-- Basic -->
      <base href="/public">

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
      <link rel="stylesheet" href="{{ asset('css/styles.css') }}">


   </head>
   <body>
      <div class="hero_area" style="display:flex; justify-content: space-between;">
         <!-- header section strats -->
        @include('home.header')
         <!-- end header section -->

            <div style ="margin:auto; padding:30px;">
                <img style="width :450px; height:450px; margin-left:150px; margin-top:50px; "src="{{ \Storage::url($product->image)}}"alt="">
                <div class="detail-box" style="margin-left:650px; margin-top:-400px; padding:30px; margin-bottom: 200px;" >
                    <h3 style="text-decoration: none; border-bottom: 1px solid black;width: 75%;">
                        {{$product->name}}
                    </h3><br>

                    <h6 style ="text-decoration: line-through;">
                        Normal Price ฿ {{$product->price_normal}} 
                    </h6>

                    <h6 style="color:red;">
                        Member Price ฿ {{$product->price_member}} 
                    </h6><br>
                    
                    @foreach($details as $detail)
                        @if($detail->is_active == '1')
                            @if($detail->type == 'Title')
                                <h5 class="break-word" >{{$detail->value}}</h5>
                            @endif
                        @endif
                    @endforeach
                    <br>
                    @foreach($details as $detail)
                        @if($detail->is_active == '1')
                            @if($detail->type == 'Description')
                                <h6 class="break-word" >{{$detail->value}}</h6>
                            @endif
                        @endif
                    @endforeach

                    <form style="display: flex; margin-top:20px;" action="{{route('add_cart',$product->id)}}" method ="POST">

                        @csrf

                            <input type="number" name="amount" value ="1" style="width:100px; ; margin: 10px; text-align:center;" min="1">
                            <input type="submit" class="btn btn-dark" style="margin-left:15px;" value="Add To Cart" >

                    </form>
                </div>
            </div>
        </div>
        <div class ="gallery">
        @foreach($gallery as $gallery)
            @if($gallery->is_active == '1')
                <img class="gallery-photo"style="width :200px; height:200px ;"src="{{ \Storage::url($gallery->image)}}"alt="">
            @endif
        @endforeach
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
      <script src="home/js/jquery-3.4.1.min.js"></script>
      <!-- popper jhome/s -->
      <script src="home/js/popper.min.js"></script>
      <!-- bootstrahome/p js -->
      <script src="home/js/bootstrap.js"></script>
      <!-- custom jhome/s -->
      <script src="home/js/custom.js"></script>
   </body>
</html>