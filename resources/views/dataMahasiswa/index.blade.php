    @extends('layouts.view')

@section('container-absensi')
<div class="content-wrapper" style="background-color: white">
    <div class="content-header layout">
        <div class="container-fluid">
            <div class="row mb-2 mt-2">
                <h3 class="mb-3 ">Data Mahasiswa</h3>
                <div class="col-md-9">
                    <a href="{{ route('mahasiswa.create') }}">
                        <button class="btn btn-outline-primary mr-2">
                            <i class="fa-solid fa-plus"></i> Tambahkan
                        </button>
                    </a>
                </div>
                <div class="col-md-3">
                    <div class="input-group mb-3">
                        <button class="btn btn-outline-success mr-2 date" data-bs-toggle="modal" data-bs-target="#importExcel">
                            <i class="fa-solid fa-file-excel mr-2"></i> Import Excel
                        </button>
                        <input type="text" class="form-control" id="searchInput" name="text-search" placeholder="Cari Data">
                    </div>
                </div>
            </div>
            <div class="modal fade" id="importExcel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header" style="border-width: 0px;">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('mahasiswa.import') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <input type="file" name="file" accept=".csv" class="form-control" required>
                            </div>
                            <div class="modal-footer d-flex justify-content-center" style="border-width: 0px;">
                                <button type="submit" class="btn btn-success down-excel wait">Upload</button>
                            </div>
                        </form>
                        @error('upload-alert')
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
                                    title: "Data telah di import!"
                                });
                            </script>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="tbl-container">
                <div class="row scroll">
                    <table class="table align-middle">
                        <thead>
                            <tr class="text-center bg-dark">
                                <th scope="col">NIM</th>
                                <th scope="col">Nama Lengkap</th>
                                <th scope="col">Kelas</th>
                                <th scope="col">Jenis Kelamin</th>
                                <th scope="col">No telp</th>
                                <th scope="col">Tahun Masuk</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @forelse($mahasiswa as $m)
                            <tr>
                                <td>{{ $m->NIM }}</td>
                                <td>{{ $m->namaLengkap }}</td>
                                @php
                                    $namaKelas = App\Models\Kelas::find($m->id_kelas);
                                @endphp
                                <td>{{ $namaKelas->kelas }}</td>
                                <td>{{ $m->jenisKelamin }}</td>
                                <td>{{ $m->NoTelp }}</td>
                                <td>{{ $m->tahunMasuk }}</td>
                                <td>
                                    <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#infoMahasiswa{{ $m->id }}">Info</button>

                                    <div class="modal animate__animated animate__zoomIn animate__faster" id="infoMahasiswa{{ $m->id }}" tabindex="-1" aria-hidden="true" aria-labelledby="infoMahasiswaLabel">
                                        <div class="modal-dialog modal-lg modal-dialog-centered">
                                            <div class="modal-content">

                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="infoMahasiswaLabel">Data {{ $m->namaLengkap }}</h1>
                                                </div>

                                                <div class="modal-body back-logo">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            Data Mahasiswa
                                                            <hr style="border-color: #4056F4; border-width: 3px; opacity:inherit;">
                                                            <div class="row">
                                                                <div class="col-md-5">
                                                                    <p class="text-left">NIM:</p>
                                                                    <p class="text-left">Nama Lengkap:</p>
                                                                    <p class="text-left">Kelas:</p>
                                                                    <p class="text-left">Nomor Telepon:</p>
                                                                    <p class="text-left">Tahun Masuk:</p>
                                                                </div>
                                                                <div class="col-md-7">
                                                                    <p class="text-left">{{ $m->NIM }}</p>
                                                                    <p class="text-left">{{ $m->namaLengkap }}</p>
                                                                    @php
                                                                        $namaKelas = App\Models\Kelas::find($m->id_kelas);
                                                                    @endphp
                                                                    <p class="text-left">{{ $namaKelas->kelas }}</p>
                                                                    <p class="text-left">{{ $m->NoTelp }}</p>
                                                                    <p class="text-left">{{ $m->tahunMasuk }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            Data Ortu
                                                            <hr style="border-color: #470FF4; border-width: 3px; opacity:inherit;">
                                                            <div class="row">
                                                                <div class="col-md-5">
                                                                    <p class="text-left">Nama Ayah:</p>
                                                                    <p class="text-left">Nomor HP Ayah:</p>
                                                                    <p class="text-left">Nama Ibu:</p>
                                                                    <p class="text-left">Nomor HP Ibu:</p>
                                                                    <p class="text-left">Domisili:</p>
                                                                </div>
                                                                <div class="col-md-7" >
                                                                    @if($m->nama_Ayah != null)
                                                                        <p class="text-left">{{ $m->nama_Ayah }}</p>
                                                                    @else
                                                                        <p class="text-left">Tidak terisi</p>
                                                                    @endif
                                                                    @if($m->NoTelp_Ayah != null)
                                                                        <p class="text-left">{{ $m->NoTelp_Ayah }}</p>
                                                                    @else
                                                                        <p class="text-left">Tidak terisi</p>
                                                                    @endif
                                                                    @if($m->nama_Ibu != null)
                                                                        <p class="text-left">{{ $m->nama_Ibu }}</p>
                                                                    @else
                                                                        <p class="text-left">Tidak terisi</p>
                                                                    @endif
                                                                    @if($m->NoTelp_Ibu != null)
                                                                        <p class="text-left">{{ $m->NoTelp_Ibu }}</p>
                                                                    @else
                                                                        <p class="text-left">Tidak terisi</p>
                                                                    @endif
                                                                    <p class="text-left">{{ $m->Domisili }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <a href="{{ route('mahasiswa.edit', $m->id) }}">
                                        <button class="btn btn-success btn-sm">Edit</button>
                                    </a>
                                    <button onclick="deleteData('{{ $m->id }}')" class="btn btn-danger btn-sm">Delete</button>
                                </td>
                                @empty
                                <td colspan="7">Data Tidak Ada!</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    mencariData();
</script>
@endsection
