@extends('layouts.home')

@section('slider')
    <section id="slider"><!--slider-->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                            <li data-target="#slider-carousel" data-slide-to="1"></li>
                            <li data-target="#slider-carousel" data-slide-to="2"></li>
                        </ol>

                        {{-- Cập nhật slider mới nhất --}}
                        {{-- @foreach ($sliders as $item)

                        @endforeach --}}

                        <div class="carousel-inner">
                            <div class="item active">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <img src="{{ asset('frontend/images/home/banner2.jpg')}}" class="girl img-responsive" alt="" />
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <img src="{{ asset('frontend/images/home/banner3.jpg')}}" class="girl img-responsive" alt="" />
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <img src="{{ asset('frontend/images/home/banner1.jpg')}}" class="girl img-responsive" alt="" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </section><!--/slider-->
@endsection

@section('sidebar')
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Danh mục sản phẩm</h2>

                    <div class="panel-group category-products" id="accordian"><!--category-productsr-->
                        @foreach ($categories as $item)
                            {{-- <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><a href="{{ route('home.showCategory', $item->id) }}"> {{ $item->title }} </a></h4>
                                </div>
                            </div> --}}
                            <div class="brands-name">
                                <ul class="nav nav-pills nav-stacked">
                                    <li><a href="{{ route('home.showCategory', $item->id) }}"> <span class="pull-right"></span> {{ $item->title }} </a></li>
                                </ul>
                            </div>
                        @endforeach
                    </div><!--/category-products-->

                    <div class="brands_products"><!--brands_products-->
                        <h2>Thương hiệu sản phẩm</h2>

                        @foreach ($brands as $item)
                            <div class="brands-name">
                                <ul class="nav nav-pills nav-stacked">
                                    <li><a href="{{ route('home.showBrand', $item->id) }}"> <span class="pull-right"></span> {{ $item->title }} </a></li>
                                </ul>
                            </div>
                        @endforeach

                    </div><!--/brands_products-->


                    <div class="shipping text-center"><!--shipping-->
                        <img src="{{ asset('frontend/images/home/shipping.jpg')}}" alt="" />
                    </div><!--/shipping-->
                </div>
            </div>

            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center">Sản phẩm mới nhất</h2>
                    @foreach ($products as $item)
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <form>
                                            @csrf
                                            <a href="{{ route('home.detailProduct', $item->id) }}">
                                                <img src="{{ asset('uploads/'.$item->image)}}" alt="" />
                                            </a>
                                            <h2> {{ number_format($item->price) }} VNĐ</h2>
                                            <p> {{ $item->title }} </p>

                                        {{-- Sử dụng thư viện laravel cart --}}
                                        {{-- <form action="{{ route('home.saveCart') }}" method="POST">
                                            @csrf
                                            <input name="quantity" type="hidden" min="1" value="1" />
                                            <input name="productId_hidden" type="hidden" value="{{ $item->id }}" />
                                            <button type="submit" name="add-to-cart" class="btn btn-default add-to-cart">
                                                <i class="fa fa-shopping-cart"></i>
                                                Thêm giỏ hàng
                                            </button>
                                        </form> --}}
                                        {{-- Sử dụng Ajax --}}

                                            <input type="hidden" value="{{ $item->id }}" class="product_id_{{ $item->id }}">
                                            <input type="hidden" value="{{ $item->title }}" class="product_title_{{ $item->id }}">
                                            <input type="hidden" value="{{ $item->image }}" class="product_image_{{ $item->id }}">
                                            <input type="hidden" value="{{ $item->price }}" class="product_price_{{ $item->id }}">
                                            <input type="hidden" value="1" class="product_qty_{{ $item->id }}">

                                            <button type="button" name="add-to-cart" data-id_product="{{ $item->id }}" class="btn btn-default add-to-cart">
                                                <i class="fa fa-shopping-cart"></i>
                                                Thêm giỏ hàng
                                            </button>
                                        </form>

                                    </div>
                                </div>
                                <div class="choose">
                                    <ul class="nav nav-pills nav-justified">
                                        <li><a href="#"><i class="fa fa-plus-square"></i>Yêu thích</a></li>
                                        <li><a href="#"><i class="fa fa-plus-square"></i>So sánh</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div><!--features_items-->
            </div>
        </div>
    </div>
</section>
@endsection


