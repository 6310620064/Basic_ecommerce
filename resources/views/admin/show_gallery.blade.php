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

        @if(session()->has('message'))

        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
            {{session()->get('message')}}
        </div>

        @endif

            <h2 class ="h2_font"> All galleries of {{$product->name}} </h2>
            <div class="add-button-container">
                <a class="btn btn-info" href="{{url('view_gallery', $product->id)}}">Add</a>
            </div>      

                <table class="center">
                    <tr>
                        <th>Image</th>
                        <th>Order</th>
                        <th>Active</th>
                        <th>Action</th>
                    </tr>
                    @foreach($gallery as $galleries)
                    <tr>
                        <td class ="show_img">
                            <img class="img_center"style="max-width: 150px; max-height: 150px;" src="{{ \Storage::url($galleries->image)}}" alt="" onclick="showFullImage(this)" />
                        </td>
                        <td>{{$galleries->order}}
                            @if($gallery->total() == '1')

                            @elseif($galleries->order == '1')
                                <span class="arrow arrow-down" onclick="gallery_arrow_down({{$galleries->id}})"></span>
                                                                
                            @elseif($galleries->order == $gallery->total())
                                <span class="arrow arrow-up" onclick="gallery_arrow_up({{$galleries->id}})"></span><br>
                            @else
                                <span class="arrow arrow-up" onclick="gallery_arrow_up({{$galleries->id}})"></span><br>
                                <span class="arrow arrow-down" onclick="gallery_arrow_down({{$galleries->id}})"></span>
                            @endif
                        </td>
                        <td>
                            @if($galleries->is_active == 1)
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
                            <a style="margin-bottom:10px;"class ="btn btn-primary"href="{{route('update_gallery', $galleries->id)}}"><i class="fa-solid fa-pen-to-square"></i> Edit</a><br>
                            <a onclick="confirmation(event)" class ="btn btn-danger" href="{{route('delete_gallery', $galleries->id)}}""><i class="fas fa-trash-alt"></i> Delete</a>

                        </td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="6">
                            <p>Total Galleries : {{ $gallery->total() }}</p>
                        </td>
                    </tr>
                </table>
                <div class="pagination">
                    {{ $gallery->links() }}
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
                        'Your gallery has been deleted.',
                        'success'
                    )
                    // Redirect to the URL
                    window.location.href = urlToRedirect;
                }
            });
        }
    </script>

    <script>
        function gallery_arrow_down(id) {
            Swal.fire({
                title: 'Confirmation',
                text: 'Are you sure you want to down the order?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.isConfirmed) {
                // Send Axios request to increase the order
                axios.post('/gallery_arrow_down/' + id)
                    .then(function (response) {
                    // Reload the page after successful update
                    location.reload();
                    })
                    .catch(function (error) {
                    // Show error message
                    Swal.fire('Error', 'An error occurred. Please try again.', 'error');
                    });
                }
            });
        }

        function gallery_arrow_up(id) {
            Swal.fire({
                title: 'Confirmation',
                text: 'Are you sure you want to up the order?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.isConfirmed) {
                // Send Axios request to increase the order
                axios.post('/gallery_arrow_up/' + id)
                    .then(function (response) {
                    // Reload the page after successful update
                    location.reload();
                    })
                    .catch(function (error) {
                    // Show error message
                    Swal.fire('Error', 'An error occurred. Please try again.', 'error');
                    });
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