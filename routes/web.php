<?php

use App\Http\Controllers\ChecklistController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MarkdownController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\OccurrenceController;
use App\Http\Controllers\ProjectController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*
|--------------------------------------------------------------------------
| General Routes
|--------------------------------------------------------------------------
*/
Route::view('/', 'pages/home');
Route::view('Portal/', 'pages/home');
Route::view('/tw', 'tw-components');
Route::view('/sitemap', 'pages/sitemap');
Route::view('/usagepolicy', 'pages/usagepolicy');

/*
|--------------------------------------------------------------------------
| Taxon Routes
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'taxon'], function () {
    Route::view('/{tid}', 'pages/taxon/profile');
});

/*
|--------------------------------------------------------------------------
| Checklists Routes
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'checklists'], function () {
    Route::get('/', [ChecklistController::class, 'checklists']);
    Route::get('/{clid}', [ChecklistController::class, 'checklist']);
});

/*
|--------------------------------------------------------------------------
| Project Routes
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => '/projects'], function () {
    Route::get('/{pid}', [ProjectController::class, 'project']);
    Route::get('/{pid}/edit', [ProjectController::class, 'editProject']);
});

/*
|--------------------------------------------------------------------------
| Occurrence Routes
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => '/occurrence'], function () {
    Route::get('/{occid}', [OccurrenceController::class, 'profilePage']);
    Route::get('/{occid}/edit', [OccurrenceController::class, 'editPage']);
});

/*
|--------------------------------------------------------------------------
| Collections Routes
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => '/collections'], function () {
    Route::get('/search', [CollectionController::class, 'searchPage']);
    Route::get('/table', [CollectionController::class, 'tablePage']);
    Route::get('/list', [CollectionController::class, 'listPage']);
    Route::get('/{collid}', [CollectionController::class, 'collection']);
});

/*
|--------------------------------------------------------------------------
| Media Routes
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => '/media'], function () {
    Route::get('/search', [MediaController::class, 'searchPage']);
});

/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
*/
Route::get('/user/profile', function (Request $request) {
    $tokens = $request->user()->tokens;

    return view('pages/user/profile', ['user_tokens' => $tokens]);
});

Route::post('/token/create', function (Request $request) {
    $user = $request->user();

    $token = $user->createToken($request->token_name);

    return view(
        'pages/user/profile',
        ['user_tokens' => $user->tokens ?? [], 'created_token' => $token->plainTextToken])
        ->fragment('tokens');
});
Route::delete('/token/delete/{id}', function (int $token_id) {
    $user = request()->user();
    $token = $user->tokens()->where('id', $token_id)->delete();

    return view(
        'pages/user/profile',
        ['user_tokens' => $user->tokens ?? []])
        ->fragment('tokens');
});

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/
Route::get('/logout', [LoginController::class, 'logout']);
Route::group(['prefix' => '/auth'], function () {
    Route::get('/redirect', function (Request $request) {
        return Socialite::driver('orcid')->redirect();
    });
    Route::get('/oauth/orcid', function () {
        $orcid_user = Socialite::driver('orcid')->user();

        $user = User::updateOrCreate([
            'guid' => $orcid_user->id,
            'oauth_provider' => 'orcid',
        ],
            [
                'name' => $orcid_user->name,
                'firstName' => $orcid_user->attributes['firstName'],
                'lastName' => $orcid_user->attributes['lastName'],
                'email' => $orcid_user->email ?? null,
                //'guid' => $orcid_user->id,
                'access_token' => $orcid_user->token,
                'refresh_token' => $orcid_user->refreshToken,
            ]);

        Auth::login($user);

        return redirect('/');
    });
});

/* Documenation */
Route::get('docs/{path}', MarkdownController::class)->where('path', '.*');
