<?php

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
//------------------------front route ----------------------------

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
//
use App\Menu;
use Illuminate\Support\Facades\Session;
Route::get('/send', 'admin@sendgmail58');
Route::get('/n', 'admin@notif');
Route::get('/x/', 'admin@x');

Route::any('/','main@index')->name('Home');
Route::any('/w','Product@test')->name('sw');

Route::prefix('product')->group(function () {
Route::get('/product_by_category/{category_id}','main@product_show_all_category');
Route::get('/product_by_color/{color_id}/','main@product_show_all_color');
Route::get('/product_by_manufacture/{manufacture_id}','main@product_show_all_manufacture');
Route::any('/product-details/{Product_id}','main@product_show_details_all');
});
//--------------------------------cart------------------------------
//Route::prefix('cart')->group(function () {
Route::group(['prefix' => 'cart',  'middleware' => 'islogin'], function() {
    Route::get('/delet_card/{row_id}/','carte@delete_product_cart_to_list');
    Route::post('/min_card','carte@mines_product_cart_to_list')->name('cart.mines');
    Route::get('/fetch_cart','carte@fetch_cart')->name('cart.list');
    Route::post('/plus_card','carte@plus_product_cart_to_list')->name('cart.plus');
    Route::get('/delet_card/{row_id}/','carte@delete_product_cart_to_list')->middleware('EmptyCart');
    Route::post('/add_card','carte@cart_show_add')->name('list-card');
    Route::GET('/card','carte@list_cart_show')->name('list-card')->middleware('EmptyCart');
});


//--------------------------panel user----------------------------------
Route::prefix('panel_user')->group(function () {
        Route::get('/login_clint','customer@login_customer_dirc');
        Route::post('/customer_login','customer@check_customer_login_dirc');
        Route::post('/customer_register','customer@check_customer_sinup_dirc');

  Route::group(['middleware' => 'islogin'], function () {

//        Route::get('/logout_customer','panel_user@customer_logout_shop');
        Route::get('/map','panel_user@user_panel_map');
        Route::get('/map_show','panel_user@user_panel_map_show');

//        Route::get('/upload','panel_user@user_panel_upload');
//        Route::post('/set_photo','panel_user@set_panel_upload');
        Route::get('/view_pay','panel_user@view_panel_pay');
        Route::get('/pay_detal/{qyt}','panel_user@view_panel_pay_detal');
        Route::get('/user_data','panel_user@add_deta_user');
        Route::post('/save_user','panel_user@save_deta_user')->name('user.save');
        Route::post('/set_shipp','panel_user@create_shipp');
        Route::get('/delet_ship/{id}','panel_user@mines_map_to_list');

        Route::get('/pay-ok/{id}','panel_user@pay_set');
        Route::get('/pay-dis/{id}','panel_user@pay_dis');

        Route::get('/check_out','panel_user@check');
    });
});

route::get('comment/{Product_id}','comments@savecomm');

//------------------------------payment------------------------------
 Route::prefix('payment')->middleware(['islogin'])->group(function () {

    Route::post('/pay/{products}','TransactionController@purchase')->name('purchase');
    Route::get('/pay/{products}/Result','TransactionController@Result')->name('purchase.Result');


    Route::get('/payment','customer@customer_payment_shop')->middleware(EmptyCart::class);
    Route::get('/min_pay/{_id}/{row}','customer@mines_product_pay_to_list');
    Route::get('/plus_pay/{row_id}/{row}','customer@plus_product_pay_to_list');
    Route::get('/delet_pay/{row_id}/','customer@delete_product_pay_to_list');
    Route::post('/order_place','PaymentController@order_place');
    Route::any('/factor','PaymentController@factor_order')->middleware(istimefa::class);
    Route::get('/disfator','PaymentController@distime');
    Route::get('/show_fact','customer@factor_order');
    Route::post('/nowpay','PaymentController@okpay');

});

//---------------------------search ----------------------------------
Route::prefix('search')->group(function () {
    Route::get('/','main@serch_user_product')->name('search');

});

//------------------------backend route --------------------------------
//Route::get('/adminlog','admin@log');
Route::post('/adminlog','superadmin@login');
Route::get('admin/ok','admin@dashboard');
Route::any('/aaa','admin@admi');
Route::any('/logout','superadmin@logout');
Route::any('/logout_admin','superadmin@logout_admin')->name('logout.admin');
Route::get('/login/admin', 'Auth\LoginController@showAdminLoginForm')->name('log');
Route::post('/login/admin', 'Auth\LoginController@adminLogin')->name('admin.log');

