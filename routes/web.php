<?php

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

/*
 *  Front pages
 */

Route::get('/', 'Front\IndexController@index');

Route::get('/json', 'Front\IndexController@frontJson');

Route::get('/kontakt', 'Front\ContactController@index');

Route::get('/oferta', 'Front\OfferController@index');

Route::get('/regulamin', 'Front\RegulationsController@index');

Route::get('/polityka-prywatnosci', 'Front\PrivacyController@index');

/*
 *  Stores pages
 */

Route::get('/zaloguj', 'Store\Auth\LoginController@index')->name('login');
Route::get('/wyloguj', 'Store\Auth\LogoutController@index');

Route::get('/rejestracja', 'Store\Auth\RegisterController@index');
Route::get('/aktywacja', 'Store\Auth\RegisterController@activation');

Route::get('/reset-hasla', 'Store\Auth\ForgotPasswordController@index');
Route::get('/reset-hasla/wyslano', 'Store\Auth\ForgotPasswordController@emailSent');
Route::get('/reset-hasla/reset', 'Store\Auth\ForgotPasswordController@changePassword');

Route::get('/konto', 'Store\StoreIndexController@index')->name('home');

Route::get('/koszyk', 'Store\Cart\CartController@index')->name('cart');

Route::get('/koszyk/zaplac', 'Store\Cart\CartController@pay');

Route::get('/konto/sklepy', 'Store\Stores\StoresController@index');

Route::get('/konto/sklepy/nowy', 'Store\Stores\AddStoreController@index');

Route::get('/konto/sklepy/{shopId}/wystaw', 'Store\Reservations\AddReservationController@index');

Route::get('/konto/rezerwacje/{reservationId}/usun', 'Store\Reservations\RemoveUnpaidReservationController@remove');

Route::post('/rejestracja', 'Store\Auth\RegisterController@registerAttempt');
Route::post('/zaloguj', 'Store\Auth\LoginController@loginAttempt');

Route::post('/reset-hasla', 'Store\Auth\ForgotPasswordController@sendEmail');
Route::post('/reset-hasla/reset', 'Store\Auth\ForgotPasswordController@changePasswordAttempt');

Route::post('/konto/sklepy/nowy', 'Store\Stores\AddStoreController@addAttempt');

Route::post('/konto/sklepy/{shopId}/wystaw', 'Store\Reservations\AddReservationController@addAttempt');

/*
 *  Panel pages
 */

Route::get('/panel/login', 'Dashboard\Auth\LoginController@index')->name('dashboardLogin');

Route::get('/panel', 'Dashboard\DashboardIndexController@index')->name('dashboard');

Route::get('/panel/sklepy', 'Dashboard\Stores\StoresController@index');

Route::get('/panel/wystawienia', 'Dashboard\Reservations\ReservationsController@index');

Route::get('/panel/wystawienia/{reservationId}/zaplacone', 'Dashboard\Reservations\ReservationsController@paid');

Route::post('/panel/login', 'Dashboard\Auth\LoginController@loginAttempt');

Route::post('/panel/sklepy/{shopId}/akceptuj', 'Dashboard\Stores\StoresController@accept');

Route::post('/panel/login{shopId}/odrzuc', 'Dashboard\Stores\StoresController@reject');
