@extends('layouts.admin')

@section('content')
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Sản phẩm
        </div>
        @if(session('msg'))
            <div class="alert alert-success text-center" id="notification">
                {{session('msg')}}
            </div>
        @endif
        <div class="row w3-res-tb">
            <div class="col-sm-5 m-b-xs">
                <select class="input-sm form-control w-sm inline v-middle">
                    <option value="0">Bulk action</option>
                    <option value="1">Delete selected</option>
                    <option value="2">Bulk edit</option>
                    <option value="3">Export</option>
                </select>
                <button class="btn btn-sm btn-default">Apply</button>
            </div>
            <div class="col-sm-4">
            </div>
            <div class="col-sm-3">
                <div class="input-group">
                    <input type="text" class="input-sm form-control" placeholder="Search">
                    <span class="input-group-btn">
                    <button class="btn btn-sm btn-default" type="button">Go!</button>
                    </span>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped b-t b-light">
                <thead>
                    <tr>
                    <th style="width:20px;">
                        <label class="i-checks m-b-none">
                        <input type="checkbox"><i></i>
                        </label>
                    </th>
                    <th>Ảnh</th>
                    <th>Tên sản phẩm</th>
                    <th>Mô tả</th>
                    <th>Giá (VNĐ)</th>
                    <th>Số lượng còn lại</th>
                    <th>Số lượng đã bán</th>
                    <th>Danh mục</th>
                    <th>Thương hiệu</th>
                    <th>Hiển thị</th>
                    <th style="width:30px;"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $item)
                        <tr>
                            <td>
                                <label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label>
                            </td>
                            <td> {{ $item->title }} </td>
                            <td>
                                <img src="{{ asset('uploads/' . $item->image) }}" width="100px">
                            </td>
                            <td> {{ $item->desc }} </td>
                            <td> {{ number_format($item->price) }} </td>
                            <td> {{ $item->quantity }} </td>
                            <td> --- </td>
                            <td> {{ $item->category->title }} </td>
                            <td> {{ $item->brand->title }} </td>
                            <td>
                                <span class="text-ellipsis">
                                    @if ($item->status == 0)
                                        <a href="{{ route('admin.activeProduct', $item->id) }}">
                                            <span class="fa-styling fa-solid fa-thumbs-down"></span>
                                        </a>
                                    @else
                                        <a href="{{ route('admin.hiddenProduct', $item->id) }}">
                                            <span class="fa-styling fa-solid fa-thumbs-up"></span>
                                        </a>
                                    @endif
                                </span>
                            </td>

                            <td>
                                <a href="{{ route('admin.editProduct', $item->id) }}" class="active styling-edit" ui-toggle-class="">
                                    <i class="fa fa-pencil-square-o text-success text-active"></i>
                                </a>
                                <a onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')" href="{{ route('admin.destroyProduct', $item->id) }}" class="active styling-edit" ui-toggle-class="">
                                    <i class="fa fa-times text-danger text"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <footer class="panel-footer">
            <div class="row">
                <div class="col-sm-5 text-center">
                    <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
                </div>
                <div class="col-sm-7 text-right text-center-xs">
                    <ul class="pagination pagination-sm m-t-none m-b-none">
                    <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
                    <li><a href="">1</a></li>
                    <li><a href="">2</a></li>
                    <li><a href="">3</a></li>
                    <li><a href="">4</a></li>
                    <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
                    </ul>
                </div>
            </div>
      </footer>
    </div>
</div>
@endsection
