<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="{{ asset ('css/static.css') }}">


<header class="header_section">
   <div class="container">
      <nav class="navbar navbar-expand-lg custom_nav-container ">
         <a class="navbar-brand" href="{{route('index')}}"><img width="120" height="120" src="{{ asset('images/shop_logo.jpg') }}" alt=" " /></a> 
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
         <span class=""> </span>
         </button>
         <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav">
               <li class="nav-item">
                  <a class="nav-link" href="{{route('index')}}">Home <span class="sr-only">(current)</span></a>
               </li>
               <!-- <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"> <span class="nav-label">Pages <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                     <li><a href="about.html">About</a></li>
                     <li><a href="testimonial.html">Testimonial</a></li>
                  </ul>
               </li> -->
               <li class="nav-item">
                  <a class="nav-link" href="{{route('all_products')}}">Products</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="{{route('all_brands')}}">Brands</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="{{route('all_categories')}}">Categories</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="{{route('all_sizes')}}">Sizes</a>
               </li>
               
               <!-- <form class="form-inline">
                  <button class="btn  my-2 my-sm-0 nav_search-btn" type="submit">
                  <i class="fa fa-search" aria-hidden="true"></i>
                  </button>
               </form> -->
               
               @if (Route::has('login'))

               @auth

               <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-list-4" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
               </button>
               <div class="collapse navbar-collapse" id="navbar-list-4">
                  <ul class="navbar-nav">
                     <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="margin-top:-8px;">
                        <img src="{{ asset('images/user_avatar.png') }}" width="40" height="40" class="rounded-circle">
                     </a>
                     <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="" style="text-align:center;">Edit Profile</a>
                        <a class="dropdown-item" href="{{route('all_orders')}}" style="text-align:center;">My Order</a>
                        <a class="dropdown-item" href="{{route('all_addresses')}}" style="text-align:center;" >My Address</a>
                        <a class="dropdown-item" href="{{ route('logout') }}">
                              <form method="POST" action="{{ route('logout') }}" class="inline">
                                 @csrf
                                 <button type="submit" id="logoutcss" class="btn btn-danger btn-sm" style="text-align:center;">
                                    {{ __('Log Out') }}
                                 </button>
                              </form>
                        </a>
                     </div>
                     </li>   
                  </ul>
               </div>

               <li>
                  <a class ="nav-link" href="{{route('show_cart')}}"><i class="fa-solid fa-cart-shopping fa-lg" style="color: #ff1100;"></i></a>
               </li>
               
               
               @else

               <li class="nav-item">
                  <a class="btn btn-primary" id="logincss"  href="{{ route('login') }}" >Login</a>
               </li>

               <li class="nav-item">
                  <a class="btn btn-success" href="{{ route('register') }}" >Register</a>
               </li>
               @endauth

               @endif
               

               
            </ul>
         </div>
      </nav>
   </div>
</header>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js" integrity="sha512-fD9DI5bZwQxOi7MhYWnnNPlvXdp/2Pj3XSTRrFs5FQa4mizyGLnJcN6tuvUS6LbmgN1ut+XGSABKvjN0H6Aoow==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>