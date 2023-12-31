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
      <title>Shopping - Product</title>
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
         <div class ="div-form">
         
            <form id ="edit_profile"action ="{{route('update_profile',$user->id)}}" method ="POST"> 
               @csrf 
                  <div style="margin-bottom: 20px;">
                     <label style="display: block; font-weight: bold; margin-bottom: 5px;">Name:</label>
                     <input type="text" id="name" name="name" placeholder="Name" value="{{$user->name}}" required style="width: 100%; padding: 10px; font-size: 16px; border-radius: 4px; border: 1px solid #ccc;">
                  </div>
                  <div style="margin-bottom: 20px;">
                     <label style="display: block; font-weight: bold; margin-bottom: 5px;" for="email">Email:</label>
                     <input type="email" id="email" name="email" placeholder="Email" value="{{$user->email}}" required style="width: 100%; padding: 10px; font-size: 16px; border-radius: 4px; border: 1px solid #ccc;">
                  </div>
                  <div style="margin-bottom: 20px;">
                     <label style="display: block; font-weight: bold; margin-bottom: 5px;" for="phone">Phone:</label>
                     <input type="tel" id="phone" name="phone" placeholder="Phone" value="{{$user->phone}}" style="width: 100%; padding: 10px; font-size: 16px; border-radius: 4px; border: 1px solid #ccc;">
                  </div>
                  <div class ="container">
                     <a href="{{route('redirect')}}" style="margin-right:10px; color:white;"class ="btn btn-primary btn-lg">Back</a>
                     <input type="submit" value="Submit">
                  </div>
            </form>
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
      <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js" integrity="sha512-fD9DI5bZwQxOi7MhYWnnNPlvXdp/2Pj3XSTRrFs5FQa4mizyGLnJcN6tuvUS6LbmgN1ut+XGSABKvjN0H6Aoow==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <!-- ... -->
      <script>
                document.getElementById('edit_profile').addEventListener('submit', function (event) {
                    event.preventDefault();

                    Swal.fire({
                    icon: 'success',
                    title: 'Profile updated successfully',
                    showConfirmButton: false,
                    timer: 1500
                    }).then(() => {
                    var form = event.target;
                    var formData = new FormData(form);

                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', form.action, true);
                    xhr.onreadystatechange = function () {
                        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                        console.log('Product submitted successfully');
                        location.reload();
                        }
                    };
                    xhr.send(formData);
                    });
                });
            </script>

   </body>
</html>