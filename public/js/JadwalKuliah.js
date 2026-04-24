function deleteJadwal(id){
    Swal.fire({
    title: "Hapus Data",
    text: "Data yang dihapus tidak dapat dikembalikan.",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Hapus",
    cancelButtonText: "Batal"
    }).then((result) => {
        if (result.isConfirmed) {

            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

            $.ajax({
                type: "POST",
                url: "/Mahasiswa/deleteData/" + id,
                data: {
                    _token: csrfToken,
                    _method: "DELETE",
                },
                success: function() {
                    Swal.fire({
                        title: "Terhapus!",
                        text: "Data telah dihapus.",
                        icon: "success",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    window.location.reload();
                },
            });
        }
    });
}

function validasiJadwal(){
    const formJadwal = document.getElementById('FormJadwal');
    const hari = document.getElementById('hari');
    const matkul = document.getElementById('matkul');
    const kelas = document.getElementById('kelas').value;
    const jurusan = document.getElementById('jurusan').value;
    const semester = document.getElementById('semester').value;
    const tanggal_jadwal = document.getElementById('tglJadwal').value;
    const tahunAkademik = document.getElementById('thnAkademik').value;
    const tahunAkademik2 = document.getElementById('thnAkademik2').value;
    const jamMulai = document.getElementById('jam_mulai').value;
    const jamAkhir = document.getElementById('jam_akhir').value;

    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

    if (hari.value === "-- Pilih Hari --" || matkul.value === "-- Pilih Mata Kuliah --" || !formJadwal.checkValidity()) {
        if (matkul.value === "-- Pilih Mata Kuliah --") {
            Swal.fire({
                position: "center",
                icon: "error",
                title: "Tolong pilih mata kuliah!",
                showConfirmButton: false,
                timer: 1500,
            });
        } else {
            Swal.fire({
                position: "center",
                icon: "error",
                title: "Lengkapi data terlebih dahulu!",
                showConfirmButton: false,
                timer: 1500,
            });
        }
        return false;
    }else{
        $.ajax({
            url: "/JadwalKuliah/checkJadwal",
            method: 'POST',
            data: {
                _token: csrfToken,
                kelas: kelas,
                jurusan: jurusan,
                semester: semester,
                hari: hari.value,
                matkul: matkul.value,
                tanggal_jadwal: tanggal_jadwal,
                tahunAkademik: tahunAkademik + '/' + tahunAkademik2,
                jam_mulai: jamMulai,
                jam_akhir: jamAkhir
            },
            success: function(response){
                var responseString = response;
                var start = responseString.indexOf('"checking":') + 11;
                var end = responseString.indexOf('}', start);
                var checkingValue = responseString.substring(start, end).trim();

                if(checkingValue === 'true'){
                    Swal.fire({
                        icon: "error",
                        position: "center",
                        title: "Data Sudah Tersedia!",
                        showConfirmButton: false,
                        timer: 1500
                    });
                }else{
                    formJadwal.submit();
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Data telah disimpan!",
                        showConfirmButton: false,
                        timer: 1500,
                    });
                }
            }
        })
    }
}

function deleteJadwal(id){
    Swal.fire({
        title: "Hapus Data",
        text: "Data yang dihapus tidak dapat dikembalikan.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Hapus",
        cancelButtonText: "Batal"
    }).then((result) => {
        if (result.isConfirmed) {

            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

            $.ajax({
                type: "POST",
                url: "/JadwalKuliah/deleteJadwal/" + id,
                data: {
                    _token: csrfToken,
                    _method: "DELETE",
                },
                success: function() {
                    Swal.fire({
                        title: "Terhapus!",
                        text: "Data telah dihapus.",
                        icon: "success",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    window.location.reload();
                },
            });
        }
    });
}

function buttonUlang(){
    const btncheck1 = document.getElementById('btncheck1');
    const btncheck2 = document.getElementById('btncheck2');
    const jmlUlang  = document.getElementById('jmlUlang');

    const pengulangan = document.getElementById('jmlPengulangan');

    if (!btncheck1.checked && !btncheck2.checked) {
        btncheck2.checked = true;
        btncheck2.disabled = true;
        pengulangan.style.display = 'none';
    }

    btncheck1.addEventListener('click', function() {
        if (btncheck1.checked) {
            btncheck2.checked  = false;
            btncheck1.disabled = true;
            btncheck2.disabled = false;

            pengulangan.style.display = 'flex';
        }
    });

    btncheck2.addEventListener('click', function() {
        if (btncheck2.checked) {
            btncheck1.checked  = false;
            btncheck2.disabled = true;
            btncheck1.disabled = false;
            jmlUlang.value = '1';

            pengulangan.style.display = 'none';
        }
    });
}

function tahunAkademik() {
    const tahunAkademik = document.getElementById('thnAkademik');
    const tahunAkademik2 = document.getElementById('thnAkademik2');

    tahunAkademik.addEventListener('change', function(){
        const selectedYear = parseInt(tahunAkademik.value);

        tahunAkademik2.value = selectedYear + 1;
    });
}

