<?php
use App\post;
use Illuminate\Support\Facades\Input;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|


Route::get('/users/{name}/{id}', function ($name,$id) {
    return 'your name is '.$name.'your id is'.$id;
});
/*
Route::get('/hello', function () {
    return '<h1>Hello worled</h1>';
});
*/
Route::get('/', 'PagesController@index');
Route::get('/about', 'PagesController@about');
Route::get('/services', 'PagesController@services');
Route::get('/contact', 'PagesController@contact');

Route::resource('posts','PostsController');
Route::resource('comments','CommentController');
Route::resource('dashbord','DashbordController');
Route::resource('users','HomeController');
Auth::routes();

Route::get('home', 'HomeController@index')->name('home');



Route::group(['as'=>'admin.','prefix'=>'admin','namespace'=>'admin','Middleware'=>['auth','admin']],function()
{
    Route::get('dashbord', 'AdminController@index')->name('admin');
    Route::get('/admin/login', 'Auth\AdminLogController@showLoginform')->name('admin.login');
    Route::post('/admin/login', 'Auth\AdminLogController@login')->name('admin.login.submit');
});
Route::get('dashbord', 'DashbordController@index')->name('dashbord');
Route::get('/search', 'PostsController@search');

Route::get('cat/{cats}', [
    'as'     => 'cats.searchcat',
    'uses' => 'PostsController@searchcat',
]);
