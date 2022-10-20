<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">
                    <h3>GENDHIS</h3>
                </li>

                <li class="sidebar-item {{ Request::is('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}" class="sidebar-link">
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item has-sub">
                    <a href="#" class="sidebar-link">
                        <i class="bi bi-file-earmark-spreadsheet-fill"></i>
                        <span>Kelola Travel</span>
                    </a>
                    <ul class="submenu">
                        <li class="submenu-item {{ Request::is('master-travel') ? 'active' : '' }}">
                            <a href="{{ route('master-travel.index') }}">Master Data Travel</a>
                        </li>
                        <li class="submenu-item {{ Request::is('list-order.travel') ? 'active' : '' }}">
                            <a href="{{ route('list-order.travel') }}">Data Order Travel</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item {{ Request::is('master-travel') ? 'active' : '' }}">
                    <a href="{{ route('master-travel.index') }}" class="sidebar-link">
                        <i class="bi bi-map-fill"></i>
                        <span>Kelola Travel</span>
                    </a>
                </li>

                <li class="sidebar-item {{ Request::is('master-bimbel') ? 'active' : '' }}">
                    <a href="{{ route('master-bimbel.index') }}" class="sidebar-link">
                        <i class="bi bi-book-fill"></i>
                        <span>Kelola Bimbel</span>
                    </a>
                </li>

                <li class="sidebar-item {{ Request::is('master-jasa-foto') ? 'active' : '' }}">
                    <a href="{{ route('master-jasa-foto.index') }}" class="sidebar-link">
                        <i class="bi bi-egg-fill"></i>
                        <span>Kelola Studio Foto</span>
                    </a>
                </li>

                <li class="sidebar-item has-sub">
                    <a href="#" class="sidebar-link">
                        <i class="bi bi-file-earmark-spreadsheet-fill"></i>
                        <span>Laporan Transaksi</span>
                    </a>
                    <ul class="submenu">
                        <li class="submenu-item">
                            <a href="">Laporan Travel</a>
                        </li>
                        <li class="submenu-item">
                            <a href="">Laporan Bimbel</a>
                        </li>
                        <li class="submenu-item">
                            <a href="">Laporan Studio Foto</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item">
                    <a href="" class="sidebar-link">
                        <i class="bi bi-grid-fill"></i>
                        <span>Kelola Akun</span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</div>
