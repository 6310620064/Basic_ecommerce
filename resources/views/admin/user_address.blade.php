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
                <h2 class ="h2_font"> User : {{$users->name}}</h2>
            </div>

            

            <div class ="search-box">
                <form action="{{route('search_address',$users->id)}}" method="GET">
                    @csrf
                        <input class ="input_color"type ="text" name="search" placeholder="Search">
                        <input type="submit" value="Search" class="btn btn-outline-success">
                </form>
            </div>



                <table class="table-user">
                <thead>
                     <tr>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Action</th>
                    </tr>      
                </thead>

                @foreach ($address as $addresses)
                <tbody>
                    <tr>
                        <td>{{$addresses->address}}</td>
                        <td>{{substr($addresses->Phone,0,3) . '-' . substr($addresses->Phone,3,3). '-' . substr($addresses->Phone, 6)}}</td>                        
                        <td>
                            <a class="btn btn-outline-danger" onclick="confirmation(event)" href="{{route('delete_address', $addresses->id)}}"><i class="fas fa-trash-alt"></i> Delete</a>      
                        </td>                     
                    </tr>
                </tbody>
            @endforeach   
            </table>

            <span style="margin-left: 100px; margin-top:-50px;">       
                {{ $address ->links() }}
            </span>
        </div>
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
    <!-- End custom js for this page -->
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
                        'Address Deleted Successfully.',
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