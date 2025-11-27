<?php

use App\Http\Controllers\Admin\BrandController as AdminBrandController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FaqController as AdminFaqController;
use App\Http\Controllers\Admin\LeadController as AdminLeadController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\ResearchProjectController as AdminResearchProjectController;
use App\Http\Controllers\BrandBlogController;
use App\Http\Controllers\BrandPageController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\OrderTrackingController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResearchController;
use App\Models\Brand;
use Illuminate\Support\Facades\Route;

Route::bind('brand', function ($value) {
    return Brand::query()->where('slug', $value)->firstOrFail();
});

Route::get('/', [LandingController::class, 'index'])->name('landing');
Route::post('/leads', [LeadController::class, 'store'])->name('leads.store');

Route::prefix('{brand:slug}')
    ->where(['brand' => 'shnikh|cordygen'])
    ->middleware(['brand.context'])
    ->group(function () {
        Route::get('/', [BrandPageController::class, 'home'])->name('brand.home');
        Route::get('/about', [BrandPageController::class, 'about'])->name('brand.about');
        Route::get('/services', [BrandPageController::class, 'services'])->name('brand.services');
        Route::get('/science', [BrandPageController::class, 'science'])->name('brand.science');
        Route::get('/r-and-d-overview', [BrandPageController::class, 'research'])->name('brand.research.overview');
        Route::get('/contact', [BrandPageController::class, 'contact'])->name('brand.contact');
        Route::post('/contact', [ContactController::class, 'store'])->name('brand.contact.store');

        Route::get('/products', [ProductController::class, 'index'])->name('brand.products.index');
        Route::get('/products/{product:slug}', [ProductController::class, 'show'])->name('brand.products.show');

        Route::get('/blog', [BrandBlogController::class, 'index'])->name('brand.blog.index');
        Route::get('/blog/{post:slug}', [BrandBlogController::class, 'show'])->name('brand.blog.show');

        Route::get('/research', [ResearchController::class, 'index'])->name('brand.research.index');
        Route::get('/research/{researchProject:slug}', [ResearchController::class, 'show'])->name('brand.research.show');

        Route::get('/faq', [BrandPageController::class, 'faq'])->name('brand.faq');
        Route::get('/faq/data', [FaqController::class, 'index'])->name('brand.faq.data');

        Route::get('/orders/track', [OrderTrackingController::class, 'index'])->name('brand.orders.track');

        Route::get('/cart', [CartController::class, 'index'])->name('brand.cart.index');
        Route::post('/products/{product:slug}/cart', [CartController::class, 'store'])->name('brand.cart.store');
        Route::patch('/cart', [CartController::class, 'update'])->name('brand.cart.update');
        Route::delete('/cart/{product:slug}', [CartController::class, 'destroy'])->name('brand.cart.destroy');

        Route::get('/checkout', [CheckoutController::class, 'show'])->name('brand.checkout.show');
        Route::post('/checkout', [CheckoutController::class, 'store'])->name('brand.checkout.store');
        Route::get('/checkout/complete', [CheckoutController::class, 'complete'])->name('brand.checkout.complete');
        Route::post('/checkout/razorpay-callback', [CheckoutController::class, 'razorpayCallback'])->name('brand.checkout.razorpay');
    });

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', fn () => view('dashboard'))->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'verified', 'role:SUPER_ADMIN,ADMIN,CONTENT_MANAGER'])
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('products', AdminProductController::class);
        Route::resource('posts', AdminPostController::class);
        Route::resource('orders', AdminOrderController::class)->only(['index', 'show', 'update']);
        Route::resource('pages', AdminPageController::class);
        Route::resource('leads', AdminLeadController::class)->only(['index', 'show', 'destroy']);
        Route::resource('research-projects', AdminResearchProjectController::class);
        Route::resource('faqs', AdminFaqController::class);

        Route::middleware('role:SUPER_ADMIN')
            ->group(function () {
                Route::resource('brands', AdminBrandController::class);
            });
    });

require __DIR__.'/auth.php';
