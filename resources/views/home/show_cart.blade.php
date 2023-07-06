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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.min.css">
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

        <div class ="cart_center">
            <table>
                <thead>
                <tr>
                    <th class ="th_deg" >Product</th>
                    <th class ="th_deg" >Price</th>
                    <th class ="th_deg" >Quantity</th>
                    <th class ="th_deg" >Subtotal</th>
                    <th class ="th_deg" >Action</th>
                </tr>
                </thead>
                
                <tbody>
                <?php $total_price = 0 ?>
                @foreach($cart as $cart)
                <tr>
                    <td class = "td_deg">
                        <div class ="content-wrapper">
                            <img class="img_deg"src="{{ \Storage::url($cart->product->image)}}" alt=""/>
                            {{$cart ->product->name}}
                        </div>
                    </td >
                    <td  class= "td_deg">฿ {{number_format($cart ->product->price_member,2)}}</td>
                    <td  class= "td_deg">
                        <button class="reduce_qty" data-cart-id="{{ $cart->id }}"> - </button>
                        <input class="qty" type="string" value="{{ $cart->quantity }}">
                        <button class="add_qty" data-cart-id="{{ $cart->id }}"> + </button>
                    </td>
                    <td  class = "td_deg"><span class="subtotal">{{number_format($cart->product->price_member * $cart->quantity, 2)}}</span></td>
                    <td  class = "td_deg" >
                        <a onclick="confirmation(event)" class ="btn btn-danger" href="{{route('delete_cart' , $cart->id)}}"><i class="fas fa-trash-alt"></i> Delete</a>
                    </td>
                </tr>

                <?php $total_price = $total_price + ($cart->product->price_member * $cart->quantity) ?>

                @endforeach
                </form>
                </tbody>
            </table>
            <div>
                <h1 id="total_price" class ="total_deg">Total Price : ฿ {{number_format($total_price,2)}}</h1>
            </div>

            <div>
                <h1 style ="font-size:25px; padding-bottom:15px;">Proceed to Order</h1>
                <a href= "{{route('cash_order')}}" class ="btn btn-warning">Cash on Delivery</a>
                <a href="" class ="btn btn-warning">Pay With QRCODE</a>

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
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.min.js"></script>
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
                        'Your cart has been deleted.',
                        'success'
                    )
                    // Redirect to the URL
                    window.location.href = urlToRedirect;
                }
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            var reduceQtyButtons = document.getElementsByClassName('reduce_qty');
            var addQtyButtons = document.getElementsByClassName('add_qty');

            for (var i = 0; i < reduceQtyButtons.length; i++) {
                reduceQtyButtons[i].addEventListener('click', function() {
                    var inputField = this.parentNode.querySelector('input[type="string"]');

                    if (parseInt(inputField.value) > 1) {
                        inputField.value = parseInt(inputField.value) - 1;

                        updateSubtotal();

                        // Update quantity in database
                        var cartId = this.dataset.cartId;
                        var newQuantity = inputField.value;
                        updateQuantityInDatabase(cartId, newQuantity);
                    }
                });
            }

            for (var i = 0; i < addQtyButtons.length; i++) {
                addQtyButtons[i].addEventListener('click', function() {
                    var inputField = this.parentNode.querySelector('input[type="string"]');

                    inputField.value = parseInt(inputField.value) + 1;

                    updateSubtotal();

                    // Update quantity in database
                    var cartId = this.dataset.cartId;
                    var newQuantity = inputField.value;
                    updateQuantityInDatabase(cartId, newQuantity);
                });
            }
        });


        function updateSubtotal() {
            var quantityInputs = document.getElementsByClassName('qty');
            var subtotalElements = document.getElementsByClassName('subtotal');
            var total_price = 0;

            for (var i = 0; i < quantityInputs.length; i++) {
                var quantity = parseInt(quantityInputs[i].value);
                var price = parseFloat(quantityInputs[i].parentNode.previousElementSibling.textContent.replace('฿', '').replace(',', ''));

                var subtotal = quantity * price;
                var formattedSubtotal = '฿ ' + number_format(subtotal, 2);

                subtotalElements[i].textContent = formattedSubtotal;

                total_price += subtotal;
            }

            var totalElement = document.getElementById('total_price');
            totalElement.textContent = 'Total Price: ฿ ' + number_format(total_price, 2);
        }

        function number_format(number, decimals, dec_point, thousands_sep) {
            number = parseFloat(number);
            decimals = decimals || 0;
            dec_point = dec_point || '.';
            thousands_sep = thousands_sep || ',';

            var roundedNumber = Math.round(number * Math.pow(10, decimals)) / Math.pow(10, decimals);
            var parts = roundedNumber.toFixed(decimals).toString().split('.');
            parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, thousands_sep);

            return parts.join(dec_point);
        }

        function updateQuantityInDatabase(cartId, newQuantity) {
            fetch('/update_quantity', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    cart_id: cartId,
                    quantity: newQuantity
                })
            })
            .then(response => response.json())
            .then(data => {
                console.log('Quantity updated successfully');
            })
            .catch(error => {
                console.log('An error occurred while updating quantity');
            });
        }
    </script>


   </body>
</html>