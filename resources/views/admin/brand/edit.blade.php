@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Sửa thương hiệu sản phẩm
            </header>
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="{{ route('admin.updateBrand', $brand->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Tên thương hiệu</label>
                            <input type="text" name="brand_product_title" class="form-control title" id="brandProductTitle" value="{{ $brand->title }}">
                            @error('brand_product_title')
                                <div class="invalid-feedback fix-noti">
                                    {{$message}} !
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Slug</label>
                            <input type="text" name="brand_product_slug" class="form-control slug" id="brandProductSlug" value="{{ $brand->slug }}">
                            @error('brand_product_slug')
                                <div class="invalid-feedback fix-noti">
                                    {{$message}} !
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Từ khóa thương hiệu</label>
                            <textarea style="resize: none;" rows="5" type="text" name="brand_product_keywords" class="form-control" id="brandProductDesc">{{ $brand->keywords }}</textarea>
                            @error('brand_product_keywords')
                                <div class="invalid-feedback fix-noti">
                                    {{$message}} !
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Mô tả thương hiệu</label>
                            <textarea style="resize: none;" rows="5" type="text" name="brand_product_desc" class="form-control" id="brandProductDesc">{{ $brand->desc }}</textarea>
                            @error('brand_product_desc')
                                <div class="invalid-feedback fix-noti">
                                    {{$message}} !
                                </div>
                            @enderror
                        </div>

                        <button type="submit" name="add_brand_product" class="btn btn-info">Cập Nhật Thương Hiệu</button>
                        <a href="{{ route('admin.indexBrand') }}" class="btn btn-warning">Quay Lại</a>
                    </form>
                </div>

            </div>
        </section>
    </div>
</div>
@endsection
