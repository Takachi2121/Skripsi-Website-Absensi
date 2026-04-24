@extends('layouts.view')

@section('container-absensi')
@php
use App\Models\mahasiswa;
@endphp
<div class="content-wrapper" style="background-color: white">
    <div class="content-header layout">
        <div class="container-fluid">
            <div class="row mb-2 mt-2">
                <h3 class="mb-3 ">Data Kelas</h3>
                <div class="col-md-9">
                    <a href="{{ route('kelas.create') }}">
                        <button class="btn btn-outline-primary mr-2">
                            <i class="fa-solid fa-plus"></i> Tambahkan
                        </button>
                    </a>
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
                                <th scope="col">Ruang Kelas</th>
                                <th scope="col">Jurusan</th>
                                <th scope="col">Semester</th>
                                <th scope="col">Nama_DPA</th>
                                <th scope="col">Jumlah Mahasiswa</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @forelse($kelas as $key => $k)
                            @php
                            $jml = mahasiswa::where('id_kelas', $k->id)->count();
                            @endphp
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $k->kelas }}</td>
                                <td>{{ $k->nama_jurusan }}</td>
                                <td>{{ $k->semester }}</td>
                                <td>{{ $k->nama_DPA }}</td>
                                <td>{{ $jml }}</td>
                                <td>
                                    <a href="{{ route('kelas.edit', $k->id) }}">
                                        <button class="btn btn-success btn-sm">Edit</button>
                                    </a>
                                    <button onclick="deleteKelas('{{ $k->id }}')" class="btn btn-danger btn-sm">Delete</button>
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
