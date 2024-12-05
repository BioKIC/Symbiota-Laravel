@props(['collection', 'occurrences' => [], 'page' => 0])
<x-layout class="p-0 h-[100vh] relative" x-data="{ menu_open: false}" :hasFooter="false" :hasHeader="false"
    :hasNavbar="false">
    <div class="pt-4 px-4 flex flex-col gap-2 h-[7rem] relative">
        <x-breadcrumbs :items="[
['title' => 'Home'],
['title' => 'Collection Management', 'href' => url(config('portal.name') . '/collections/misc/collprofiles.php?emode=1&collid='. request('collid'))],
['title' => 'Occurrence Table view'],
]" />
        <div class="text-2xl text-primary font-bold">
            {{$collection->collectionName}} ({{$collection->institutionCode}})
        </div>

        <x-button x-on:click="menu_open = true" class="w-fit absolute right-4">Adjust Search</x-button>
    </div>

    <div class="absolute h-screen w-1/2 min-w-[40rem] bg-base-100 z-[100] top-0 left-0" x-cloak x-show="menu_open">
        <button x-on:click="menu_open = false"
            class="float-right mr-2 mt-2 hover:ring-4 focus:outline-none focus:ring-4 rounded-md w-6 h-6 ring-accent">
            <i class="cursor-pointer fa fas fa-close"></i>
        </button>
        <fieldset class="p-4 flex flex-col gap-4">
            <legend class="text-2xl font-bold">Record Search Form</legend>
            <form id="search_form" hx-get="{{ url('/collections/table') }}" hx-target="#table-container" x-on:htmx:after-request.window="menu_open = false;"
                hx-swap="outerHTML" class="flex flex-col gap-4">
                <input type="hidden" name="collid" value="{{ request('collid') }}">
                <div class="flex gap-4 items-center">
                    <x-input label="Collector" id="recordedBy" />
                    <x-input label="Number" id="recordNumber" />
                    <x-input label="Date" id="eventDate" />
                </div>

                <div class="flex gap-4 items-center">
                    <x-input label="Catalog Number" id="catalogNumber" />
                    <x-input label="Other Catalog Numbers" id="otherCatalogNumbers" />
                </div>

                <div class="flex gap-4 items-center">
                    <x-input label="Entered By" id="recordEnteredBy" />
                    <x-input label="Date Entered" id="dateEntered" />
                    <x-input label="Date Modified" id="dateLastModified" />
                    <x-button class="mt-7">CU</x-button>
                </div>

                <div class="flex gap-4 items-center">
                <x-select class="w-60" name="processingStatus" default="0" :items="[
                    ['title' => 'All Records', 'value' => '', 'disabled' => false],
                    ['title' => 'Unprocessed', 'value'=> 'unprocessed', 'disabled' => false],
                    ['title' => 'Unprocessed/NLP','value'=>'unprocessed/nlp', 'disabled' => false],
                    ['title' => 'Stage 1', 'value'=>'stage 1', 'disabled' => false],
                    ['title' => 'Stage 2', 'value'=>'stage 2', 'disabled' => false],
                    ['title' => 'Stage 3', 'value'=>'stage 3', 'disabled' => false],
                    ['title' => 'Pending Review-nfn', 'value'=>'pending review-nfn', 'disabled' => false],
                    ['title' => 'Pending Review', 'value'=>'pending review', 'disabled' => false],
                    ['title' => 'Expert Required', 'value'=>'expert required', 'disabled' => false],
                    ['title' => 'Reviewed', 'value' =>'reviewed', 'disabled' => false],
                    ['title' => 'Closed', 'value' =>'closed', 'disabled' => false],
                    ['title' => 'No Set Status', 'value' => 'isnull', 'disabled' => false]
                ]" />
                    <x-radio id="hasImages"
                        name="hasImages"
                        :options="[ ['label' => 'All', 'value' => 0], ['label' => 'With Images', 'value' => 'with_images'], ['label' => 'Without Images', 'value' => 'without_images']]"
                    />
                </div>
                @if(false)
                <x-select class="w-full" :items="[
                    ['title' => 'Select Exsiccati', 'value' => null, 'disabled' => false]
                ]" />
                @endif
                <div class="text-2xl font-bold w-full py-10 text-center bg-base-200">
                    TODO CUSTOM FILTERS
                </div>
                @if(false)
                <div class="flex gap-4 items-center">
                    <x-select class="w-full" label="Sort By" :items="[
                    ['title' => '--------', 'value' => null, 'disabled' => false]
                ]" />
                    <x-select class="w-full" label="Order By" :items="[
                    ['title' => '--------', 'value' => null, 'disabled' => false]
                ]" />
                    <x-select class="w-full" label="Record Output" :items="[
                    ['title' => '--------', 'value' => null, 'disabled' => false]
                ]" />
                </div>
                @endif

                <div class="flex gap-4 items-center">
                    {{-- <x-button>Display Editor</x-button> --}}
                    <x-button type="submit">Display Table</x-button>
                    <x-button variant="neutral" onclick="document.getElementById('search_form').reset()">Display Reset
                        Form</x-button>
                </div>
            </form>
        </fieldset>
    </div>
    @php
    $property_display_map = [
    ['label' => 'Symbiota ID', 'name' => 'occid'],
    ['label' => 'Institution Code', 'name' => 'institutionCode'],
    ['label' => 'Catalog Number', 'name' => 'catalogNumber'],
    ['label' => 'Other Catalog Numbers','name' => 'otherCatalogNumbers'],
    ['label' => 'Family', 'name' => 'family'],
    ['label' => 'Scientific Name', 'name' => 'sciname'],
    ['label' => 'Author', 'name' => 'scientificNameAuthorship'],
    ['label' => 'Collector', 'name' => 'recordedBy'],
    ['label' => 'Number', 'name' => 'recordNumber'],
    ['label' => 'Associated Collectors', 'name' => 'associatedCollectors'],
    ['label' => 'Event Date', 'name' => 'eventDate'],
    ['label' => 'Verbatim Date', 'name' => 'verbatimEventDate'],
    ['label' => 'Identified By', 'name' => 'identifiedBy'],
    ['label' => 'Country', 'name' => 'country'],
    ['label' => 'State/Province', 'name' => 'stateProvince'],
    ['label' => 'County', 'name' => 'county'],
    ['label' => 'locality', 'name' => 'locality'],
    ['label' => 'Latitude', 'name' => 'latitudeDecimal'],
    ['label' => 'Longitude', 'name' => 'longitudeDecimal'],
    ['label' => 'Uncertainty In Meters', 'name' => 'coordinateUncertaintyInMeters'],
    ['label' => 'Verbatim Coordinates', 'name' => 'verbatimCoordinates'],
    ['label' => 'Datum', 'name' => 'geodeticDatum'],
    ['label' => 'Georeferenced By', 'name' => 'georeferencedBy'],
    ['label' => 'Georeference Sources', 'name' => 'georeferenceSources'],
    ['label' => 'GeoRef Verification Status', 'name' => 'georeferenceVerificationStatus'],
    ['label' => 'GeoRef Remarks', 'name' => 'georeferenceRemarks'],
    ['label' => 'Elev. Min. (m)', 'name' => 'minimumElevationInMeters'],
    ['label' => 'Elev. Max. (m)', 'name' => 'maximumElevationInMeters'],
    ['label' => 'Verbatim Elev.', 'name' => 'verbatimElevation'],
    ['label' => 'Habitat', 'name' => 'habitat'],
    ['label' => 'Substrate', 'name' => 'substrate'],
    ['label' => 'Notes (Occurrence Remarks)', 'name' => 'occurrenceRemarks'],
    ['label' => 'Associated Taxa', 'name' => 'associatedTaxa'],
    ['label' => 'Description', 'name' => 'lifeStage'],
    ['label' => 'Life Stage', 'name' => 'lifeStage'],
    ['label' => 'Date Last Modified', 'name' => 'dateLastModified'],
    ['label' => 'Processing Status', 'name' => 'processingStatus'],
    ['label' => 'EnteredBy', 'name' => 'recordEnteredBy'],
    ['label' => 'Basis Of Record', 'name' => 'basisOfRecord'],
    ];
    @endphp

    <div x-data="{ occid: null, column: null, column_property: null, column_value: null}">
        <x-context-menu>
            <x-slot:menu>
                <x-context-menu-item x-on:click="menu_open = true">
                    Adjust Search
                </x-context-menu-item>

                <x-context-menu-item type='divider' />

                <x-context-menu-item>
                    <a x-bind:href="'{{ url(config('portal.name') . '/collections/individual/index.php') }}?occid=' + occid">Open Occurrence</a>
                </x-context-menu-item>
                <x-context-menu-item>
                    <a target="_blank" x-bind:href="'{{ url(config('portal.name') . '/collections/individual/index.php') }}?occid=' + occid">Open Occurrence in New
                        Tab</a>
                </x-context-menu-item>

                <x-context-menu-item type='divider' />

                <x-context-menu-item>
                    <a
                        x-bind:href="'{{ url(config('portal.name') . '/collections/editor/occurrenceeditor.php?csmode=1&collid=' . $collection->collID) }}&occid=' + occid">Open
                        Occurrence Edtior</a>
                </x-context-menu-item>
                <x-context-menu-item>
                    <a target="_blank"
                        x-bind:href="'{{ url(config('portal.name') . '/collections/editor/occurrenceeditor.php?csmode=1&collid=' . $collection->collID) }}&occid=' + occid">Open
                        Occurrence Editor in New
                        Tab</a>
                </x-context-menu-item>

                <x-context-menu-item type='divider' />

                <x-context-menu-item hx-include="#sort"
                    hx-get="{{url('collections/table') . '?fragment=table&collid='. request('collid')}}" hx-trigger="click"
                    hx-target='#table-container' hx-swap="outerHTML">
                    <input type="hidden" name="sort" id="sort" x-bind:value="column_property" />
                    Sort By&nbsp;<span x-text="column"></span>
                </x-context-menu-item>

                <x-context-menu-item hx-include="#filter"
                    hx-get="{{url('collections/table') . '?fragment=table&collid='. request('collid') }}" hx-trigger="click"
                    hx-target='#table-container' hx-swap="outerHTML">
                    <input type="hidden" x-bind:name="column_property" id="filter" x-bind:value="column_value" />
                    Filter By&nbsp;<span x-text="column"></span>
                </x-context-menu-item>

                <x-context-menu-item hx-get="{{ url('collections/table') . '?fragment=table&collid='. request('collid') }}"
                    hx-trigger="click" hx-target='#table-container' hx-swap="outerHTML">
                    Clear Filters
                </x-context-menu-item>
            </x-slot:menu>
            @fragment('table')
            <div id="table-container"
                class="overflow-x-scroll overflow-y-scroll w-screen h-[calc(100vh-7rem)] relative">
                <table class="w-full border-seperate">
                    <thead class="text-left">
                        <tr class="bg-base-100">
                            @foreach($property_display_map as $property)
                            <th @class([ 'bg-neutral text-neutral-content sticky top-0 text-nowrap p-2 border border-base-content z-50'
                                , 'pl-4'=> $loop->first,
                                'pr-4' => $loop->last,
                                ])>
                                {{ $property['label'] }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @fragment('rows')
                        @foreach ($occurrences as $occurrence)
                        <tr @contextmenu="occid = {{$occurrence->occid}}" @class([ 'bg-base-200'=> $loop->even,
                            'bg-base-300' => $loop->odd,
                            ])>
                            @foreach($property_display_map as $property)
                            <td @contextmenu="column = '{{$property['label']}}'; column_property = '{{$property['name']}}'; column_value = $el.innerHTML.trim()"
                                @class([ 'p-2 text-nowrap border border-base-content' , 'pl-4'=> $loop->first,
                                'pr-4' => $loop->last,
                                'sticky left-0 text-neutral-content' => $property['name'] === 'occid',
                                'bg-neutral' =>$loop->parent->odd && $property['name'] === 'occid',
                                'bg-neutral-lighter' =>$loop->parent->even && $property['name'] === 'occid',
                                ])>
                                @if($property['name'] === 'occid')
                                @php
                                $url = url(config('portal.name') . '/collections/editor/occurrenceeditor.php?' .
                                implode('&', ['csmode=1', 'collid=' . $occurrence->collid, 'occid=' .
                                $occurrence->occid, 'occindex=' . $loop->parent->index]));
                                @endphp
                                <a href="{{ $url }}" class="cursor-pointer">{{ $occurrence->{$property['name']} }}</a>
                                <a target="_blank" href="{{ $url }}" class="cursor-pointer">
                                    <i class="fa-solid fa-up-right-from-square"></i>
                                </a>
                                @else
                                {{ $occurrence->{$property['name']} ?? ''}}
                                @endif
                            </td>
                            @endforeach
                        </tr>
                        @endforeach

                        @if(count($occurrences) === 100)
                                <tr class="h-0 w-full" hx-get="{{ url('/collections/table') . '?&fragment=rows&page='. $page + 1 . '&' . http_build_query(request()->except(['page', 'fragment'])) }}" hx-indicator="#scroll-loader" hx-trigger="intersect once" hx-swap="afterend"></tr>
                        @endif
                        @endfragment
                    </tbody>
                </table>
                <div id="scroll-loader" class="htmx-indicator">
                    Loading more records...
                </div>
            </div>
            @endfragment
        </x-context-menu>
    </div>
</x-layout>
