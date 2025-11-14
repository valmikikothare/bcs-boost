<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\SocialController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\SlotController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
 * |--------------------------------------------------------------------------
 * | Web Routes
 * |--------------------------------------------------------------------------
 * |
 * | Here is where you can register web routes for your application. These
 * | routes are loaded by the RouteServiceProvider and all of them will
 * | be assigned to the "web" middleware group. Make something great!
 * |
 */

// Deprecated pages
/* Route::POST('food_item_suggestions', [HomeController::class, 'food_item_suggestions'])->name('food_item_suggestions'); */
/* Route::get('login/facebook', [SocialController::class, 'redirectToFacebook']); */
/* Route::get('facebook/callback', [SocialController::class, 'handleFacebookCallback']); */
/* Route::get('login/instagram', [SocialController::class, 'redirectToInstagram']); */
/* Route::get('login/instagram/callback', [SocialController::class, 'handleInstagramCallback']); */
/* Route::get('login/google', [SocialController::class, 'redirectToGoogle']); */
/* Route::get('auth/google/callback', [SocialController::class, 'handleGoogleCallback']); */
/* Route::get('/generate_random_dish', [HomeController::class, 'generate_random_dish'])->name('generate_random_dish'); */
/* Route::get('about', [HomeController::class, 'about'])->name('about'); */
/* Route::get('privacypolicy', [HomeController::class, 'privacypolicy'])->name('views.privacypolicy'); */
/* Route::get('terms', [HomeController::class, 'terms'])->name('views.terms'); */
/* Route::get('forums', [HomeController::class, 'forums'])->name('views.forums'); */
/* Route::Post('store_forum', [HomeController::class, 'store_forum'])->name('views.store_forum'); */
/* Route::Post('store_forum_answer', [HomeController::class, 'store_forum_answer'])->name('views.store_forum_answer'); */
/* Route::get('forumdetails/{id?}', [HomeController::class, 'forumdetails'])->name('views.forumdetails'); */
/* Route::get('editreply/{id}', [HomeController::class, 'editreply'])->name('views.editreply'); */
/* Route::delete('deletereply/{id}', [HomeController::class, 'deletereply'])->name('views.deletereply'); */
/* Route::Patch('updatereply/{id}', [HomeController::class, 'updatereply'])->name('views.updatereply'); */
/* Route::post('like/{type}/{id}', [HomeController::class, 'like'])->name('like'); */
/* Route::post('dislike/{type}/{id}', [HomeController::class, 'dislike'])->name('dislike'); */
/* Route::get('dishdetails/{id?}', [HomeController::class, 'dishdetails'])->name('dishdetails'); */
/* Route::get('viewallcuisine', [HomeController::class, 'viewallcuisine'])->name('viewallcuisine'); */
/* Route::get('emailsave', [HomeController::class, 'save_email'])->name('emailsave'); */
/* Route::get('ip_address', [HomeController::class, 'ip_address'])->name('ip_address'); */
/* Route::get('contact', [HomeController::class, 'contact'])->name('views.contact'); */
/* Route::get('dishes_menu/{kitchen}', [HomeController::class, 'dishes_menu'])->name('dishes_menu'); */
/* Route::get('/per_day', [MemberController::class, 'per_day'])->name('per_day'); */
/* Route::get('/add_suggestion_dish', [MemberController::class, 'add_suggestion_dish'])->name('add_suggestion_dish'); */
/* Route::POST('forgetpassword', [HomeController::class, 'forgetpassword'])->name('forgetpassword'); */
/* Route::get('/Contact_Data', [HomeController::class, 'Contact_us'])->name('Contact_Data'); */


// Non login pages
Route::get('/', [HomeController::class, 'home_page'])->name('home_page');
Route::get('/how-to-use-this-site', [MemberController::class, 'howtousethissite'])->name('user.howtousethissite');
Route::get('faq', [HomeController::class, 'faq'])->name('views.faq');
Route::get('/verify-email/{token}', [RegisterController::class, 'verifyEmail'])->name('verify.email');
Route::post('/set-locale', [HomeController::class, 'setLocale'])->name('set-locale');

