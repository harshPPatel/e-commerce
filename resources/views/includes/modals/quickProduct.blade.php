<!-- QUICKVIEW PRODUCT -->
<div class="quickview-wrapper">
    <!-- Modal -->
    <div class="modal fade" id="{{ $product->product_id }}" tabindex="-1" role="dialog">
        <div class="modal-dialog modal__container" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="modal-product">
                        <!-- Start product images -->
                        <div class="product-images">
                            <div class="main-image images" style="height: 100%; text-align: center;">
                                <img alt="big images" style="height: 100%" src="/storage/productImages/{{$product->productFeaturedImage()->product_image}}">
                            </div>
                        </div>
                        <!-- end product images -->
                        <div class="product-info">
                            <h2>{{ $product->product_name }}</h2>
                            <div class="rating__and__review">
                                <ul class="rating">
                                    <li><span class="ti-star"></span></li>
                                    <li><span class="ti-star"></span></li>
                                    <li><span class="ti-star"></span></li>
                                    <li><span class="ti-star"></span></li>
                                    <li><span class="ti-star"></span></li>
                                </ul>
                                <div class="review">
                                    <a href="#">4 customer reviews</a>
                                </div>
                            </div>
                            <div class="price-box-3">
                                <div class="s-price-box">
                                    <span class="new-price">${{$product->product_price}}</span>
                                    <span class="old-price">{{ $product->product_old_price ? '$' . $product->product_old_price : '' }}</span>
                                </div>
                            </div>
                            <div class="quick-desc">
                                {{ $product->product_description }}
                            </div>

                            @if( $modalSizes )
                                <div class="select__color">
                                    <h2>Select color</h2>
                                    <ul class="color__list">
                                        @foreach ($product->productColors as $color)
                                            <li>
                                                <a style="background: {{$color->product_color}}; border: 1px solid rgba(0,0,0,0.2)" title="{{$color->color_name}}" href="#"></a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="select__size">
                                    <h2>Select size</h2>
                                    <ul class="color__list">
                                        @foreach ($product->productSizes as $size)
                                            <li>
                                                <a title="{{ $size->product_size }}" href="#">{{ $size->product_size }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="social-sharing">
                                <div class="widget widget_socialsharing_widget">
                                    <h3 class="widget-title-modal">Share this product</h3>
                                    <ul class="social-icons">
                                        <li><a target="_blank" title="rss" href="#" class="rss social-icon"><i class="zmdi zmdi-rss"></i></a></li>
                                        <li><a target="_blank" title="Linkedin" href="#" class="linkedin social-icon"><i class="zmdi zmdi-linkedin"></i></a></li>
                                        <li><a target="_blank" title="Pinterest" href="#" class="pinterest social-icon"><i class="zmdi zmdi-pinterest"></i></a></li>
                                        <li><a target="_blank" title="Tumblr" href="#" class="tumblr social-icon"><i class="zmdi zmdi-tumblr"></i></a></li>
                                        <li><a target="_blank" title="Pinterest" href="#" class="pinterest social-icon"><i class="zmdi zmdi-pinterest"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="addtocart-btn">
                                <a href="#">Add to cart</a>
                            </div>
                        </div><!-- .product-info -->
                    </div><!-- .modal-product -->
                </div><!-- .modal-body -->
            </div><!-- .modal-content -->
        </div><!-- .modal-dialog -->
    </div>
    <!-- END Modal -->
</div>
<!-- END QUICKVIEW PRODUCT -->