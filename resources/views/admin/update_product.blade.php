<!DOCTYPE html>
<html lang="en">
  <head>

    <base href ="/public">
    @include('admin.css')
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.min.css">
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
  </head>
  <body>
    <div class="container-scroller">
    @include('admin.sidebar')

    @include('admin.header')

<div class="main-panel">
    <div class="content-wrapper">

        <div class ="div_center">

            <h2 class ="h2_font"> Update Product</h2>

            <form id="update_product" action="{{route('update_product_confirm',$product->id)}}" method="POST" enctype="multipart/form-data">

            @csrf

            <div class = "div_design">

                <input type="hidden" class="input_form" name="is_highlight" value="0">
                <input type="hidden" class="input_form" name="is_active" value="0">
                <label> Name :</label>
                <input class = "input_color" type="text" name="name" placeholder="Name" required="" value="{{$product->name}}">
            </div>

            <div class = "div_design">
                <label>Price Normal :</label>
                <input class = "input_color" type="number" min="0" name="price_normal" placeholder="Price Normal" required="" value="{{$product->price_normal}}">
            </div>

            <div class = "div_design">
                <label>Price Member :</label>
                <input class = "input_color" type="number" min="0" name="price_member" placeholder="Price Member" required="" value="{{$product->price_member}}">
            </div>

            <label>Brand :</label>
                <select class = "input_color" name="brand" style="margin-bottom:10px;">
                    <option value="{{$product->brand->id}}" selected="" required="" >{{$product->brand->name}} </option>
                    @foreach($brand as $brand)
                        @if($brand->name != $product->brand->name)
                            <option value = "{{$brand->id}}">{{$brand->name}}</option>
                        @endif
                    @endforeach
                </select><br>

            <label>Category :</label>
                <select class = "input_color" name="category" style="margin-bottom:10px;">
                    <option value="{{$product->category->id}}" selected="" required="" >{{$product->category->name}} </option>
                    @foreach($category as $category)
                        @if($category->name != $product->category->name)
                            <option value = "{{$category->id}}">{{$category->name}}</option>
                        @endif
                    @endforeach
                </select><br>

            <label>Size :</label>
                <select class = "input_color" name="size" style="margin-bottom:10px;">
                    <option value="{{$product->size->id}}" selected="" required="" >{{$product->size->size}}</option>
                    @foreach($size as $size)
                        @if($size->size != $product->size->size)
                            <option value = "{{$size->id}}">{{$size->size}}</option>
                        @endif
                    @endforeach
                </select>

            <div class = "div_design">
                <label> Amount :</label>
                <input class = "input_color" type="number" min="0" name="amount" placeholder="Amount" required=""value="{{$product->amount}}">
            </div>

            <div class = "div_img">
                <label>Currect Image :</label>
                <img  height="150" width="150" src="{{ \Storage::url($product->image)}}" alt="">
            </div>

            <div class = "div_img">
                <label>Change Image :</label>
                <input type="file" name="image" placeholder="Image" >
            </div>

            <div class = "div_design">
                <label>Start_display :</label>
                <input class = "input_color" type="datetime-local" name="start_display" required="" value="{{$product->start_display}}">
            </div>

            <div class = "div_design">
                <label>End_display :</label>
                <input class = "input_color" type="datetime-local" name="end_display" value="{{$product->end_display}}">
            </div>

            @if($product->is_highlight == '1')
                <input type="checkbox" class="input_form" name="is_highlight" value="1" checked>
                <label for="is_highlight">Highlight</label><br>
            @else
                <input type="checkbox" class="input_form" name="is_highlight" value="1" >
                <label for="is_highlight">Highlight</label><br>
            @endif
            @if($product->is_active == '1')
                <input type="checkbox" class="input_form" name="is_active" value="1" checked>
                <label for="active">Active</label><br>
            @else
                <input type="checkbox" class="input_form" name="is_active" value="1">
                <label for="active">Active</label><br>
            @endif

            <div class = "div_design">
                <input type="submit" value="Update" class="btn btn-primary">
                <a  href="{{route('show_product')}}" class="btn btn-outline-warning">Back</a>

            </div>
            </form>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                document.getElementById('update_product').addEventListener('submit', function (event) {
                    event.preventDefault(); // Prevent the default form submission

                    Swal.fire({
                        title: 'Do you want to save the changes?',
                        showDenyButton: true,
                        showCancelButton: true,
                        confirmButtonText: 'Save',
                        denyButtonText: `Don't save`,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // If the user confirms, submit the form
                            Swal.fire('Edit Success!', '', 'success')
                            
                            var form = event.target;
                            var formData = new FormData(form);

                            var xhr = new XMLHttpRequest();
                            xhr.open('POST', form.action, true);
                            xhr.onreadystatechange = function () {
                                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                                    // ส่งคำขอเสร็จสมบูรณ์
                                    console.log('Form submitted successfully');
                                    // โหลดหน้าเว็บใหม่
                                    location.reload();
                                }
                            };
                            xhr.send(formData);
                        } else if (result.isDenied) {
                            Swal.fire('Changes are not saved', '', 'info');
                        }
                    });
                });
            });

            </script>


        </div>
    </div>
</div>

    @include('admin.script')
  </body>
</html>