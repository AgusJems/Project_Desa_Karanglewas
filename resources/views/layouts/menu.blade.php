            {{-- tampilan menu --}}
            <ul class="sidebar-menu">
                <li class="menu-header">Dashboard</li>
                {{-- menu admin --}}
                @if (Auth::user()->role == 'admin')
                    <li class="{{ request()->is('admin') ? 'active' : '' }}">
                        <a href="{{ route('user.index') }}" class="nav-link"><i
                                class="fas fa-fire"></i><span>Dashboard</span></a>
                    </li>
                @endif
                {{-- menu user --}}
                @if (Auth::user()->role == 'user')
                    <li class="{{ request()->is('/') ? 'active' : '' }}">
                        <a href="{{ route('user.index') }}" class="nav-link"><i
                                class="fas fa-fire"></i><span>Dashboard</span></a>
                    </li>
                @endif
                {{-- menu global --}}
                <li class="{{ request()->is('profile') ? 'active' : '' }}">
                    <a href="{{ route('profile.index') }}" class="nav-link"><i
                            class="fas fa-book-reader"></i><span>Profil Desa</span></a>
                </li>
                <li class="{{ request()->is('struktur') ? 'active' : '' }}">
                    <a href="{{ route('struktur.index') }}" class="nav-link"><i
                            class="fas fa-sitemap"></i><span>Struktur Organisasi</span></a>
                </li>

                </li>
                {{-- menu admin --}}
                @if (Auth::user()->role == 'admin')
                    <li class="menu-header">Master</li>
                    <li class="nav-item dropdown">
                    <li class="{{ request()->is('penduduk') ? 'active' : '' }}">
                        <a href="{{ route('penduduk.index') }}" class="nav-link"><i class="fas fa-users"></i>
                            <span>Data Penduduk</span>
                        </a>
                    </li>
                    <li class="{{ request()->is('pkh') ? 'active' : '' }}">
                        <a href="{{ route('pkh.index') }}" class="nav-link"><i class="fas fa-users"></i>
                            <span>Data PKH</span>
                        </a>
                    </li>
                    <li class="{{ request()->is('vaksin') ? 'active' : '' }}">
                        <a href="{{ route('vaksin.index') }}" class="nav-link"><i class="fas fa-address-card"></i>
                            <span>Data Vaksin</span>
                        </a>
                    </li>
                    </li>

                    <li class="menu-header">Pembayaran</li>
                    <li class="nav-item dropdown">
                    <li class="{{ request()->is('umkm') ? 'active' : '' }}">
                        <a href="{{ route('umkm.index') }}" class="nav-link"><i class="fas fa-th-large"></i>
                            <span>UMKM</span></a>
                    </li>
                    <li class="{{ request()->is('pamsimas') ? 'active' : '' }}">
                        <a href="{{ route('pamsimas.index') }}" class="nav-link"><i class="fab fa-product-hunt"></i>
                            <span>Pamsimas</span></a>
                    </li>
                    </li>
                @endif

                {{-- menu user --}}
                @if (Auth::user()->role == 'user')
                    <li class="menu-header">Pembayaran</li>
                    <li class=" {{ request()->is('umkm') ? 'active' : '' }}">
                        <a href="{{ route('umkm.index') }}" class="nav-link"><i class="fas fa-th-large"></i>
                            <span>UMKM</span></a>
                    <li class=" {{ request()->is('pamsimas') ? 'active' : '' }}">
                        <a href="{{ route('pamsimas.index') }}" class="nav-link"><i class="fab fa-product-hunt"></i>
                            <span>Pamsimas</span></a>
                    </li>
                @endif

                {{-- tombol logout --}}
                <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
                    <a href="{{ route('logout.logout') }}" class="btn btn-danger btn-lg btn-block btn-icon-split">
                        <i class="fa fa-power-off"></i> Log Out
                    </a>
                </div>
