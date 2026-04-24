@extends('layouts.view')

@section('container-absensi')

<div class="content-wrapper" style="background-color: white">
    <div class="content-header p-4">
        <div class="container-fluid px-4">
            <h3>Tambah Jadwal Kuliah</h3>
            <hr style="border-width: 2px; background-color: #B4B8C5">
            <form action="{{ route('kelas.store') }}" method="POST" id="FormKelas">
                @csrf
                <div class="row mt-1">
                    <div class="col-md-4">
                        <p>Jurusan<span class="star-wajib">*</span></p>
                    </div>
                    <div class="col-sm-2">
                        <select name="jurusan" class="form-control jurusan" id="jurusan">
                            <option selected style="display: none;">-- Pilih Jurusan --</option>
                            @foreach ($jurusan as $item)
                                <option value="{{ $item->jur_id }}">{{ $item->nama_jurusan }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-md-4">
                        <p>Kelas<span class="star-wajib">*</span></p>
                    </div>
                    <div class="col-md-2">
                        <select name="kelas" id="kelas" class="form-control kelas">
                            <option selected style="display: none;">-- Pilih jurusan terlebih dahulu --</option>
                        </select>
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-md-4">
                        <p>Semester<span class="star-wajib">*</span></p>
                    </div>
                    <div class="col-sm-1">
                        <input type="number" min="1" max="8" class="form-control" name="semester" id="semester" required placeholder="semester">
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-md-4">
                        <p>Hari<span class="star-wajib">*</span></p>
                    </div>
                    <div class="col-md-2">
                        <select name="hari" id="hari" class="form-control">
                            <option selected style="display: none;">-- Pilih Hari --</option>
                            <option value="Senin">Senin</option>
                            <option value="Selasa">Selasa</option>
                            <option value="Rabu">Rabu</option>
                            <option value="Kamis">Kamis</option>
                            <option value="Jumat">Jumat</option>
                        </select>
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-md-4">
                        <p>Mata Kuliah<span class="star-wajib">*</span></p>
                    </div>
                    <div class="col-md-3">
                        <select name="matkul" id="matkul" class="form-control matkul">
                            <option selected style="display: none;">-- Pilih kelas terlebih dahulu --</option>
                            {{-- @foreach ($kelas as $item)
                                @for ($i = 1; $i < 9; $i++)
                                    @php
                                        $matkul = 'matkul_' . $i;
                                    @endphp
                                    <option value="{{ $item->$matkul }}">{{ $item->$matkul }}</option>
                                @endfor
                            @endforeach --}}
                        </select>
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-md-4">
                        <p>Jam Mulai<span class="star-wajib">*</span></p>
                    </div>
                    <div class="col-md-1">
                        <input type="text" class="form-control" name="matkul_1" id="matkul_1">
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-md-4">
                        <p>Jam Akhir<span class="star-wajib">*</span></p>
                    </div>
                    <div class="col-md-1">
                        <input type="text" class="form-control" name="matkul_1" id="matkul_1">
                    </div>
                </div>
                <div class="col-mt-6 d-flex justify-content-center gap-3">
                    <button type="button" class="btn btn-danger" onclick="window.location.href='{{ route('mahasiswa.view') }}'">Kembali</button>
                    <button type="button" onclick="validasiKelas()" class="btn btn-success">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(".jurusan").change(function() {
        var selectedOption = $(this).children("option:selected").val();

        // Lakukan permintaan Ajax
        $.ajax({
            url: 'getKelas/' + selectedOption,
            type: 'GET',
            success: function(data) {
                // Hapus opsi lama pada pilihan kedua
                $(".kelas").empty();

                // Tambahkan opsi baru berdasarkan data dari server
                $.each(data, function(id, value) {
                    $(".kelas").append('<option value="" selected style="display:none;">-- Pilih Kelas --</option>');
                    $(".kelas").append('<option value="' + id + '">' + value + '</option>');
                });
            }
        });
    });

    $(".kelas").change(function() {
        var kelas = $(this).children("option:selected").val();

        // Lakukan permintaan Ajax
        $.ajax({
            url: 'getMatkul/' + kelas,
            type: 'GET',
            success: function(data) {
                // Hapus opsi lama pada pilihan ketiga
                $(".matkul").empty();
                $(".matkul").append('<option value="" selected style="display:none;">-- Pilih Mata Kuliah --</option>');

                // Tambahkan opsi baru berdasarkan data dari server
                $(".matkul").append('<option value="' + data.id + '">' + data.matkul_1 + '</option>');
                $(".matkul").append('<option value="' + data.id + '">' + data.matkul_2 + '</option>');
                $(".matkul").append('<option value="' + data.id + '">' + data.matkul_3 + '</option>');
                $(".matkul").append('<option value="' + data.id + '">' + data.matkul_4 + '</option>');
                $(".matkul").append('<option value="' + data.id + '">' + data.matkul_5 + '</option>');
                $(".matkul").append('<option value="' + data.id + '">' + data.matkul_6 + '</option>');
                $(".matkul").append('<option value="' + data.id + '">' + data.matkul_7 + '</option>');
                $(".matkul").append('<option value="' + data.id + '">' + data.matkul_8 + '</option>');

                // Tambahkan kolom matkul lainnya sesuai kebutuhan
            }
        });
    });
</script>

@endsection
