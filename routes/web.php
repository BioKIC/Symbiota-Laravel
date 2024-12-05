<?php

use App\Http\Controllers\LegacyController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MarkdownController;
use App\Http\Controllers\RegistrationController;
use App\Models\User;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
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

/* Orcid Oauth */
Route::get('/oauth/orcid', function() {
    $orcid_user = Socialite::driver('orcid')->user();

    $user = User::updateOrCreate([
        'guid' => $orcid_user->id,
        'oauth_provider' => 'orcid'
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

Route::get('/auth/redirect', function(Request $request) {
    return Socialite::driver('orcid')->redirect();
});

/* Simple View Routes */
Route::view('/', 'pages/home');
Route::view('Portal/', 'pages/home');
Route::view('/tw', 'tw-components');
Route::view('/sitemap', 'pages/sitemap');
Route::view('/usagepolicy', 'pages/usagepolicy');

/* In Progress Skeletons */
Route::view('/collections/search', 'pages/collections');
Route::view('/taxon', 'pages/taxon/profile');

Route::view('/user/profile', 'pages/user/profile');

// Collection
Route::get('/collections/list', function(Request $request) {
    $params = $request->except(['page', '_token']);

    Cache::forget($request->fullUrl());
    $occurrences = Cache::remember($request->fullUrl(), now()->addMinutes(1), function() use ($params) {
        if(count($params) === 0) {
            return [];
        }

        $query = DB::table('omoccurrences as o')
            ->select(
                'o.*',
                DB::raw('sum(if(media_type = "image", 1, 0)) as image_cnt'),
                DB::raw('sum(if(media_type = "audio", 1, 0)) as audio_cnt'))
            ->leftJoin('media as m', 'm.occid', '=', 'o.occid')
            ->join('omcollections as c', 'c.collid', '=', 'o.collid')
            ->groupBy('o.occid');

        if(isset($params['taxa'])) {
            $query->whereLike('o.sciname', $params['taxa']);
        }

        return $query->paginate(30)->appends($params);
    });

    return view('pages/collections/list', ['occurrences' => $occurrences]);
});

Route::get('/collections/table', function (Request $request){
    $collection = DB::table('omcollections')->where('collid', '=', $request->query('collid'))->select('*')->first();

    $query = DB::table('omoccurrences as o')
        ->join('omcollections as c', 'c.collid', '=', 'o.collid')
        ->where('c.collid', '=', $request->query('collid'))
       // ->where('o.family', '=', 'Apiaceae')
        ->select('*');

    $sortables = [
        'occid',
        'institutionCode',
        'catalogNumber',
        'otherCatalogNumbers',
        'family',
        'sciname',
        'scientificNameAuthorship',
        'recordedBy',
        'recordNumber',
        'associatedCollectors',
        'eventDate',
        'verbatimEventDate',
        'identifiedBy',
        'country',
        'stateProvince',
        'county',
        'locality',
        'latitudeDecimal',
        'longitudeDecimal',
        'coordinateUncertaintyInMeters',
        'verbatimCoordinates',
        'geodeticDatum',
        'georeferencedBy',
        'georeferenceSources',
        'georeferenceVerificationStatus',
        'georeferenceRemarks',
        'minimumElevationInMeters',
        'maximumElevationInMeters',
        'verbatimElevation',
        'habitat',
        'substrate',
        'occurrenceRemarks',
        'associatedTaxa',
        'lifeStage',
        'dateLastModified',
        'processingStatus',
        'recordEnteredBy',
        'basisOfRecord'
    ];

    foreach ($sortables as $property) {
        if($request->query($property)) {
            $query->where('o.' . $property, '=', $request->query($property));
        }
    }

    if($request->query('sort')) {
        if(($idx = array_search($request->query('sort'), $sortables)) > 0) {
            $query->orderByRaw('ISNULL(o.'. $sortables[$idx].') ASC');
        }
        $query->orderBy(
            $request->query('sort'),
            $request->query('sortDirection') === 'DESC'? 'DESC' : 'ASC'
        );
    }

    if($request->query('hasImages')) {
        if($request->query('hasImages') === 'with_images') {
            $query->whereIn('o.occid', function(Builder $query) {
                $query->select('i.occid')->from('images as i')->groupBy('i.occid');
            });
        } else if($request->query('hasImages') === 'without_images') {
            $query->whereNotIn('o.occid', function(Builder $query) {
                $query->select('i.occid')->from('images as i')->groupBy('i.occid');
            });
        }
    }

    $view = view('pages/collections/table', [
        'occurrences' => $query->paginate(100),
        'collection' => $collection,
        'page' => $request->query('page') ?? 0
    ]);

    if($request->header('HX-Request')) {
        if($request->query('fragment') === 'rows') {
            return $view->fragment('rows');
        } else if ($request->query('fragment') === 'table') {
            return $view->fragment('table');
        }
    }

    return $view;
});

// Checklist
Route::get('/checklist/{clid}', function(int $clid) {
    $checklist = DB::table('fmchecklists as c')
        ->select('*')
        ->where('c.clid', '=', $clid)
        ->first();

    return view('pages/checklist/profile', ['checklist' => $checklist]);
});


Route::get('/checklists', function (Request $request){
    $checklists = DB::table('fmchecklists as c')
        ->select('proj.pid', 'c.clid', 'c.name', 'projname', 'mapChecklist')
        ->leftJoin('fmchklstprojlink as link', 'link.clid', '=', 'c.clid')
        ->leftJoin('fmprojects as proj', 'proj.pid', '=', 'link.pid')
        ->orderByRaw('-proj.pid DESC')
        ->get();

    return view('pages/checklists', ['checklists' => $checklists]);
});

Route::get('/project', function (Request $request){
    $project = DB::table('fmprojects')
        ->select('pid', 'projname', 'managers')
        ->where('pid', '=', request('pid'))
        ->first();

    $checklists = DB::table('fmchecklists as c')
        ->select('link.pid', 'c.clid', 'c.name', 'mapChecklist')
        ->leftJoin('fmchklstprojlink as link', 'link.clid', '=', 'c.clid')
        ->where('link.pid', '=', request('pid'))
        ->orderByRaw('-link.pid DESC')
        ->get();

    return view('pages/project', ['project' => $project, 'checklists' => $checklists]);
});

//occurrence
Route::get('/occurrence/{occid}', function(int $occid) {
    $occurrence = DB::table('omoccurrences as o')
        ->select('*')
        ->where('o.occid', '=', $occid)
        ->first();

    return view('pages/occurrence/profile', ['occurrence' => $occurrence]);
});

Route::get('/occurrence/{occid}/edit', function(int $occid) {
    $occurrence = DB::table('omoccurrences as o')
        ->select('*')
        ->where('o.occid', '=', $occid)
        ->first();

    return view('pages/occurrence/editor', ['occurrence' => $occurrence]);
});

/* Login/out routes */
/*
Route::get('/login', LoginController::class);
Route::post('/login', [LoginController::class, 'login']);
Route::post('/signup', [RegistrationController::class, 'register']);
Route::get('/signup', RegistrationController::class);
*/

Route::get('/logout', [LoginController::class, 'logout']);

Route::get('/media/search', function (Request $request) {
    $media = [];
    $start = $request->query('start') ?? 0;
    if(count($request->all()) > 0) {
        $media = DB::table('media as m')
            ->leftJoin('taxa as t', 't.tid', '=', 'm.tid')
            ->leftJoin('users as u', 'u.uid', '=', 'm.creatoruid')
            ->leftJoin('omoccurrences as o', 'o.occid', '=', 'm.occid')
            ->when($request->query('media_type'), function(Builder $query, $type) {
                $query->where('m.media_type', '=', $type);
            })
            ->when($request->query('tid'), function(Builder $query, $tid) {
                $query->whereIn('t.tid', is_array($tid)? $tid: [$tid]);
            })
            ->when($request->query('taxa'), function(Builder $query, $taxa) {
                $query->whereIn('t.sciName', array_map('trim', explode(',', $taxa)));
            })
            ->when($request->query('uid'), function(Builder $query, $uid) {
                $query->where('u.uid', '=', $uid);
            })
            ->when($request->query('tag'), function(Builder $query, $tag) {
                $query->leftJoin('imagetag as tag', 'tag.imgid', '=', 'm.media_id')
                    ->leftJoin('imagetagkey as imgkey', 'imgkey.tagkey', '=', 'tag.keyvalue')
                    ->where('imgkey.tagkey', '=', $tag);
            })
            /* Requires strict mode currently
            ->when($request->query('resource_counts'), function(Builder $query, $group) {
                if($group === 'one_per_taxon') {
                    $query->groupBy('t.tid');
                } else if($group = 'one_per_specimen') {
                    $query->groupBy('o.occid');
                }
            })
            */
            ->select('m.url', 'm.thumbnailUrl', 't.sciName', 'o.occid')
            ->limit(30)
            ->offset($start)
            ->get();
        if($request->query('partial')) {
            $query_params = $request->except('partial');
            $query_params['start'] = $start;

            $base_url = $request->header('referer') ?? url()->current();
            $base_url = substr($base_url, 0, strpos('?', $base_url));

            $new_url = $base_url .
                '?' .
                http_build_query($query_params);
            return response(view('media/item', ['media' => $media ]))
                ->header('HX-Replace-URL', $new_url);
        }
    }

    $creators = DB::table('users as u')
        ->join('media as m', 'm.creatoruid', '=', 'u.uid')
        ->select('uid','name')
        ->distinct()
        ->get();

    $tag_options = DB::table('imagetagkey as key')
        ->select('tagkey')
        ->get();

    return view('pages/media/search', ['media' => $media, 'creators' => $creators, 'tags' => $tag_options]);
});

/* Documenation */
Route::get('docs/{path}', MarkdownController::class)->where('path', '.*');
