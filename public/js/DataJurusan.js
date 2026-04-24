function tambahJurusan(){
    Swal.fire({
        title: "Tambah Data Jurusan",
        input: "text",
        inputAttribute:{
            autocapitalize: "off"
    },
        imageUrl: "/img/polinema_logo.png",
        imageWidth: 200,
        imageHeight: 200,
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Tambahkan",
        cancelButtonText: "Batal"
    }).then((result) => {
        if (result.isConfirmed) {
            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
            var namaJurusan = result.value;

            $.ajax({
                type: "POST",
                url: "/Jurusan/storeData/",
                data: {
                    _token: csrfToken,
                    jurusan: namaJurusan,
                },
                success: function() {
                    Swal.fire({
                        title: "Tambah Data",
                        text: "Data telah ditambahkan.",
                        icon: "success",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    window.location.reload();
                },
                error: function(){
                    Swal.fire({
                        title: "Tambah Data",
                        text: "Data gagal ditambahkan.",
                        icon: "error",
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            });
        }
    });
}

function editJurusan(jurusan, id){
    Swal.fire({
        title: "Edit Data Jurusan",
        input: "text",
        inputAttribute:{
            autocapitalize: "off"
        },
        inputValue: jurusan,
        imageUrl: "/img/polinema_logo.png",
        imageWidth: 200,
        imageHeight: 200,
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Update",
        cancelButtonText: "Batal"
        }).then((result) => {
        if (result.isConfirmed) {
            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
            var namaJurusan = result.value;

            var regex = /[.;,'[\]]/;
            if (regex.test(namaJurusan)) {
                Swal.fire({
                    title: "Error",
                    text: "Input mengandung simbol yang tidak diizinkan.",
                    icon: "error",
                    confirmButtonText: "OK"
                });
                return;
            }

            $.ajax({
                type: "POST",
                url: "/Jurusan/updateData/" + id,
                data: {
                    _token: csrfToken,
                    jurusan: namaJurusan,
                    _method: "PUT"
                },
                success: function() {
                    Swal.fire({
                        title: "Update Data",
                        text: "Data telah diubah.",
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

function deleteJurusan(id){
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
                url: "/Jurusan/deleteData/" + id,
                data: {
                    _token: csrfToken,
                    _method: "DELETE",
                },
                success: function() {
                    Swal.fire({
                        title: "Delete Data",
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
