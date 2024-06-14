<?php

use App\Http\Controllers\HoaDonController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\FoodsController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\InforUser;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\testController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// định tuyến route food
Route::resource('/foods',
    FoodsController::class
)
->middleware('check_user_session');
// định tuyến route gioi thiệu
Route::get('gioithieu',[
    PagesController::class,'index1'
]);
// định tuyến route đăng xuất
Route::get('logout',[LoginController::class,'dangxuat'])->name('logout');

// định tuyến route đăng nhập
Route::resource('/login',LoginController::class);
// định tuyến route chỉnh sửa thông tin cá nhân
Route::resource('/infouser',InforUser::class);

//định tuyến route hoá đơn
Route::resource('/hoadon',
    HoaDonController::class
)
->middleware('check_user_session');
// định tuyến route thương hiệu
Route::resource('/category',CategoryController::class)->middleware('check_user_session');



// tra ve view index
Route::get('/', function(){
    return view('index1');
})->name('trangchu');

Route::resource('/test',testController::class);

//vi du
// Route::get('/posts',[
//     PostsController::class, // goi controller co class nhu vay va xai ham detail
//     'index'
// ]
// );


// Route::get('/products/{id}',[
//     ProductsController::class, // goi controller co class nhu vay va xai ham detail
//     'detail'
// ]
// );
// -> where('id','[0-9]+'); // dk tham so la id va phai la so



// Route::get('/products/{name}/{id}',[
//     ProductsController::class, // goi controller co class nhu vay va xai ham detail
//     'detail'
// ]
// )-> where([
//     'id'=>'[0-9]+',
//     'name'=> '[a-z]+'
// ]); // dk tham so la id va phai la so va nam la chu




// Route::get('about', [
//     PagesController::class,
//     'index'
// ] )->name('products');

// Route::get('kiki', [
//     PagesController::class,
//     'kiki'
// ] )->name('products1');



// Route::get('/hi',function(){
//     return response()->json([
//         'name' => 'duc',
//         'email' => 'ngu@gmail.com'
//     ]);
// });

// Route::get('/something',function(){
//     return redirect('/');
// });
