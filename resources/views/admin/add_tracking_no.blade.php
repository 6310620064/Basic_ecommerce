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
    @include('sweetalert::alert')
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
                <h2 class ="h2_font">Add Tracking No.</h2>

                <form id="create_size" action ="{{route('add_size')}}" method="POST">
                    @csrf
                    <div class = "div_design">
                        <label> T :</label>
                        <input type="submit" class ="btn btn-primary" name="submit">                      
                    </div>
                    
                    <input type="hidden" class="input_form" name="is_active" value="0">
                    <input type="checkbox" class="input_form" name="is_active" value="1" checked>
                    <label for="active">Active</label><br>

                    <input type="submit" class ="btn btn-primary" name="submit" value="Add Size">  
                </form>



    @include('admin.script')
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js" integrity="sha512-fD9DI5bZwQxOi7MhYWnnNPlvXdp/2Pj3XSTRrFs5FQa4mizyGLnJcN6tuvUS6LbmgN1ut+XGSABKvjN0H6Aoow==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


  </body>
</html>