<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/thong-ke.html', 'HomeController@Index');
Route::get('/charting.html', 'HomeController@Charting');
Route::get('/not-role.html', 'HomeController@Error');

Route::group(['middleware' => ['login_admin'],'prefix' => '/tin-tuc'], function() {
    //
    Route::get('/danh-sach.html', 'TinTucController@Index');
    Route::get('/them-moi.html', 'TinTucController@Add');
    Route::post('/add.html', 'TinTucController@frmAdd');

    Route::get('/cap-nhat/{ID}', 'TinTucController@Edit');
    Route::post('/edit.html', 'TinTucController@frmEdit');

    Route::get('/delete/{ID}', 'TinTucController@Delete');
    Route::get('/changeStatus/{ID}', 'TinTucController@changeStatus');
});

Route::group(['middleware' => ['login_admin'],'prefix' => '/loai-tin'], function() {
    //
    Route::get('/danh-sach.html', 'LoaiTinController@Index')->middleware('role:admin');
    Route::post('/add.html', 'LoaiTinController@frmAdd');
    Route::post('/edit.html', 'LoaiTinController@frmEdit');
    Route::get('/delete/{ID}', 'LoaiTinController@Delete')->middleware('role:admin');
    Route::get('/getByID/{ID}', 'LoaiTinController@GetByID')->middleware('role:admin');

});

Route::group(['middleware' => ['login_admin'],'prefix' => '/nhan-vien'], function() {
    //
    Route::get('/danh-sach.html', 'NhanVienController@Index')->middleware('role:admin');
    Route::post('/add.html', 'NhanVienController@frmAdd');
    Route::post('/edit.html', 'NhanVienController@frmEdit');
    Route::get('/delete/{ID}', 'NhanVienController@Delete')->middleware('role:admin');
    Route::get('/getByID/{ID}', 'NhanVienController@GetByID')->middleware('role:admin');
    Route::get('/changeStatus/{ID}', 'NhanVienController@changeStatus')->middleware('role:admin');


    Route::get('/doi-mat-khau.html', 'NhanVienController@ChangePass');
    Route::post('/frmChangePass.html', 'NhanVienController@frmChangePass');
});

Route::group(['middleware' => ['login_admin'],'prefix' => '/lien-he'], function() {
    //
    Route::get('/danh-sach.html', 'LienHeController@Index');
   
    Route::get('/getByID/{ID}', 'LienHeController@GetByID');
});

Route::group(['middleware' => ['login_admin'],'prefix' => '/chuong'], function() {
    //
    Route::get('/danh-sach.html', 'ChuongController@Index')->middleware('role:admin');
    Route::post('/add.html', 'ChuongController@frmAdd');
    Route::post('/edit.html', 'ChuongController@frmEdit');
    Route::get('/delete/{ID}', 'ChuongController@Delete')->middleware('role:admin');
    Route::get('/getByID/{ID}', 'ChuongController@GetByID')->middleware('role:admin');
    Route::get('/thong-tin-heo.html', 'ChuongController@Info')->middleware('role:admin');

});

Route::group(['middleware' => ['login_admin'],'prefix' => '/giong'], function() {
    //
    Route::get('/danh-sach.html', 'GiongController@Index')->middleware('role:admin');
    Route::post('/add.html', 'GiongController@frmAdd');
    Route::post('/edit.html', 'GiongController@frmEdit');
    Route::get('/delete/{ID}', 'GiongController@Delete')->middleware('role:admin');
    Route::get('/getByID/{ID}', 'GiongController@GetByID')->middleware('role:admin');

});


Route::group(['middleware' => ['login_admin'],'prefix' => '/chuatri'], function() {
    //
    Route::get('/danh-sach.html', 'ChuaTriController@Index');
    Route::post('/add.html', 'ChuaTriController@frmAdd');
    Route::post('/edit.html', 'ChuaTriController@frmEdit');
    Route::get('/delete/{ID}', 'ChuaTriController@Delete');
    Route::get('/getByID/{ID}', 'ChuaTriController@GetByID');

});

Route::group(['middleware' => ['login_admin'],'prefix' => '/nhap'], function() {
    //
    Route::get('/danh-sach/{nhap_id}', 'NhapController@Index');
    Route::get('/nhap.html', 'NhapController@Add');
    Route::post('/frmAdd', 'NhapController@frmAdd');
    Route::post('/sec_nhap', 'NhapController@AddNhap')->name('frm_sec_nhap');
    Route::get('/delete_inward/{ID}', 'NhapController@Delete');
    Route::get('/edit_inward/{ID}/{SoLuong}', 'NhapController@Edit');


});


Route::group(['middleware' => ['login_admin'],'prefix' => '/xuat'], function() {
    //
    Route::get('/danh-sach.html', 'XuatController@Index');
    Route::post('/frmAdd', 'XuatController@frmAdd');
    Route::post('/add.html', 'XuatController@AddNhap')->name('frm_xuat');
    Route::get('/delete_inward/{ID}', 'XuatController@Delete');
    Route::get('/edit_inward/{ID}/{SoLuong}', 'XuatController@Edit');
    Route::get('/xuat.html', 'XuatController@Add');
    Route::get('/chi-tiet-{ID}', 'XuatController@Detail');
    Route::get('/getGiongByChuongNhap/{Chuong_ID}', 'XuatController@GetGiongByChuongNhap');

});


Route::group(['namespace' => 'Client'], function() {
    //
    Route::get('/', 'HomeController@Index');
    Route::get('/lien-he.html', 'HomeController@Contact');
    Route::post('/frmcontact.html', 'HomeController@frmContact');

    Route::get('/tin-tuc/{Metatitle}/{ID}', 'TinTucController@Detail');
    Route::get('/danh-muc/{Link}/{ID}', 'TinTucController@Category');


    Route::get('/dang-nhap.html', 'LoginController@Index');
    Route::get('/dang-xuat.html', 'LoginController@Logout');
    Route::post('/frmLogin.html', 'LoginController@frmLogin');
});

View::composer('a_client.layout._layout', function ($view) {

    $loaitin = DB::table('loaitin')->get();
    $view->with('loaitin', $loaitin);
});