<?php


Route::get('/', function () {
    return view('welcome');
});

Route::get('/not-found', function () {
    return view('404');
});

Route::get('/login/{slug}', 'HomeController@login');
Route::get('/register/{slug}', 'HomeController@register');
Route::post('/register/{slug}', 'HomeController@register_user');
Route::get('/logouth', 'HomeController@logouth');
Route::post('/login/{slug}', 'HomeController@auth');
Route::get('/login', function(){
    return redirect('/not-found');
})->name('login');

Route::middleware(['auth'])->group(function () {
    Route::group(['prefix' => 'cp'], function() {

        Route::get('dashboard', function() {

           return view('dashboard');

        });

        Route::get('/buy_membership/{id}', 'MembershipController@buy_membership_form');
        Route::post('/membership', 'MembershipController@buy_membership');

        // Rutas para cliente
        Route::get('/my_transactions', 'TransactionController@my_transactions');
        Route::get('/my_transactions/{id}/delete', 'TransactionController@destroy');

        // Admin
        Route::get('/admin/transactions', 'TransactionController@admin_transactions');
        Route::get('/admin/transactions/{id}/detail', 'TransactionController@transaction_detail');
        Route::get('/admin/transactions/aprobar/{id}', 'TransactionController@transaction_aprov');

        // Rutas para manger
        Route::post('/send_signals', 'SignalController@send');
        Route::get('/manager/my_transactions', 'TransactionController@my_transactions_manager');
        Route::get('/manager/my_clients', 'UserController@my_clients');
        Route::get('/manager/memberships', 'MembershipController@manager_create');
        Route::get('/manager/memberships/change_status/{id}', 'MembershipController@change_status');
        Route::post('/manager/memberships/create', 'MembershipController@create_membership');

    });
});

// Route::get('/bridge', 'SignalController@send');
Route::get('/get_all_signals/{id_group}', 'SignalController@get_all_signals');
Route::get('/verify_subscriberid', 'UserController@verify_subscriberid');



