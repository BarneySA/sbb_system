<?php
Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function(){
    return view('welcome');
})->name('login');

Route::post('/login', 'AuthController@auth_user');
Route::post('/login/auth_token', 'AuthController@auth_token');

Route::get('/logouth', function () {
    Auth::logout();
    return redirect('/');
});

Route::get('/about_us', function () {
    return view('about_us');
});

Route::get('/report_problem', function () {
    return view('report_problem');
});

Route::get('/contact_us', function () {
    return view('contact_us');
});

Route::get('/help', function () {
    return view('help');
});

Route::get('/thanks_for_the_registration', function () {
    return view('users.thanks_for_the_registration');
});

Route::get('/qr-code/{text}', function ($text) {
    return QRCode::text($text)->setSize(8)->png();
});

Route::middleware(['auth'])->group(function () {
    
    // Rutas para usuarios CP
    Route::prefix('/cp/users')->group(function () {
        Route::get('/', 'UserController@index');
        Route::get('/my_transactions', 'UserController@my_transactions');
        Route::post('/transactions/{transaction_id}/refund', 'TransactionController@refund_for_client');
    });

    Route::prefix('/products')->group(function () {
        Route::get('/categories', 'ProductController@categories');
        Route::get('/category/{slug}', 'ProductController@category');
    });
    
    Route::get('/product/{slug}', 'ProductController@product');
    Route::post('/product/register_transaction', 'ProductController@register_transaction');

    // Rutas para administradores
    Route::prefix('/cp/admin')->middleware('admin_auth')->group(function () {
        Route::get('/users', 'UserController@admin_users');
        Route::get('/send/{currency}/{user_id}', 'UserController@send_currency');
        Route::post('/send/{currency}/{user_id}', 'UserController@send_currency_post');
        Route::get('/change_status_acc/{id}', 'UserController@change_status_acc');
        Route::get('/transactions', 'UserController@admin_transactions');
        Route::post('/transactions/{transaction_id}/refund', 'TransactionController@refund');
        
    });
});

