@extends('layouts.view')

@section('container-absensi')

<div class="content-wrapper" style="background-color: white">
    <div class="content-header p-4">
        <div class="container-fluid px-4">
            <h3>Tambah Data Kelas</h3>
            <hr style="border-width: 2px; background-color: #B4B8C5">
            <form action="{{ route('kelas.update', $kelas->id) }}" method="POST" id="FormKelas">
                @method('PUT')
                @csrf
                <div class="row mt-1">
                    <div class="col-md-4">
                        <p>Kelas<span class="star-wajib">*</span></p>
                    </div>
                    <div class="col-md-1">
                        <input type="text" class="form-control" name="Kelas" id="Kelas" value="{{ $kelas->kelas }}" required>
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-md-4">
                        <p>Jurusan<span class="star-wajib">*</span></p>
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="jurusan" id="jurusan" value="{{ $kelas->jurusan }}" required>
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-md-4">
                        <p>SKS<span class="star-wajib">*</span></p>
                    </div>
                    <div class="col-sm-1">
                        <input type="number" class="form-control" name="sks" id="sks" value="{{ $kelas->sks }}" required>
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-md-4">
                        <p>Nama DPA<span class="star-wajib">*</span></p>
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="namaDPA" id="namaDPA" value="{{ $kelas->nama_DPA }}" required>
                    </div>
                </div>
                @for ($i = 1; $i < 9; $i++)
                    <div class="row mt-1">
                        <div class="col-md-4">
                            <p>Mata Kuliah {{ $i }}<span class="star-wajib"></span></p>
                        </div>
                        @php
                            $matkul = "matkul_" . $i;
                        @endphp
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="{{ $matkul }}" id="{{ $matkul }}" value="{{ $kelas->$matkul }}">
                        </div>
                    </div>
                @endfor
                <div class="col-mt-6 d-flex justify-content-center gap-3">
                    <button type="button" class="btn btn-danger" onclick="window.location.href='{{ route('kelas.view') }}'">Kembali</button>
                    <button type="button" onclick="editKelas()" class="btn btn-primary px-4">Ubah</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
