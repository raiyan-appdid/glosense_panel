<?php

namespace App;

use App\DataTables\PromocodeDataTable;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\BusinessSettingController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CcAvenueTransactionController;
use App\Http\Controllers\Admin\ComboProductController;
use App\Http\Controllers\Admin\ContentManagementController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DeliveryChargeController;
use App\Http\Controllers\Admin\EnquiryController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\PromocodeController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\SuccessStoryController;
use App\Http\Controllers\Admin\TakeMedicineController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\UnitController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\VideoGalleryController;
use App\Http\Controllers\BasicController;
use App\Http\Controllers\ShipRocketController;
use App\Models\ComboProduct;


Route::prefix('ccavenue')->name('ccavenue.')->controller(BasicController::class)->group(function () {
    Route::post('success', 'successCallBack')->name('success');
    Route::post('failed', 'failedCallBack')->name('failed');
});
Route::prefix('cashfree')->name('cashfree.')->controller(BasicController::class)->group(function () {
    Route::get('callback', 'cashfreeCallback')->name('callback');
});

Route::get('/', function(){
    return redirect()->route('login');
});

Route::prefix('admin')->middleware(['web'])->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);
    Route::get('/logout', [LogoutController::class, 'logout'])->name('logout-admin');
});

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin', 'web'])->group(function () {


    Route::name('home')->controller(DashboardController::class)->group(function () {
        Route::get('/', 'home');
    });
    Route::name('users.')->prefix('users')->controller(UsersController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::delete('destroy/{id}', 'destroy')->name('destroy');
        Route::post('update', 'update')->name('update');
        Route::put('status', 'status')->name('status');
    });
    /*=================================================================>
    /==========================Orders Management =====================>
    /=================================================================*/
    // Route::name('orders.')->prefix('orders')->controller(OrderController::class)->group(function () {
    //     Route::get('/', 'index')->name('index');
    //     Route::get('today-orders', 'todayOrders')->name('today-orders');
    //     Route::post('/', 'store')->name('store');
    //     Route::get('edit/{id}', 'edit')->name('edit');
    //     Route::delete('destroy/{id}', 'destroy')->name('destroy');
    //     Route::post('update', 'update')->name('update');
    //     Route::put('status', 'status')->name('status');
    //     Route::get('order-detail/{id}', 'orderDetail')->name('order-detail');
    //     Route::get('send-invoice', 'sendInvoice')->name('send-invoice');
    //     Route::post('update-tracking-code', 'updateTrackingCode')->name('update-tracking-code');
    // });
    /*=================================================================>
    /==========================Product Management =====================>
    /=================================================================*/
    Route::name('products.')->prefix('products')->controller(ProductController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::get('blocked', 'blockedBlog')->name('blocked');
        Route::post('/', 'store')->name('store');
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::delete('destroy/{id}', 'destroy')->name('destroy');
        Route::delete('image_destroy/{id}', 'imageDestroy')->name('image_destroy');
        Route::post('update', 'update')->name('update');
        Route::put('status', 'status')->name('status');
        Route::put('in-stock', 'inStock')->name('in-stock');
        Route::put('is_special', 'isSpecial')->name('is_special');
        Route::put('is_best_seller', 'isBestSeller')->name('is_best_seller');
        Route::put('is-returnable', 'isReturnable')->name('is-returnable');
        Route::put('is-cancellable', 'isCancellable')->name('is-cancellable');
        Route::put('is-cod', 'isCod')->name('is-cod');
        Route::put('is-combo', 'isCombo')->name('is-combo');
    });
    /*=================================================================>
    /==========================Promocode Management =====================>
    /=================================================================*/
    Route::name('promocodes.')->prefix('promocodes')->controller(PromocodeController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::delete('destroy/{id}', 'destroy')->name('destroy');
        Route::post('update', 'update')->name('update');
        Route::put('status', 'status')->name('status');
    });
    /*=================================================================>
    /==========================Slider Management =====================>
    /=================================================================*/
    Route::name('sliders.')->prefix('sliders')->controller(SliderController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('blocked', 'blockedSliders')->name('blocked');
        Route::post('/', 'store')->name('store');
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::delete('destroy/{id}', 'destroy')->name('destroy');
        Route::post('update', 'update')->name('update');
        Route::put('status', 'status')->name('status');
    });
    /*=================================================================>
    /==========================Gallery Management =====================>
    /=================================================================*/
    Route::name('gallerys.')->prefix('gallerys')->controller(GalleryController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('blocked', 'blockedImage')->name('blocked');
        Route::post('/', 'store')->name('store');
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::delete('destroy/{id}', 'destroy')->name('destroy');
        Route::post('update', 'update')->name('update');
        Route::put('status', 'status')->name('status');
    });
    /*=================================================================>
    /==========================Video Gallery Management =====================>
    /=================================================================*/
    Route::name('videogallerys.')->prefix('videogallerys')->controller(VideoGalleryController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('blocked', 'blockedImage')->name('blocked');
        Route::post('/', 'store')->name('store');
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::delete('destroy/{id}', 'destroy')->name('destroy');
        Route::post('update', 'update')->name('update');
        Route::put('status', 'status')->name('status');
    });
    /*=================================================================>
    /==========================Testimonial Management =====================>
    /=================================================================*/

    Route::name('testimonials.')->prefix('testimonials')->controller(TestimonialController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('blocked', 'blockedTestimonial')->name('blocked');
        Route::post('/', 'store')->name('store');
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::delete('destroy/{id}', 'destroy')->name('destroy');
        Route::post('update', 'update')->name('update');
        Route::put('status', 'status')->name('status');
    });
    /*=================================================================>
    /==========================Blog Management =====================>
    /=================================================================*/
    Route::name('blogs.')->prefix('blogs')->controller(BlogController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::get('blocked', 'blockedBlog')->name('blocked');
        Route::post('/', 'store')->name('store');
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::delete('destroy/{id}', 'destroy')->name('destroy');
        Route::post('update', 'update')->name('update');
        Route::put('status', 'status')->name('status');
    });
    Route::name('orders.')->prefix('orders')->controller(OrderController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::get('blocked', 'blockedBlog')->name('blocked');
        Route::post('/', 'store')->name('store');
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::delete('destroy/{id}', 'destroy')->name('destroy');
        Route::post('update', 'update')->name('update');
        Route::put('status', 'status')->name('status');
    });
    Route::name('reviews.')->prefix('reviews')->controller(ReviewController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/website', 'websiteReview')->name('website');
        Route::get('create', 'create')->name('create');
        Route::get('blocked', 'blockedBlog')->name('blocked');
        Route::post('/store', 'store')->name('store');
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::delete('destroy/{id}', 'destroy')->name('destroy');
        Route::post('update', 'update')->name('update');
        Route::put('status', 'status')->name('status');
        Route::get('store-global-star', 'storeGlobalStar')->name('store-global-star');
        Route::get('store-global-reviews', 'storeGlobalreviews')->name('store-global-reviews');
    });
    Route::name('transaction-orders.')->prefix('transaction-orders')->controller(CcAvenueTransactionController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::get('blocked', 'blockedBlog')->name('blocked');
        Route::post('/', 'store')->name('store');
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::delete('destroy/{id}', 'destroy')->name('destroy');
        Route::post('update', 'update')->name('update');
        Route::put('status', 'status')->name('status');
    });
    /*=================================================================>
    /==========================Business Setting Management =====================>
    /=================================================================*/
    Route::name('businesssettings.')->prefix('businesssettings')->controller(BusinessSettingController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::delete('destroy/{id}', 'destroy')->name('destroy');
        Route::post('update', 'update')->name('update');
        Route::put('status', 'status')->name('status');
    });
    /*=================================================================>
    /==========================Delivery Charges Management =====================>
    /=================================================================*/
    Route::name('deliverycharges.')->prefix('deliverycharges')->controller(DeliveryChargeController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::delete('destroy/{id}', 'destroy')->name('destroy');
        Route::post('update', 'update')->name('update');
        Route::put('status', 'status')->name('status');
    });
    /*=================================================================>
    /==========================Units Management =====================>
    /=================================================================*/
    Route::name('units.')->prefix('units')->controller(UnitController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::delete('destroy/{id}', 'destroy')->name('destroy');
        Route::post('update', 'update')->name('update');
        Route::put('status', 'status')->name('status');
    });
    /*=================================================================>
    /==================Enquiry from website Management ================>
    /=================================================================*/
    Route::name('enquirys.')->prefix('enquirys')->controller(EnquiryController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::delete('destroy/{id}', 'destroy')->name('destroy');
        Route::post('update', 'update')->name('update');
        Route::put('status', 'status')->name('status');
    });
});

Route::prefix('ship-rocket')->name('ship-rocket.')->controller(ShipRocketController::class)->group(function () {
    Route::get('create',  'createOrder')->name('create');
});
