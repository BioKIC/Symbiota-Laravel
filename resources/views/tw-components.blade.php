<x-layout>
    <div class="flex flex-col w-[90%] max-w-screen-lg gap-y-4 mx-auto">
        <h1 class="text-4xl my-3 font-bold font-sans text-primary">
            Tailwind Components
        </h1>
        <h1 class="text-4xl font-bold font-sans">H1</h1>
        <h2 class="text-3xl font-bold font-sans">H2</h2>
        <h3 class="text-2xl font-bold font-sans">H3</h3>
        <h4 class="text-lg font-bold font-sans">Subheading</h4>
        <p class="font-sans">Paragraph</p>
        <span class="text-sm font-sans">Small Text</span>

        <div class="flex gap-x-4 items-center">
            <div class="bg-primary rounded-md w-32">
                <x-brand />
            </div>
            <x-swatch />
        </div>
        <div class="flex gap-x-4">
            <x-button variant="primary">Primary</x-button>
            <x-button variant="secondary">Secondary</x-button>
            <x-button variant="neutral">Neutral</x-button>
            <x-button variant="accent">Accent</x-button>
            <x-button variant="neutral">
                <x-slot:icon>
                    <div class="stroke-accent w-7 h-7">
                        <x-icons.loading />
                    </div>
                    </x-slot>
                    Async
            </x-button>
        </div>
        <x-input required :id="'input'" :label="'Text Input'" />
        <x-input required type="number" :id="'input'" :label="'Number Input'" />
        <x-radio :default_value="2"
            :options="[ ['label' => 'Option 1', 'value' => '2'], ['label' => 'Option 2', 'value' => 1]]"
            label="Symb Radio" name="radio_options" />
        <x-checkbox :id="'checkbox'" :label="'Checkbox'" />
        <x-nested-checkbox-group :id="'nested-checkbox'" :label="'All Options'">
            <x-checkbox :id="'optional-1'" :label="'Optional 1'" />
            <x-checkbox :id="'optional-2'" :label="'Optional 2'" />
        </x-nested-checkbox-group>
        <x-accordion :id="'taxonomy'" :label="'accordian'">
            <x-input required :id="'input'" :label="'Text input'" />
            <x-input required type="number" :id="'input'" :label="'Number Input'" />
        </x-accordion>

        <x-accordion :id="'nested'" :label="'nested accordian'">
            <x-accordion :id="'collections'" :label="'accordian'">
                <x-input required :id="'input'" :label="'Text Input'" />
                <x-input required type="number" :id="'input'" :label="'Number Input'" />
            </x-accordion>
        </x-accordion>

        <x-autocomplete-input name="taxa" :label="'Auto Complete Input'" id="test-search" search="/api/taxa/search">
            <x-slot:input class="w-full"></x-slot>
                <x-slot:menu>Menu</x-slot>
        </x-autocomplete-input>
        <x-taxa-search />

        @php
        class OccurrenceStub {
        public $sciname = "Pinus albicaulis";
        public $scientificNameAuthorship= "Engelm.";
        public $catalogNumber= "9973";
        public $family= "Pinaceae";
        public $recordedBy= "Lupin Praug";
        public $recordNumber= "1";
        public $eventDate = "1999/10/24";
        public $locality= "United States, California";
        public $institutionCode = "BLMAR";
        public $collectionCode = "";
        public $decimalLatitude= 90;
        public $decimalLongititude = 90;
        public $minimumElevationInMeters = "3322m";
        public $maximumElevationInMeters = "3383m";
        public $tidInterpreted= 1;
        public $occid = 1;
        public $image_cnt = 1;
        public $audio_cnt = 1;
        }
        @endphp
        <x-collections.list.item :occurrence="new OccurrenceStub" />

        <div class="w-fit">
            <x-popover>
                <div class="flex flex-col gap-4">

                    <div class="text-xl">Title</div>
                    <x-input label="Height" id="Something" />
                    <x-input label="Width" id="Other thing" />
                </div>
            </x-popover>


        </div>
        <div class="w-fit">
            <x-breadcrumbs :items="[
                ['title' => 'Home', 'href' => '#_'],
                ['title' => 'Collections', 'href' => '#_'],
                ['title' => 'Collection Profile', 'href' => '#_'],
            ]" />
        </div>

        <x-context-menu>
            Right Click Here
        </x-context-menu>

        <x-modal>
            <x-slot:label>
                Open Modal
                </x-slot>
                <x-slot:title class="text-2xl">
                    Title
                    </x-slot>
                    <x-slot name="body">
                        <form class="flex flex-col gap-2">
                            <x-input name="testOne" label="Test 1" />
                            <x-input name="testTwo" label="Test 2" />
                            <x-button type="submit">Submit</x-button>
                        </form>
                    </x-slot>
        </x-modal>

        <x-tooltip text="Tooltip">
            Tooltip
        </x-tooltip>

        <x-select label="Groceries" :default="1" :items="[
            [
                'title' => 'Milk',
                'value' => 'milk',
                'disabled' => false
            ],
            [
                'title' => 'Eggs',
                'value' => 'eggs',
                'disabled' => false
            ],
            [
                'title' => 'Cheese',
                'value' => 'cheese',
                'disabled' => false
            ],
            [
                'title' => 'Bread',
                'value' => 'bread',
                'disabled' => false
            ],
            [
                'title' => 'Apples',
                'value' => 'apple',
                'disabled' => false
            ],
            [
                'title' => 'Bananas',
                'value' => 'bananas',
                'disabled' => false
            ],
            [
                'title' => 'Yogurt',
                'value' => 'yogurt',
                'disabled' => false
            ],
            [
                'title' => 'Sugar',
                'value' => 'sugar',
                'disabled' => false
            ],
            [
                'title' => 'Salt',
                'value' => 'salt',
                'disabled' => false
            ],
        ]" />
        <x-image-card src="https://collections.nmnh.si.edu/media/?i=10333969&width=300"
            title="Pinus albicaulis Engelm." />
        <x-slide-tab-container :tabs="['Tab 1', 'Tab 2', 'Tab 3']">
            <x-slide-tab class="border rounded-lg shadow-sm bg-card text-base-content p-4">
                Tab 1
            </x-slide-tab>

            <x-slide-tab class="border rounded-lg shadow-sm bg-card text-base-content p-4">
                Tab 2
            </x-slide-tab>

            <x-slide-tab class="border rounded-lg shadow-sm bg-card text-base-content p-4">
                Tab 3
            </x-slide-tab>
        </x-slide-tab-container>
    </div>
</x-layout>