Auth::routes();
Route::group(['middleware' => ['auth', 'rolecheck', 'admin.locale']], function () {
    // Admin Users
    Route::get('/home', [UserController::class, 'admin_dashboard'])->name('home');
    Route::get('/users', [UserController::class, 'user_list'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users/destroy', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::get('/users/{id}/update', [UserController::class, 'update'])->name('users.update');
    Route::get('/users/show', [UserController::class, 'show'])->name('users.show');
    Route::post('/users/store', [UserController::class, 'store'])->name('users.store');

    Route::prefix('slots')->name('slots.')->group(function () {
        Route::get('/', [SlotController::class, 'index'])->name('index');
        Route::post('/', [SlotController::class, 'store'])->name('store');
        Route::get('/{slot}/edit', [SlotController::class, 'edit'])->name('edit');
        Route::post('/{slot}', [SlotController::class, 'update'])->name('update');
    });
    Route::get('/attendees/{id}', [SlotController::class, 'view_attendees'])->name('view_attendees');
    Route::delete('/slots/{id}', [SlotController::class, 'destroy'])->name('slots.destroy');
    Route::get('/slots/{slot}/leads', [SlotController::class, 'showLeads'])->name('slots.leads');

    Route::get('/assign/{encryptedSlot}/leads', [SlotController::class, 'assignLead'])->name('assign_leads');

    Route::post('/slots/leads/{lead}/approve', [SlotController::class, 'approveLead'])->name('slots.leads.approve');
    Route::post('/slots/{id}/approve', [SlotController::class, 'approve'])->name('slots.approve');

    Route::get('/markas_complete/{id}', [SlotController::class, 'markas_complete'])->name('slots.markas_complete');

    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::post('/set-admin-locale', [UserController::class, 'setAdminLocale'])->name('set-admin-locale');
    Route::get('/admin/users/export/csv', [UserController::class, 'exportCSV'])->name('users.export.csv');
    Route::get('/admin/slots/export/csv', [SlotController::class, 'exportResetCSV'])->name('resetslots.export.csv');
    Route::get('/export/newsletter-subscribers', [UserController::class, 'exportNewsletterSubscribers'])->name('newsletter.export.csv');

    Route::post('/system/reset', [UserController::class, 'resetSystem'])->name('system.reset');
    Route::get('/export/slots', [SlotController::class, 'exportSlotsCSV'])->name('export.slots.csv');

    Route::get('/export/booking-history', [SlotController::class, 'exportBookingHistoryCSV'])->name('export.booking.history.csv');

    Route::get('/export-sessions', [SlotController::class, 'exportSessions'])->name('sessions.export.csv');

    Route::post('/users/check-before-delete', [UserController::class, 'checkBeforeDelete'])->name('users.checkBeforeDelete');

    Route::post('/cancel-session/{slot}', [UserController::class, 'Cancellation_request'])->name('cancel.session');

    Route::put('/admin/cancellation-requests/{id}/approve', [UserController::class, 'approveCancellationrequest'])->name('cancellation_requests.approve');

    Route::get('/cancellation-requests', [UserController::class, 'showcancellatRequeest'])->name('cancellation.requests.index');

    Route::post('/users/verify', [UserController::class, 'verify'])->name('users.verify');
});

// Front User Login Pages
Route::group(['middleware' => ['auth', 'noadmin']], function () {
    Route::get('/dashboard', [MemberController::class, 'dashboard'])->name('dashboard');

    Route::get('/userprofile', [MemberController::class, 'userprofile'])->name('userprofile');

    Route::get('/change-password', [MemberController::class, 'change_password'])->name('changepassword');
    Route::post('/users/{id}/update-password', [MemberController::class, 'updatepassword'])->name('updatepassword');
    Route::get('/profile/update/{id}', [MemberController::class, 'updateprofile'])->name('updateprofile');
    Route::delete('/unregister/{id}', [MemberController::class, 'unregister'])->name('unregister');
    Route::get('check-active-slot', [MemberController::class, 'checkActiveSlots']);

    Route::get('/leadmanagement', [MemberController::class, 'leadmanagement'])->name('user.leadmanagement');
    Route::get('/availableslots', [MemberController::class, 'availableslots'])->name('user.availableslots');
    Route::get('/user-dashboard', [MemberController::class, 'user_dashboard'])->name('user.user_dashboard');

    Route::get('/book-a-session', [MemberController::class, 'book_session_list'])->name('user.book_session_list');
    Route::get('/booking-history', [MemberController::class, 'bookingHistorylist'])->name('user.bookingHistorylist');
    Route::post('/cancelBookingById/{id}/{slot_id}', [MemberController::class, 'cancelBookingById'])->name('user.cancelBookingById');

    Route::get('/user/my-sessions', [MemberController::class, 'mySessions'])->name('user.my_sessions');

    Route::post('/bookasession', [MemberController::class, 'bookasession'])->name('bookasession');

    Route::get('/leadmanagement/search', [MemberController::class, 'leadmanagement'])->name('leadmanagement.search');

    Route::post('/sessionleads/store', [MemberController::class, 'store'])->name('sessionleads.store');

    Route::post('/check-slot-status', [MemberController::class, 'checkSlotStatus'])->name('check.slot.status');
});

Route::group(['middleware' => ['auth']], function () {
    Route::post('/logout', [HomeController::class, 'logout'])->name('logout');
});
