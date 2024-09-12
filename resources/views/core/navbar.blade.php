@props(['navigations'])
<!-- resources/views/core/navbar.blade.php -->
<nav {{$attributes}} class="bg-primary text-primary-content h-14">
    <ul class="flex flex-wrap gap-2 justify-center h-full font-bold">
        @foreach ($navigations as $nav)
        <x-navbar.item>
            <a href="{{ $nav['link']}}">
                {{$nav['title']}}
            </a>
        </x-navbar.item>
        @endforeach
        <x-navbar.item>
            <x-language-selector />
        </x-navbar.item>
    </ul>
</nav>
