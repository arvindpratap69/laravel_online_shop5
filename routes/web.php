<?php

use Faker\Guesser\Name;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\VendorController;
use App\Http\Controllers\admin\SectionController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\Admin\AdminLoginController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::group(['prefix' => 'admin'],function(){
    Route::get('login/',[AdminLoginController::class,'index'])->name('admin.login');
    Route::post('authenticate/',[AdminLoginController::class,'authenticate'])->name('admin.authenticate');


    Route::group(['middleware' => 'admin'], function(){
        Route::get('dashboard/',[AdminController::class,'index'])->name('admin.dashboard');
        Route::get('logout/',[AdminController::class,'logout'])->name('admin.logout');
        Route::get('update/change-password',[AdminLoginController::class,'change_password'])->name('admin.password');
        Route::post('update/update-password',[AdminLoginController::class,'update_password'])->name('admin.update-password');
        Route::get('update/admin-details',[AdminLoginController::class,'edit_details'])->name('admin.edit_details');
        Route::post('update/admin-details/',[AdminLoginController::class,'update_details'])->name('admin.update_details');


        // Vendor Details Updated
        Route::get('update-vendor-details/{slug}',[VendorController::class,'index']);
        Route::post('update-vendor-details/{slug}',[VendorController::class,'vendorUpdateDetails'])->name('vendor.update-details');

        //    Admin and SubAdmin OR vendors
         Route::get('admins/{type?}',[AdminController::class,'admins']);
         Route::get('admin/view-vendor-details/{id}',[AdminController::class,'vendorDetails'])->name('vendor.edit');

    // update admin status route --------------------------------
    Route::post('/update-admin-status',[AdminController::class,'updateAdminStatus'])->name('admin.updatestatus');

    // Section Route
      Route::get('sections',[SectionController::class,'sections'])->name('catalogue.sections');
      Route::post('/update-section-status',[SectionController::class,'updateSectionStatus'])->name('updatesection.sections');
      Route::get('delete-section/{id}',[SectionController::class,'deleteSection'])->name('section.delete');
    Route::get('section/{section}/edit',[SectionController::class,'EditSection'])->name('edit.section');
    Route::put('section/{section}/update',[SectionController::class,'UpdateSection'])->name('update.section');
    Route::get('/section/create',[SectionController::class,'AddSection'])->name('section.add');
    Route::post('/section',[SectionController::class,'SectionAdd'])->name('add.section');

    // Categories Route
    Route::get('/categories',[CategoryController::class,'index'])->name('categories.index');
    Route::get('/categories/create',[CategoryController::class,'create'])->name('categories.create');
    Route::post('/categories',[CategoryController::class,'store'])->name('categories.store');
    Route::get('/categories/{category}/edit',[CategoryController::class,'edit'])->name('categories.edit');
    Route::put('/categories/{category}',[CategoryController::class,'update'])->name('categories.update');
    Route::delete('/categories/{category}',[CategoryController::class,'destroy'])->name('categories.destroy');


    Route::get('/append-categories-level/',[CategoryController::class,'appendCategory'])->name('append-categories.level');




    Route::post('/update-category-status',[CategoryController::class,'updateCategoryStatus']);


    // Route::get('delete-categories/{id}',[CategoryController::class,'deleteCategory'])->name('categories.delete');





    });
});
