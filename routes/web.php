<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\New\AdminController;
use App\Http\Controllers\Admin\WareHouseController;
use App\Http\Controllers\Company\ProductController;
use App\Http\Controllers\Admin\Users\UserController;
use App\Http\Controllers\Common\DashboardController;
use App\Http\Controllers\Company\DeliveryController;
use App\Http\Controllers\Company\ShipmentController;
use App\Http\Controllers\Admin\Common\AjaxController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\AdminShipmentController;
use App\Http\Controllers\Company\BundleProductController;
use App\Http\Controllers\Company\CompanyProfileController;
use App\Http\Controllers\Company\PackagingMaterialController;
use App\Http\Controllers\Admin\RolePermission\RolePermissionController;
use App\Http\Controllers\Admin\DeliveryController as AdminDeliveryController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::prefix('admin')->as('admin.')->middleware(['auth', 'verified', 'admin'])->group(
    function () {
        Route::get('/dashboard', [DashboardController::class, 'adminIndex'])->name('dashboard');
        Route::get('/profile/{id}', [AdminProfileController::class, 'profileEdit'])->name('profile.edit');
        Route::post('/profile/update/{id}', [AdminProfileController::class, 'profileupdate'])->name('profile.update');
        //user
        Route::post('/users/bulk/action', [UserController::class, 'bulk_action'])->name('users.bulk.action');
        Route::resource('users', UserController::class);
        Route::post('/new-admin/bulk/action', [AdminController::class, 'bulk_action'])->name('new-admin.bulk.action');
        Route::resource('new-admin', AdminController::class);
        // Role Permissions
        Route::post('/roles/bulk/action', [RolePermissionController::class, 'bulk_action'])->name('roles.bulk.action');
        Route::resource('/roles', RolePermissionController::class);
        Route::post('/ware-house/bulk/action', [WareHouseController::class, 'bulk_action'])->name('ware-house.bulk.action');
        Route::resource('/ware-house', WareHouseController::class);

        Route::resource('/delivery', AdminDeliveryController::class);
        Route::get('/shipment/return', [AdminShipmentController::class, 'returnList'])->name('shipment.return-list');
        Route::post('/shipment/dhl', [AdminShipmentController::class, 'dhl_order'])->name('shipment.dhl-order');
        Route::get('/shipment/dhl/create/{id}', [AdminShipmentController::class, 'dhl_create'])->name('shipment.dhl-create');
        Route::resource('/shipment', AdminShipmentController::class);
        Route::get('/shipment/change-status/{id}/{status}', [AdminShipmentController::class, 'change_status'])->name('shipment.change-status');

        Route::get('/delivery/change-status/{id}/{status}', [AdminDeliveryController::class, 'change_status'])->name('delivery.change-status');

        // SETTINGS
        Route::controller(SettingsController::class)->group(function () {
            Route::get('/application-settings', 'index')->name('application.settings');
            Route::post('/application-settings-update', 'update')->name('application.settings-update');
        });
    }
);
Route::prefix('company')->as('company.')->middleware(['auth', 'verified', 'company'])->group(
    function () {
        Route::get('/dashboard', [DashboardController::class, 'companyIndex'])->name('dashboard');
        Route::get('/profile/{id}', [CompanyProfileController::class, 'profileEdit'])->name('profile.edit');
        Route::post('/profile/update/{id}', [CompanyProfileController::class, 'profileupdate'])->name('profile.update');
        Route::get('/product/csv', [ProductController::class, 'csv_product'])->name('product.csv.create');
        Route::post('/product/csv/store', [ProductController::class, 'csv_store'])->name('product.csv.store');
        Route::post('/product/bulk/action', [ProductController::class, 'bulk_action'])->name('product.bulk.action');
        //product moduels
        Route::resource('/product', ProductController::class);
        Route::post('/packaging/bulk/action', [PackagingMaterialController::class, 'bulk_action'])->name('packaging.bulk.action');
        Route::resource('/packaging', PackagingMaterialController::class);
        Route::post('/product/status-change', [ProductController::class, 'status_change'])->name('product.status.change');
        Route::post('/packaging/status-change', [PackagingMaterialController::class, 'status_change'])->name('packaging.status.change');
        Route::resource('/bundle-product', BundleProductController::class);
        Route::post('/delivery/bulk/action', [DeliveryController::class, 'bulk_action'])->name('delivery.bulk.action');
        Route::resource('/delivery', DeliveryController::class);
        Route::post('/delivery/status-change', [DeliveryController::class, 'status_change'])->name('delivery.status.change');
        //product shipment 
        Route::get('/shipment/csv', [ShipmentController::class, 'csv_product_shipment'])->name('shipment.csv.create');
        Route::post('/shipment/csv/store', [ShipmentController::class, 'csv_store_shipment'])->name('shipment.csv.store');
        Route::get('/shipment/return', [ShipmentController::class, 'return_shipment'])->name('shipment.return');
        Route::get('/shipment/change-status/{id}/{status}', [ShipmentController::class, 'change_status'])->name('shipment.change-status');
        Route::post('/shipment/bulk/action', [ShipmentController::class, 'bulk_action'])->name('shipment.bulk.action');
        Route::resource('/shipment', ShipmentController::class);
        Route::post('/product/stock', [ShipmentController::class, 'product_stock'])->name('product.stock');
        Route::get('/delivery/send-warehouse/{id}', [DeliveryController::class, 'sendToWarehouse'])->name('delivery.send.warehouse');
    }

);
Route::post('/ajax-get-product-bundle', [AjaxController::class, 'getProductBundle'])->name('ajax-get-product-bundle');
Route::get('/get-prod/{id}', [ShipmentController::class, 'product_stock']);
//notification 
Route::get('/markasread/{id}', [HomeController::class, 'markAsRead'])->name('markasread');
Route::post('/markasread-all', [HomeController::class, 'markAsReadAll'])->name('markasreadall');
Route::get('/', [HomeController::class, 'index'])->name('front.home');
