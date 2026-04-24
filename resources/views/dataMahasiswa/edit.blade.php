@extends('layouts.view')

@section('container-absensi')

<div class="content-wrapper" style="background-color: white">
    <div class="content-header p-4">
        <div class="container-fluid px-4">
            <h3>Edit Data Mahasiswa</h3>
            <hr style="border-width: 2px; background-color: #B4B8C5">
            <form action="{{ route('mahasiswa.update', $mahasiswa->id) }}" method="POST" id="editForm">
                @csrf
                @method('PUT')
                <div class="row mt-1">
                    <div class="col-md-4">
                        <p>NIM<span class="star-wajib">*</span></p>
                    </div>
                    <div class="col-md-8">
                        <input type="tel" pattern="[0-9]+"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                            class="form-control" name="NIM" id="NIM" value="{{ $mahasiswa->NIM }}" required>
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-md-4">
                        <p>Nama Lengkap<span class="star-wajib">*</span></p>
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" value="{{ $mahasiswa->namaLengkap }}" required>
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-md-4">
                        <p>Kelas<span class="star-wajib">*</span></p>
                    </div>
                    <div class="col-sm-2">
                        <select name="kelas" id="kelas" class="form-control" style="width: 95px;" required>
                            @foreach ($kelas as $item)
                                <option value="{{ $item->id }}" {{ $item->id == $mahasiswa->id_kelas ? 'selected' : '' }}>
                                    {{ $item->kelas }} &nbsp;
                                    @if ($item->id != $mahasiswa->id_kelas)
                                        (Semester {{ $item->semester }})
                                    @endif
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <script>
                    document.getElementById('kelas').addEventListener('change', function() {
                        var selectedOption = this.options[this.selectedIndex];
                        selectedOption.textContent = selectedOption.textContent.split('(')[0].trim();
                    });
                </script>
                <div class="row mt-1 d-flex align-items-center">
                    <div class="col-md-4">
                        <p>Jenis Kelamin<span class="star-wajib">*</span></p>
                    </div>
                    <div class="col-md-4 d-flex align-items-center column-gap-3">
                        <input {{ $mahasiswa->jenisKelamin == "Laki-Laki" ? 'checked' : '' }} type="radio" name="jenisKelamin" value="Laki-Laki"> Laki-Laki
                        <input {{ $mahasiswa->jenisKelamin == "Perempuan" ? 'checked' : '' }} type="radio" name="jenisKelamin" value="Perempuan"> Perempuan
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-md-4">
                        <p>Nomor Telepon<span class="star-wajib">*</span></p>
                    </div>
                    <div class="col-md-8">
                        <input type="tel" pattern="[0-9]+"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                            class="form-control" name="NomorTelp" id="NomorTelp" value="{{ $mahasiswa->NoTelp }}" required>
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-md-4">
                        <p>Tahun Masuk<span class="star-wajib">*</span></p>
                    </div>
                    <div class="col-md-1">
                        <select name="tahunMasuk" class="form-control" required>
                            <option value="" style="display: none;">YYYY</option>
                            @for($tahun = 2020; $tahun <= 2024; $tahun++)
                                <option value='{{ $tahun }}' {{ $tahun == $mahasiswa->tahunMasuk ? 'selected': '' }} >{{ $tahun }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <h3>Edit Data Orang Tua</h3>
                <hr style="border-width: 2px; background-color: #B4B8C5">
                <div class="row mt-1">
                    <div class="col-md-4">
                        <p>Nama Ayah<span class="star-wajib">*</span></p>
                    </div>
                    <div class="col-md-8">
                        <input type="text" name="namaAyah" class="form-control" value="{{ $mahasiswa->nama_Ayah }}">
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-md-4">
                        <p>Nomor Telepon Ayah<span class="star-wajib">*</span></p>
                    </div>
                    <div class="col-md-8">
                        <input type="tel" pattern="[0-9]+"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                            class="form-control" name="NomorAyah" id="NomorAyah" value="{{ $mahasiswa->NoTelp_Ayah }}">
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-md-4">
                        <p>Nama Ibu<span class="star-wajib">*</span></p>
                    </div>
                    <div class="col-md-8">
                        <input type="text" name="namaIbu" class="form-control" value="{{ $mahasiswa->nama_Ibu }}">
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-md-4">
                        <p>Nomor telpon Ibu<span class="star-wajib">*</span></p>
                    </div>
                    <div class="col-md-8">
                        <input type="tel" pattern="[0-9]+"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                            class="form-control" name="NomorIbu" id="NomorIbu" value="{{ $mahasiswa->NoTelp_Ibu }}">
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-md-4">
                        <p>Domisili<span class="star-wajib">*</span></p>
                    </div>
                    <div class="col-md-8">
                        <select name="provinsiIndo" class="form-control" id="provinsi" data-domisili="{{ $mahasiswa->Domisili }}"></select>
                    </div>
                </div>
                <div class="col-mt-6 d-flex justify-content-center gap-3">
                    <button type="button" class="btn btn-danger" onclick="window.location.href='{{ route('mahasiswa.view') }}'">Kembali</button>
                    <button type="button" onclick="editData()" class="btn btn-primary px-4">Ubah</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>APIKotaEdit();</script>
@endsection
