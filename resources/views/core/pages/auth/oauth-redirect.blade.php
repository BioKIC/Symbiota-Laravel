<x-layout class="flex justify-center items-center" :hasHeader="false" :hasFooter="false" :hasNavbar="false">
    <div class="h-fit p-4 border border-base-300">
        <div class="text-xl">
            Orcid Redirect
        </div>
        Request From:
        <x-link href="{{ request()->header('referer') }}">
            {{ request()->header('referer') }}
        </x-link>
    </div>
</x-layout>
