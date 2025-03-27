{{-- Must have Be in a slide-tab-container --}}
<div :id="$id(tabId + '-content')" x-show="tabContentActive($el)" {{ $attributes->twMerge('relative') }}>
    {{ $slot }}
</div>
