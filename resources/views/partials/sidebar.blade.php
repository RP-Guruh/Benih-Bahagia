<div class="sidebar-area" id="sidebar-area">
<div class="logo position-relative">
                <a href="{{ url('/') }}" class="d-block text-decoration-none position-relative">
                    <img src="{{ asset('assets/images/logo-icon.png') }}" alt="logo-icon">
                    <span class="logo-text fw-bold text-dark">Benih Bahagia</span>
                </a>
                <button class="sidebar-burger-menu bg-transparent p-0 border-0 opacity-0 z-n1 position-absolute top-50 end-0 translate-middle-y" id="sidebar-burger-menu">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>



    <aside id="layout-menu" class="layout-menu menu-vertical menu active" data-simplebar>
        <ul class="menu-inner">

            {{-- Dashboard --}}
            <li class="menu-item">
                <a href="{{ url('/dashboard') }}" class="menu-link {{ request()->is('/dashboard') ? 'active' : '' }}">
                    <span class="material-symbols-outlined menu-icon">dashboard</span>
                    <span class="title">Dashboard</span>
                </a>
            </li>

            @if(auth()->check())
                {{-- Loop menu sesuai permission --}}
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
                    ],
                    'Skrinning' => [
                        'icon'=>'diversity_1',
                        'children'=>[
                            ['code'=>'skrinning/siswa','title'=>'Skrinning Siswa','url'=>'skrinning/siswa'],
                        ]
                    ],
                ] as $menuTitle => $menuData)

                    @php
                        $childrenCodes = array_column($menuData['children'], 'code');
                        $hasMenu = auth()->user()->permissions()
                            ->whereHas('menu', fn($q) => $q->whereIn('code', $childrenCodes))
                            ->exists();

                      
                        $childUrls = array_map(fn($c) => $c['url'].'*', $menuData['children']);
                    @endphp

                    @if($hasMenu)
                        <li class="menu-item {{ request()->is(...$childUrls) ? 'open' : '' }}">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <span class="material-symbols-outlined menu-icon">{{ $menuData['icon'] }}</span>
                                <span class="title">{{ $menuTitle }}</span>
                            </a>
                            <ul class="menu-sub">
                                @foreach($menuData['children'] as $child)
                                    @if(auth()->user()->permissions()->whereHas('menu', fn($q) => $q->where('code',$child['code']))->exists())
                                        <li class="menu-item">
                                            <a href="{{ url($child['url']) }}" class="menu-link {{ request()->is($child['url'].'*') ? 'active' : '' }}">
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
