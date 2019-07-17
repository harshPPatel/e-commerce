<!-- Start Our Product Area -->
<section class="htc__product__area bg__white pb--80">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="product-categories-all">
                    <div class="product-categories-title">
                        <h3>{{ $category->category_name }}</h3>
                    </div>
                    <div class="product-categories-menu">
                        <ul>
                            @foreach ($category->subCategories as $subCategory)
                                <li><a href="#">{{$subCategory->sub_category_name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="product-style-tab">
                    <div class="product-tab-list">
                        <!-- Nav tabs -->
                        <ul class="tab-style" role="tablist">
                            <li class="active">
                                <a href="#home1" data-toggle="tab">
                                    <div class="tab-menu-text">
                                        <h4>latest </h4>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#home4" data-toggle="tab">
                                    <div class="tab-menu-text">
                                        <h4>View All</h4>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content another-product-style jump">
                        <div class="tab-pane active" id="home1">
                            <div class="row">
                                <div class="product-slider-active owl-carousel">
                                    @foreach ($category->products as $product)
                                        
                                        <div class="col-md-4 single__pro col-lg-4 cat--1 col-sm-4 col-xs-12">
                                            <div class="product">
                                                <div class="product__inner">
                                                    <div class="pro__thumb">
                                                        <a href="#">
                                                            <img src="/storage/productImages/{{ $product->productFeaturedImage()->product_image }}" alt="product images">
                                                        </a>
                                                    </div>
                                                    <div class="product__hover__info">
                                                        <ul class="product__action">
                                                            <li><a data-toggle="modal" data-target="#{{$product->product_id}}" title="Quick View" class="quick-view modal-view detail-link" href="#"><span class="ti-plus"></span></a></li>
                                                            <li><a title="Add TO Cart" href="cart.html"><span class="ti-shopping-cart"></span></a></li>
                                                            <li><a title="Wishlist" href="wishlist.html"><span class="ti-heart"></span></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="product__details">
                                                    <h2><a href="product-details.html">{{ $product->product_name }}</a></h2>
                                                    <ul class="product__price">
                                                        <li class="old__price">{{ $product->product_old_price ? '$' . $product->product_old_price : '' }}</li>
                                                        <li class="new__price">${{ $product->product_price }}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            @section('modals')
                                                @parent

                                                @include('includes.modals.quickProduct', ['product' => $product, 'modalSizes' => $modalSizes])
                                            @stop
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</section>
<!-- End Our Product Area -->