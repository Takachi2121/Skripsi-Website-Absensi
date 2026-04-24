<nav class="main-header navbar navbar-expand navbar-light">
    <!-- Left navbar links -->
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">
            <div class="navbar-search-block">
                <form class="form-inline">
                    <div class="input-group input-group-sm">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                            <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>

        <!-- Messages Dropdown Menu -->
        @php
            $user = Auth::guard('admin')->user();
        @endphp
        <li class="nav-item dropdown mr-3">
            <a class="nav-link nav-icon-hover mb-3" id="drop2" data-toggle="dropdown">
            <img src="{{ asset('img/'. $user->imgProfile) }}" alt="Polinema Picture" width="40" height="40" class="rounded-circle ">
            </a>
            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up " aria-labelledby="drop2 ">
                <div class="message-body ">
                    <a href="#" class="d-flex align-items-center gap-2 dropdown-item ">
                        <i class="ti ti-user fs-6 "></i>
                        <p class="mb-0 fs-3 ">My Profile</p>
                    </a>
                    <a id="logout-button" href="/login" class="btn btn-outline-primary mx-3 mt-2 d-block ">Logout</a>
                </div>
            </div>
        </li>
    </ul>
</nav>
<script>
    document.getElementById('logout-button').addEventListener('click', function(event) {
        event.preventDefault(); // Mencegah tindakan klik default

        // Munculkan lapisan latar belakang gelap
        var overlay = document.createElement('div');
        overlay.className = 'overlay';

        // Buat elemen kotak popup
        var popup = document.createElement('div');
        popup.className = 'popup';

        // Isi pesan dalam popup
        var message = document.createElement('p');
        message.textContent = "Apakah anda yakin akan keluar?";

        // Buat kontainer tombol dalam popup
        var buttonContainer = document.createElement('div');
        buttonContainer.className = 'button-container';

        // Buat tombol dalam popup
        var confirmButton = document.createElement('button');
        confirmButton.className = 'popup-button';
        confirmButton.textContent = 'Ya';

        var cancelButton = document.createElement('button');
        cancelButton.className = 'popup-cancel-button';
        cancelButton.textContent = 'Tidak';

        // Tambahkan tombol ke dalam kontainer tombol
        buttonContainer.appendChild(cancelButton);
        buttonContainer.appendChild(confirmButton);


        // Tambahkan elemen pesan, kontainer tombol, dan tombol ke dalam popup
        popup.appendChild(message);
        popup.appendChild(buttonContainer);

        // Tambahkan popup ke lapisan latar belakang gelap
        overlay.appendChild(popup);

        // Tambahkan lapisan latar belakang gelap ke dalam body dokumen
        document.body.appendChild(overlay);

        // Tambahkan event listener untuk tombol konfirmasi dalam popup
        confirmButton.addEventListener('click', function() {
            // Hapus lapisan latar belakang gelap
            document.body.removeChild(overlay);

            // Arahkan ke route logout
            window.location.href = '/logout';
        });

        // Tambahkan event listener untuk tombol batal dalam popup
        cancelButton.addEventListener('click', function() {
            // Hapus lapisan latar belakang gelap
            document.body.removeChild(overlay);
        });
    });
</script>
