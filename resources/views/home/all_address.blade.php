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

         <div class="div_center">
            <h2 class ="h2_font">All Addresses</h2>
            <a class ="btn btn-success" href="{{route('shipping_address')}}">Add</a>

        </div>



        <table class ="table_address">
        <thead>
            <tr>
                <th>Address</th>
                <th>Phone</th>
                <th>Default</th>
                <th>Action</th>
            </tr>
        </thead>

        @foreach ($address as $addresses)
            <tbody>
                <tr>
                    <td>{{$addresses->address}}</td>
                    <td>{{substr($addresses->Phone,0,3) . '-' . substr($addresses->Phone,3,3). '-' . substr($addresses->Phone, 6)}}</td>
                    <td>
                    @if($addresses->is_default == 0)
                        <span class="icon-center">
                            <span class="iconify" data-icon="charm:cross" style="color: red;"data-width="25" data-height="25"></span>
                        </span>
                    @else
                        <span class="icon-center">
                            <span class="iconify" data-icon="fa6-solid:check" style="color: green;"data-width="20" data-height="20"></span>
                        </span>
                    @endif
                    </td>
                    <td>
                        <a style="margin-bottom:10px; margin-top:10px;"class ="btn btn-primary" href="{{route('update_address', $addresses->id)}}"><i class="fa-solid fa-pen-to-square"></i> Edit</a><br>
                        <a  onclick="confirmation(event)" style="margin-bottom:10px;"class ="btn btn-danger" href="{{route('delete_address', $addresses->id)}}"><i class="fas fa-trash-alt"></i> Delete</a>
                    </td>
                </tr>
            </tbody>
        @endforeach

        </table>
         
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
      <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <script src="https://cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js" integrity="sha512-fD9DI5bZwQxOi7MhYWnnNPlvXdp/2Pj3XSTRrFs5FQa4mizyGLnJcN6tuvUS6LbmgN1ut+XGSABKvjN0H6Aoow==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <script>
        function confirmation(event) {
            event.preventDefault();
            var urlToRedirect = event.currentTarget.getAttribute('href');
            Swal.fire({

                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'No, cancel!',
                confirmButtonText: 'Yes, delete it!',
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Deleted!',
                        'Your Address has been deleted.',
                        'success'
                    )
                    // Redirect to the URL
                    window.location.href = urlToRedirect;
                }
            });
        }
    </script>
    </body>
</html>