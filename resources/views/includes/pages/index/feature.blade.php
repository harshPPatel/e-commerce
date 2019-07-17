<!-- Start Feature Product -->
<section class="categories-slider-area bg__white pb--80">
    <div class="container">
        <div class="row">
            <!-- Start Left Feature -->
            <div class="col-md-9 col-lg-9 col-sm-8 col-xs-12 float-left-style">
                <!-- Start Slider Area -->
                <div class="slider__container slider--one">
                    <div class="slider__activation__wrap owl-carousel owl-theme">
                        @foreach ($featuredProducts as $featuredProduct)
                            <!-- Start Single Slide -->
                            <div class="slide slider__full--screen slider-height-inherit slider-text-right" style="background: rgba(0, 0, 0, 0) url('/storage/productImages/{{ $featuredProduct->productFeaturedImage()->product_image }}') no-repeat scroll center center / cover ;">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-10 col-lg-8 col-md-offset-2 col-lg-offset-4 col-sm-12 col-xs-12">
                                            <div class="slider__inner">
                                                <h1 style="transition-duration: 0.3s">New Product <span class="text--theme">Collection</span></h1>
                                                <div class="slider__btn" style="transition-duration: 0.3s">
                                                    <a class="htc__btn" href="/products/{{ $featuredProduct->product_id }}">shop now</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Slide -->
                        @endforeach
                    </div>
                </div>
                <!-- Start Slider Area -->
            </div>
            <div class="col-md-3 col-lg-3 col-sm-4 col-xs-12 float-right-style">
                <div class="categories-menu mrg-xs">
                    <div class="category-heading">
                        <h3 style="cursor: default;"> Browse Categories</h3>
                    </div>
                    <div class="category-menu-list">
                        <ul>
                            @foreach ($categories as $category)
                                <li><a href="/products?category={{ $category->category_name }}"> {{$category->category_name}} <i class="zmdi zmdi-chevron-right"></i></a>
                                    <div class="category-menu-dropdown" style="min-width: 300px; width: auto; padding: 2rem;">
                                        <div class="category-part category-common" style="width: 100%;">
                                            <h4 class="categories-subtitle"> {{ $category->category_name }}</h4>
                                            <ul>
                                                @foreach ($category->subCategories as $subCategory)
                                                    <li><a href="/products?category={{$category->category_name}}&subcategory={{$subCategory->sub_category_name}}">{{$subCategory->sub_category_name}}</a></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <!-- End Left Feature -->
        </div>
    </div>
</section>
<!-- End Feature Product -->