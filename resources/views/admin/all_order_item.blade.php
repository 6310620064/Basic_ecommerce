<!DOCTYPE html>
<html lang="en">
    <base href="/public">
  <head>
    <!-- Required meta tags -->
    @include('admin.css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.min.css">
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
    @include('admin.sidebar')
      <!-- partial -->
    @include('admin.header')
        <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">

            @if(session()->has('message'))

            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                {{session()->get('message')}}
            </div>

            @endif

            <div class="div_center">
                <h2 class ="h2_font">Order No. {{$order->order_no}} </h2>
            </div>

            <table class ="table-item" >
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            @foreach ($items as $item)
                <tbody>
                    <tr>
                        <td>{{$item->product->name}}</td>
                        <td>
                            <img src="{{ \Storage::url( $item->product->image ) }}" alt=""/>
                        </td>
                        <td> ฿ {{number_format($item->price,2)}}</td>
                        <td>{{$item->quantity}}</td>
                        <td>฿ {{number_format($item->sub_total,2)}}</td>
                    </tr>
                </tbody>
            @endforeach
            <tfoot>
                <tr>
                    <td colspan="1" style="text-align: center;"><strong>Total Price</strong></td>
                    <td colspan="4"><strong>฿ {{number_format($order->total_price,2)}}</strong></td>
                </tr>
            </tfoot>
            </table>

        <div>
            <a style="margin-left:200px; margin-top:50px;" href="{{route('show_order')}}" class="btn btn-primary">Back</a>
        </div>

        </div>
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
    <!-- End custom js for this page -->
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js" integrity="sha512-fD9DI5bZwQxOi7MhYWnnNPlvXdp/2Pj3XSTRrFs5FQa4mizyGLnJcN6tuvUS6LbmgN1ut+XGSABKvjN0H6Aoow==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  </body>
        
</html>