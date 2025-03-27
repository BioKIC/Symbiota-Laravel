@props(['id' => uniqid(),'tabs' => [] ])
<div
    x-data="{
        tabSelected: 1,
        tabId: $id('{{ $id }}'),
        tabButtonClicked(tabButton){
            this.tabSelected = tabButton.id.replace(this.tabId + '-', '');
            this.tabRepositionMarker(tabButton);
        },
        tabRepositionMarker(tabButton){
            this.$refs.tabMarker.style.width=tabButton.offsetWidth + 'px';
            this.$refs.tabMarker.style.height=tabButton.offsetHeight + 'px';
            this.$refs.tabMarker.style.left=tabButton.offsetLeft + 'px';
        },
        tabContentActive(tabContent){
            // return this.tabSelected == tabContent.id.replace(this.tabId + '-content-', '');
            const tabId = tabContent.id.split('-').slice(-1);
            return this.tabSelected == tabId;
        }
    }"

    x-init="tabRepositionMarker($refs.tabButtons.firstElementChild);" class="relative w-full">

    <div x-ref="tabButtons" class="relative flex items-center w-full h-10 p-1 text-base-content bg-base-200 rounded-lg select-none">
    @foreach ($tabs as $tab)
        <button :id="$id(tabId)" @click="tabButtonClicked($el);" type="button" class="relative z-20 inline-flex items-center justify-center w-full h-8 px-3 text-sm font-medium transition-all rounded-md cursor-pointer whitespace-nowrap">{{ $tab }}</button>

    @endforeach
        <div x-ref="tabMarker" class="absolute left-0 z-10 w-1/2 h-full duration-300 ease-out" x-cloak>
            <div class="w-full h-full bg-base-100 rounded-md shadow-sm"></div>
        </div>
    </div>
    <div class="relative w-full mt-2 content">
        {{ $slot }}
    </div>
</div>
