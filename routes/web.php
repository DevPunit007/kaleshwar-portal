<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageLineController;

// ########## So that there is no 'page not found'-error when the user calls '/' instead of '/en' or '/de' etc. ##########
Route::get('/', 'EventController@index')->name('home')->middleware('auth');
//Route::get('/mail/send/group', 'MailController@sendMessageToGroup')->name('mail-send-group')->middleware('auth');
//Route::get('/mail/send/event', 'MailController@sendMessageToEvent')->name('mail-send-event')->middleware('auth');
//Route::get('/mail/send/users', 'MailController@sendMessageToUsers')->name('mail-send-users')->middleware('auth');


// ########## Routes only available through ajax. Calling these through browser url bar should not work ##########
Route::get('/get-states/{country}', 'LanguageController@ajaxGetStates')->name('get-states')->middleware('ajax');
Route::get('/get-rooms/{location}', 'LocationController@ajaxGetRooms')->name('get-rooms')->middleware('ajax');
Route::get('/mail/send/all-events/{emailAddress}', 'MailController@ajaxShipAllEventsMail')->name('mail-send-event-booked')->middleware('ajax');



// ########## Pretty much every regular page must be inside the language route group so that language functionality works. ##########
Route::group(['prefix' => '{language}'], function() {

    // ##############################################
    // ############# Auth::routes(); ################
    // ##############################################
    // Authentication Routes
        Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
        Route::get('logout', 'Auth\LoginController@logout')->name('logout');
        Route::post('login', 'Auth\LoginController@login');
        Route::post('logout', 'Auth\LoginController@logout')->name('logout');
    // Registration Routes
        if ($options['register'] ?? true) {
            Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
            Route::post('add-register', 'Auth\RegisterController@register')->name('add-register');
        }
     // Password Reset Routes
        if ($options['reset'] ?? true) {
            Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
            Route::get('password/reactivate', 'Auth\ForgotPasswordController@showLinkRequestFormReactivate')->name('password.reactivate');
            Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
            Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
            Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');
        }
    // Email Verification Routes
        if ($options['verify'] ?? false) {
            Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
            Route::get('email/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify');
            Route::get('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');
        }


    // ##############################################
    // #################### User ####################
    // ##############################################
    Route::get('/user/account', function(){ return view('pages.user.user-account-iframe'); })->name('user-account-iframe')->middleware('auth');
    Route::get('/user-account', 'UserController@showAccount')->name('user-account')->middleware('auth');
    Route::get('/user/list', 'UserController@showList')->name('user-list')->middleware('auth');
    Route::get('/user/list-active', 'UserController@showListActive')->name('user-list-active')->middleware('auth');
    Route::get('/user/list-status', 'UserController@showListStatus')->name('user-list-status')->middleware('auth');
    Route::get('/user/list-check', 'UserController@showListCheck')->name('user-list-check')->middleware('auth');

    // show for add and edit
    Route::get('/user/add', 'UserController@showForAdd')->name('user-add')->middleware('auth');
    Route::get('/user/{id}/edit-basic', 'UserController@showForEditBasic')->name('user-edit-basic')->middleware('auth');
    Route::get('/user/{id}/edit-contact', 'UserController@showForEditContact')->name('user-edit-contact')->middleware('auth');
    Route::get('/user/{id}/edit-personal', 'UserController@showForEditPersonal')->name('user-edit-personal')->middleware('auth');
    Route::get('/user/{id}/edit-spiritual', 'UserController@showForEditSpiritual')->name('user-edit-spiritual')->middleware('auth');
    Route::get('/user/{id}/edit-additional', 'UserController@showForEditAdditional')->name('user-edit-additional')->middleware('auth');
    Route::get('/user/{id}/edit-ashram', 'UserController@showForEditAshram')->name('user-edit-ashram')->middleware('auth');
    Route::get('/user/{id}/edit-bookings', 'UserController@showForEditBookings')->name('user-edit-bookings')->middleware('auth');
    Route::get('/user/{id}/edit-files', 'UserController@showForEditFiles')->name('user-edit-files')->middleware('auth');
     // delete user
    Route::get('/delete-user-phone/{id}', 'UserController@deleteUserPhone')->name('delete-user-phone')->middleware('auth');
    Route::get('/delete-user-group/{id}', 'UserController@deleteUserGroup')->name('delete-user-group')->middleware('auth');
    // add as post request
    Route::post('/add-user-basic', 'UserController@addUserBasic')->name('add-user-basic')->middleware('auth');
    Route::post('/add-user-phone', 'UserController@addUserPhone')->name('add-user-phone')->middleware('auth');
    Route::post('/add-user-group', 'UserController@addUserGroup')->name('add-user-group')->middleware('auth');


    // edit as post request
    Route::post('/edit-user-basic/{id}', 'UserController@editUserBasic')->name('edit-user-basic')->middleware('auth');
    Route::post('/edit-user-contact/{id}', 'UserController@editUserContact')->name('edit-user-contact')->middleware('auth');
    Route::post('/edit-user-personal/{id}', 'UserController@editUserPersonal')->name('edit-user-personal')->middleware('auth');
    Route::post('/edit-user-spiritual/{id}', 'UserController@editUserSpiritual')->name('edit-user-spiritual')->middleware('auth');
    Route::post('/edit-user-ashram/{id}', 'UserController@editUserAshram')->name('edit-user-ashram')->middleware('auth');
    Route::post('/edit-user-files/{id}', 'UserController@editUserFiles')->name('edit-user-files')->middleware('auth');
    // search user with post request
    Route::post('/search-user', 'UserController@searchUser')->name('search-user')->middleware('auth');


    // ##############################################
    // ################ Organizer ###################
    // ##############################################
    // list views
    Route::get('/organizer/list/{type}', 'OrganizerController@showOrganizerList')->name('organizer-list')->middleware('auth');
    // show for add and edit
    Route::get('/organizer/add/{type}', 'OrganizerController@showForAdd')->name('organizer-add')->middleware('auth');
    Route::get('/group/edit/{id}', 'OrganizerController@showForEdit')->name('group-edit')->middleware('auth');
    Route::get('/teacher/edit/{id}', 'OrganizerController@showForEdit')->name('teacher-edit')->middleware('auth');
    Route::get('/organizer/add-translation/{id}', 'OrganizerController@showForLanguageAddition')->name('organizer-add-translation')->middleware('auth');

    Route::get('/organizer/delete-phone/{id}', 'OrganizerController@deleteOrganizerPhone')->name('delete-organizer-phone')->middleware('auth');
    // add teacher by user
    Route::get('/create-teacher-by-user/{id}', 'OrganizerController@addTeacherByUser')->name('create-teacher-by-user')->middleware('auth');
    Route::get('/send/message/tutorial/{id}', 'MailController@sendMessageToTeacher')->name('send-message-tutorial')->middleware('auth');

    // add and edit as post request
    Route::post('/organizer/add/{type}', 'OrganizerController@add')->name('organizer-add')->middleware('auth');
    Route::post('/organizer/edit/{id}', 'OrganizerController@edit')->name('organizer-edit')->middleware('auth');
    Route::post('/organizer/edit-address/{id}', 'OrganizerController@editAddress')->name('organizer-contact-edit')->middleware('auth');
    Route::post('/organizer/add-translation/{id}', 'OrganizerController@addTranslation')->name('organizer-add-translation')->middleware('auth');
    Route::post('/organizer/organizer-details/{id}', 'OrganizerController@editDetails')->name('organizer-details-edit')->middleware('auth');
    Route::post('/organizer/add-phone/{id}', 'OrganizerController@addPhone')->name('organizer-add-phone')->middleware('auth');
    Route::post('/organizer/change-topics/{id}', 'OrganizerController@changeTopics')->name('organizer-change-topics')->middleware('auth');
    Route::post('/organizer/change-certifications/{id}', 'OrganizerController@changeCertifications')->name('organizer-change-certifications')->middleware('auth');



    // ##############################################
    // ################ Location ####################
    // ##############################################
    // return views
    Route::get('/location/list', 'LocationController@showList')->name('location-list')->middleware('auth');
    Route::get('/room/list', 'LocationController@showRoomList')->name('room-list')->middleware('auth');
    Route::get('/room/edit/{id}', 'LocationController@showRoomForEdit')->name('room-edit')->middleware('auth');
    Route::get('/room/add', 'LocationController@showRoomForAdd')->name('room-add')->middleware('auth');
    Route::get('/location/edit/{id}', 'LocationController@showForEdit')->name('location-edit')->middleware('auth');
    Route::get('/location/add', 'LocationController@showForAdd')->name('location-add')->middleware('auth');
    Route::get('/location/add-translation/{id}', 'LocationController@showForLanguageAddition')->name('location-add-translation')->middleware('auth');
    // redirect, because post request
    Route::post('/location/edit/{id}', 'LocationController@edit')->name('location-edit')->middleware('auth');
    Route::post('/location/add', 'LocationController@add')->name('location-add')->middleware('auth');
    Route::post('/building/edit/{id}', 'LocationController@editBuilding')->name('building-edit')->middleware('auth');
    Route::post('/room/edit/{id}', 'LocationController@editRoom')->name('room-edit')->middleware('auth');
    Route::post('/room/add', 'LocationController@addRoom')->name('room-add')->middleware('auth');
    Route::post('/building/add', 'LocationController@addBuilding')->name('building-add')->middleware('auth');
    Route::post('/location/add-translation/{id}', 'LocationController@addTranslation')->name('location-add-translation')->middleware('auth');


    // ##############################################
    // ################# Event ######################
    // ##############################################
    // return views
    Route::get('/', 'EventController@index')->name('home')->middleware('auth');
    Route::get('/iframe', 'EventController@index')->name('iframe');
    Route::get('/event/list', 'EventController@showList')->name('event-list')->middleware('auth');
    Route::get('/event/add', 'EventController@showForAdd')->name('event-add')->middleware('auth');
    Route::get('/event/edit/{id}', 'EventController@showForEdit')->name('event-edit')->middleware('auth');
    Route::get('/event/clone/{id}', 'EventController@cloneEvent')->name('event-clone')->middleware('auth');

    Route::get('/event/add-translation/{id}', 'EventController@showForLanguageAddition')->name('event-add-translation')->middleware('auth');
    Route::get('/event/report-message/{id}', 'EventController@showReportMessage')->name('event-report-message')->middleware('auth');
    Route::get('/event/report-address/{id}', 'EventController@showReportAddress')->name('event-report-address')->middleware('auth');
    Route::get('/event/report-user-details/{id}', 'EventController@showReportUserDetails')->name('event-report-user-details')->middleware('auth');
    Route::get('/event/report-booking-details/{id}', 'EventController@showReportBookingDetails')->name('event-report-booking-details')->middleware('auth');


    Route::get('/event/section/edit/{id}', 'EventController@showForSectionEdit')->name('event-section-edit')->middleware('auth');
    Route::get('/event/section/add/{id}', 'EventController@showForSectionAdd')->name('event-section-add')->middleware('auth');
    Route::get('/event/section/add-translation/{id}', 'EventController@showSectionForLanguageAddition')->name('event-section-add-translation')->middleware('auth');
    // redirect, because post request
    Route::post('/event/add', 'EventController@add')->name('event-add')->middleware('auth');
    Route::post('/event/edit-details/{id}', 'EventController@editDetails')->name('event-details-edit')->middleware('auth');
    Route::post('/event/edit/{id}', 'EventController@edit')->name('event-edit')->middleware('auth');
    Route::post('/event/section/edit/{id}', 'EventController@editSection')->name('event-section-edit')->middleware('auth');
    Route::post('/event/section/add/{id}', 'EventController@addSection')->name('event-section-add')->middleware('auth');
    Route::post('/event/section-details/edit/{id}', 'EventController@editSectionDetails')->name('event-section-details-edit')->middleware('auth');
    Route::post('/event/add-translation/{id}', 'EventController@addTranslation')->name('event-add-translation')->middleware('auth');
    Route::post('/event/section/add-translation/{id}', 'EventController@addSectionTranslation')->name('event-section-add-translation')->middleware('auth');

    

    // ##############################################
    // ################ Booking #####################
    // ##############################################
    // return views
    Route::get('/booking/list', 'BookingController@showList')->name('booking-list')->middleware('auth');
    Route::get('/booking/list-current', 'BookingController@showListCurrent')->name('booking-list-current')->middleware('auth');
    Route::get('/booking/list-open', 'BookingController@showListOpen')->name('booking-list-open')->middleware('auth');
    Route::get('/booking/edit/{id}', 'BookingController@showForEdit')->name('booking-edit')->middleware('auth');
    Route::get('/booking/email/{id}', 'BookingController@showForEmail')->name('booking-email')->middleware('auth');
    Route::get('/booking/user-list', 'BookingController@showListUser')->name('booking-user-list')->middleware('auth');
    Route::get('/booking/user-edit/{id}', 'BookingController@showForUserEdit')->name('booking-user-edit')->middleware('auth');

    // actions with change of status
    Route::get('/email-booking-accepted/{id}', 'BookingController@actionBookingAccepted')->name('email-booking-accepted')->middleware('auth');
    Route::get('/email-booking-payment-confirmation/{id}', 'BookingController@actionPaymentConfirmation')->name('email-booking-payment-confirmation')->middleware('auth');
    Route::get('/email-booking-no-payment/{id}', 'BookingController@actionNoPaymentNecessary')->name('email-booking-no-payment')->middleware('auth');
    Route::get('/cancel-booking/{id}', 'BookingController@cancelBooking')->name('cancel-booking')->middleware('auth');

    // actions without change of status
    Route::get('/email-booking-payment-reminder/{id}', 'BookingController@actionPaymentReminder')->name('email-booking-payment-reminder')->middleware('auth');

    // delete booking
    Route::get('/delete-booking-admin/{id}', 'BookingController@deleteBookingByAdmin')->name('delete-booking-admin')->middleware('auth');

    // redirect, because post request
    Route::post('/add-booking', 'BookingController@add')->name('add-booking')->middleware('auth');
    Route::post('/add-registration-details', 'BookingController@addBookingDetails')->name('add-registration-details')->middleware('auth');

    Route::post('/edit-booking/{id}', 'BookingController@edit')->name('edit-booking')->middleware('auth');
    Route::post('/edit-booking-details/{id}', 'BookingController@editDetails')->name('edit-booking-details')->middleware('auth');
    Route::post('/add-booking-admin', 'BookingController@addBookingByAdmin')->name('add-booking-admin')->middleware('auth');
    Route::post('/add-booking-details-admin', 'BookingController@addBookingDetailsByAdmin')->name('add-booking-details-admin')->middleware('auth');


    // ##############################################
    // ################# iframe #####################
    // ##############################################
    // show in user-account in iframe
    Route::get('/iframe', 'FrontendController@index')->name('iframe');
    Route::get('/iframe/show-events', function(){ return view('pages.iframe.show-events'); })->name('iframe-show-events')->middleware('auth');
    Route::get('/iframe/details/{id}', 'FrontendController@show')->name('iframe-details');
    Route::get('/iframe/booking/{id}', 'FrontendController@showForBooking')->name('iframe-booking')->middleware('auth');
    Route::get('/iframe/booking-registration/{id}', 'FrontendController@showForRegistration')->name('iframe-booking-registration')->middleware('auth');
    Route::get('/iframe/after-booking/{id}', 'FrontendController@showAfterBooking')->name('iframe-after-booking')->middleware('auth');

    Route::get('/iframe/user-account-welcome', 'FrontendController@showUserWelcome')->name('iframe-user-welcome')->middleware('auth');

    Route::get('/iframe/user-account-basic', 'FrontendController@showUserAccountBasic')->name('iframe-user-account-basic')->middleware('auth');
    Route::get('/iframe/user-account-contact', 'FrontendController@showUserAccountContact')->name('iframe-user-account-contact')->middleware('auth');
    Route::get('/iframe/user-account-personal', 'FrontendController@showUserAccountPersonal')->name('iframe-user-account-personal')->middleware('auth');
    Route::get('/iframe/user-account-additional', 'FrontendController@showUserAccountAdditional')->name('iframe-user-account-additional')->middleware('auth');
    Route::get('/iframe/user-account-spiritual', 'FrontendController@showUserAccountSpiritual')->name('iframe-user-account-spiritual')->middleware('auth');

    Route::get('/iframe/user-account-files', 'FrontendController@showUserFiles')->name('iframe-user-files')->middleware('auth');
    Route::get('/iframe/user-account-file-show/{id}', 'FrontendController@showFile')->name('iframe-user-file-show')->middleware('auth');

    Route::get('/iframe/organizer/list', 'FrontendController@showOrganizerList')->name('iframe-organizer-list');
    Route::get('/iframe/organizer/details/{id}', 'FrontendController@showOrganizerDetails')->name('iframe-organizer-edit');
    // other views for user frontend
    Route::get('/iframe/user-register', 'FrontendController@showRegistrationForm')->name('iframe-user-register');
    Route::get('/iframe/user-redirect', function(){ return redirect('https://srikaleshwar.world/en/user/account'); })->name('iframe-user-redirect');
    Route::get('/iframe/logout', function(){Auth::logout(); return redirect(route('iframe-user-account-basic', app()->getLocale()));})->name('iframe-user-logout');
    //Route::post('iframe/register', 'FrontendController@addUser')->name('iframe-user-add');
    //Route::post('/iframe/add-register', 'Auth\RegisterController@register')->name('iframe-add-register');


    // ##############################################
    // ################## File ######################
    // ##############################################
    // return views
    Route::get('/file/list', 'FileController@showFileList')->name('file-list')->middleware('auth');
    Route::get('/file/show/{id}', 'FileController@showFile')->name('file-show')->middleware('auth');
    Route::get('/file/edit/{id}', 'FileController@showFileForEdit')->name('file-edit')->middleware('auth');
    Route::get('/file/add', 'FileController@showFileForAdd')->name('file-add')->middleware('auth');
    // redirect, because post request
    Route::post('store-user-images', 'FileController@storeUserImages')->name('store-user-images')->middleware('auth');
    Route::post('/file/add', 'FileController@addFile')->name('add-file')->middleware('auth');
    Route::post('/file/edit/{id}', 'FileController@editFile')->name('edit-file')->middleware('auth');


    // ##############################################
    // ################ Timeline ####################
    // ##############################################
    // return views
    Route::get('/timeline/media/list', 'TimelineController@showListMedia')->name('timeline-media-list')->middleware('auth');
    Route::get('/timeline/media/add/', 'TimelineController@showMediaForAdd')->name('timeline-media-add')->middleware('auth');
    //Route::get('/timeline/media/add/{id}', 'TimelineController@showMediaForAddwithDate')->name('timeline-media-add-with-date')->middleware('auth');
    Route::get('/timeline/media/edit/{id}', 'TimelineController@showMediaForEdit')->name('timeline-media-edit')->middleware('auth');
    // redirect, because post request
    Route::post('/timeline/add-media', 'TimelineController@addMedia')->name('timeline-add-media')->middleware('auth');
    Route::post('/timeline/edit-media/{id}', 'TimelineController@editMedia')->name('timeline-edit-media')->middleware('auth');


    // ##############################################
    // ################# Reports ####################
    // ##############################################

Route::get('/audits', 'AuditsController@index')->name('show-audits')->middleware('auth');

Route::get('/translation/list', 'LanguageLineController@index')->name('translation-list')->middleware('auth');
Route::get('/translation/add', 'LanguageLineController@AddTranslation')->name('translation-add')->middleware('auth');
Route::post('/translation/add', 'LanguageLineController@storeTranslation')->name('store-translation')->middleware('auth');
Route::get('/translation/edit/{id}', 'LanguageLineController@edit')->name('translation-edit')->middleware('auth');
Route::post('/translation/edit/{id}', 'LanguageLineController@update')->name('update-translation')->where('language', '[a-zA-Z]{2}')->middleware('auth');
Route::delete('/translation/delete/{id}', 'LanguageLineController@destroy')->name('translation-delete')->middleware('auth');
Route::post('/translation/import', 'LanguageLineController@importData')->name('translation-import')->middleware('auth');
Route::get('/translation/download', 'LanguageLineController@downloadFile')->name('translation-download')->middleware('auth');
Route::post('/translation/upload', 'LanguageLineController@uploadFile')->name('translation-upload')->middleware('auth');

});

