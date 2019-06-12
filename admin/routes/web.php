<?php
use Mpociot\BotMan\BotMan;
Route::get('/', function () { return redirect('/admin/home'); });
Route::get('/bot',function(){
    $botman = app('botman');

$botman->hears('hello', function (BotMan $bot) {
    $bot->reply('Hello yourself.');
});

// start listening
$botman->listen();
});
// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('auth.login');
$this->post('login', 'Auth\LoginController@login')->name('auth.login');
$this->post('logout', 'Auth\LoginController@logout')->name('auth.logout');

// Change Password Routes...
$this->get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
$this->patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.reset');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.reset');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset')->name('auth.password.reset');

Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/home', 'HomeController@index');
    
    Route::resource('roles', 'Admin\RolesController');
    Route::post('roles_mass_destroy', ['uses' => 'Admin\RolesController@massDestroy', 'as' => 'roles.mass_destroy']);
    Route::resource('users', 'Admin\UsersController');
    Route::post('users_mass_destroy', ['uses' => 'Admin\UsersController@massDestroy', 'as' => 'users.mass_destroy']);
    Route::resource('lecturers', 'Admin\LecturersController');
    Route::post('lecturers_mass_destroy', ['uses' => 'Admin\LecturersController@massDestroy', 'as' => 'lecturers.mass_destroy']);
    Route::post('lecturers_restore/{id}', ['uses' => 'Admin\LecturersController@restore', 'as' => 'lecturers.restore']);
    Route::delete('lecturers_perma_del/{id}', ['uses' => 'Admin\LecturersController@perma_del', 'as' => 'lecturers.perma_del']);
    Route::resource('payments', 'Admin\PaymentsController');
    Route::post('payments_mass_destroy', ['uses' => 'Admin\PaymentsController@massDestroy', 'as' => 'payments.mass_destroy']);
    Route::post('payments_restore/{id}', ['uses' => 'Admin\PaymentsController@restore', 'as' => 'payments.restore']);
    Route::delete('payments_perma_del/{id}', ['uses' => 'Admin\PaymentsController@perma_del', 'as' => 'payments.perma_del']);



 
});
