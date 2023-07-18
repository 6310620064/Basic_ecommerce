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
      <link rel="stylesheet" type="text/css" href="slick/slick.css"/>
      <link rel="stylesheet" type="text/css" href="slick/slick-theme.css"/>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.min.css">
      <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" integrity="sha512-17EgCFERpgZKcm0j0fEq1YCJuyAWdz9KUtv1EjVuaOz8pDnh/0nZxmU6BBXwaaxqoi9PQXnRWqlcDB027hgv9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   </head>
   <body>
         <!-- header section strats -->
        @include('home.header')
         <!-- end header section -->
            <div>
                <section>
                    <div class ="slider-for">
                        <div>
                            <img style="width :450px; height:450px; margin-left:300px; margin-top:150px; margin-bottom:200px; "src="{{ \Storage::url($product->image)}}"alt="">
                        </div>
                        @foreach($gallery as $galleries)
                            @if($galleries->is_active == '1')
                                <div>
                                    <img class="gallery-photo"style="width :450px; height:450px; margin-left:300px; margin-top:150px;"src="{{ \Storage::url($galleries->image)}}"alt="">
                                </div>
                            @endif
                        @endforeach
                    </div>
                <div class="detail-box" style="margin-left:900px; margin-top:-650px; padding:30px; margin-bottom: 200px;" >
                    <h3 style="text-decoration: none; border-bottom: 1px solid black;width: 75%;">
                        {{$product->name}}
                    </h3><br>

                    <h6 style ="text-decoration: line-through;">
                        Normal Price ฿ {{number_format($product->price_normal)}} 
                    </h6>

                    <h6 style="color:red;">
                        Member Price ฿ {{number_format($product->price_member)}} 
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

                    <form id="add_cart"style="display: flex; margin-top:30px;" action="{{route('add_cart',$product->id)}}" method ="POST">
                        @csrf
                        <div class ="row">
                            <div class="col-md-4">
                                <input type="number" name="amount" value ="1" style=" width:100px;text-align:center;" min="1">
                            </div>  
                            <div class="col-md-4">
                                <input type="submit" class="btn btn-dark" style="margin-left:15px;" value="Add To Cart" >
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        @if($gallery !== null && count($gallery) > 0)
            <div class ="slider-nav" style="margin-bottom:100px;">
                <div>
                    <img style="width :200px; height:200px; margin-bottom:100px; margin-left: -250px;"src="{{ \Storage::url($product->image)}}"alt="">
                </div>
                    @foreach($gallery as $galleries)
                        @if($galleries->is_active == '1')
                            <div>
                                <img class="gallery-photo"style="width :200px; height:200px; margin-bottom:100px; margin-left: -250px;"src="{{ \Storage::url($galleries->image)}}"alt="">
                            </div>
                        @endif
                    @endforeach
            </div>
        @endif
        
        </section>
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
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.all.min.js"></script>
        <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
        <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
        <script type="text/javascript" src="slick/slick.min.js"></script>			
        <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
        <script src="home/js/custom.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js" integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script>
            $('.slider-for').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: false,
                fade: true,
                asNavFor: '.slider-nav'
                });
            $('.slider-nav').slick({
                slidesToShow: 6,
                slidesToScroll: 1,
                asNavFor: '.slider-for',
                dots: true,
                centerMode: true,
                focusOnSelect: true
                });
        </script>
        <script>
            document.getElementById('add_cart').addEventListener('submit', function (event) {
                event.preventDefault();
                var form = event.target;
                var formData = new FormData(form);
                var amount = formData.get('amount');

                // ตรวจสอบว่า amount ไม่ใช่ null หรือว่างเปล่า
                if (amount === null || amount === '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid quantity',
                    text: 'Please enter a valid quantity.',
                });
                return;
                }

                // ตรวจสอบว่า amount เป็นจำนวนเต็มบวกหรือไม่
                if (amount <= 0 || isNaN(amount)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid quantity',
                    text: 'Please enter a valid quantity greater than 0.',
                });
                return;
                }

                // ตรวจสอบว่า amount ไม่เกินจำนวนที่มีในสต็อกของสินค้า
                var stockAmount = {{ $product->amount }}; // ตัวอย่างการใช้งานตามที่ product มีการเก็บจำนวนสินค้าในตัวแปร $product->amount
                if (amount > stockAmount) {
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid quantity',
                    text: 'Please enter a quantity less than or equal to the stock amount.',
                });
                return;
                }

                Swal.fire({
                icon: 'success',
                title: 'Add to cart successfully',
                showConfirmButton: false,
                timer: 1500,
                }).then(() => {
                // ส่งข้อมูลฟอร์มโดยใช้ XMLHttpRequest
                var xhr = new XMLHttpRequest();
                xhr.open('POST', form.action, true);
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                    console.log('Add to cart successfully');
                    }
                };
                xhr.send(formData);
                });
            });
            </script>


    </body>
</html>