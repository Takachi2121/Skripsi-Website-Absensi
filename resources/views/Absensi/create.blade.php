@extends('layouts.view')

@section('container-absensi')

<div class="content-wrapper" style="background-color: white">
    <div class="content-header p-4">
        <div class="container-fluid px-4">
            <h3>Tambah Data Absensi</h3>
            <hr style="border-width: 2px; background-color: #B4B8C5">
            <form action="{{ route('absensi.store') }}" method="POST" id="FormAbsen">
                @csrf
                <div class="row mt-1">
                    <div class="col-md-4">
                        <p>NIM<span class="star-wajib">*</span></p>
                    </div>
                    <div class="col-sm-2">
                        <select name="NIM" id="NIM" class="form-control">
                            <option value="" class="d-none" selected>-- Pilih NIM --</option>
                            @foreach($mahasiswa as $item)
                                <option value="{{ $item->NIM }}">{{ $item->NIM }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-md-4">
                        <p>Nama Mahasiswa<span class="star-wajib">*</span></p>
                    </div>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" name="namaMahasiswa" id="namaMahasiswa" required>
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-md-4">
                        <p>Kelas<span class="star-wajib">*</span></p>
                    </div>
                    <div class="col-md-2">
                        <select name="kelas" id="kelas" class="form-control kelas">
                            <option selected style="display: none;">-- Pilih Kelas --</option>
                            @foreach ($kelas as $item)
                                <option value="{{ $item->id }}">{{ $item->kelas }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-md-4">
                        <p>Semester<span class="star-wajib">*</span></p>
                    </div>
                    <div class="col-sm-1">
                        <input type="number" min="1"  max="8" class="form-control" name="semester" id="semester" required placeholder="semester">
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
                        </select>
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-md-4">
                        <p>Tanggal Absen<span class="star-wajib">*</span></p>
                    </div>
                    <div class="col-md-1">
                        <input type="text" class="form-control" name="tgl_absen" id="tgl_absen">
                    </div>
                </div>
                <script>
                    const tglAbsen = document.getElementById('tgl_absen');

                    flatpickr(tglAbsen, {
                        enableTime: false,
                        noCalendar: false,
                        dateFormat: "d-m-Y",
                        maxDate: "today"
                    });
                </script>
                <div class="row mt-1">
                    <div class="col-md-4">
                        <p>Jam Absen<span class="star-wajib">*</span></p>
                    </div>
                    <div class="col-md-1">
                        <input type="text" class="form-control" name="absen" id="absen">
                    </div>
                </div>
                <script>
                    const jamAbsen = document.getElementById('absen');

                    flatpickr(jamAbsen, {
                        enableTime: true,
                        noCalendar: true,
                        dateFormat: "H:i",
                        time_24hr: true
                    });
                </script>
                <div class="row mt-1">
                    <div class="col-md-4">
                        <p>Status<span class="star-wajib">*</span></p>
                    </div>
                    <div class="col-sm-2">
                        <select class="form-control" name="status" id="status" required>
                            <option value="" class="d-none" selected>-- Pilih Status Absen --</option>
                            <option value="Tidak Terlambat">Tidak Terlambat</option>
                            <option value="Tidak Absen">Tidak Absen / Sakit</option>
                            <option value="Terlambat">Terlambat</option>
                        </select>
                    </div>
                </div>
                <div class="col-mt-6 d-flex justify-content-center gap-3">
                    <button type="button" class="btn btn-danger" onclick="window.location.href='{{ route('absensi.view') }}'">Kembali</button>
                    <button type="button" onclick="validasiAbsen()" class="btn btn-success">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $("#NIM").change(function() {
        var NIM = $(this).val();

        // Lakukan permintaan Ajax
        $.ajax({
            url: 'getMahasiswa/' + NIM,
            type: 'GET',
            success: function(data) {
                $("#namaMahasiswa").val(data.namaLengkap);
                // Isi otomatis select kelas
                $("#kelas").val(data.id_kelas);

                $.ajax({
                    url: 'getKelas/' + data.id_kelas,
                    type: 'GET',
                    success: function(kelasData) {
                        // Isi otomatis input semester berdasarkan data kelas
                        $("#semester").val(kelasData.semester);

                        $(".matkul").append('<option value="" selected class="d-none">-- Pilih Matkul --</option>');
                        if (kelasData.matkul_1) $(".matkul").append('<option value="' + kelasData.matkul_1 + '">' + kelasData.matkul_1 + '</option>');
                        if (kelasData.matkul_2) $(".matkul").append('<option value="' + kelasData.matkul_2 + '">' + kelasData.matkul_2 + '</option>');
                        if (kelasData.matkul_3) $(".matkul").append('<option value="' + kelasData.matkul_3 + '">' + kelasData.matkul_3 + '</option>');
                        if (kelasData.matkul_4) $(".matkul").append('<option value="' + kelasData.matkul_4 + '">' + kelasData.matkul_4 + '</option>');
                        if (kelasData.matkul_5)$(".matkul").append('<option value="' + kelasData.matkul_5 + '">' + kelasData.matkul_5 + '</option>');
                        if (kelasData.matkul_6) $(".matkul").append('<option value="' + kelasData.matkul_6 + '">' + kelasData.matkul_6 + '</option>');
                        if (kelasData.matkul_7) $(".matkul").append('<option value="' + kelasData.matkul_7 + '">' + kelasData.matkul_7 + '</option>');
                        if (kelasData.matkul_8)$(".matkul").append('<option value="' + kelasData.matkul_8 + '">' + kelasData.matkul_8 + '</option>');
                    }
                });
            }
        });
    });
</script>

@endsection
