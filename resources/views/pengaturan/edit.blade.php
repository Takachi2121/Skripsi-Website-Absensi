@extends('layouts.view')

@section('container-absensi')
<div class="content-wrapper" style="background-color: white">
    <div class="content-header ">
        <div class="container-fluid ">
            <h3 class="py-2">Edit Profil</h3>
            <div class="row">
                <div class="col-xl-3">
                    <!-- Profile picture card-->
                    @error('change-data')
                            <script>
                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: "bottom-end",
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true,
                                    didOpen: (toast) => {
                                        toast.onmouseenter = Swal.stopTimer;
                                        toast.onmouseleave = Swal.resumeTimer;
                                    }
                                });
                                    Toast.fire({
                                    icon: "success",
                                    title: "Data telah diubah!"
                                });
                            </script>
                        @enderror

                        @error('img-delete')
                            <script>
                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: "bottom-end",
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true,
                                    didOpen: (toast) => {
                                        toast.onmouseenter = Swal.stopTimer;
                                        toast.onmouseleave = Swal.resumeTimer;
                                    }
                                });
                                    Toast.fire({
                                    icon: "success",
                                    title: "Gambar telah dihapus!"
                                });
                            </script>
                        @enderror
                    <div class="card mb-4 mb-xl-0">
                        <center><div class="card-header bg-gradient-blue">Profile Picture</div></center>
                        <div class="card-body text-center">

                            <img class="img-account-profile rounded-circle mb-2" src="{{ asset('img/' . $user->imgProfile) }}" alt="" style="width: 150px; height: 150px;" data-toggle="modal" data-target="#profileModal">

                            <div class="modal fade" id="profileModal" tabindex="-1" role="dialog" aria-labelledby="profileModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <img src="{{ asset('img/' . $user->imgProfile) }}" alt="Profile Picture" width="100%">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="small mb-0"><h4>{{ $user->username }}</h4></div>
                            <div class="small text-muted  mb-4">{{ $user->email }}</div>

                            <div class="dropdown">
                                <button class="btn dropdown-toggle btn-primary" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Pengaturan Gambar
                                </button>
                                <ul class="dropdown-menu text-center pl-2 pr-2">
                                    <li>
                                        <a style="cursor: pointer;" class="dropdown-item" id="changeProfile">Ubah Gambar</a>
                                        <input type="file" id="img_profile" name="img_profile" style="display: none;" accept=".png, .jpg">
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('profile.delete', $user->id) }}">Hapus Gambar</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- JS Sederhana untuk mengubah gambar --}}
                <script>
                    const labelUbah = document.querySelector('#changeProfile');
                    const inputImgProfile = document.getElementById('img_profile');

                    labelUbah.addEventListener('click', () => {
                        inputImgProfile.click();
                    });

                    inputImgProfile.addEventListener('change', () => {
                        if (inputImgProfile.files.length > 0) {
                            const formData = new FormData();
                            formData.append('img_profile', inputImgProfile.files[0]);

                            fetch('{{ route('profile.update', $user->id) }}', {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-Token': '{{ csrf_token() }}'
                                },
                                body: formData
                            })
                        var xhr = new XMLHttpRequest();
                        xhr.open('GET', '{{ route('admin.edit', $user->id) }}', true);
                        xhr.onreadystatechange = function() {
                            if (xhr.readyState === 4 && xhr.status === 200) {
                            // Gantikan konten bagian tertentu dengan konten yang diperbarui
                            window.location.href = '{{ route('admin.edit', $user->id) }}';
                            }else{
                                document.getElementById('segar').innerHTML = xhr.responseText;
                            }
                        };
                        xhr.send();
                        }
                    });
                </script>
                <div class="col-xl-9">
                    <!-- Account details card-->
                    <div class="card mb-4">
                        <center><div class="card-header bg-blue">Account Details</div></center>
                        <div class="card-body justify-content-center back-logo" style="background-size: 200px;">
                            <form action="{{ route('admin.update', $user->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="row gx-3 mb-3">
                                    <div class="col-md-6">
                                        <label class="small mb-1">Email</label>
                                        <input class="form-control" type="text" name="email" value="{{ $user->email }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="small mb-1">Username</label>
                                        <input class="form-control" style="cursor:default;" type="text" name="username" value="{{ $user->username }}">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="small mb-1">Nama Lengkap</label>
                                <input class="form-control" type="text" name="namaLengkap" value="{{ $user->namaLengkap }}" >
                                </div>
                                <div class="row gx-3 mb-3">
                                    <div class="col-md-6">
                                        <label class="small mb-1">Prodi</label>
                                        <input class="form-control" name="prodi" type="text" value="{{ $user->prodi }}" >
                                    </div>
                                    <div class="col-md-6">
                                        <label class="small mb-1">Jurusan</label>
                                        <input class="form-control" name="jurusan" type="text" value="{{ $user->jurusan }}" >
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="small mb-1">Alamat</label>
                                    <input class="form-control" name="alamat" type="text" value="{{ $user->alamat }}" >
                                </div>
                                <center>
                                    <button class="btn btn-success pl-5 pr-5 mr-2" type="submit">Simpan</button>
                                    <a href="{{ route('admin.data') }}">
                                        <button class="btn btn-danger pl-5 pr-5" type="button">Batal</button>
                                    </a>
                                </center>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
