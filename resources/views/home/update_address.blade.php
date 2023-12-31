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

        <div class ="div-form">
            <form id ="update_address" action = "{{route('update_address_confirm' , $address->id)}}" method ="POST"> 
                @csrf 
                    <div style="margin-bottom: 20px;">
                        <label style="display: block; font-weight: bold; margin-bottom: 5px;">Address:</label>
                        <input type="text" id="address" name="address" placeholder="Address" required style="width: 100%; padding: 10px; font-size: 16px; border-radius: 4px; border: 1px solid #ccc;" value="{{$address->address}}">
                    </div>
                    <div style="margin-bottom: 20px;">
                        <label style="display: block; font-weight: bold; margin-bottom: 5px;" for="phone">Phone:</label>
                        <input type="tel" id="phone" name="phone" placeholder="Phone" required style="width: 100%; padding: 10px; font-size: 16px; border-radius: 4px; border: 1px solid #ccc;" value="{{$address->Phone}}">
                    </div>
                    <div class ="container">
                        @if($address->is_default == 1)
                            <input  class ="input-check" type="checkbox" id="default" name="is_default" value="1" checked>
                            <label class= "label-check"  for="default">Default</label><br>
                        @else
                            <input   type="hidden" id="default" name="is_default" value="0" >
                            <input  class ="input-check" type="checkbox" id="default" name="is_default" value="1" >
                            <label class= "label-check"  for="default">Default</label><br>

                        @endif
            
                    </div>
                    <div class ="container">
                        <a href="{{route('all_addresses')}}" style="margin-right:10px;"class ="btn btn-primary btn-lg">Back</a>
                        <input type="submit" value="Update">
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
      <script src="home/js/jquery-3.4.1.min.js"></script>
      <!-- popper jhome/s -->
      <script src="home/js/popper.min.js"></script>
      <!-- bootstrahome/p js -->
      <script src="home/js/bootstrap.js"></script>
      <!-- custom jhome/s -->
      <script src="home/js/custom.js"></script>
      <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>

      <script src="https://cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js" integrity="sha512-fD9DI5bZwQxOi7MhYWnnNPlvXdp/2Pj3XSTRrFs5FQa4mizyGLnJcN6tuvUS6LbmgN1ut+XGSABKvjN0H6Aoow==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

      <script>
            document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('update_address').addEventListener('submit', function (event) {
                event.preventDefault(); // Prevent the default form submission

                Swal.fire({
                    title: 'Do you want to save the changes?',
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: 'Save',
                    denyButtonText: `Don't save`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        // If the user confirms, submit the form
                        Swal.fire('Edit Success!', '', 'success')
                        
                        var form = event.target;
                        var formData = new FormData(form);

                        var xhr = new XMLHttpRequest();
                        xhr.open('POST', form.action, true);
                        xhr.onreadystatechange = function () {
                            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                                // ส่งคำขอเสร็จสมบูรณ์
                                console.log('Form submitted successfully');
                                // โหลดหน้าเว็บใหม่
                                location.reload();
                            }
                        };
                        xhr.send(formData);
                    } else if (result.isDenied) {
                        Swal.fire('Changes are not saved', '', 'info');
                    }
                });
            });
        });

        </script>
    </body>
</html>