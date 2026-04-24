@extends('layouts.view')

@section('container-absensi')
<div class="content-wrapper" style="background-color: white">
    <div class="content-header layout">
        <div class="container-fluid">
            <div class="row mb-2 mt-2">
                <h3 class="mb-3 ">Data Absensi</h3>
                <div class="col-md-8">
                    <a href="{{ route('absensi.create') }}">
                        <button class="btn btn-outline-primary mr-2">
                            <i class="fa-solid fa-plus mr-2"></i>Tambah Data
                        </button>
                    </a>
                    <button class="btn btn-outline-dark mr-2 date" data-bs-toggle="modal" data-bs-target="#dateModal">
                        <i class="fa-solid fa-calendar mr-2"></i> Berdasarkan Tanggal
                    </button>
                    <div class="btn-group">
                        <button class="btn btn-outline-danger mr-2" data-bs-toggle="dropdown" aria-expanded="false" style="border-radius: 5px">
                            <i class="fa-solid fa-clipboard-check mr-2"></i> Berdasarkan Status
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="#" class="dropdown-item status">Terlambat</a></li>
                            <li><a href="#" class="dropdown-item status">Tidak Terlambat</a></li>
                            <li><a href="#" class="dropdown-item status">Tidak Absen</a></li>
                        </ul>
                    </div>
                    <button class="btn btn-outline-secondary mr-2 reset" onclick="window.location.reload()">
                        <i class="fa-solid fa-rotate mr-2"></i> Reset
                    </button>
                </div>
                <div class="col-md-4">
                    <div class="input-group mb-3">
                        <button class="btn btn-outline-success mr-2 date" data-bs-toggle="modal" data-bs-target="#excelModal">
                            <i class="fa-solid fa-file-excel mr-2"></i> Export Excel
                        </button>
                        <input type="text" class="form-control" name="search" id="searchInput" placeholder="Cari Data">
                    </div>
                </div>
            </div>
            <div class="tbl-container">
                <div class="row scroll">
                    <table class="table align-middle">
                        <thead>
                            <tr class="text-center bg-dark">
                                <th scope="col">No</th>
                                <th scope="col">NIM</th>
                                <th scope="col">Nama Mahasiswa</th>
                                <th scope="col">Kelas</th>
                                <th scope="col">Semester</th>
                                <th scope="col">Mata Kuliah</th>
                                <th scope="col">Hari</th>
                                <th scope="col">Tanggal Absen</th>
                                <th scope="col">Jam Absen</th>
                                <th scope="col">Status</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="text-center absenFilter regular">
                            @forelse($absensi as $key => $a)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $a->NIM }}</td>
                                <td>{{ $a->namaMahasiswa }}</td>
                                <td>{{ $a->kelas }}</td>
                                <td>{{ $a->semester }}</td>
                                <td>{{ $a->mataKuliah }}</td>
                                <td>{{ $a->hari }}</td>
                                <td>{{ $a->tgl_absen }}</td>
                                <td>{{ $a->jam_absen }}</td>
                                <td>
                                    @if($a->status == "Terlambat")
                                        <button class="btn btn-danger btn-sm">{{$a->status}}</button>
                                    @elseif($a->status == "Tidak Terlambat")
                                        <button class="btn btn-success btn-sm">{{$a->status}}</button>
                                    @elseif($a->status == "Tidak Absen")
                                        <button class="btn btn-dark btn-sm">{{ $a->status }}</button>
                                    @endif
                                </td>
                                <td>
                                    <button onclick="deleteAbsensi('{{ $a->id }}')" class="btn btn-danger btn-sm">Hapus</button>
                                </td>
                                @empty
                                <td colspan="11">Data Tidak Ada!</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    @include('Absensi.Modal.dateModal')
                    @include('Absensi.Modal.excelModal')
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    mencariData();

    $(document).on('click', '.status', function() {
        var status = $(this).html();
        $.ajax({
            url: "DataAbsensi/getAbsensi/" + status,
            method: "GET",
            data: {status: status},
            success: function(data) {
                $('.absenFilter').html(data);
                $('.absenFilter').removeClass('regular').addClass('filtered');
            }
        });
    });
</script>
@endsection
