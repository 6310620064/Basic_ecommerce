<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    @include('admin.css')
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
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


      <table class ="head_product">
        <tr>
          <th >ID</th>
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
          <th>Action</th>
        </tr>
      @foreach($product as $product)

        <tr>
          <td>{{$product->id}}</td>
          <td>{{$product->name}}</td>
          <td>{{$product->price_normal}}</td>
          <td>{{$product->price_member}}</td>
          <td>{{$product->brand->name}}</td>
          <td>{{$product->category->name}}</td>
          <td>{{$product->size->size}}</td>
          <td>{{$product->amount}}</td>
          <td>
            <img src="{{ \Storage::url($product->image)}}" alt=""/>
          </td>
          <td>
              @if($product->is_highlight == 1)
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
              @if($product->is_active == 1)
                <span class="icon-center">
                  <span class="iconify" data-icon="fa6-solid:check" style="color: green;"data-width="20" data-height="20"></span>
                </span>
              @else
                <span class="icon-center">
                  <span class="iconify" data-icon="charm:cross" style="color: red;"data-width="25" data-height="25"></span>
                </span>
              @endif
          </td>
          <td>{{$product->start_display}}</td>
          <td>{{$product->end_display}}</td>
          <td>
            <a style="margin-bottom:10px;"class ="btn btn-info" href="{{url('update_product', $product->id)}} ">Edit</a>
            <a onclick ="return confirm('Are you sure to delete this?')" class ="btn btn-danger" href="{{url('delete_product', $product->id)}}">Delete</a>
          </td>
        </tr>
      @endforeach
        <tr>
            <td colspan="14">
                <p>Total Products : {{ $product->count() }}</p>
            </td>
        </tr>
      </table>
    </div>
  </div>
    
    @include('admin.script')
  </body>
</html>