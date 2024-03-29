<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\CustomerController as AdminCustomerController;
use App\Http\Controllers\Admin\ManaOrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\DeliveryController;
use App\Http\Controllers\Admin\ManaCustomerController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomerController;
// use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

// Home page
Route::prefix('/')->name('home.')->group(function(){
    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::get('/danh-muc-san-pham/{id}', [HomeController::class, 'showCategory'])->name('showCategory');
    Route::get('/thuong-hieu-san-pham/{id}', [HomeController::class, 'showBrand'])->name('showBrand');
    Route::get('/chi-tiet-san-pham/{id}', [HomeController::class, 'detailProduct'])->name('detailProduct');

    // Cart
    Route::get('/them-gio-hang', [CartController::class, 'show'])->name('showCart');
    Route::post('/them-gio-hang', [CartController::class, 'save'])->name('saveCart');
    Route::post('/cap-nhat-so-luong-san-pham', [CartController::class, 'updateQty'])->name('updateQty');
    Route::get('/xoa-gio-hang/{id}', [CartController::class, 'delete'])->name('deleteCart');

    Route::get('/gio-hang', [CartController::class, 'showCartAjax'])->name('showCartAjax');
    Route::post('/them-san-pham-vao-gio-hang',[CartController::class, 'addCartAjax'])->name('addCartAjax');
    Route::post('/cap-nhat-gio-hang',[CartController::class, 'updateCartAjax'])->name('updateCartAjax');
    Route::get('/xoa-san-pham/{id}', [CartController::class, 'deleteCartAjax'])->name('deleteCartAjax');
    Route::get('/xoa-tat-san-pham', [CartController::class, 'deleteAllAjax'])->name('deleteAllAjax');

    // Coupon
    Route::post('/phieu-giam-gia',[CartController::class, 'checkCoupon'])->name('checkCoupon');
    Route::get('/xoa-phieu-giam-gia',[CartController::class, 'deleteCoupon'])->name('deleteCoupon');

    // Bill
    Route::get('/thu-tuc-thanh-toan', [BillController::class, 'checkout'])->name('checkout');
    Route::post('/them-thong-tin-thanh-toan', [BillController::class, 'addCheckout'])->name('addCheckout');
    Route::get('/thanh-toan', [BillController::class, 'payment'])->name('payment');
    Route::post('/select-delivery-home', [BillController::class, 'select_delivery_home'])->name('selectDeliveryHome');
    Route::post('/calculate-feeship', [BillController::class, 'calculate_feeship'])->name('calculateFeeship');
    Route::get('/del-feeship', [BillController::class, 'del_feeship'])->name('delFeeship');

    // Customer
    Route::get('/trang-ca-nhan', [CustomerController::class, 'index'])->name('customerShow');
    Route::get('/cap-nhat-thong-tin-tai-khoan', [CustomerController::class, 'edit_customer'])->name('editCustomer');
    Route::post('/cap-nhat-thong-tin-tai-khoan', [CustomerController::class, 'store_customer'])->name('storeCustomer');

    // Checkout
    // Route::get('/dang-nhap-thanh-toan', [CheckoutController::class, 'login_checkout'])->name('loginCheckout');
    // Route::get('/thoat-dang-nhap-thanh-toan', [CheckoutController::class, 'logout_checkout'])->name('logoutCheckout');
    // Route::post('/them-nguoi-dung', [CheckoutController::class, 'addCustomer'])->name('addCustomer');
    // Route::post('/dang-nhap-nguoi-dung', [CheckoutController::class, 'login_customer'])->name('loginCustomer');

    // login and register
    Route::get('/dang-nhap', [CustomerController::class, 'login'])->name('login');
    Route::post('/dang-nhap-nguoi-dung', [CustomerController::class, 'login_customer'])->name('loginCustomer2');
    Route::get('/dang-ky', [CustomerController::class, 'register'])->name('register');
    Route::post('/dang-ky-nguoi-dung', [CustomerController::class, 'add_customer'])->name('addCustomer2');
    Route::get('/dang-xuat', [CustomerController::class, 'logout'])->name('logout');

    // Search
    Route::post('/tim-kiem', [SearchController::class, 'search'])->name('search');

    // Order
    Route::post('/dat-hang', [OrderController::class, 'order_place'])->name('orderPlace');
    Route::post('/xac-nhan-dat-hang', [OrderController::class, 'confirm_order'])->name('confirmOrder');

    // Send mail
    Route::get('/gui-email', [HomeController::class, 'send_email'])->name('sendEmail');
});



