@php
$navigations = [
    ["title" => __("header.home"), "link" => '/'],
    ["title" => __("header.collections"), "link" => '/collections/search/'],
    ["title" => __("header.map_search"), "link" => config('portal.name') . '/collections/map'],
    ["title" => __("header.species_checklists"), "link" => config('portal.name') . '/checklists'],
    ["title" => __("header.images"), "link" => config('portal.name') . '/imagelib/search.php'],
    ["title" => __("header.data_use"), "link" => '/usagepolicy'],
    ["title" => __("header.symbiota_help"), "link" => 'https://biokic.github.io/symbiota-docs/'],
    ["title" => __("header.sitemap"), "link" => '/sitemap'],
];

$logos = [
    [
        "img" => url('/images/logo_nsf.gif'),
        "link" => 'https://www.nsf.gov',
        "title" => 'NSF'
    ],
    [
        "img" =>url('/images/logo_idig.png'),
        "link" => 'http://idigbio.org',
        "title" => 'iDigBio'
    ],
    [
        "img" => url('/images/logo-asu-biokic.png'),
        "link" => 'https://biokic.asu.edu',
        "title" => 'Biodiversity Knowledge Integration Center'
    ],
];

$grants= [
    [
        "link" => 'https://www.nsf.gov',
        "label" => '#-------',
        "grant_id" => ''
    ],
];
@endphp

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    @vite(['resources/js/app.js','resources/css/app.css'])
    @stack('css-styles')
    @stack('js-libs')
</head>

<body id="app-body" class="min-h-screen flex flex-col bg-base-100 text-base-content">
    <x-header />
    <x-navbar :navigations="$navigations" />
    <div {{ $attributes->twMerge('flex-grow') }} >
        {{ $slot }}
    </div>
    <div class="bg-base-200 p-8">
        <x-footer :logos="$logos" :grants="$grants" />
    </div>
    @stack('js-scripts')
</body>

</html>
