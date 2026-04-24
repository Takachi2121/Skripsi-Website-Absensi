@extends('layouts.view')

@section('container-absensi')

<div class="content-wrapper" style="background-color: white">
    <div class="content-header p-4">
        <div class="container-fluid px-4">
            <h3>Tambah Data Kelas</h3>
            <hr style="border-width: 2px; background-color: #B4B8C5">
            <form action="{{ route('kelas.store') }}" method="POST" id="FormKelas">
                @csrf
                <div class="row mt-1">
                    <div class="col-md-4">
                        <p>Kelas<span class="star-wajib">*</span></p>
                    </div>
                    <div class="col-md-1">
                        <input type="text" class="form-control" name="Kelas" id="Kelas" required>
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-md-4">
                        <p>Jurusan<span class="star-wajib">*</span></p>
                    </div>
                    <div class="col-md-2">
                        <select name="jurusan" id="jurusan" class="form-control">
                            <option style="display: none;" selected>-- Pilih Jurusan --</option>
                            @foreach($jurusan as $jur)
                                <option value="{{ $jur->jur_id }}">{{ $jur->nama_jurusan }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-md-4">
                        <p>Semester<span class="star-wajib">*</span></p>
                    </div>
                    <div class="col-sm-1">
                        <input type="number" class="form-control" name="semester" id="semester" min="0" required>
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-md-4">
                        <p>Nama DPA<span class="star-wajib">*</span></p>
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="namaDPA" id="namaDPA" required>
                    </div>
                </div>
                @for ($i = 1; $i < 9; $i++)
                <div class="row mt-1">
                    <div class="col-md-4">
                        <p>Mata Kuliah {{ $i }}<span class="star-wajib"></span></p>
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="matkul_{{ $i }}" id="matkul_{{ $i }}">
                    </div>
                </div>
                @endfor
                <div class="col-mt-6 d-flex justify-content-center gap-3">
                    <button type="button" class="btn btn-danger" onclick="window.location.href='{{ route('mahasiswa.view') }}'">Kembali</button>
                    <button type="button" onclick="validasiKelas()" class="btn btn-success">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