// Admin
Route::prefix('admin')->name('admin.')->group(function(){
    Route::get('/', [AdminController::class, 'index'])->name('index');

    // category
    Route::get('/category', [CategoryController::class, 'index'])->name('indexCategory');
    Route::get('/create-category', [CategoryController::class, 'create'])->name('createCategory');
    Route::post('/store-category', [CategoryController::class, 'store'])->name('storeCategory');
    Route::get('/edit-category/{id}', [CategoryController::class, 'edit'])->name('editCategory');
    Route::post('/update-category/{id}', [CategoryController::class, 'update'])->name('updateCategory');
    Route::get('/destroy-category/{id}', [CategoryController::class, 'destroy'])->name('destroyCategory');

    Route::get('active-category/{id}', [CategoryController::class, 'active'])->name('activeCategory');
    Route::get('hidden-category/{id}', [CategoryController::class, 'hidden'])->name('hiddenCategory');

    Route::post('/export-csv', [CategoryController::class, 'export_csv'])->name('exportCsvCategory');
    Route::post('/import-csv', [CategoryController::class, 'import_csv'])->name('importCsvCatefory');

    // brand
    Route::get('/brand', [BrandController::class, 'index'])->name('indexBrand');
    Route::get('/create-brand', [BrandController::class, 'create'])->name('createBrand');
    Route::post('/store-brand', [BrandController::class, 'store'])->name('storeBrand');
    Route::get('/edit-brand/{id}', [BrandController::class, 'edit'])->name('editBrand');
    Route::post('/update-brand/{id}', [BrandController::class, 'update'])->name('updateBrand');
    Route::get('/destroy-brand/{id}', [BrandController::class, 'destroy'])->name('destroyBrand');

    Route::get('active-brand/{id}', [BrandController::class, 'active'])->name('activeBrand');
    Route::get('hidden-brand/{id}', [BrandController::class, 'hidden'])->name('hiddenBrand');

    // product
    Route::get('/product', [ProductController::class, 'index'])->name('indexProduct');
    Route::get('/create-product', [ProductController::class, 'create'])->name('createProduct');
    Route::post('/store-product', [ProductController::class, 'store'])->name('storeProduct');
    Route::get('/edit-product/{id}', [ProductController::class, 'edit'])->name('editProduct');
    Route::post('/update-product/{id}', [ProductController::class, 'update'])->name('updateProduct');
    Route::get('/destroy-product/{id}', [ProductController::class, 'destroy'])->name('destroyProduct');

    Route::get('active-product/{id}', [ProductController::class, 'active'])->name('activeProduct');
    Route::get('hidden-product/{id}', [ProductController::class, 'hidden'])->name('hiddenProduct');

    // Order
    Route::get('/order', [ManaOrderController::class, 'index'])->name('indexOrder');
    Route::get('/view-order/{code}', [ManaOrderController::class, 'view_order'])->name('viewOrder');
    Route::get('/destroy-order/{id}', [ManaOrderController::class, 'destroy'])->name('destroyOrder');
    Route::get('/print-order/{checkout_code}', [ManaOrderController::class, 'print_order'])->name('printOrder');

    Route::post('/update-quantity-sale', [ManaOrderController::class, 'update_quantity_sale'])->name('updateQuantitySale');
    Route::post('/update-order-quantity', [ManaOrderController::class, 'update_order_quantity'])->name('updateOrderQuantity');

    // Coupon
    Route::get('/coupon', [CouponController::class, 'index'])->name('indexCoupon');
    Route::get('/create-coupon', [CouponController::class, 'create'])->name('createCoupon');
    Route::post('/store-coupon', [CouponController::class, 'store'])->name('storeCoupon');
    Route::get('/edit-coupon/{id}', [CouponController::class, 'edit'])->name('editCoupon');
    Route::post('/update-coupon/{id}', [CouponController::class, 'update'])->name('updateCoupon');
    Route::get('/destroy-coupon/{id}', [CouponController::class, 'destroy'])->name('destroyCoupon');

    // Delivery
    Route::get('/delivery', [DeliveryController::class, 'delivery'])->name('delivery');
    Route::post('/select-delivery', [DeliveryController::class, 'selectDelivery'])->name('selectDelivery');
    Route::post('/insert-delivery', [DeliveryController::class, 'insertDelivery'])->name('insertDelivery');
    Route::post('/load-feeship', [DeliveryController::class, 'loadFeeship'])->name('loadFeeship');
    Route::post('/update-feeship', [DeliveryController::class, 'updateFeeship'])->name('updateFeeship');

    // Slider
    Route::get('/slider', [SliderController::class, 'slider'])->name('slider');
    Route::get('/create-slider', [SliderController::class, 'create'])->name('createSlider');
    Route::post('/store-slider', [SliderController::class, 'store'])->name('storeSlider');
    Route::get('/edit-slider/{id}', [SliderController::class, 'edit'])->name('editSlider');
    Route::post('/update-slider/{id}', [SliderController::class, 'update'])->name('updateSlider');
    Route::get('/destroy-slider/{id}', [SliderController::class, 'destroy'])->name('destroySlider');

    Route::get('active-slider/{id}', [SliderController::class, 'active'])->name('activeSlider');
    Route::get('hidden-slider/{id}', [SliderController::class, 'hidden'])->name('hiddenSlider');

    // Customer
    Route::get('/customer', [ManaCustomerController::class, 'index'])->name('customer');

});
