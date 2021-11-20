<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HomeAboutController;
use App\Http\Controllers\ChangePassword;
use App\Models\Brand;
use App\Models\Multipic;
use Illuminate\Support\Facades\DB;
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

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/', function () {
    $brands = DB::table('brands')->get();
    $about = DB::table('abouts')->latest()->first();
    $portfolio = Multipic::all();
    return view('home', compact('brands', 'about', 'portfolio'));
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/blablabla', [ContactController::class, 'index'])->name('contact');

// Categories
Route::get('/categories/all', [CategoriesController::class, 'getAllCategories'])->name('category');
Route::post('/categories/add', [CategoriesController::class, 'AddCategories'])->name('addCategory');
Route::get('/categories/edit/{id}/', [CategoriesController::class, 'editCategories'])->name('editCategory');
Route::post('/categories/update/{id}/', [CategoriesController::class, 'updateCategories'])->name('updateCategory');
Route::get('/softdelete/category/{id}/', [CategoriesController::class, 'softDelete']);
Route::get('/categories/restore/{id}/', [CategoriesController::class, 'restoreCategories']);
Route::get('/permanentDelete/categories/{id}/', [CategoriesController::class, 'permanentDelete']);




// Brand
Route::get('/brand/all', [BrandController::class, 'getBrands'])->name('brand');
Route::post('/brand/add', [BrandController::class, 'addBrand'])->name('addBrand');
Route::get('/brand/edit/{id}/', [BrandController::class, 'editBrand']);
Route::post('/brand/update/{id}/', [BrandController::class, 'updateBrand']);
Route::get('/brand/delete/{id}/', [BrandController::class, 'deleteBrand']);

// Multi Image
Route::get('/multi/image', [BrandController::class, 'multiPic'])->name('multipic');
Route::post('/multi/add', [BrandController::class, 'addMultiPic'])->name('addMultiPic');



// Home About
Route::get('/home/about', [HomeAboutController::class, 'HomeAbout'])->name('home.about');
Route::get('/add/about', [HomeAboutController::class, 'AddAbout'])->name('add.about');
Route::post('/store/about/', [HomeAboutController::class, 'StoreAbout'])->name('store.about');
Route::get('/edit/about/{id}', [HomeAboutController::class, 'EditAbout'])->name('edit.about');
Route::post('/update/about/{id}', [HomeAboutController::class, 'UpdateAbout'])->name('update.about');
Route::get('/delete/homeabout/{id}', [HomeAboutController::class, 'DeleteAbout'])->name('delete.about');

//Slider
Route::get('/slider/image', [HomeController::class, 'HomeSlider'])->name('slider');
Route::get('/slider/create', [HomeController::class, 'CreateSlider'])->name('slider.create');
Route::get('/slider/edit/{id}', [HomeController::class, 'EditSlider'])->name('slider.edit');
Route::post('/slider/update/{id}', [HomeController::class, 'UpdateSlider'])->name('slider.update');
Route::post('/slider/save', [HomeController::class, 'SaveSlider'])->name('slider.save');
Route::get('/slider/delete/{id}', [HomeController::class, 'DeleteSlider'])->name('slider.delete');


// Portfolio
Route::get('/portfolio', [HomeController::class, 'Portfolio'])->name('portfolio');



// Admin Contact Routes
Route::get('/contact', [ContactController::class, 'AdminContact'])->name('admin.contact');
Route::get('/contact/add', [ContactController::class, 'AdminAddContact'])->name('admin.addcontact');
Route::post('/contact/store', [ContactController::class, 'AdminStoreContact'])->name('admin.storecontact');
Route::get('/edit/contact/{id}', [ContactController::class, 'AdminEditContact'])->name('admin.editcontact');
Route::post('/update/contact/{id}', [ContactController::class, 'AdminUpdateContact'])->name('admin.updatecontact');
Route::get('/delete/contact/{id}', [ContactController::class, 'AdminDeleteContact'])->name('admin.deletecontact');
Route::post('/contact/form', [ContactController::class, 'ContactForm'])->name('contact.form');
Route::get('/contact/message', [ContactController::class, 'AdminContactMessage'])->name('admin.contact.message');



// Home Contact
Route::get('/home/contact', [ContactController::class, 'Contact'])->name('home.contact');


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    // ORM
    // $users = User::all();

    // Query builder
    $users = DB::table('users')->get();
    return view('admin.index', compact('users'));
})->name('dashboard');

Route::get('/user/changePassword', [ChangePassword::class, 'ChangePassword'])->name('change.password');
Route::get('/edit/profile', [ChangePassword::class, 'EditProfile'])->name('edit.profile');
Route::post('/update/profile', [ChangePassword::class, 'UpdateProfile'])->name('update.profile');
Route::post('/password/update', [ChangePassword::class, 'UpdatePassword'])->name('password.update');
Route::get('/user/logout', [BrandController::class, 'logout'])->name('user.logout');
