<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\ContactController as DashboardContactController;
use App\Http\Controllers\Dashboard\OrderController as DashboardOrderController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\UserControler;

use App\Http\Controllers\Pizza\AjaxController;
use App\Http\Controllers\Pizza\Cart\CartController;
use App\Http\Controllers\Pizza\OrderController;
use App\Http\Controllers\Pizza\ProductController as PizzaProductController;

use App\Models\Product;
use GuzzleHttp\Psr7\Request;
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

//register page ang login page permission
Route::group(['middleware' => 'register.login'], function () {

    //login , register
    Route::get('loginPage', [AuthController::class, 'loginPage'])->name('loginPage');
    Route::get('registerPage', [AuthController::class, 'registerPage'])->name('registerPage');

    //only login user can use this app
    Route::middleware(['auth'])->group(function () {

        Route::redirect('/', 'pizza')->name('home');

        //Actions which Auth can do with own profile
        Route::group(['prefix' => 'auth'], function () {
            //profile
            Route::group(['prefix' => 'profile'], function () {
                Route::get('details', [ProfileController::class, 'details'])->name('profile#details');
                Route::get('edit', [ProfileController::class, 'edit'])->name('profile#edit');
                Route::post('update', [ProfileController::class, 'update'])->name('profile#update');
            });

            //password
            Route::group(['prefix' => 'password'], function () {
                Route::get('changePage', [AuthController::class, 'changePasswordPage'])->name('change#password#page');
                Route::post('change', [AuthController::class, 'changePassword'])->name('change#password');
            });
        });

        //Any user's can go these routes
        Route::group(['prefix' => 'pizza'], function () {
            Route::get('/', [PizzaProductController::class, 'list'])->name('pizza#list');
            Route::get('filter/category/{id}', [PizzaProductController::class, 'categoryFilter'])->name('category#filter');
            Route::get('detail/{id}', [PizzaProductController::class, 'detail'])->name('pizza#detail');

            Route::prefix('contact')->group(function () {
                Route::get('/',[ContactController::class,'contactPage'])->name('contact#Page');
                Route::post('sent-message',[ContactController::class,'sentMessage'])->name('sent#message');
            });

            Route::group(['prefix' => 'ajax'], function () {
                Route::get('sorting', [AjaxController::class, 'sorting']);
                Route::get('increasing-view-count',[AjaxController::class,'increasingViewCount']);
            });

            Route::group(['prefix' => 'cart'], function () {
                Route::get('/', [CartController::class, 'list'])->name('cart#list');
                Route::get('add-to-cart', [CartController::class, 'addToCart'])->name('add#to#cart');
                // Route::get('delete/{id}', [CartController::class, 'delete'])->name('cart#delete'); //suddenly change with ajax
                Route::get('clear',[CartController::class,'clear'])->name('cart#clear#all');
                Route::get('clear-all',[CartController::class,'clearAll'])->name('cart#clear#all');
            });

            Route::group(['prefix' => 'order'], function () {
                Route::get('/', [OrderController::class, 'list'])->name('customer#order#list');
                Route::get('create', [OrderController::class, 'create'])->name('order#create');
                Route::get('detail/{code}', [OrderController::class, 'detail'])->name('order#detail');
            });
        });

        //Only Admin Can go these routes
        Route::group(["prefix" => "dashboard", "middleware" => 'auth.admin'], function () {

            //Product
            Route::group(['prefix' => 'products'], function () {
                Route::get('/', [ProductController::class, 'list'])->name('product#list');
                Route::get('show/{id}', [ProductController::class, 'show'])->name('product#show');
                Route::get('create', [ProductController::class, 'create'])->name('product#create');
                Route::post('store', [ProductController::class, 'store'])->name('product#store');
                Route::get('edit/{id}', [ProductController::class, 'edit'])->name('product#edit');
                Route::post('update', [ProductController::class, 'update'])->name('product#update');
                Route::delete('delete/{id}', [ProductController::class, 'delete'])->name('product#delete');
            });

            //Category
            Route::group(['prefix' => 'categories'], function () {
                Route::get('/', [CategoryController::class, 'list'])->name('category#list');
                Route::get('create', [CategoryController::class, 'create'])->name('category#create');
                Route::post('store', [CategoryController::class, 'store'])->name('category#store');
                Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('category#edit');
                Route::patch('update', [CategoryController::class, 'update'])->name('category#update');
                Route::delete('delete/{id}', [CategoryController::class, 'delete'])->name('category#delete');
            });

            //Customer
            Route::group(['prefix' => 'customers'], function () {
                Route::get('/', [UserControler::class, 'list'])->name('user#list');
                Route::get('deleted-list', [UserControler::class, 'deleteList'])->name('user#delete#list');
                // Route::get('create', [UserControler::class, 'create'])->name('user#create');
                // Route::post('store', [UserControler::class, 'store'])->name('user#store');
                // Route::get('edit/{id}', [UserController::class, 'edit'])->name('user#edit');
                // Route::post('update', [UserControler::class, 'update'])->name('user#update');
                Route::get('delete/{id}', [UserControler::class, 'delete'])->name('user#delete');
                Route::get('hard-delete/{id}', [UserControler::class, 'hardDelete'])->name('user#hard#delete');
                Route::get('restore/{id}',[UserControler::class,'restore'])->name('user#restore');
                Route::get('restore-all',[UserControler::class,'restoreAll'])->name('user#restore#all');
                // Route::post('change-role/{id}', [UserControler::class, 'changeRole'])->name('change#role');
                Route::get('change-role', [UserControler::class, 'changeRoleAjax'])->name('change#role');
            });

            //Order
            Route::group(['prefix' => 'orders'], function () {
                Route::get('/', [DashboardOrderController::class, 'list'])->name('order#list');
                Route::get('item-list{code}', [DashboardOrderController::class, 'itemList'])->name('order#item#list');
                Route::post('filter-by-status',[DashboardOrderController::class,'filterByStatus'])->name('filter#by#status');
                Route::get('change-status',[DashboardOrderController::class,'changeStatus'])->name('change#status');
            });

            //Contact
            Route::prefix('contact')->group(function () {
                Route::get('/',[DashboardContactController::class,'contactList'])->name('contact#list');
            });
        });
    });
});
Route::view('nav', 'admin.index');
