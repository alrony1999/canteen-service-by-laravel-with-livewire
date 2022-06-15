<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminHighChartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SellerHighChartController;
use App\Http\Livewire\OrderDetailsController;
use App\Http\Livewire\Admin\AdminAddCategoryComponent;
use App\Http\Livewire\Admin\AdminAddDeliverymenComponent;
use App\Http\Livewire\Admin\AdminAddSellertComponent;
use App\Http\Livewire\Admin\AdminCategoryComponent;
use App\Http\Livewire\Admin\AdminContactComponent;
use App\Http\Livewire\Admin\AdminDashboardComponent;
use App\Http\Livewire\Admin\AdminDeliverymenComponent;
use App\Http\Livewire\Admin\AdminEditCategoryComponent;
use App\Http\Livewire\Admin\AdminEditDeliverymenComponent;
use App\Http\Livewire\Admin\AdminEditSellerComponent;
use App\Http\Livewire\Admin\AdminSellerComponent;
use App\Http\Livewire\Admin\AdminSellertComponent;
use App\Http\Livewire\Admin\AdminUserComponent;
use App\Http\Livewire\CanteenComponent;
use App\Http\Livewire\CartComponent;
use App\Http\Livewire\CategoryComponent;
use App\Http\Livewire\ChangePasswordComponent;
use App\Http\Livewire\CheckoutComponent;
use App\Http\Livewire\ContactComponent;
use App\Http\Livewire\Deliveryman\DeliverymanDashboardComponent;
use App\Http\Livewire\Deliveryman\DeliverymanLatestOrderComponent;
use App\Http\Livewire\Deliveryman\DeliverymanPendingOrderComponent;
use App\Http\Livewire\DetailsComponent;
use App\Http\Livewire\EditProfileComponent;
use App\Http\Livewire\ProfileComponent;
use App\Http\Livewire\Seller\SellerAddFoodComponent;
use App\Http\Livewire\Seller\SellerDashboardComponent;
use App\Http\Livewire\Seller\SellerEditFoodComponent;
use App\Http\Livewire\Seller\SellerFoodComponent;
use App\Http\Livewire\Seller\SellerOrderDetailsComponent;
use App\Http\Livewire\Seller\SellerOrdersComponent;
use App\Http\Livewire\Seller\SellerTodaysAllOrderComponent;
use App\Http\Livewire\Seller\SellerTodaysDeliveryTypeOrderComponent;
use App\Http\Livewire\Seller\SellerTodaysPickUpOrderComponent;
use App\Http\Livewire\ShopComponent;
use App\Http\Livewire\ThankyouComponent;
use App\Http\Livewire\User\UserDashboardComponent;
use App\Http\Livewire\User\UserOrderDetailsComponent;
use App\Http\Livewire\User\UserOrdersComponent;
use App\Http\Livewire\User\UserReviewComponent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', ShopComponent::class);
Route::get('/shop', ShopComponent::class)->name('shop');
Route::get('/cart', CartComponent::class)->name('food.cart');;
Route::get('/checkout', CheckoutComponent::class)->name('checkout');
Route::get('/food/{slug}', DetailsComponent::class)->name('food.details');
Route::get('/food-category/{category_slug}', CategoryComponent::class)->name('food.category');
Route::get('/search', ShopComponent::class)->name('food.search');
Route::get('/thank-you', ThankyouComponent::class)->name('thankyou');
Route::get('/contact-us', ContactComponent::class)->name('contact');
Route::get('/change-password', ChangePasswordComponent::class)->name('changepassword');
Route::get('/profile', ProfileComponent::class)->name('profile');
Route::get('/edit/profile', EditProfileComponent::class)->name('editprofile');
Route::get('/redirect', [HomeController::class, 'redirect']);
//For Admin
Route::middleware(['auth:sanctum', 'verified', 'authadmin'])->group(function () {
    Route::get('/admin/dashboard', AdminDashboardComponent::class)->name('admin.dashboard');
    Route::get('/admin/highchart', [AdminHighChartController::class, 'userChart'])->name('admin.highchart');
    Route::get('/admin/categories', AdminCategoryComponent::class)->name('admin.categories');
    Route::get('/admin/category/add', AdminAddCategoryComponent::class)->name('admin.addcategory');
    Route::get('/admin/category/edit/{category_slug}', AdminEditCategoryComponent::class)->name('admin.editcategory');
    Route::get('/admin/sellers', AdminSellerComponent::class)->name('admin.sellers');
    Route::get('/admin/seller/add', AdminAddSellertComponent::class)->name('admin.addseller');
    Route::get('/admin/seller/edit/{seller_id}', AdminEditSellerComponent::class)->name('admin.editseller');
    Route::get('/admin/deliverymen', AdminDeliverymenComponent::class)->name('admin.deliverymen');
    Route::get('/admin/deliveryman/add', AdminAddDeliverymenComponent::class)->name('admin.adddeliveryman');
    Route::get('/admin/deliveryman/edit/{deliveryman_id}', AdminEditDeliverymenComponent::class)->name('admin.editdeliveryman');
    Route::get('admin/contact-us', AdminContactComponent::class)->name('admin.contact');
    Route::get('admin/user', AdminUserComponent::class)->name('admin.user');
});
//For User or Customer
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/user/dashboard', UserDashboardComponent::class)->name('user.dashboard');
    Route::get('/user/orders', UserOrdersComponent::class)->name('user.orders');
    Route::get('/user/order/{order_id}', UserOrderDetailsComponent::class)->name('user.orderdetails');
    Route::get('user/review/{order_item_id}', UserReviewComponent::class)->name('user.review');
});
//for seller
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/seller/dashboard', SellerDashboardComponent::class)->name('seller.dashboard');
    Route::get('/seller/food/', SellerFoodComponent::class)->name('seller.foods');
    Route::get('/seller/food/add', SellerAddFoodComponent::class)->name('seller.addfood');
    Route::get('/seller/food/edit/{food_slug}', SellerEditFoodComponent::class)->name('seller.editfood');
    Route::get('/seller/orders', SellerOrdersComponent::class)->name('seller.orders');
    Route::get('/seller/pick-up-orders', SellerTodaysPickUpOrderComponent::class)->name('seller.pickup-orders');
    Route::get('/seller/delivery-type-orders', SellerTodaysDeliveryTypeOrderComponent::class)->name('seller.delivery-type-orders');
    Route::get('/seller/Today', SellerTodaysAllOrderComponent::class)->name('seller.today');
    Route::get('/seller/order/{order_id}', SellerOrderDetailsComponent::class)->name('seller.orderdetails');
    Route::get('/seller/highchart', [SellerHighChartController::class, 'highchart'])->name('seller.highchart');
});
//for deliveryman
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/deliveryman/dashboard', DeliverymanDashboardComponent::class)->name('deliveryman.dashboard');
    Route::get('/deliveryman/latestorder', DeliverymanLatestOrderComponent::class)->name('deliveryman.latestorder');
    Route::get('/deliveryman/pendingorder', DeliverymanPendingOrderComponent::class)->name('deliveryman.pendingorder');
});
