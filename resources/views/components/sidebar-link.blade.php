@props(['route', 'icon'])

<li class="{{ request()->routeIs($route) ? 'page-active' : '' }}">
    <a href="{{ route($route) }}">
        <i class="{{ $icon }} me-2"></i>
        {{ $slot }}
    </a>
</li>
