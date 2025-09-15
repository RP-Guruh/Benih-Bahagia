<header class="header-area bg-white mb-4 rounded-bottom-15 sticky-top z-3" id="header-area">
    <div class="d-flex justify-content-between align-items-center">
        <!-- Left: Hamburger -->
        <div class="left-header-content">
            <ul
                class="d-flex align-items-center ps-0 mb-0 list-unstyled justify-content-center justify-content-sm-start">
                <li>
                    <button class="header-burger-menu bg-transparent p-0 border-0" id="header-burger-menu">
                        <span class="material-symbols-outlined">menu</span>
                    </button>
                </li>
                <li>
                    <form class="src-form position-relative">
                        <input type="text" id="global-search" class="form-control" placeholder="Global search here ...">
                        <button type="submit" class="src-btn position-absolute top-50 end-0 translate-middle-y bg-transparent p-0 border-0">
                                <span class="material-symbols-outlined">search</span>
                        </button>
                    </form>
                    
                    <div id="search-results" 
                        class="dropdown-menu shadow-lg rounded mt-1" 
                        style="display:none; overflow-y:auto;">  
                    </div>
                </li>
            </ul>
        </div>




    <div class="right-header-content d-flex align-items-center">

    <!-- Toggle Light/Dark selalu tampil -->
    <div header-right-item">
    <button class="switch-toggle settings-btn dark-btn p-0 bg-transparent me-2 d-flex align-items-center"
        id="switch-toggle">
        <span class="dark" style="color: #FE7A36;"><i class="material-symbols-outlined">light_mode</i></span>
        <span class="light"><i class="material-symbols-outlined">dark_mode</i></span>
    </button>
    </div>

    <!-- Dropdown User Profile -->
    <div class="dropdown admin-profile">
        <div class="d-flex align-items-center cursor dropdown-toggle" data-bs-toggle="dropdown">
            <img class="rounded-circle wh-40 administrator" src="/assets/images/welcome.png" alt="admin" />
            <!-- Nama hanya muncul di layar besar -->
            <div class="d-none d-sm-block ms-2 ">
                <h3 class="mb-0 fs-14 fw-semibold">{{ auth()->user()->name }}</h3>
            </div>
        </div>

        <div class="dropdown-menu dropdown-menu-end mt-2 shadow border-0">
            <div class="d-flex align-items-center info p-2">
                <img class="rounded-circle wh-30 administrator" src="/assets/images/welcome.png" alt="admin" />
                <div class="ms-2">
                    <h3 class="fw-medium mb-0 text-muted">{{ auth()->user()->name }}</h3>
                    <span class="fs-12 text-muted">{{ auth()->user()->email }}</span>
                </div>
            </div>
            <hr class="my-1">
            <a class="dropdown-item d-flex align-items-center" href="my-profile.html">
                <i class="material-symbols-outlined">account_circle</i><span class="ms-2">Change Password</span>
            </a>
            <form action="{{ route('logout') }}" method="POST" id="logout-form">
                @csrf
                <button type="submit" class="dropdown-item d-flex align-items-center bg-transparent border-0 w-100 text-start">
                    <i class="material-symbols-outlined">logout</i>
                    <span class="ms-2">Logout</span>
                </button>
            </form>
        </div>
    </div>
</div>

    </div>
</header>