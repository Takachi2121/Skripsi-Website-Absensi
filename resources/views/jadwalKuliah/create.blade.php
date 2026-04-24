@extends('layouts.view')

@section('container-absensi')

<div class="content-wrapper" style="background-color: white">
    <div class="content-header p-4">
        <div class="container-fluid px-4">
            <h3>Tambah Jadwal Kuliah</h3>
            <hr style="border-width: 2px; background-color: #B4B8C5">
            <form action="{{ route('jadwal.store') }}" method="POST" id="FormJadwal">
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
                        <input type="number" min="1" max="8" class="form-control semester" name="semester" id="semester" required placeholder="semester">
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
                        </select>
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-md-4">
                        <p>Tanggal Jadwal<span class="star-wajib">*</span></p>
                    </div>
                    <div class="col-md-2">
                        <input type="text" class="form-control" name="tanggal_jadwal" id="tglJadwal">
                    </div>
                    <script>
                        const tglJadwal = document.getElementById('tglJadwal');

                        flatpickr(tglJadwal, {
                            noCalendar: false,
                            enableTime: false,
                            dateFormat: "d-m-Y"
                        });
                    </script>
                </div>
                <div class="row mt-1">
                    <div class="col-md-4">
                        <p>Tahun Akademik <span class="star-wajib">*</span></p>
                    </div>
                    <div class="col-md-1">
                        <select class="form-control" name="tahunAkademik" id="thnAkademik">
                            <option selected class="d-none">YYYY</option>
                            @for ($i = 2020; $i <= date('Y'); $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-sm-1 text-center pt-1">
                        <p><b>/</b></p>
                    </div>
                    <div class="col-md-1">
                        <input type="text" placeholder="YYYY" class="form-control" name="tahunAkademik2" id="thnAkademik2" readonly>
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-md-4">
                        <p>Jam Mulai<span class="star-wajib">*</span></p>
                    </div>
                    <div class="col-md-1">
                        <input type="text" class="form-control" name="jam_mulai" id="jam_mulai">
                    </div>
                </div>
                <script>
                    const jamMulai = document.getElementById('jam_mulai');

                    flatpickr(jamMulai, {
                        enableTime: true,
                        noCalendar: true,
                        dateFormat: "H:i",
                        time_24hr: true
                    });
                </script>
                <div class="row mt-1">
                    <div class="col-md-4">
                        <p>Jam Akhir<span class="star-wajib">*</span></p>
                    </div>
                    <div class="col-md-1">
                        <input type="text" class="form-control" name="jam_akhir" id="jam_akhir">
                    </div>
                </div>
                <script>
                    const jamAkhir = document.getElementById('jam_akhir');

                    flatpickr(jamAkhir, {
                        enableTime: true,
                        noCalendar: true,
                        dateFormat: "H:i",
                        time_24hr: true
                    });
                </script>
                <div class="row mt-1">
                    <div class="col-md-4">
                        <p>Pembuatan Ulang<span class="star-wajib">*</span></p>
                    </div>
                    <div class="col-md-1">
                        <div class="btn-group" role="group">
                            <input type="checkbox" class="btn-check" id="btncheck1">
                            <label class="btn btn-outline-dark" for="btncheck1">Enabled</label>

                            <input type="checkbox" class="btn-check" id="btncheck2">
                            <label class="btn btn-outline-danger" for="btncheck2">Disabled</label>
                        </div>
                    </div>
                </div>
                <div class="row mt-1" id="jmlPengulangan">
                    <div class="col-md-4">
                        <p>Jumlah Pengulangan<span class="star-wajib">*</span></p>
                    </div>
                    <div class="col-sm-1">
                        <input type="number" min="1" class="form-control" name="jmlRepeat" id="jmlUlang" value="1">
                    </div>
                </div>
                <div class="col-mt-6 d-flex justify-content-center gap-3">
                    <button type="button" class="btn btn-danger" onclick="window.location.href='{{ route('jadwal.view') }}'">Kembali</button>
                    <button type="button" onclick="validasiJadwal()" class="btn btn-success">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(".jurusan").change(function(){
        var selectedJurusan = $(this).children("option:selected").val();

        $.ajax({
            url: 'getKelas/' + selectedJurusan,
            type: 'GET',
            success: function(data){
                $(".kelas").empty();
                $(".kelas").append('<option selected class="d-none">-- Pilih Kelas -- </option>');

                $.each(data, function(id, kelas) {
                    $(".kelas").append('<option value="' + id + '" data-kelas="' + kelas + '">' + kelas + '</option>');
                });
            }
        });
    });


    $(".kelas").change(function(){
        var selectedKelas = $(".kelas").find("option:selected").data("kelas");

        $.ajax({
            url: 'getMatkul/' + selectedKelas + '/' + $(".semester").val(),
            type: 'GET',
            success: function(data){
                $(".matkul").empty();
                $(".matkul").append('<option selected class="d-none"> -- Pilih Mata Kuliah -- </option>');

                if(data) {
                    for(var i = 1; i <= 8; i++) {
                        var matkul = data['matkul_' + i];
                        if(matkul) {
                            $(".matkul").append('<option value ="' + matkul + '">' + matkul + '</option>');
                        }
                    }
                } else {
                    $(".matkul").append('<option value = "" class="d-none" selected> Matkul tidak ditemukan </option>')
                }
            }
        });
    });

    $(".semester").change(function(){
        var selectedKelas = $(".kelas").find("option:selected").data("kelas");
        var selectedSemester = $(this).val();

        $.ajax({
            url: 'getMatkul/' + selectedKelas + '/' + selectedSemester,
            type: 'GET',
            success: function(data){
                $(".matkul").empty();
                $(".matkul").append('<option selected class="d-none"> -- Pilih Mata Kuliah -- </option>');

                if(data) {
                    for(var i = 1; i <= 8; i++) {
                        var matkul = data['matkul_' + i];
                        if(matkul) {
                            $(".matkul").append('<option value ="' + matkul + '">' + matkul + '</option>');
                        }
                    }
                } else {
                    $(".matkul").append('<option value = "" class="d-none" selected> Matkul tidak ditemukan </option>')
                }
            }
        });
    });

    document.addEventListener('DOMContentLoaded', buttonUlang);
    document.addEventListener('DOMContentLoaded', tahunAkademik);
</script>

@endsection
