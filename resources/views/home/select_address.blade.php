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
         <div class="div-form">
            <form id="select_address" action="{{ route('select_address_confirm') }}" method="POST">
               @csrf
               @if($default != null)
                  <label>Address :</label>
                  <select name="address" style="margin-bottom:10px;">
                  <option value="{{$default->id}}" selected="" required=""> {{$default->address}} Phone: {{$default->Phone}} </option>
                     @foreach($address as $addresses)
                        @if($addresses != $default)
                           <option value="{{$addresses->id}}" required=""> {{$addresses->address}} Phone: {{$addresses->Phone}} </option>
                        @endif
                     @endforeach
                  </select>
               @else
                  <label>Address :</label>
                  <select name="address" style="margin-bottom:10px;">
                  <option >Select address here</option>
                     @foreach($address as $addresses)
                           <option value="{{$addresses->id}}" required=""> {{$addresses->address}} Phone: {{$addresses->Phone}} </option>
                     @endforeach
                  </select>
               @endif
               <input type="submit" value="Submit" style="margin-top:50px; margin-left:150px;">
            </form>
            <a href="{{route('show_cart')}}" class="btn btn-primary btn-lg" style="margin-left:30px; margin-top:-75px;">Back</a>

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
      <script src="home/js/jquery-3.4.1.min.js"></script>
      <!-- popper jhome/s -->
      <script src="home/js/popper.min.js"></script>
      <!-- bootstrahome/p js -->
      <script src="home/js/bootstrap.js"></script>
      <!-- custom jhome/s -->
      <script src="home/js/custom.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

      <script src="https://cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js" integrity="sha512-fD9DI5bZwQxOi7MhYWnnNPlvXdp/2Pj3XSTRrFs5FQa4mizyGLnJcN6tuvUS6LbmgN1ut+XGSABKvjN0H6Aoow==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <!-- ... -->
      <script>
         document.getElementById('select_address').addEventListener('submit', function (event) {
         event.preventDefault();

         var form = event.target;
         var formData = new FormData(form);

         fetch(form.action, {
            method: 'POST',
            body: formData
         })
         .then(function (response) {
            if (response.ok) {
               return response.text();
            }
            throw new Error('Network response was not ok.');
         })
         .then(function (data) {
            Swal.fire({
               icon: 'success',
               title: 'Select address successfully',
               showConfirmButton: false,
               timer: 1500
            }).then(function () {
               window.location.href = '{{ route('show_cart') }}';
            });
         })
         .catch(function (error) {
            console.log('Error:', error);
         });
         });

      </script>

   </body>
</html>