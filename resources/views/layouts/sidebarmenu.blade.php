<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        @can('user-list')
            <li
                class="nav-item @isset($navlink) @if (in_array('pengurusan_pengguna', $navlink)) menu-open @endif @endisset">
                <a href="#"
                    class="nav-link @isset($navlink) @if (in_array('pengurusan_pengguna', $navlink)) active @endif @endisset">
                    <i class="nav-icon fas fa-user-cog"></i>
                    <p>PENGURUSAN PENGGUNA <i class="fas fa-angle-left right"></i> </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('users.index') }}"
                            class="nav-link @isset($navlink) @if (in_array('pengguna', $navlink)) active @endif @endisset">
                            <i class="nav-icon fas fa-user"></i>
                            <p>PENGGUNA </p>
                        </a>
                    </li>
                </ul>
            </li>
        @endcan

        @can('role-list')
            <li
                class="nav-item @isset($navlink) @if (in_array('pengurusan_sistem', $navlink)) menu-open @endif @endisset">
                <a href="#"
                    class="nav-link @isset($navlink) @if (in_array('pengurusan_sistem', $navlink)) active @endif @endisset">
                    <i class="nav-icon fas fa-tools"></i>
                    <p>PENGURUSAN SISTEM<i class="fas fa-angle-left right"></i></p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('roles.index') }}"
                            class="nav-link @isset($navlink) @if (in_array('peranan', $navlink)) active @endif @endisset">
                            <i class="nav-icon fas fa-suitcase-rolling"></i>
                            <p>PERANAN</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('permissions.index') }}"
                            class="nav-link @isset($navlink) @if (in_array('kebenaran', $navlink)) active @endif @endisset">
                            <i class="nav-icon far fa-calendar-alt"></i>
                            <p> KEBENARAN </p>
                        </a>
                    </li>
                    @can('pangkat-list')
                        <li class="nav-item">
                            <a href="{{ route('pangkat.index') }}"
                                class="nav-link @isset($navlink) @if (in_array('pangkat', $navlink)) active @endif @endisset">
                                <i class="nav-icon far fa-calendar-alt"></i>
                                <p>PANGKAT </p>
                            </a>
                        </li>
                    @endcan
                    @can('jawatan-list')
                        <li class="nav-item">
                            <a href="{{ route('jawatan.index') }}"
                                class="nav-link @isset($navlink) @if (in_array('jawatan', $navlink)) active @endif @endisset">
                                <i class="nav-icon far fa-calendar-alt"></i>
                                <p>JAWATAN</p>
                            </a>
                        </li>
                    @endcan
                    {{-- @can('jawatan-list')
                        <li class="nav-item">
                            <a href="{{ route('status.index') }}"
                                class="nav-link @isset($navlink) @if (in_array('status', $navlink)) active @endif @endisset">
                                <i class="nav-icon far fa-calendar-alt"></i>
                                <p> STATUS</p>
                            </a>
                        </li>
                    @endcan --}}

                </ul>
            </li>
        @endcan

        @can('pangkat-list')
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon far fa-calendar-alt"></i>
                    <p> PENGURUSAN UTILITI <i class="right fas fa-angle-left"></i></p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('pasukan.index') }}" class="nav-link">
                            <i class="nav-icon far fa-calendar-alt"></i>
                            <p>PASUKAN </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('saluran.index') }}"
                            class="nav-link @isset($navlink) @if (in_array('saluran', $navlink)) active @endif @endisset">
                            <i class="nav-icon far fa-calendar-alt"></i>
                            <p>SALURAN</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('orgmatriks.index') }}" class="nav-link">
                            <i class="nav-icon far fa-calendar-alt"></i>
                            <p> ORGANISASI TENTERA DARAT</p>
                        </a>
                    </li>
                    
                </ul>
            </li>
        @endcan

        <li
            class="nav-item @isset($navlink) @if (in_array('utama', $navlink)) menu-open @endif @endisset">
            <a href="{{ route('carianutama', ['id' => '21ece77a-4382-11ed-8dfb-0242ac110002']) }}" class="nav-link">
                <i class="nav-icon fas fa-landmark"></i>
                <p> UTAMA<i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('carianutama', ['id' => '21ece77a-4382-11ed-8dfb-0242ac110002']) }}"
                        class="nav-link">
                        <i class="nav-icon far fa-calendar-alt"></i>
                        <p> ASET UTAMA</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('cariankja', ['id' => '21ece77a-4382-11ed-8dfb-0242ac110002']) }}"
                        class="nav-link">
                        <i class="nav-icon far fa-calendar-alt"></i>
                        <p> ASET KJA</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('senjata', ['id' => '21ece77a-4382-11ed-8dfb-0242ac110002']) }}"
                        class="nav-link">
                        <i class="nav-icon far fa-calendar-alt"></i>
                        <p> ASET SENJATA</p>
                    </a>
                </li>

                <li
                    class="nav-item @isset($navlink) @if (in_array('artileri', $navlink)) menu-open @endif @endisset">
                    <a href="#"
                        class="nav-link @isset($navlink) @if (in_array('artileri', $navlink)) active @endif @endisset">
                        <i class="nav-icon fas fa-user-cog"></i>
                        <p> ASET ARTILERI<i class="fas fa-angle-left right"></i> </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('artileri', ['id' => '21ece77a-4382-11ed-8dfb-0242ac110002']) }}"
                                class="nav-link @isset($navlink) @if (in_array('artileri', $navlink)) active @endif @endisset">
                                <i class="nav-icon fas fa-user"></i>
                                <p> ARTILERI </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('medan', ['id' => '21ece77a-4382-11ed-8dfb-0242ac110002']) }}"
                                class="nav-link @isset($navlink) @if (in_array('medan', $navlink)) active @endif @endisset">
                                <i class="nav-icon fas fa-user"></i>
                                <p> MEDAN </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('pertahananudara', ['id' => '21ece77a-4382-11ed-8dfb-0242ac110002']) }}"
                                class="nav-link @isset($navlink) @if (in_array('pertahananudara', $navlink)) active @endif @endisset">
                                <i class="nav-icon fas fa-user"></i>
                                <p> PERTAHANAN UDARA </p>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('pasukankhas', ['id' => '21ece77a-4382-11ed-8dfb-0242ac110002']) }}"
                        class="nav-link">
                        <i class="nav-icon far fa-calendar-alt"></i>
                        <p> ASET PASUKAN KHAS</p>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a href="{{ route('carianutama', ['id' => '21ece77a-4382-11ed-8dfb-0242ac110002']) }}" class="nav-link">
                <i class="nav-icon fas fa-landmark"></i>
                <p>DUKUNGAN<i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('dukungan', ['id' => '21ece77a-4382-11ed-8dfb-0242ac110002']) }}"
                        class="nav-link">
                        <i class="nav-icon far fa-calendar-alt"></i>
                        <p>ASET DUKUNGAN </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('darat', ['id' => '21ece77a-4382-11ed-8dfb-0242ac110002']) }}"
                        class="nav-link">
                        <i class="nav-icon far fa-calendar-alt"></i>
                        <p>MOBILITI DARAT</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('perairan', ['id' => '21ece77a-4382-11ed-8dfb-0242ac110002']) }}"
                        class="nav-link">
                        <i class="nav-icon far fa-calendar-alt"></i>
                        <p>MOBILITI PERAIRAN</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('udara', ['id' => '21ece77a-4382-11ed-8dfb-0242ac110002']) }}"
                        class="nav-link">
                        <i class="nav-icon far fa-calendar-alt"></i>
                        <p>MOBILITI UDARA</p>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a href="{{ route('komunikasi', ['id' => '21ece77a-4382-11ed-8dfb-0242ac110002']) }}" class="nav-link">
                <i class="nav-icon fas fa-landmark"></i>
                <p>KOMUNIKASI<i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">

                <li class="nav-item">
                    <a href="{{ route('komunikasi', ['id' => '21ece77a-4382-11ed-8dfb-0242ac110002']) }}"
                        class="nav-link">
                        <i class="nav-icon far fa-calendar-alt"></i>
                        <p>ASET KOMUNIKASI</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('manpack', ['id' => '21ece77a-4382-11ed-8dfb-0242ac110002']) }}"
                        class="nav-link">
                        <i class="nav-icon far fa-calendar-alt"></i>
                        <p>ASET MANPACK</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('vehicular', ['id' => '21ece77a-4382-11ed-8dfb-0242ac110002']) }}"
                        class="nav-link">
                        <i class="nav-icon far fa-calendar-alt"></i>
                        <p>ASET VEHICULAR</p>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a href="{{ route('khidmat', ['id' => '21ece77a-4382-11ed-8dfb-0242ac110002']) }}" class="nav-link">
                <i class="nav-icon fas fa-landmark"></i>
                <p>KHIDMAT</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="" class="nav-link">
                <i class="nav-icon fas fa-landmark"></i>
                <p> LAPORAN STOK <i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">

                <li class="nav-item">
                    <a href="{{ route('DukunganAir', ['id' => '21ece77a-4382-11ed-8dfb-0242ac110002']) }}"
                        class="nav-link">
                        <i class="nav-icon far fa-calendar-alt"></i>
                        <p>DUKUNGAN AIR</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('jutra.index') }}" class="nav-link">
                        <i class="nav-icon far fa-calendar-alt"></i>
                        <p>JURUTERA </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('splogpeluru.index') }}" class="nav-link">
                        <i class="nav-icon far fa-calendar-alt"></i>
                        <p>PELURU</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('sputama.index') }}" class="nav-link">
                        <i class="nav-icon far fa-calendar-alt"></i>
                        <p>PERALATAN</p>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a href="{{ route('carianpantas.index') }}" class="nav-link">
                <i class="nav-icon fas fa-landmark"></i>
                <p>CARIAN PANTAS </p>
            </a>
        </li>
    </ul>
    </li>
</nav>
