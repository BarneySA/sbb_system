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

Route::get('/thanks_for_your_answer', function () {
    return view('users.thanks_for_your_answer');
});


Route::get('/qr-code/{text}', function ($text) {
    return QRCode::text($text)->setSize(8)->png();
});

Route::post('/register', 'UserController@register');

Route::middleware(['auth'])->group(function () {
    Route::get('/thanks_for_your_answer/{transaction_id}/{response}', 'TransactionController@thanks_for_your_answer');
    
    // Rutas para usuarios CP
    Route::prefix('/cp/users')->group(function () {
        Route::get('/', 'UserController@index');
        Route::get('/my_transactions', 'UserController@my_transactions');
        Route::get('/my_shopping', 'UserController@my_shopping');
        Route::post('/transactions/{transaction_id}/refund', 'TransactionController@refund_for_client');
        // Route::get('/vaciar_cuenta', 'TransactionController@vaciar_cuenta');
    });

    Route::prefix('/products')->group(function () {
        Route::get('/categories', 'ProductController@categories');
        Route::get('/category/{slug}', 'ProductController@category');
    });
    
    Route::get('/product/{slug}', 'ProductController@product');
    Route::post('/product/register_transaction', 'ProductController@register_transaction');

    // Rutas para administradores
    Route::prefix('/cp/admin')->middleware('admin_auth')->group(function () {
        Route::get('/', 'HomeController@index');
        Route::post('/', 'HomeController@filtering_and_reports');
        Route::get('/users', 'UserController@admin_users');
        Route::get('/send/{currency}/{user_id}', 'UserController@send_currency');
        Route::post('/send/{currency}/{user_id}', 'UserController@send_currency_post');
        Route::get('/send_reward/{user_id}', 'UserController@send_reward_user');
        Route::get('/change_status_acc/{id}', 'UserController@change_status_acc');
        Route::get('/transactions', 'UserController@admin_transactions');
        Route::post('/transactions/{transaction_id}/refund', 'TransactionController@refund');
        Route::get('/transactions/{transaction_id}/poll_change_status', 'TransactionController@poll_change_status');

        Route::prefix('/products')->group(function () {
            Route::get('/', 'ProductController@index');
            Route::get('/edit/{product_id}', 'ProductController@edit');
            Route::get('/destroy/{product_id}', 'ProductController@destroy');
            Route::get('/change_status_p/{product_id}', 'ProductController@change_status_p');
            Route::post('/edit/{product_id}', 'ProductController@update');
            Route::get('/create', 'ProductController@create');
            Route::post('/create', 'ProductController@store');
        });

        Route::prefix('/categories')->group(function () {
            Route::get('/', 'CategoryController@index');
            Route::post('/', 'CategoryController@store');
            Route::get('/destroy/{category_id}', 'CategoryController@destroy');
            Route::get('/change_status/{category_id}', 'CategoryController@change_status');
            
            
        });
    });
});