Route::prefix('admin')->middleware(['auth.admin'])->group(function () {
    Auth::routes();
    Route::get('/Dashboard','superadmin@index')->name('admin.Dashboard');
Route::get('/show_Comments','comments@management_comment')->name('management.comment');
Route::get('/fetch_Comments','comments@fetch_comment')->name('fetch.comment');
Route::post('/rejected_Comments','comments@rejected_Comments_product')->name('rejected.comment');


Route::post('/rejected_Comments','comments@rejected_Comments_product')->name('rejected.comment');

//--------------------------------rule------------------------------------
Route::get('/add_roll','superadmin@add_access_roll');
Route::post('/add_save_roll','superadmin@save_access_roll')->name('roll.seve');
Route::get('/sales_Year','superadmin@analyze_sales_Year')->name('sales.Year');
//Route::get('/analyze_browser','superadmin@analyze_view_browser')->name('analyze.view.browser');
Route::get('/analyze_platform','superadmin@analyze_view_platform')->name('analyze.platform');
Route::get('/analyze_category','superadmin@analyze_view_category')->name('analyze.category');
Route::get('/sales_Month','superadmin@analyze_sales_Month')->name('sales.Month');
Route::get('/sales_Day','superadmin@analyze_sales_Day')->name('sales.Day');
Route::get('/register_save_roll','superadmin@save_register')->name('register.admin');
Route::post('/re','superadmin@save_registera')->name('regi');
Route::get('/show_rule','superadmin@show_details_rule')->name('show.rule');
Route::get('/show_rule_ADMIN','superadmin@show_ADMIN_details_rule')->name('show.rule.ADMIN');
Route::get('/show_rule_fetch','superadmin@rule_fetch')->name('fetch.rule');
Route::get('/regi','superadmin@rule_admin_fetch')->name('fetch.admin.rule');
Route::post('/delete_rule_admin','superadmin@delet_rule_admin')->name('delet.rule.admin');
Route::post('/delete_rule','superadmin@delet_rule')->name('delet.rule');
Route::get('/Edite_roll/{id}','superadmin@Edite_rule_show')->name('Edite.rule');
Route::get('/Edite_roll_admin/{id}','superadmin@Edite_rule_admin_show')->name('Edite.rule.admin');
Route::post('/Edite_rule_save','superadmin@Edite_rule_save')->name('Edite.rule_save');
Route::post('/Edite_roll_admin','superadmin@Edite_rule_save_admin')->name('Edite.rule.save.admin');

//---------------------------category-------------------------------------
//Route::prefix('admin_category')->group(function () {
    Route::prefix('admin_category')->group( function(){

        route::get('/ADD-CATEGORY','CATEGORY@index');
    //route::get('/saveCATEGORY','CATEGORY@index');
    route::post('/saveCATEGORY','CATEGORY@cheCATEGORY')->name('cat.seve');
    route::get('/show-CATEGORY','CATEGORY@all');
//    route::get('/Banne_CATEGORY/{category_id}','CATEGORY@diact');
//    route::get('/Active_CATEGORY/{category_id}','CATEGORY@Act');
    route::get('/edit_CATEGORY/{category_id}','CATEGORY@edit');
    route::post('/EDITa_CATEGORY/{category_id}','CATEGORY@SAVECAT');
    route::post('/EDITa_CATEGORY/{category_id}','CATEGORY@update');
    route::get('/delet_CATEGORY/{category_id}','CATEGORY@del_category');
    route::get('/fetch_CATEGORY','CATEGORY@fetch_category')->name('fetch.category');
    route::post('/delete_CATEGORY','CATEGORY@delete_CATEGORY_save')->name('delete.category');
    route::post('/Active_CATEGORY','CATEGORY@Active_CATEGORY_save')->name('act.diact.category');
});


//---------------------------------manufacture-------------------------------
//Route::prefix('admin_manufacture')->group(function () {
    Route::prefix('admin_manufacture')->group( function(){

    Route::get('/add_manufacture','manufacture@brand');
    Route::post('/save_manufacture','manufacture@savemanuadd')->name('manufacture.save');
    Route::get('/allmanufacture','manufacture@show_all')->name('show.manufacture');
//    route::post('/Banne_manufacture/{manufacture_id}','manufacture@diact_manufacture')->name('manufacture.save');;
    route::post('/Active_manufacture','manufacture@Act_manufacture')->name('Act.diact');
    route::get('/edit_manufacture/{manufacture_id}','manufacture@edit');
    route::post('/EDIT_manufacture/{manufacture_id}','manufacture@SAVECAT');
    route::post('/EDIT_manufacture_fetch','manufacture@fetch_category')->name('EDIT.manufacture.fetch');
    route::post('/EDIT_manufacture_fetchs','manufacture@fetch_categorys')->name('EDIT.manufacture.fetchs');
    route::post('/EDIT_manufacture_category','manufacture@chenge_category_manufacture')->name('category.manufacture.fetch');
    route::post('/EDIT_manufacture_category_delete','manufacture@delete_category_manufacture')->name('category.manufacture.delete');
    route::post('/delet_manufacture','manufacture@del_category')->name('delete.manufacture');
    route::get('/get_data_manufacture/','manufacture@Fetch_manufacture')->name('Fetch.manufacture');

    });
//----------------------------------Product--------------------------------------
//Route::prefix('admin_Product')->group(function () {
    Route::prefix('admin_Product')->group( function(){

    route::get('/add_Product','Product@add');
    route::post('/save_Product','Product@save_add')->name('save.Product');
    route::get('/show_Product','Product@all');


    route::get('/Banne_Product/{Product_id}','Product@diact_Product');
    route::get('/Banne_recommended/{Product_id}','RECOMMENDED@diact_Product_recommended');
    route::post('/Active_recommended','RECOMMENDED@Act_Product_recommended')->name('Act.diact.recommended');
    route::post('/Active_Product','Product@Act_Product')->name('Act.diact.Product');
    route::get('/edit_Product/{Product_id}','Product@edit');
    route::post('/EDIT_Product/{Product_id}','Product@Updatepro')->name('Update.Product');
    route::post('/delet_Product','Product@del_Product')->name('delete.Product');
    route::post('/category_brand','Product@serch_brand')->name('manufacture.category');
    route::get('/get_data_manufacture/','Product@Fetch_Product')->name('Fetch.Product');
    route::post('/image_save','Product@image_save_Product')->name('save.image');
        route::post('/save_image_product','Product@edit_image_product')->name('save.image.product');
        route::post('/delete_Product_photo','Product@image_delete_Product')->name('delete.Product.image');
        route::get('/delete_image_edite','Product@delete_image_edite_Product')->name('delete.edite.image');


    });

//---------------------------------------RECOMMENDED---------------------------------------------
//Route::prefix('admin_RECOMMENDED')->group(function () {
    Route::prefix('admin_RECOMMENDED')->group( function()
    {
    route::get('/RECOMMENDED','RECOMMENDED@RECOMMENDED_show');
    route::get('/Banne_recomm/{Product_id}','RECOMMENDED@diact_recommended');

    route::get('/Active_recomm/{Product_id}','RECOMMENDED@Act_recommended');
});
//------------------------------------slider--------------------------------------
//Route::prefix('admin_slider')->group(function () {
    Route::prefix('admin_slider')->group( function()
    {
    route::get('/slider_admin','slider@index');
    route::get('/add_slider','slider@access');
    route::post('/save_slider','slider@save')->name('save.slider');
    route::get('/edit_slider/{slider}','slider@edit')->name('edit.slider');
    route::post('/save_edit_slider','slider@edit_save')->name('save.edit.slider');


    route::get('/fetch_slider','slider@fetch_Product')->name('fech.slider');
    route::post('/Active_slider','slider@Act_Product')->name('Act.diact.slider');
    route::post('/delete_slider','slider@del_Product')->name('delet.slider');
});
//---------------------------------manage order---------------------------------------
Route::prefix('admin_order')->group(function () {
route::get('/manage_order','manege_order@show_manage');
route::get('/view_order/{order_id}','manege_order@vi_order');
route::get('/delet_mang/{order_id}','manege_order@del_manage');
});

//-------------------------------------------menu------------------------------------------
route::get('/add_menu','menu@add_menu');
route::post('/seve_menu','menu@sevemenu')->name('seve.menu');
route::post('/seve_sub','menu@seveSUBmenu')->name('seve.sub');
route::get('/show_menu','menu@show_men');
route::post('/submenu_fetch','menu@Fetch_menu')->name('submenu.fetch');

});




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/test', 'admin@twdt')->middleware(['auth.isAdmin']);
Route::get('/adi', 'admin@admin');
Route::any('/aaa','admin@admi')->name('test');
Route::any('/tfech','admin@tfetch')->name('tfetch');
Route::any('/tfe','admin@tfetch_sho')->name('tfetch1');
Route::any('/wqwq','admin@sho')->name('q');
Route::any('/swv','admin@action')->name('ajaxupload.action');
Route::any('/p','admin@tr')->name('p');
route::get('/xc','admin@dss');

