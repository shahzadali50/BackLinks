<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\AddCreditController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PurchaseWebController;

Route::get('/', [MainController::class, 'index'])->name('home');

Route::get('/home', [MainController::class, 'checkAccount'])->name('dashboard');


Auth::routes();

Route::middleware(['auth'])->as('user.')->prefix('user')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});

// publishers Routes🌟
Route::middleware(['auth', 'publishers'])->as('publishers.')->prefix('publishers')->group(function () {

    Route::get('/dashboard', [MainController::class, 'dashboard'])->name('dashboard');
    Route::get('/websites', [MainController::class, 'website'])->name('website');
    Route::get('/website/detail/{encodedId}', [WebsiteController::class, 'website_detail'])->name('website.detail');
    Route::get('/websites/add/step-1', [WebsiteController::class, 'add_web_step1'])->name('add.websiteStep1');
    Route::get('/websites/add/step-2', [WebsiteController::class, 'add_web_step2'])->name('add.websiteStep2');
    Route::get('/websites/add/step-3', [WebsiteController::class, 'add_web_step3'])->name('add.websiteStep3');
    Route::get('/websites/add/step-4', [WebsiteController::class, 'add_web_step4'])->name('add.websiteStep4');
    Route::post('/form/step1', [WebsiteController::class, 'postStep1'])->name('form.postStep1');
    Route::post('form/step2', [WebsiteController::class, 'postStep2'])->name('form.postStep2');
    Route::delete('website/delete/{id}', [WebsiteController::class, 'webDelete'])->name('websiteDelete');
    Route::post('/website/finish', [WebsiteController::class, 'storeAllStep'])->name('store.allSteps');


    Route::get('/sponsored', [MainController::class, 'sponsoredList'])->name('sponsored');
    Route::get('/contact-support', [MainController::class, 'ContactSupport'])->name('ContactSupport');
    Route::get('/profile-setting', [MainController::class, 'ProfileSetting'])->name('ProfileSetting');
    Route::get('/explore-now', [MainController::class, 'exploreNow'])->name('explore');
    Route::get('/membership', [MainController::class, 'membership'])->name('membership');
    Route::get('/payments/transactions', [MainController::class, 'transactions'])->name('transactions');
    Route::get('/payments/billing', [MainController::class, 'billing'])->name('billing');
    Route::get('/support-ticket/ticket-list', [MainController::class, 'list'])->name('ticket.list');
    Route::get('/chat', [MainController::class, 'chat'])->name('chat');
    Route::post('/update-password', [MainController::class, 'updatePassword'])->name('update.password');
    Route::post('/update-email', [MainController::class, 'updateEmail'])->name('update.email');
    Route::post('/update-profile', [MainController::class, 'updateProfile'])->name('update.profile');

    Route::get('/KYC', [MainController::class, 'KYC'])->name('KYC');

});
// advertiser Routes🌟
Route::middleware(['auth', 'advertiser'])->as('advertiser.')->prefix('advertiser')->group(function () {
    Route::get('/home', [MainController::class, 'advertiserDashboard'])->name('dashboard');
    Route::get('/profile-setting', [MainController::class, 'ProfileSetting'])->name('ProfileSetting');
    Route::get('/contact-support', [MainController::class, 'ContactSupport'])->name('ContactSupport');
    Route::get('/wallet', [MainController::class, 'wallet'])->name('wallet');
    Route::get('/projects', [ProjectController::class, 'list'])->name('project.list');
    Route::get('/projects/create/step-1', [ProjectController::class, 'projectStep1'])->name('projectStep1');
    Route::get('/projects/create/step-2', [ProjectController::class, 'projectStep2'])->name('projectStep2');
    Route::get('/projects/create/step-3', [ProjectController::class, 'projectStep3'])->name('projectStep3');
    Route::post('/projects/create/step-1', [ProjectController::class, 'storeStep1'])->name('storeStep1');
    Route::post('/projects/create/step-2', [ProjectController::class, 'storeStep2'])->name('storeStep2');
    Route::post('/projects/create/step-3', [ProjectController::class, 'storeStep3'])->name('storeStep3');
    // Route::post('/projects/delete/{id}', [ProjectController::class, 'projectDelete'])->name('project.delete');
    Route::delete('/projects/delete/{id}', [ProjectController::class, 'projectDelete'])->name('project.delete');

    Route::get('/websites', [ProjectController::class, 'webList'])->name('webs.list');
    Route::post('/purchase/web', [PurchaseWebController::class, 'purchase_web'])->name('purchase.web');
    Route::get('purchase/website/list', [PurchaseWebController::class, 'puchaseWebList'])->name('purchase.webList');

    Route::post('/update-profile', [MainController::class, 'updateProfile'])->name('update.profile');
    Route::post('/update-password', [MainController::class, 'updatePassword'])->name('update.password');
    Route::post('/update-email', [MainController::class, 'updateEmail'])->name('update.email');
    Route::post('/update/name/phone/country', [MainController::class, 'updateNamePhoneCountry'])->name('addNamecountry');
    Route::get('/add/bill-detail', [MainController::class, 'billDetail'])->name('bill.detail');
    Route::post('/add/credit', [AddCreditController::class, 'creditStore'])->name('credit.store');
    // if need then uncommentðŸ‘‡
    // Route::get('/KYC', [MainController::class, 'KYC'])->name('KYC');
    Route::get('/chat', [MainController::class, 'chat'])->name('chat');

    Route::post('favourite/web/add', [MainController::class, 'addFavouriteWeb'])->name('add.favourite');
    Route::get('favourite/websites', [MainController::class, 'favouriteWeb'])->name('favourireWeb');

});
// admin Routes🌟
Route::middleware(['auth', 'admin'])->as('admin.')->prefix('admin')->group(function () {
    Route::get('/home', [MainController::class, 'adminDashboard'])->name('dashboard');
    Route::get('/profile-setting', [MainController::class, 'ProfileSetting'])->name('ProfileSetting');
    Route::post('/update-profile', [MainController::class, 'updateProfile'])->name('update.profile');

    Route::post('/update-password', [MainController::class, 'updatePassword'])->name('update.password');
    Route::post('/update-email', [MainController::class, 'updateEmail'])->name('update.email');
    Route::get('/users/list', [AdminController::class, 'user_list'])->name('user.list');
    Route::get('/users/detail/{encodedId}', [AdminController::class, 'user_detail'])->name('user.detail');
    Route::delete('/user-delete/{id}', [AdminController::class, 'user_delete'])->name('user.delete');
    Route::get('/websites/list', [AdminController::class, 'website_list'])->name('website.list');
    Route::get('/websites/details/{encodedId}', [AdminController::class, 'website_detail'])->name('website.detail');
    Route::get('/websites/approve', [AdminController::class, 'website_approve'])->name('websites.approve');
    Route::get('/websites/pending', [AdminController::class, 'website_pending'])->name('websites.pending');
    Route::get('/website/rejected', [AdminController::class, 'website_rejected'])->name('website.rejected');

    Route::post('/website/status', [AdminController::class, 'change_status'])->name('website.status');
});



Route::get('/run-migration', function () {
    // Run the migration command
    Artisan::call('migrate');
    // Get the output from the migration command
    $output = Artisan::output();
    return $output;
    // Return the output to the browser or redirect back with a message
    return redirect()->back()->with('success', "Migration executed successfully. Output: " . nl2br($output));
});

// storage link route
Route::get('/run-storage-link', function () {
    // Run the storage:link command
    Artisan::call('storage:link');
    // Get the output from the command
    $output = Artisan::output();
    return $output;
    // Return the output to the browser or redirect back with a message
    // return redirect()->back()->with('success', "Storage link created successfully. Output: " . nl2br($output));
});
    Route::get('/run-optimize-clear', function () {
        Artisan::call('optimize:clear');
        // Get the output from the command
        $output = Artisan::output();
        return $output;
        // Combine the outputs
        // $output = "Storage Link Output: " . $storageOutput . "<br><br>" . "Optimize Clear Output: " . $optimizeOutput;
    });
