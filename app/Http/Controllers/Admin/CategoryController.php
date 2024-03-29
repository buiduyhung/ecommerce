<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExcelExports;
use App\Imports\ExcelImports;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = Category::all();

        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $category = new Category();
        $category->title = $request->category_product_title;
        $category->slug = $request->category_product_slug;
        $category->desc = $request->category_product_desc;
        $category->status = $request->category_product_status;
        $category->keywords = $request->category_product_keywords;
        $category->save();

        return redirect()->route('admin.indexCategory')->with('msg', 'Thêm danh mục sản phẩm thành công !');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request,$id)
    {
        $category = Category::find($id);
        $category->title = $request->category_product_title;
        $category->slug = $request->category_product_slug;
        $category->desc = $request->category_product_desc;
        $category->keywords = $request->category_product_keywords;
        $category->save();

        return redirect()->route('admin.indexCategory')->with('msg', 'Cập nhật danh mục sản phẩm thành công !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();

        return redirect()->route('admin.indexCategory')->with('msg', 'Xóa danh mục sản phẩm thành công !');
    }

    /**
     * Unactive category product.
     */
    public function hidden($id){
        Category::where('id', $id)->update(['status' => '0']);

        return redirect()->route('admin.indexCategory')->with('msg', 'Ẩn danh mục sản phẩm thành công !');
    }

    /**
     * Active category product.
     */
    public function active($id){
        Category::where('id', $id)->update(['status' => '1']);

        return redirect()->route('admin.indexCategory')->with('msg', 'Kích hoạt danh mục sản phẩm thành công !');
    }

    /**
     * Import data csv.
     */
    public function import_csv(Request $request){
        $path = $request->file('file')->getRealPath();
        Excel::import(new ExcelImports, $path);
        return redirect()->route('admin.indexCategory')->with('msg', 'Thêm file data excel thể loại sản phẩm thành công !');
    }

    /**
     * Export data csv.
     */
    public function export_csv(){
        return Excel::download(new ExcelExports, 'categoryProduct.xlsx');
    }
}
