@extends('layouts.view')

@section('container-absensi')
<div class="content-wrapper" style="background-color: white">
    <div class="content-header layout">
        <div class="container-fluid">
            <div class="row mb-2 mt-2">
                <h3 class="mb-3 ">Data Jurusan</h3>
                <div class="col-md-9">
                    <button class="btn btn-outline-primary mr-2" onclick="tambahJurusan()">
                        <i class="fa-solid fa-plus"></i> Tambahkan
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
                                <th scope="col">Jurusan</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @forelse($jurusan as $key => $j)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $j->nama_jurusan }}</td>
                                <td>
                                    <button class="btn btn-success btn-sm" onclick="editJurusan('{{ $j->nama_jurusan }}', '{{ $j->jur_id }}')">Edit</button>
                                    <button onclick="deleteJurusan('{{ $j->jur_id }}')" class="btn btn-danger btn-sm">Delete</button>
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
