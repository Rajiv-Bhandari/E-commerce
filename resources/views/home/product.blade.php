<section class="product_section layout_padding">
         <div class="container">
            <div class="heading_container heading_center">
               <h2>
                  Our <span>products</span>
               </h2>
            </div>
            <div class="row">
               @foreach($product as $products)
               <div class="col-sm-6 col-md-4 col-lg-4">
                  <div class="box">
                     <div class="option_container">
                        <div class="options">
                           <a href="" class="option1">
                           {{$products->category}}
                           </a>
                           <a href="" class="option2">
                           Buy Now
                           </a>
                        </div>
                     </div>
                     <div class="img-box">
                        <img src="/productimg/{{$products->image}}" alt="">
                     </div>
                     <div class="detail-box">
                        <h5>
                           {{$products->title}}
                        </h5>
                        @if($products->discount_price != null)
                        <h6 style="color:blue;">
                           Discounted Price <br>
                           Rs. {{$products->discount_price}}
                        </h6>
                        <h6 style="text-decoration: line-through; color:red;">
                           Price <br>
                           Rs. {{$products->price}}
                        </h6>
                        @else
                        <h6 style="color:blue;">
                           Price <br>
                           Rs. {{$products->price}}
                        </h6>
                        @endif
                        
                     </div>
                  </div>
               </div>
               @endforeach
               <span style="padding-top:20px;">
               {!! $product->withQueryString()->links('pagination::bootstrap-4') !!}
               </span>
            </div>
            <!-- <div class="btn-box">
               <a href="">
               View All products
               </a>
            </div> -->
         </div>
      </section>