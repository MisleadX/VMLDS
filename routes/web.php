<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => env('ADMIN_URL'), 'middleware' => ['web']], function () use ($router) {

    $router->get('login', ['uses' => 'App\Http\Controllers\Admin\AccessAdminController@getLogin', 'middleware' => ['adminHaveLogin']])->name('admin.login');
    $router->post('login', ['uses' => 'App\Http\Controllers\Admin\AccessAdminController@postLogin', 'middleware' => ['adminHaveLogin']])->name('admin.login.post');
    $router->get('logout', ['uses' => 'App\Http\Controllers\Admin\AccessAdminController@doLogout'])->name('admin.logout');

    $router->group(['middleware' => ['adminLogin', 'preventBackHistory']], function () use ($router) {

        $router->group(['prefix' => 'profile'], function () use ($router) {
            $router->get('edit', ['uses'=>'App\Http\Controllers\Admin\ProfileController@getProfile'])->name('admin.get_profile');
            $router->post('edit', ['uses'=>'App\Http\Controllers\Admin\ProfileController@postProfile'])->name('admin.post_profile');
            $router->get('password', ['uses'=>'App\Http\Controllers\Admin\ProfileController@getPassword'])->name('admin.get_password');
            $router->post('password', ['uses'=>'App\Http\Controllers\Admin\ProfileController@postPassword'])->name('admin.post_password');
            $router->get('/', ['uses'=>'App\Http\Controllers\Admin\ProfileController@profile'])->name('admin.profile.index');
        });

        $router->group(['middleware' => ['adminAccessPermission']], function () use ($router) {

            $listRouter = [
                'App\Http\Controllers\Admin\SettingsController' => 'settings',
                'App\Http\Controllers\Admin\AdminController' => 'admin',
                'App\Http\Controllers\Admin\RoleController' => 'role',
                'App\Http\Controllers\Admin\PageController' => 'page',
                'App\Http\Controllers\Admin\ContactController' => 'contact',
            ];

            foreach ($listRouter as $controller => $linkName) {
                switch ($linkName) {
                    case 'admin':
                        $router->get($linkName . '/{id}/password', $controller.'@password')->name('admin.' . $linkName . '.password');
                        $router->post($linkName . '/{id}/update-password', $controller.'@updatePassword')->name('admin.' . $linkName . '.updatePassword');
                        break;
                    case 'contact':
                        $router->get($linkName . '/{id}/read', $controller.'@read')->name('admin.' . $linkName . '.read');
                        break;

                }

                $router->get($linkName . '/data', $controller . '@dataTable')->name('admin.' . $linkName . '.dataTable');
                $router->resource($linkName, $controller, ['as' => 'admin']);
            }

        });

        $router->get('/', ['uses' => 'App\Http\Controllers\Admin\DashboardController@dashboard'])->name('admin');

    });
});

$router->get('/', ['uses' => 'App\Http\Controllers\Website\HomeController@index'])->name('homepage');
$router->get('/contact', ['uses' => 'App\Http\Controllers\Website\ContactController@index'])->name('contact');
$router->post('/contact', ['uses' => 'App\Http\Controllers\Website\ContactController@postContact'])->name('postContact');

$router->get('/404', function() {
    return view('error');
})->name('404');
