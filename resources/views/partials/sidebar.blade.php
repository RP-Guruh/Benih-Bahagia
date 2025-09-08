<div class="sidebar-area" id="sidebar-area">
    <div class="logo d-flex align-items-center justify-content-between px-3 py-2 position-relative">
        <a href="{{ url('/') }}" class="d-flex align-items-center text-decoration-none">
            <img src="/assets/landing_page/images/logosidebar.png" 
                 alt="logo-icon" 
                 style="height: 40px; width: auto; object-fit: contain;" />
            <span class="ms-2 fw-bold text-dark" style="font-size: 1rem;">BenihBahagia</span>
        </a>
        
<button
    class="sidebar-burger-menu d-block d-xl-none bg-transparent p-0 border-0 position-absolute top-50 end-0 translate-middle-y"
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

            @if(auth()->check())
                {{-- Loop semua module sesuai permission --}}
                @foreach([
                    'Master Data' => [
                        'icon' => 'database',
                        'children' => [
                            ['code'=>'masterdata/formulir','title'=>'Formulir','url'=>'masterdata/formulir'],
                            ['code'=>'masterdata/pertanyaan','title'=>'Daftar Pertanyaan','url'=>'masterdata/pertanyaan'],
                            ['code'=>'masterdata/jawaban','title'=>'Daftar Jawaban','url'=>'masterdata/jawaban'],
                        ]
                    ],
                    'Settings' => [
                        'icon'=>'settings',
                        'children'=>[
                            ['code'=>'settings/menu','title'=>'Menu','url'=>'settings/menu'],
                            ['code'=>'settings/menu_action','title'=>'Menu Actions','url'=>'settings/menu_action'],
                        ]
                    ],
                    'Edukasi' => [
                        'icon'=>'emoji_objects',
                        'children'=>[
                            ['code'=>'content/article','title'=>'Article','url'=>'content/article'],
                            ['code'=>'content/category','title'=>'Category','url'=>'content/category'],
                            ['code'=>'content/video','title'=>'Video','url'=>'content/video'],
                        ]
                    ],
                    'Hak Akses' => [
                        'icon'=>'settings_accessibility',
                        'children'=>[
                            ['code'=>'access/user','title'=>'Auth User','url'=>'access/user'],
                            ['code'=>'access/permission','title'=>'Hak Akses','url'=>'access/permission'],
                            ['code'=>'access/level','title'=>'Level','url'=>'access/level'],
                        ]
                    ]
                ] as $menuTitle => $menuData)

                    @php
                        $childrenCodes = array_column($menuData['children'], 'code');
                        $hasMenu = auth()->user()->permissions()->whereHas('menu', fn($q) => $q->whereIn('code', $childrenCodes))->exists();
                    @endphp

                    @if($hasMenu)
                        <li class="menu-item {{ request()->is(array_column($menuData['children'],'url').'/*') ? 'open' : '' }}">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <span class="material-symbols-outlined menu-icon">{{ $menuData['icon'] }}</span>
                                <span class="title">{{ $menuTitle }}</span>
                            </a>
                            <ul class="menu-sub">
                                @foreach($menuData['children'] as $child)
                                    @if(auth()->user()->permissions()->whereHas('menu', fn($q) => $q->where('code',$child['code']))->exists())
                                        <li class="menu-item">
                                            <a href="{{ url($child['url']) }}" class="menu-link {{ request()->is($child['url']) ? 'active' : '' }}">
                                                {{ $child['title'] }}
                                            </a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </li>
                    @endif
                @endforeach

                {{-- Logout --}}
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
