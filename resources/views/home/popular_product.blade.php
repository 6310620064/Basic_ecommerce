<section class="product_section layout_padding">
         <div class="container">
            <div class="heading_container heading_center">
               <h2>
                  Popular <span>products</span>
               </h2>
            </div>
            <div class="row">

               @foreach($product as $products)
                  @if($products->is_highlight == '1' && $products->is_active =='1' && $products->start_display <= now() && $products->end_display > now() && $products->amount != '0' )

                     <div class="col-sm-6 col-md-4 col-lg-4">
                        <div class="box">
                           <div class="option_container">
                              <div class="options">
                                 <a href="{{route('product_detail', $products->id)}}" class="option1">
                                 Detail
                                 </a>
                              </div>
                           </div>
                           <div class="img-box">
                              <img src="{{ \Storage::url($products->image)}}"alt="">
                           </div>
                              <div >
                                 <h5>
                                    {{$products->name}}
                                 </h5>

                                 <h6 style ="text-decoration: line-through;">
                                    Price <br>
                                    ฿ {{number_format($products->price_normal)}} 
                                 </h6>

                                 <h6 style="color:red;">
                                    Member Price <br>
                                    ฿ {{number_format($products->price_member)}} 
                                 </h6>           
                                 
                                 <h6 style="padding-left:190px;">
                                    Amount <br>
                                       <p style="margin-left:25px;">{{$products->amount}}</p>
                                 </h6>
                              </div>
                        </div>
                     </div>
                  @elseif($products->is_highlight == '1' && $products->is_active =='1' && $products->start_display <= now()  && $products->end_display == null && $products->amount != '0')
                     <div class="col-sm-6 col-md-4 col-lg-4">
                           <div class="box">
                              <div class="option_container">
                                 <div class="options">
                                    <a href="{{route('product_detail', $products->id)}}" class="option1">
                                    Detail
                                    </a>
                                 </div>
                              </div>
                              <div class="img-box">
                                 <img src="{{ \Storage::url($products->image)}}"alt="">
                              </div>
                                 <div >
                                    <h5>
                                       {{$products->name}}
                                    </h5>

                                    <h6 style ="text-decoration: line-through;">
                                       Price <br>
                                       ฿ {{number_format($products->price_normal)}} 
                                    </h6>

                                    <h6 style="color:red;">
                                       Member Price <br>
                                       ฿ {{number_format($products->price_member)}} 
                                    </h6> 
                                    
                                    <h6 style="padding-left:190px;">
                                       Amount <br>
                                       <p style="margin-left:25px;">{{$products->amount}}</p>
                                    </h6>
                                 </div>
                           </div>
                     </div>
                  @endif

               @endforeach

            <span style="padding-top: 20px;">       
               {{ $product ->links() }}
            </span>     
         </div>
</section>