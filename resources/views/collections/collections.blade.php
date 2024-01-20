@php
/*
    function formatCollection($collection) {
        $abr = $collection['instcode'] . (('-' . $collection['collcode']) ?? '');
        return $collection['collname'] . ' (' . $abr . ')';
    }*/
$LANG_TAG = App::currentLocale();
$SERVER_ROOT = base_path('public/' . config('portal.name'));
$CLIENT_ROOT = config('portal.name');

//LANG_TAGS
include_once(base_path('public/' . config('portal.name')) . '/content/lang/index.' . $LANG_TAG . '.php');
include_once(base_path('public/' . config('portal.name')) . '/content/lang/collections/sharedterms.' . $LANG_TAG . '.php');
include_once(base_path('public/' . config('portal.name')) . '/content/lang/collections/harvestparams.' . $LANG_TAG . '.php');
include_once(base_path('public/' . config('portal.name')) . '/content/lang/collections/misc/collstats.' . $LANG_TAG . '.php');

//Classes
include_once(base_path('public/' . config('portal.name')) . '/classes/CollectionMetadata.php');
include_once(base_path('public/' . config('portal.name')) . '/classes/DatasetsMetadata.php');
include_once($SERVER_ROOT . '/classes/OccurrenceManager.php');

$collManager = new OccurrenceManager();
$collectionSource = $collManager->getQueryTermStr();

$SHOULD_INCLUDE_CULTIVATED_AS_DEFAULT = $SHOULD_INCLUDE_CULTIVATED_AS_DEFAULT ?? false;
$collData = new CollectionMetadata();
$siteData = new DatasetsMetadata();

@endphp

@push('css-styles')
    <link href="/{{ config('portal.name') }}/collections/search/css/main.css?ver=1" type="text/css" rel="stylesheet" />
    <link href="/{{ config('portal.name') }}/collections/search/css/app.css" type="text/css" rel="stylesheet" />
    <link href="/{{ config('portal.name') }}/collections/search/css/tables.css" type="text/css" rel="stylesheet" />
    <link href="/{{ config('portal.name') }}/css/v202209/symbiota/collections/sharedCollectionStyling.css" type="text/css" rel="stylesheet" />
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
@endpush

@push('js-libs')
	<script src="/{{ config('portal.name')}}/js/jquery-3.2.1.min.js" type="text/javascript"></script>
@endpush

@push('js-scripts')
    <script src="/{{ config('portal.name')}}/collections/search/js/searchform.js" type="text/javascript"></script>
    <script src="/{{ config('portal.name')}}/collections/search/js/alerts.js?v=202107" type="text/javascript"></script>
    <script src="/{{ config('portal.name')}}/js/jquery-ui-1.12.1/jquery-ui.min.js" type="text/javascript"></script>
    <script src="/{{ config('portal.name')}}/js/symb/api.taxonomy.taxasuggest.js" type="text/javascript"></script>
    <script src="/{{ config('portal.name')}}/js/symb/collections.index.js?ver=20171215" type="text/javascript"></script>
@endpush

