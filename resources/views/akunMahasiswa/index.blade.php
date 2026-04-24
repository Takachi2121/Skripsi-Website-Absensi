@extends('layouts.view')

@section('container-absensi')
<div class="content-wrapper" style="background-color: white">
    <div class="content-header layout">
        <div class="container-fluid">
            <div class="row mb-2 mt-2">
                <h3 class="mb-3 ">Akun Mahasiswa</h3>
                <div class="col-md-9">
                    <button class="btn btn-outline-primary mr-2">
                        <i class="fa-solid fa-filter"></i> Online
                    </button>
                    <button class="btn btn-outline-danger mr-2">
                        <i class="fa-solid fa-filter"></i> Offline
                    </button>
                    <button class="btn btn-outline-secondary mr-2">
                        <i class="fa-solid fa-rotate"></i> Reset
                    </button>
                </div>
                <div class="col-md-3">
                    <div class="input-group mb-3">
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
                                <th scope="col">Password</th>
                                <th scope="col">Nama Lengkap</th>
                                <th scope="col">Kelas</th>
                                <th scope="col">Tahun Masuk</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>

                        <tbody class="text-center">
                            @forelse($mahasiswa as $key => $j)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $j->NIM }}</td>
                                <td>{{ $j->password }}</td>
                                <td>{{ $j->namaLengkap }}</td>
                                <td>{{ $j->kelas }}</td>
                                <td>{{ $j->tahunMasuk }}</td>
                                <td>
                                    @if($j->Status == "Offline")
                                        <button class="btn btn-danger btn-sm">{{$j->Status}}</button>
                                    @elseif($j->Status == "Online")
                                        <button class="btn btn-success btn-sm">{{$j->Status}}</button>
                                    @endif
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

<script>
    $(document).ready(function() {
        // Fungsi untuk menampilkan semua data mahasiswa
        function showAllData() {
            $('tbody tr').show();
        }

        // Fungsi untuk menyembunyikan semua data mahasiswa
        function hideAllData() {
            $('tbody tr').hide();
        }

        // Fungsi untuk menampilkan data mahasiswa berdasarkan status
        function showDataByStatus(status) {
            $('tbody tr').each(function() {
                if ($(this).find('td:last button').text().trim() === status) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        }

        // Tambahkan penanganan klik pada tombol Online
        $('.btn-outline-primary').on('click', function() {
            hideAllData();
            showDataByStatus('Online');
        });

        // Tambahkan penanganan klik pada tombol Offline
        $('.btn-outline-danger').on('click', function() {
            hideAllData();
            showDataByStatus('Offline');
        });

        // Tambahkan penanganan klik pada tombol Reset
        $('.btn-outline-secondary').on('click', function() {
            showAllData();
        });

        // Tambahkan penanganan klik pada tombol untuk menampilkan semua data
        $('.btn-outline-primary, .btn-outline-danger').on('click', function() {
            if ($(this).hasClass('active')) {
                showAllData();
            }
        });
    });
</script>
@endsection
