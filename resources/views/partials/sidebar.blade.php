<aside class="main-sidebar sidebar-light elevation-4 position-fixed">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
        <img src="{{ asset('img/polinema_logo.png') }}" alt="Polinema Picture" class="rounded mx-auto d-block" height="100" width="100">
    </a>
    @php
        $admin = Auth::guard('admin')->user();
    @endphp
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('img/'. $admin->imgProfile) }}" class="img-circle elevation-2" alt="User Image" style="width: 40px; height: 40px;">
            </div>
            <div class="info">
                <a class="d-block" style="cursor: default;">{{ $admin->username }}</a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2 position-relative">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
            <a href="{{ route('mahasiswa.view') }}" class="nav-link">
                <i class="nav-icon fas fa-address-card"></i>
                    <p>
                        Data Mahasiswa
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('kelas.view') }}" class="nav-link">
                <i class="nav-icon fa-solid fa-folder"></i>
                    <p>
                        Data Kelas
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('jurusan.view') }}" class="nav-link">
                <i class="nav-icon fa-solid fa-graduation-cap"></i>
                    <p>
                        Data Jurusan
                    </p>
                </a>
            </li>
            <hr style=" border-color: gray">
            <li class="nav-item">
                <a href="{{ route('jadwal.view') }}" class="nav-link">
                <i class="nav-icon fa-solid fa-calendar"></i>
                    <p>
                        Jadwal Kuliah
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('absensi.view') }}" class="nav-link">
                <i class="nav-icon fa-solid fa-cloud"></i>
                    <p>
                        Data Absensi
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('akun.home') }}" class="nav-link">
                <i class="nav-icon fas fa-solid fa-building"></i>
                    <p>
                        Akun Mahasiswa
                    </p>
                </a>
            </li>
            <hr style="border-color: gray">
            <li class="nav-item">
                <a href="{{ route('admin.data') }}" class="nav-link">
                <i class="nav-icon fas fa-solid fa-gear"></i>
                    <p>
                        Pengaturan
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.pass') }}" class="nav-link">
                <i class=" nav-icon fas fa-solid fa-pen-to-square"></i>
                    <p>
                        Ubah Password
                    </p>
                </a>
            </li>
            <li class="nav-item position-fixed bottom-0">
                <hr style="border-color: gray; width: 100%">
                <a href="{{ route('logout.acc') }}" class="nav-link">
                <i class=" nav-icon fas fa-solid fa-door-open"></i>
                    <p>
                        Log Out
                    </p>
                </a>
            </li>
        </ul>
    </nav>
</div>
</aside>
