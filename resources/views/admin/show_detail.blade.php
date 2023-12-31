<!DOCTYPE html>
<html lang="en">
  <head>
    <base href ="/public">
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

        <div class="div_center">
            <h2 class ="h2_font"> All details of {{$product->name}} </h2>
        </div>

        <div class="add-button-container">
            <a class="btn btn-info" href="{{route('view_detail', $product->id)}}">Add</a>
        </div> 

        <div class ="search-boxs">
            <form action="{{route('search_detail' , $product->id)}}" method="GET">
                @csrf
                    <input class ="input_color"type ="text" name="search" placeholder="Search">
                    <input type="submit" value="Search" class="btn btn-outline-success">
            </form>
        </div>

                <table class="center">
                    <tr>
                        <th>ID</th>
                        <th>Type</th>
                        <th>Value</th>
                        <th>Language</th>
                        <th>Active</th>
                        <th>Action</th>
                    </tr>

                    @foreach($detail as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->type}}</td>
                            <td>{{$item->value}}</td>
                            <td>{{$item->language}}</td>
                            <td>
                                @if($item->is_active == 1)
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
                                <a style="margin-bottom:10px;"class ="btn btn-primary"href="{{route('update_detail', $item->id)}}"><i class="fa-solid fa-pen-to-square"></i> Edit</a><br>
                                <a onclick="confirmation(event)" class ="btn btn-danger" href="{{route('delete_detail', $item->id)}}"><i class="fas fa-trash-alt"></i> Delete</a>

                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="6">
                            <p>Total details : {{ $detail->total() }}</p>
                        </td>
                    </tr>

                </table>
                <div class="pagination">
                    {{ $detail->links() }}
                </div>
        </div>
        </div>
    </div>
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
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
    <!-- End custom js for this page -->
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js" integrity="sha512-fD9DI5bZwQxOi7MhYWnnNPlvXdp/2Pj3XSTRrFs5FQa4mizyGLnJcN6tuvUS6LbmgN1ut+XGSABKvjN0H6Aoow==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  </body>
        
</html>