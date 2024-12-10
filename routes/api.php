<?php

use App\Http\Controllers\CollectionController;
use App\Http\Controllers\InstallationController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\InventoryPackageController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\OccurrenceAnnotationController;
use App\Http\Controllers\OccurrenceController;
use App\Http\Controllers\TaxonomyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/taxa/search', function (Request $request) {
    $sciname = $request->query('taxa');
    $format = strtolower($request->query('format', 'html'));
    $result = DB::select('SELECT sciname, tid FROM taxa WHERE sciname LIKE ? LIMIT 20', ['%' . $sciname . '%']);

    if ($format === 'json') {
        return $result;
    } else {
        return view(
            'core/autocomplete/result',
            ['data' => $result, 'label' => 'sciname', 'value' => 'tid']
        );
    }
});

Route::get('/', function () {
    return app()->version();
});

Route::get('/v2', function () {
    //return redirect('/v2/documentation');
    return view('/vendor/l5-swagger/index');
});

Route::group(['prefix' => 'v2'], function () {
    Route::get('collection', [CollectionController::class, 'showAllCollections']);
    Route::get('collection/{id}', [CollectionController::class, 'showOneCollection']);

    Route::get('occurrence/search', [OccurrenceController::class, 'showAllOccurrences']);

    //Temporarily keep following route until new documentation is created. The one above will be keep so that I follows GBIF API layout
    Route::get('occurrence', [OccurrenceController::class, 'showAllOccurrences']);
    Route::get('occurrence/{id}', [OccurrenceController::class, 'showOneOccurrence']);
    Route::get('occurrence/{id}/media', [OccurrenceController::class, 'showOneOccurrenceMedia']);
    Route::get('occurrence/{id}/identification', [OccurrenceController::class, 'showOneOccurrenceIdentifications']);
    Route::get('occurrence/{id}/annotation', [OccurrenceAnnotationController::class, 'showOccurrenceAnnotations']);
    Route::get('occurrence/{id}/reharvest', [OccurrenceController::class, 'oneOccurrenceReharvest']);
    Route::get('occurrence/annotation/search', [OccurrenceAnnotationController::class, 'showAllAnnotations']);
    Route::post('occurrence/skeletal', [OccurrenceController::class, 'skeletalImport']);
    Route::get('installation', [InstallationController::class, 'showAllPortals']);
    Route::get('installation/ping', [InstallationController::class, 'pingPortal']);
    Route::get('installation/{id}', [InstallationController::class, 'showOnePortal']);
    Route::get('installation/{id}/touch', [InstallationController::class, 'portalHandshake']);
    Route::get('installation/{id}/occurrence', [InstallationController::class, 'showOccurrences']);
    Route::get('inventory', [InventoryController::class, 'showAllInventories']);
    Route::get('inventory/{id}', [InventoryController::class, 'showOneInventory']);
    Route::get('inventory/{id}/taxa', [InventoryController::class, 'showOneInventoryTaxa']);
    Route::get('inventory/{id}/package', [InventoryPackageController::class, 'oneInventoryDataPackage']);
    Route::get('media', [MediaController::class, 'showAllMedia']);
    Route::get('media/{id}', [MediaController::class, 'showOneMedia']);
    Route::get('media/{id}', [MediaController::class, 'showOneMedia']);
    Route::post('media', [MediaController::class, 'insert']);
    Route::patch('media/{id}', [MediaController::class, 'update']);
    Route::patch('media/{id}', [MediaController::class, 'update']);
    Route::delete('media/{id}', [MediaController::class, 'delete']);
    Route::delete('media/{id}', [MediaController::class, 'delete']);
    Route::get('taxonomy', [TaxonomyController::class, 'showAllTaxa']);
    Route::get('taxonomy/search', [TaxonomyController::class, 'showAllTaxaSearch']);
    Route::get('taxonomy/{id}', [TaxonomyController::class, 'showOneTaxon']);

    //Route::get('taxonomy/{id}/description',  [TaxonomyController::class, 'showAllDescriptions']);
    //Route::get('taxonomy/{id}/description/{id}',  [TaxonomyDescriptionController::class, 'showOneDescription']);
});
