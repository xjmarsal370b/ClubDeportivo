<?php

use App\Models\Event;
use App\Models\PostCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $events = Event::paginate( 3 );
    $categories = PostCategory::all();
    return view('welcome', compact('events', 'categories'));
});
Route::get('userVerification/{token}', 'UserVerificationController@approve')->name('userVerification');
Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Event
    Route::delete('events/destroy', 'EventController@massDestroy')->name('events.massDestroy');
    Route::post('events/media', 'EventController@storeMedia')->name('events.storeMedia');
    Route::post('events/ckmedia', 'EventController@storeCKEditorImages')->name('events.storeCKEditorImages');
    Route::resource('events', 'EventController');

    // Post
    Route::delete('posts/destroy', 'PostController@massDestroy')->name('posts.massDestroy');
    Route::post('posts/media', 'PostController@storeMedia')->name('posts.storeMedia');
    Route::post('posts/ckmedia', 'PostController@storeCKEditorImages')->name('posts.storeCKEditorImages');
    Route::resource('posts', 'PostController');

    // Transportation
    Route::delete('transportations/destroy', 'TransportationController@massDestroy')->name('transportations.massDestroy');
    Route::resource('transportations', 'TransportationController');

    // Event Organizer
    Route::delete('event-organizers/destroy', 'EventOrganizerController@massDestroy')->name('event-organizers.massDestroy');
    Route::resource('event-organizers', 'EventOrganizerController');

    // Post Category
    Route::delete('post-categories/destroy', 'PostCategoryController@massDestroy')->name('post-categories.massDestroy');
    Route::resource('post-categories', 'PostCategoryController');

    // Result
    Route::delete('results/destroy', 'ResultController@massDestroy')->name('results.massDestroy');
    Route::post('results/media', 'ResultController@storeMedia')->name('results.storeMedia');
    Route::post('results/ckmedia', 'ResultController@storeCKEditorImages')->name('results.storeCKEditorImages');
    Route::resource('results', 'ResultController');

    Route::get('system-calendar', 'SystemCalendarController@index')->name('systemCalendar');
});

Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});

Route::group(['as' => 'frontend.', 'namespace' => 'Frontend', 'middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Event
    Route::delete('events/destroy', 'EventController@massDestroy')->name('events.massDestroy');
    Route::post('events/media', 'EventController@storeMedia')->name('events.storeMedia');
    Route::post('events/ckmedia', 'EventController@storeCKEditorImages')->name('events.storeCKEditorImages');
    Route::resource('events', 'EventController');

    // Post
    Route::delete('posts/destroy', 'PostController@massDestroy')->name('posts.massDestroy');
    Route::post('posts/media', 'PostController@storeMedia')->name('posts.storeMedia');
    Route::post('posts/ckmedia', 'PostController@storeCKEditorImages')->name('posts.storeCKEditorImages');
    Route::resource('posts', 'PostController');

    // Transportation
    Route::delete('transportations/destroy', 'TransportationController@massDestroy')->name('transportations.massDestroy');
    Route::resource('transportations', 'TransportationController');

    // Event Organizer
    Route::delete('event-organizers/destroy', 'EventOrganizerController@massDestroy')->name('event-organizers.massDestroy');
    Route::resource('event-organizers', 'EventOrganizerController');

    // Post Category
    Route::delete('post-categories/destroy', 'PostCategoryController@massDestroy')->name('post-categories.massDestroy');
    Route::resource('post-categories', 'PostCategoryController');

    // Result
    Route::delete('results/destroy', 'ResultController@massDestroy')->name('results.massDestroy');
    Route::post('results/media', 'ResultController@storeMedia')->name('results.storeMedia');
    Route::post('results/ckmedia', 'ResultController@storeCKEditorImages')->name('results.storeCKEditorImages');
    Route::resource('results', 'ResultController');

    Route::get('frontend/profile', 'ProfileController@index')->name('profile.index');
    Route::post('frontend/profile', 'ProfileController@update')->name('profile.update');
    Route::post('frontend/profile/destroy', 'ProfileController@destroy')->name('profile.destroy');
    Route::post('frontend/profile/password', 'ProfileController@password')->name('profile.password');
});
