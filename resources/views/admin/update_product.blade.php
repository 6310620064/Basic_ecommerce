<!DOCTYPE html>
<html lang="en">
  <head>

    <base href ="/public">
    @include('admin.css')
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


        <div class ="div_center">

            <h2 class ="h2_font"> Update Product</h2>

            <form action="{{url('/update_product_confirm',$product->id)}}" method="POST" enctype="multipart/form-data">

            @csrf

            <div class = "div_design">

                <input type="hidden" class="input_form" name="is_highlight" value="1">
                <input type="hidden" class="input_form" name="is_active" value="1">
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
                    <option value = "{{$brand->id}}">{{$brand->name}}</option>
                    @endforeach
                </select><br>

            <label>Category :</label>
                <select class = "input_color" name="category" style="margin-bottom:10px;">
                    <option value="{{$product->category->id}}" selected="" required="" >{{$product->category->name}} </option>
                    @foreach($category as $category)
                        <option value = "{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select><br>

            <label>Size :</label>
                <select class = "input_color" name="size" style="margin-bottom:10px;">
                    <option value="{{$product->size->id}}" selected="" required="" >{{$product->size->size}}</option>
                    @foreach($size as $size)
                        <option value = "{{$size->id}}">{{$size->size}}</option>
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

            <input type="checkbox" class="input_form" name="is_highlight" value="0">
            <label for="is_highlight">Not Highlight</label><br>
            <input type="checkbox" class="input_form" name="is_active" value="0">
            <label for="active">Inactive</label><br>

            <div class = "div_design">
                <input type="submit" value="Update Product" class="btn btn-primary">
            </div>
            </form>



        </div>
    </div>
</div>

    @include('admin.script')
  </body>
</html>