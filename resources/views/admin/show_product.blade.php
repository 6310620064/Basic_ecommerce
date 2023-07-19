<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    @include('admin.css')
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.min.css">
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    
  </head>
  <body>
    <div class="container-scroller">
    @include('admin.sidebar')
    @include('admin.header')
  <div class="main-panel">
    <div class="content-wrapper">

      @if(session()->has('message'))

        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
            {{session()->get('message')}}
        </div>

      @endif

    <div class="div_center">
      <h2 class ="h2_font">All Products</h2>
    </div>

    <div class ="search-box">
      <form action="{{route('search_product')}}" method="GET">
          @csrf
              <input class ="input_color"type ="text" name="search" placeholder="Search">
              <input type="submit" value="Search" class="btn btn-outline-success">
      </form>
    </div>


      <table class ="head_product">
        <tr>
          <th>Name</th>
          <th>Price Normal</th>
          <th>Price Member</th>
          <th>Brand</th>
          <th>Category</th>
          <th>Size</th>
          <th>Amount</th>
          <th>Image</th>
          <th>Highlight</th>
          <th>Active</th>
          <th>Start Display</th>
          <th>End Display</th>
          <th>Relate</th>
          <th>Action</th>
        </tr>
      @foreach($product as $products)

        <tr>
          <td >{{$products->name}}</td>
          <td>{{number_format($products->price_normal,2)}} ฿</td>
          <td>{{number_format($products->price_member,2)}} ฿</td>
          <td>{{$products->brand->name}}</td>
          <td>{{$products->category->name}}</td>
          <td>{{$products->size->size}}</td>
          <td>
            @if($products->amount == 0)
              <p style="color:red">{{$products->amount}}</p>
            @else
              {{$products->amount}}
            @endif
          </td>
          <td>
            <img class ="img_center"style="max-width: 100px; max-height: 100px;" src="{{ \Storage::url($products->image)}}" alt="" onclick="showFullImage(this)"/>
          </td>
          <td>
              @if($products->is_highlight == 1)
                <span class="icon-center">
                  <span class="iconify" data-icon="fa6-solid:check" style="color: green;"data-width="20" data-height="20"></span>
                </span>
              @else
                <span class="icon-center">
                  <span class="iconify" data-icon="charm:cross" style="color: red;"data-width="25" data-height="25"></span>
                </span>
              @endif
          </td>
          <td>
              @if($products->is_active == 1)
                <span class="icon-center">
                  <span class="iconify" data-icon="fa6-solid:check" style="color: green;"data-width="20" data-height="20"></span>
                </span>
              @else
                <span class="icon-center">
                  <span class="iconify" data-icon="charm:cross" style="color: red;"data-width="25" data-height="25"></span>
                </span>
              @endif
          </td>
          <td>{{$products->start_display}}</td>
          <td>{{$products->end_display}}</td>
          <td>
            <a style="margin-bottom:10px; "class ="btn btn-info" href="{{route('show_detail', $products->id)}}">Detail</a>
            <a class ="btn btn-success" href="{{route('show_gallery', $products->id)}}" >Gallery</a>
          </td>
          <td colspan="2">
            <a style="margin-bottom:10px;"class ="btn btn-primary" href="{{route('update_product', $products->id)}} "><i class="fa-solid fa-pen-to-square"></i> Edit</a><br>
            <a onclick="confirmation(event)" class ="btn btn-danger" href="{{route('delete_product', $products->id)}}"><i class="fas fa-trash-alt"></i> Delete</a>
          </td>
        </tr>
      @endforeach
        <tr>
            <td colspan="15">
              @if($product->count() == '0')
                <p>Total Products : {{ $product->count() }}</p>
              @else
                <p>Total Products : {{ $products->count() }}</p>
              @endif
            </td>
        </tr>
      </table>
        <div class="pagination_product">
          {{ $product->links() }}
        </div>
    </div>
  </div>
    
    @include('admin.script')
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                        'Your product has been deleted.',
                        'success'
                    )
                    // Redirect to the URL
                    window.location.href = urlToRedirect;
                }
            });
        }
    </script>
    <script>
        function showFullImage(image) {
            const imageUrl = image.src;
            Swal.fire({
                imageUrl,
                imageAlt: 'Full Image',
                width: '500px',
                height: '500px',
                showConfirmButton: false,
                showCloseButton: true
            });
        }
    </script>

  </body>
</html>