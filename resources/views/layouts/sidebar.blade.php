<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">
                    <h3>CV. GENDHIS</h3>
                </li>

                <li class="sidebar-item {{ Request::is('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}" class="sidebar-link">
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                {{-- MENU KHUSUS ADMIN --}}
                @if (Auth::user()->role == 'Admin')
                    <li class="sidebar-item has-sub">
                        <a href="#" class="sidebar-link">
                            <i class="bi bi-file-earmark-spreadsheet-fill"></i>
                            <span>Kelola Travel</span>
                        </a>
                        <ul class="submenu">
                            <li class="submenu-item {{ Request::is('master-travel') ? 'active' : '' }}">
                                <a href="{{ route('master-travel.index') }}">Master Data Travel</a>
                            </li>
                            <li class="submenu-item {{ Request::is('list-order-travel') ? 'active' : '' }}">
                                <a href="{{ route('list-order.travel') }}">Data Order Travel</a>
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-item has-sub">
                        <a href="#" class="sidebar-link">
                            <i class="bi bi-book-fill"></i>
                            <span>Kelola Bimbel</span>
                        </a>
                        <ul class="submenu">
                            <li class="submenu-item {{ Request::is('master-bimbel') ? 'active' : '' }}">
                                <a href="{{ route('master-bimbel.index') }}">Master Data Bimbel</a>
                            </li>
                            <li class="submenu-item {{ Request::is('list-order-bimbel') ? 'active' : '' }}">
                                <a href="{{ route('list-order.bimbel') }}">Data Order Bimbel</a>
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-item has-sub">
                        <a href="#" class="sidebar-link">
                            <i class="bi bi-egg-fill"></i>
                            <span>Kelola Studio Foto</span>
                        </a>
                        <ul class="submenu">
                            <li class="submenu-item {{ Request::is('master-jasa-foto') ? 'active' : '' }}">
                                <a href="{{ route('master-jasa-foto.index') }}">Master Data Jasa Foto</a>
                            </li>
                            <li class="submenu-item {{ Request::is('list-order-jasa-foto') ? 'active' : '' }}">
                                <a href="{{ route('list-order.foto') }}">Data Order Jasa Foto</a>
                            </li>
                        </ul>
                    </li>
                @endif

                {{-- MENU KHUSUS OWNER --}}
                @if (Auth::user()->role == 'Owner')
                    <li class="sidebar-item">
                        <a href="" class="sidebar-link">
                            <i class="bi bi-grid-fill"></i>
                            <span>Kelola Akun</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="" class="sidebar-link">
                            <i class="bi bi-grid-fill"></i>
                            <span>isine list menu owner</span>
                        </a>
                    </li>
                @endif

                <li class="sidebar-item has-sub">
                    <a href="#" class="sidebar-link">
                        <i class="bi bi-file-earmark-spreadsheet-fill"></i>
                        <span>Laporan Transaksi</span>
                    </a>
                    <ul class="submenu">
                        <li class="submenu-item {{ Request::is('laporan-travel') ? 'active' : '' }}">
                            <a href="{{ route('laporan.travel') }}">Laporan Travel</a>
                        </li>
                        <li class="submenu-item {{ Request::is('laporan-bimbel') ? 'active' : '' }}">
                            <a href="{{ route('laporan.bimbel') }}">Laporan Bimbel</a>
                        </li>
                        <li class="submenu-item {{ Request::is('laporan-jasa-foto') ? 'active' : '' }}">
                            <a href="{{ route('laporan.foto') }}">Laporan Studio Foto</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('logout') }}" class="sidebar-link">
                        <i class="bi bi-door-open-fill"></i>
                        <span>Logout</span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</div>
