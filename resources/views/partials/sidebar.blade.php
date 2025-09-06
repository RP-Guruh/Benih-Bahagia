<div class="sidebar-area" id="sidebar-area">
    <div class="logo position-relative">
        <a href="{{ url('/') }}" class="d-block text-decoration-none position-relative">
            <img src="/assets/images/logo-icon.png" alt="logo-icon" />
            <span class="logo-text fw-bold text-dark">BenihBahagia</span>
        </a>
        <button
            class="sidebar-burger-menu bg-transparent p-0 border-0 opacity-0 z-n1 position-absolute top-50 end-0 translate-middle-y"
            id="sidebar-burger-menu">
            <i data-feather="x"></i>
        </button>
    </div>

    <aside id="layout-menu" class="layout-menu menu-vertical menu active" data-simplebar>
        <ul class="menu-inner">

            {{-- Dashboard --}}
            <li class="menu-item">
                <a href="{{ url('/') }}" class="menu-link {{ request()->is('/') ? 'active' : '' }}">
                    <span class="material-symbols-outlined menu-icon">dashboard</span>
                    <span class="title">Dashboard</span>
                </a>
            </li>


            @if (auth()->check())

                {{-- Master Data --}}
                @php
                    $masterdataChildren = ['masterdata/formulir', 'masterdata/pertanyaan', 'masterdata/jawaban'];
                    $hasMasterdata = auth()
                        ->user()
                        ->permissions()
                        ->whereHas('menu', fn($q) => $q->whereIn('code', $masterdataChildren))
                        ->exists();
                @endphp
                @if ($hasMasterdata)

                    <li class="menu-item {{ request()->is('masterdata/*') ? 'open' : '' }}">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <span class="material-symbols-outlined menu-icon">database</span>
                            <span class="title">Master Data</span>
                        </a>
                        <ul class="menu-sub">
                            @if (auth()->user()->permissions()->whereHas('menu', fn($q) => $q->where('code', 'masterdata/formulir'))->exists())
                                <li class="menu-item">
                                    <a href="{{ url('masterdata/formulir') }}"
                                        class="menu-link {{ request()->is('masterdata/formulir') ? 'active' : '' }}">
                                        Formulir
                                    </a>
                                </li>
                            @endif
                            @if (auth()->user()->permissions()->whereHas('menu', fn($q) => $q->where('code', 'masterdata/pertanyaan'))->exists())
                                <li class="menu-item">
                                    <a href="{{ url('masterdata/pertanyaan') }}"
                                        class="menu-link {{ request()->is('masterdata/pertanyaan') ? 'active' : '' }}">
                                        Daftar Pertanyaan
                                    </a>
                                </li>
                            @endif

                            @if (auth()->user()->permissions()->whereHas('menu', fn($q) => $q->where('code', 'masterdata/jawaban'))->exists())
                                <li class="menu-item">
                                    <a href="{{ url('masterdata/jawaban') }}"
                                        class="menu-link {{ request()->is('masterdata/jawaban') ? 'active' : '' }}">
                                        Daftar Jawaban
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                {{-- Settings --}}
                @php
                    $settingsChildren = ['settings/menu', 'settings/menu_action'];
                    $hasSettings = auth()
                        ->user()
                        ->permissions()
                        ->whereHas('menu', fn($q) => $q->whereIn('code', $settingsChildren))
                        ->exists();
                @endphp
                @if ($hasSettings)
                    <li class="menu-item {{ request()->is('settings/*') ? 'open' : '' }}">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <span class="material-symbols-outlined menu-icon">settings</span>
                            <span class="title">Settings</span>
                        </a>
                        <ul class="menu-sub">
                            @if (auth()->user()->permissions()->whereHas('menu', fn($q) => $q->where('code', 'settings/menu'))->exists())
                                <li class="menu-item">
                                    <a href="{{ url('settings/menu') }}"
                                        class="menu-link {{ request()->is('settings/menu') ? 'active' : '' }}">
                                        Menu
                                    </a>
                                </li>
                            @endif
                            @if (auth()->user()->permissions()->whereHas('menu', fn($q) => $q->where('code', 'settings/menu_action'))->exists())
                                <li class="menu-item">
                                    <a href="{{ url('settings/menu_action') }}"
                                        class="menu-link {{ request()->is('settings/menu_action') ? 'active' : '' }}">
                                        Menu Actions
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                {{-- Hak Akses --}}
                @php
                    $accessChildren = ['access/user', 'access/permission', 'access/level'];
                    $hasAccess = auth()
                        ->user()
                        ->permissions()
                        ->whereHas('menu', fn($q) => $q->whereIn('code', $accessChildren))
                        ->exists();
                @endphp
                @if ($hasAccess)
                    <li class="menu-item {{ request()->is('access/*') ? 'open' : '' }}">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <span class="material-symbols-outlined">settings_accessibility</span>
                            <span class="title">Hak Akses</span>
                        </a>
                        <ul class="menu-sub">
                            @if (auth()->user()->permissions()->whereHas('menu', fn($q) => $q->where('code', 'access/user'))->exists())
                                <li class="menu-item">
                                    <a href="{{ url('access/user') }}"
                                        class="menu-link {{ request()->is('access/user') ? 'active' : '' }}">
                                        Auth User
                                    </a>
                                </li>
                            @endif
                            @if (auth()->user()->permissions()->whereHas('menu', fn($q) => $q->where('code', 'access/permission'))->exists())
                                <li class="menu-item">
                                    <a href="{{ url('access/permission') }}"
                                        class="menu-link {{ request()->is('access/permission') ? 'active' : '' }}">
                                        Hak Akses
                                    </a>
                                </li>
                            @endif
                            @if (auth()->user()->permissions()->whereHas('menu', fn($q) => $q->where('code', 'access/level'))->exists())
                                <li class="menu-item">
                                    <a href="{{ url('access/level') }}"
                                        class="menu-link {{ request()->is('access/level') ? 'active' : '' }}">
                                        Level
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif
            @endif

            {{-- Logout --}}
            @if (auth()->check())
                <li class="menu-item">
                    <form action="{{ route('logout') }}" method="POST" id="logout-form">
                        @csrf
                        <a href="#" class="menu-link logout"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <span class="material-symbols-outlined menu-icon">logout</span>
                            <span class="title">Logout</span>
                        </a>
                    </form>
                </li>
            @endif
        </ul>
    </aside>
</div>
