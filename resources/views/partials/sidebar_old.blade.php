<div class="sidebar-area" id="sidebar-area">
    <div class="logo position-relative">
        <a href="index" class="d-block text-decoration-none position-relative">
            <img src="/assets/images/logo-icon.png" alt="logo-icon">
            <span class="logo-text fw-bold text-dark">Trezo</span>
        </a>
        <button class="sidebar-burger-menu bg-transparent p-0 border-0 opacity-0 z-n1 position-absolute top-50 end-0 translate-middle-y" id="sidebar-burger-menu">
            <i data-feather="x"></i>
        </button>
    </div>

    <aside id="layout-menu" class="layout-menu menu-vertical menu active" data-simplebar>
        <ul class="menu-inner">
            <li class="menu-title small text-uppercase">
                <span class="menu-title-text">MAIN</span>
            </li>
            <li class="menu-item open">
                <a href="javascript:void(0);" class="menu-link menu-toggle active">
                    <span class="material-symbols-outlined menu-icon">dashboard</span>
                    <span class="title">Dashboard</span>
                    <span class="count">9</span>
                </a>
        
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="/" class="menu-link {{ Request::is('/') ? 'active' : '' }}">
                            eCommerce
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="/crm" class="menu-link {{ Request::is('crm') ? 'active' : '' }}">
                            CRM
                            <span class="hot tag">Hot</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="/project-management" class="menu-link {{ Request::is('project-management') ? 'active' : '' }}">
                            Project Management
                        </a>
                    </li>
                    <li class="menu-item mb-0">
                        <a href="/lms" class="menu-link {{ Request::is('lms') ? 'active' : '' }}">
                            LMS
                        </a>
                    </li>
                    <li class="menu-item mb-0">
                        <a href="/help-desk" class="menu-link {{ Request::is('help-desk') ? 'active' : '' }}">
                            HelpDesk 
                            <span class="new tag">New</span>
                        </a>
                    </li>
                    <li class="menu-item mb-0">
                        <a href="/analytics" class="menu-link {{ Request::is('analytics') ? 'active' : '' }}">
                            Analytics 
                            <span class="hot tag">New</span>
                        </a>
                    </li>
                    <li class="menu-item mb-0">
                        <a href="/crypto" class="menu-link {{ Request::is('crypto') ? 'active' : '' }}">
                            Crypto 
                            <span class="hot tag">New</span>
                        </a>
                    </li>
                    <li class="menu-item mb-0">
                        <a href="/sales" class="menu-link {{ Request::is('sales') ? 'active' : '' }}">
                            Sales 
                            <span class="hot tag">New</span>
                        </a>
                    </li>
                    <li class="menu-item mb-0">
                        <a href="/hospital" class="menu-link {{ Request::is('hospital') ? 'active' : '' }}">
                            Hospital 
                            <span class="hot tag">New</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="menu-title small text-uppercase">
                <span class="menu-title-text">Master Data</span>
            </li>
            <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle active">
                    <span class="material-symbols-outlined menu-icon">dashboard</span>
                    <span class="title">Dashboard</span>
                    <span class="count">9</span>
                </a>
        
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="/" class="menu-link {{ Request::is('/') ? 'active' : '' }}">
                            eCommerce
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="/crm" class="menu-link {{ Request::is('crm') ? 'active' : '' }}">
                            CRM
                            <span class="hot tag">Hot</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="/project-management" class="menu-link {{ Request::is('project-management') ? 'active' : '' }}">
                            Project Management
                        </a>
                    </li>
                    <li class="menu-item mb-0">
                        <a href="/lms" class="menu-link {{ Request::is('lms') ? 'active' : '' }}">
                            LMS
                        </a>
                    </li>
                    <li class="menu-item mb-0">
                        <a href="/help-desk" class="menu-link {{ Request::is('help-desk') ? 'active' : '' }}">
                            HelpDesk 
                            <span class="new tag">New</span>
                        </a>
                    </li>
                    <li class="menu-item mb-0">
                        <a href="/analytics" class="menu-link {{ Request::is('analytics') ? 'active' : '' }}">
                            Analytics 
                            <span class="hot tag">New</span>
                        </a>
                    </li>
                    <li class="menu-item mb-0">
                        <a href="/crypto" class="menu-link {{ Request::is('crypto') ? 'active' : '' }}">
                            Crypto 
                            <span class="hot tag">New</span>
                        </a>
                    </li>
                    <li class="menu-item mb-0">
                        <a href="/sales" class="menu-link {{ Request::is('sales') ? 'active' : '' }}">
                            Sales 
                            <span class="hot tag">New</span>
                        </a>
                    </li>
                    <li class="menu-item mb-0">
                        <a href="/hospital" class="menu-link {{ Request::is('hospital') ? 'active' : '' }}">
                            Hospital 
                            <span class="hot tag">New</span>
                        </a>
                    </li>
                </ul>
            </li>


          
            <li class="menu-item">
                <a href="logout" class="menu-link logout">
                    <span class="material-symbols-outlined menu-icon">logout</span>
                    <span class="title">Logout</span>
                </a>
            </li>
        </ul>
    </aside>
</div>