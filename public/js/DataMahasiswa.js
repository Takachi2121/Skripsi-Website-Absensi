function mencariData() {
    const searchInput = document.getElementById("searchInput");
    const tableRows = document.querySelectorAll(".tbl-container tbody tr");

    searchInput.addEventListener("input", function () {
        const searchTerm = searchInput.value.toLowerCase();

        tableRows.forEach((row) => {
            const rowData = row.textContent.toLowerCase();
            if (rowData.includes(searchTerm)) {
                row.style.display = "table-row";
            } else {
                row.style.display = "none";
            }
        });
    });
}

function validasiData() {
    const NIM = document.getElementById("NIM");
    const namaLengkap = document.getElementById("nama_lengkap");
    const kelas = document.getElementById("kelas");
    const jenisKelamin = document.querySelector(
        'input[name="jenisKelamin"]:checked'
    );
    const nomorTelepon = document.getElementById("NomorTelp");
    const tahunMasuk = document.getElementById("tahunMasuk");

    const namaAyah = document.getElementById("namaAyah");
    const nomorAyah = document.getElementById("NomorAyah");
    const namaIbu = document.getElementById("namaIbu");
    const NomorIbu = document.getElementById("NomorIbu");
    const domisili = document.getElementById("provinsi");

    const formTambah = document.getElementById("myForm");

    const jenisKelaminValid = jenisKelamin ? true : false;
    const domisiliKosong = domisili.value == "";
    const domisiliPilihKota = domisili.value == "-- Pilih Kota --";

    if (
        !NIM.checkValidity() ||
        !namaLengkap.checkValidity() ||
        kelas.value == "" ||
        !jenisKelaminValid ||
        !nomorTelepon.checkValidity() ||
        tahunMasuk.value == "" ||
        !namaAyah.checkValidity() ||
        !namaIbu.checkValidity() ||
        !NomorIbu.checkValidity() ||
        !nomorAyah.checkValidity() ||
        domisiliKosong ||
        domisiliPilihKota
    ) {
        Swal.fire({
            position: "center",
            icon: "error",
            title: "Lengkapi data terlebih dahulu!",
            showConfirmButton: false,
            timer: 1500,
        });
        return false;
    } else {
        formTambah.submit();

        Swal.fire({
            position: "center",
            icon: "success",
            title: "Data telah disimpan!",
            showConfirmButton: false,
            timer: 1500,
        });
    }
}

function editData() {
    Swal.fire({
        title: "Simpan Perubahan?",
        icon: "question",
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: "Ubah",
        denyButtonText: `Batal`
    }).then((result) => {
        var myForm = document.getElementById('editForm');
        var inputs = myForm.querySelectorAll('input[required]');

        if (result.isConfirmed) {
            for (var i = 0; i < inputs.length; i++) {
                if (inputs[i].value.trim() === '') {
                    Swal.fire({
                        title: "Lengkapi Data Terlebih Dahulu",
                        icon: "error",
                        showConfirmButton: false,
                    });
                    return;
                }else{
                    Swal.fire({
                        title: "Perubahan telah disimpan",
                        icon: "success",
                        showConfirmButton: false,
                        timer: 1500
                    });

                    myForm.submit();
                }
            }

        } else if (result.isDenied) {
            Swal.fire({
                title: "Perubahan telah dibatalkan",
                icon: "error",
                showConfirmButton: false,
                timer: 1500
            });
            window.location.href="/Mahasiswa";
        }
    });
}

function deleteData(id){
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