<x-layout>
    <div id="innertext" class="inner-search">
		<h1>Sample Search</h1>
		<div id="error-msgs" class="errors"></div>
		<form id="params-form" action="javascript:void(0);">
			<!-- Criteria forms -->
			<div class="accordions">
				<!-- Taxonomy -->
				<section>
					<!-- Accordion selector -->
					<input type="checkbox" id="taxonomy" class="accordion-selector" checked />

					<!-- Accordion header -->
					<label for="taxonomy" class="accordion-header">Taxonomy</label>

					<!-- Taxonomy -->
					<div id="search-form-taxonomy" class="content">
						<div id="taxa-text" class="input-text-container">
							<label for="taxa" class="input-text--outlined">
								<span class="skip-link">Taxon</span>
								<input type="text" name="taxa" id="taxa" data-chip="Taxa">
								<span data-label="Taxon"></span>
							</label>
							<span class="assistive-text">Type at least 4 characters for quick suggestions. Separate multiple with commas.</span>
						</div>
						<div class="select-container">
							<label for="taxontype" class="skip-link">Taxon type</label>
							<select name="taxontype" id="taxontype">
								<option value="1">Any name</option>
								<option value="2">Scientific name</option>
								<option value="3">Family</option>
								<option value="4">Taxonomic group</option>
								<option value="5">Common name</option>
							</select>
							<span class="assistive-text">Taxon type</span>
						</div>
						<div>
							<input type="checkbox" name="usethes" id="usethes" data-chip="Include Synonyms" value="1" checked>
							<label for="usethes">
								<span class="ml-1">Include Synonyms</span>
							</label>
						</div>
					</div>
				</section>
				<!-- Collections -->
				<section>
					<!-- Accordion selector -->
					<input type="checkbox" id="collections" class="accordion-selector" checked />
					<!-- Accordion header -->
					<label for="collections" class="accordion-header">Collections</label>
					<!-- Accordion content -->
					<div class="content">
						<div id="search-form-colls">
							<!-- Open Collections modal -->
							<div id="specobsdiv">
							<!-- TODO .collecitonContent.php

                            -->
							</div>

						</div>
					</div>
				</section>

				<!-- Sample Properties -->
				<section>
					<!-- Accordion selector -->
					<input type="checkbox" id="sample" class="accordion-selector" checked />
					<!-- Accordion header -->
					<label for="sample" class="accordion-header">Sample Properties</label>
					<!-- Accordion content -->
					<div class="content">
						<div id="search-form-sample">
							<div>
								<div>
									<input type="checkbox" name="includeothercatnum" id="includeothercatnum" value="1" data-chip="Include other IDs" checked>
									<label for="includeothercatnum">Include other catalog numbers and GUIds</label>
								</div>
								<div class="input-text-container">
									<label for="catnum" class="input-text--outlined">
										<span class="skip-link">Catalog Number</span>
										<input type="text" name="catnum" id="catnum" data-chip="Catalog Number">
										<span data-label="Catalog Number"></span>
									</label>
									<span class="assistive-text">Separate multiple with commas.</span>
								</div>
							</div>
							<div>
								<div>
									<input type='checkbox' name='typestatus' id='typestatus' value='1' data-chip="Only type specimens" />
									<label for="typestatus">{{ isset($LANG['TYPE'])?$LANG['TYPE']:'Limit to Type Specimens Only' }}</label>
								</div>
								<div>
									<input type="checkbox" name="hasimages" id="hasimages" value=1 data-chip="Only with images">
									<label for="hasimages">Limit to specimens with images</label>
								</div>
								<div>
									<input type="checkbox" name="hasgenetic" id="hasgenetic" value=1 data-chip="Only with genetic">
									<label for="hasgenetic">Limit to specimens with genetic data</label>
								</div>
								<div>
									<input type='checkbox' name='hascoords' id='hascoords' value='1' data-chip="Only with coordinates" />
									<label for="hascoords">{{ isset($LANG['HAS_COORDS'])?$LANG['HAS_COORDS']:'Limit to Specimens with Geocoordinates Only' }}</label>
								</div>
								<div>
									<input type='checkbox' name='includecult' id='includecult' value='1' data-chip="Include cultivated" {{ $SHOULD_INCLUDE_CULTIVATED_AS_DEFAULT ? 'checked' : '' }} />
									<label for="includecult">{{ isset($LANG['INCLUDE_CULTIVATED'])?$LANG['INCLUDE_CULTIVATED']:'Include cultivated/captive occurrences' }}</label>
								</div>
							</div>
						</div>
					</div>
				</section>

				<!-- Locality -->
				<section>
					<!-- Accordion selector -->
					<input type="checkbox" id="locality" name="locality" class="accordion-selector" />
					<!-- Accordion header -->
					<label for="locality" class="accordion-header">Locality</label>
					<!-- Accordion content -->
					<div class="content">
						<div id="search-form-locality">
							<div>
								<div>
									<div class="input-text-container">
										<label for="country" class="input-text--outlined">
											<span class="skip-link">Country</span>
											<input type="text" name="country" id="country" data-chip="Country">
											<span data-label="Country"></span>
										</label>
										<span class="assistive-text">Separate multiple with commas.</span>
									</div>
									<div class="input-text-container">
										<label for="state" class="input-text--outlined">
											<span class="skip-link">State</span>
											<input type="text" name="state" id="state" data-chip="State">
											<span data-label="State"></span>
										</label>
										<span class="assistive-text">Separate multiple with commas.</span>
									</div>
									<div class="input-text-container">
										<label for="county" class="input-text--outlined">
											<span class="skip-link">County</span>
											<input type="text" name="county" id="county" data-chip="County">
											<span data-label="County"></span>
										</label>
										<span class="assistive-text">Separate multiple with commas.</span>
									</div>
									<div class="input-text-container">
										<label for="local" class="input-text--outlined">
											<span class="skip-link">Locality/Localities</span>
											<input type="text" name="local" id="local" data-chip="Locality">
											<span data-label="Locality/Localities"></span>
										</label>
										<span class="assistive-text" style="line-height:1.7em">Separate multiple with commas.</span>
									</div>
								</div>
								<div class="grid grid--half">
									<div class="input-text-container">
										<label for="elevlow" class="input-text--outlined">
											<span class="skip-link">Minimum Elevation</span>
											<input type="number" step="any" name="elevlow" id="elevlow" data-chip="Min Elevation">
											<span data-label="Minimum Elevation"></span>
										</label>
										<span class="assistive-text">Number in meters.</span>
									</div>
									<div class="input-text-container">
										<label for="elevhigh" class="input-text--outlined">
											<span class="skip-link">Maximum Elevation</span>
											<input type="number" step="any" name="elevhigh" id="elevhigh" data-chip="Max Elevation">
											<span data-label="Maximum Elevation"></span>
										</label>
										<span class="assistive-text">Number in meters.</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>

				<!-- Latitude & Longitude -->
				<section>
					<!-- Accordion selector -->
					<input type="checkbox" id="lat-long" class="accordion-selector" />
					<!-- Accordion header -->
					<label for="lat-long" class="accordion-header">Latitude & Longitude</label>
					<!-- Accordion content -->
					<div class="content">
						<div id="search-form-latlong">
							<div id="bounding-box-form">
								<h3>Bounding Box</h3>
								<button onclick="openCoordAid('rectangle');return false;">Select in map (BB)</button>
								<div class="input-text-container">
										<label for="upperlat" class="input-text--outlined">
											<span class="skip-link">Upper latitude</span>
											<input type="number" step="any" min="-90" max="90" id="upperlat" name="upperlat" data-chip="Upper Lat">
											<span data-label="_Northern Latitude"></span>
											<span class="assistive-text">Values between -90 and 90.</span>
										</label>

										<label for="upperlat_NS" class="input-text--outlined">
											<span class="skip-link">Select upper lat direction N/S</span>
											<select class="mt-1" id="upperlat_NS" name="upperlat_NS">
												<option value="">Select N/S</option>
												<option id="ulN" value="N">N</option>
												<option id="ulS" value="S">S</option>
											</select>
										</label>
								</div>
								<div class="input-text-container">
									<label for="bottomlat" class="input-text--outlined">
										<span class="skip-link">Bottom latitude</span>
										<input type="number" step="any" min="-90" max="90" id="bottomlat" name="bottomlat" data-chip="Bottom Lat">
										<span data-label="_Southern Latitude"></span>
										<span class="assistive-text">Values between -90 and 90.</span>
									</label>
									<label for="bottomlat_NS">
										<span class="skip-link">Select bottom lat direction N/S</span>
										<select class="mt-1" id="bottomlat_NS" name="bottomlat_NS">
											<option value="">Select N/S</option>
											<option id="blN" value="N">N</option>
											<option id="blS" value="S">S</option>
										</select>
									</label>
								</div>
								<div class="input-text-container">
									<label for="leftlong" class="input-text--outlined">
										<span class="skip-link">Left longitude</span>
										<input type="number" step="any" min="-180" max="180" id="leftlong" name="leftlong" data-chip="Left Long">
										<span data-label="_Western Longitude"></span>
										<span class="assistive-text">Values between -180 and 180.</span>
									</label>
									<label for="leftlong_EW" class="input-text--outlined">
										<span class="skip-link">Select left long direction W/E</span>
										<select class="mt-1" id="leftlong_EW" name="leftlong_EW">
											<option value="">Select W/E</option>
											<option id="llW" value="W">W</option>
											<option id="llE" value="E">E</option>
										</select>
									</label>
								</div>
								<div class="input-text-container">
									<label for="rightlong" class="input-text--outlined">
										<span class="skip-link">Right longitude</span>
										<input type="number" step="any" min="-180" max="180" id="rightlong" name="rightlong" data-chip="Right Long">
										<span data-label="_Eastern Longitude"></span>
										<span class="assistive-text">Values between -180 and 180.</span>
									</label>
										<label for="rightlong_EW" class="input-text--outlined">
											<span class="skip-link">Select right long direction W/E</span>
											<select class="mt-1" id="rightlong_EW" name="rightlong_EW">
												<option value="">Select W/E</option>
												<option id="rlW" value="W">W</option>
												<option id="rlE" value="E">E</option>
											</select>
										</label>
								</div>
							</div>
							<div id="polygon-form">
								<h3>Polygon (WKT footprint)</h3>
								<button onclick="openCoordAid('polygon');return false;">Select in map (Polygon)</button>
								<div class="text-area-container">
									<label for="footprintwkt" class="text-area--outlined">
										<span class="skip-link">Polygon</span>
										<textarea id="footprintwkt" name="footprintwkt" class="full-width-pcnt" rows="5"></textarea>
										<span data-label="Polygon"></span>
									</label>
									<span class="assistive-text">Select in map with button or paste values.</span>
								</div>
							</div>
							<div id="point-radius-form">
								<h3>Point-Radius</h3>
								<button onclick="openCoordAid('circle');return false;">Select in map (PR)</button>
								<div class="input-text-container">
									<label for="pointlat" class="input-text--outlined">
										<span class="skip-link">Point latitude</span>
										<input type="number" step="any" min="-90" max="90" id="pointlat" name="pointlat" data-chip="Point Lat">
										<span data-label="_Latitude"></span>
										<span class="assistive-text">Values between -90 and 90.</span>
									</label>
									<label for="pointlat_NS" class="input-text--outlined">
										<span class="skip-link">Point latitude direction N/S</span>
										<select class="mt-1" id="pointlat_NS" name="pointlat_NS">
											<option value="">Select N/S</option>
											<option id="N" value="N">N</option>
											<option id="S" value="S">S</option>
										</select>
									</label>
								</div>
								<div class="input-text-container">
									<label for="pointlong" class="input-text--outlined">
										<span class="skip-link">Point longitude</span>
										<input type="number" step="any" min="-180" max="180" id="pointlong" name="pointlong" data-chip="Point Long">
										<span data-label="_Longitude"></span>
										<span class="assistive-text">Values between -180 and 180.</span>
									</label>
									<label for="pointlong_EW" class="input-text--outlined">
										<span class="skip-link">Point longitude direction E/W</span>
										<select class="mt-1" id="pointlong_EW" name="pointlong_EW">
											<option value="">Select W/E</option>
											<option id="W" value="W">W</option>
											<option id="E" value="E">E</option>
										</select>
									</label>
								</div>
								<div class="input-text-container">
									<label for="radius" class="input-text--outlined">
										<span class="skip-link">Radius</span>
										<input type="number" min="0" step="any" id="radius" name="radius" data-chip="Radius">
										<span data-label="_Radius"></span>
										<span class="assistive-text">Any positive values.</span>
									</label>
									<label for="radiusunits" class="input-text--outlined">
										<span class="skip-link">Select radius units</span>
										<select class="mt-1" id="radiusunits" name="radiusunits">
											<option value="">Select Unit</option>
											<option value="km">Kilometers</option>
											<option value="mi">Miles</option>
										</select>
									</label>
								</div>
							</div>
						</div>
					</div>
				</section>
				<!-- Collecting Event -->
				<section>
					<!-- Accordion selector -->
					<input type="checkbox" id="coll-event" class="accordion-selector" />
					<!-- Accordion header -->
					<label for="coll-event" class="accordion-header">Collecting Event</label>
					<!-- Accordion content -->
					<div class="content">
						<div id="search-form-coll-event">
							<div class="input-text-container">
								<label for="eventdate1" class="input-text--outlined">
									<span class="skip-link">Collection Start Date</span>
									<input type="text" name="eventdate1" id="eventdate1" data-chip="Event Date Start">
									<span data-label="Collection Start Date"></span>
								</label>
								<span class="assistive-text">Single date or start date of range (ex: YYYY-MM-DD or similar format).</span>
							</div>
							<div class="input-text-container">
								<label for="eventdate2" class="input-text--outlined">
									<span class="skip-link">Collection End Date</span>
									<input type="text" name="eventdate2" id="eventdate2" data-chip="Event Date End">
									<span data-label="Collection End Date"></span>
								</label>
								<span class="assistive-text">Single date or end date of range (ex: YYYY-MM-DD or similar format).</span>
							</div>
							<div class="input-text-container">
								<label for="collector" class="input-text--outlined">
									<span class="skip-link">Collector Last Name</span>
									<input type="text" id="collector" size="32" name="collector" value="" title="{{ $LANG['SEPARATE_MULTIPLE'] }}" data-chip="Collector last" />
									<span data-label="{{ $LANG['COLLECTOR_LASTNAME'] }}:"></span>
								</label>
							</div>
							<div class="input-text-container">
								<label for="collnum" class="input-text--outlined">
									<span class="skip-link">Collector Number</span>
									<input type="text" id="collnum" size="31" name="collnum" value="" title="{{ $LANG['TITLE_TEXT_2'] }}" data-chip="Collector num" />
									<span data-label="{{ $LANG['COLLECTOR_NUMBER'] }}:"></span>
								</label>
							</div>
						</div>
					</div>
				</section>
            </div>

			<!-- Criteria panel -->
			<div id="criteria-panel" style="position: sticky; top: 0; height: 100vh">
				<button id="search-btn" onclick="simpleSearch()">Search</button>
				<button id="reset-btn">Reset</button>
				<h2>Criteria</h2>
				<div id="chips"></div>
			</div>
		</form>
    </div>
</x-layout>
