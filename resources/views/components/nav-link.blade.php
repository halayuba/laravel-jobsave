@props(['route'])

@php
    $active = Request::routeIs($route) ? 'bg-logo text-white font-semibold' : 'text-gray-700';
@endphp

<a href="{{ route($route) }}" class="{{ $active }} font-light focus:outline-none hover:bg-gray-200 hover:text-gray-800 px-3 py-2 rounded-sm">
    {{ $slot }}
</a>
