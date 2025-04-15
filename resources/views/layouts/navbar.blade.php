@php
    $currentUrl = request()->url();
@endphp
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item @if($currentUrl == url('/')) active @endif">
                <a class="nav-link" href="{{ url('/') }}">Home</a>
            </li>
            <li class="nav-item @if($currentUrl == url('/upload_transcript')) active @endif">
                <a class="nav-link" href="{{ url('/upload_transcript') }}">Generate</a>
            </li>
            <li class="nav-item @if($currentUrl == url('/about')) active @endif">
                <a class="nav-link" href="{{ url('/about') }}">About</a>
            </li>
        </ul>
    </div>
</nav>