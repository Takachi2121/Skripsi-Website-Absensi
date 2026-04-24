function APIKota() {
    fetch(
        "https://kanglerian.github.io/api-wilayah-indonesia/api/provinces.json"
    )
        .then((response) => response.json())
        .then((provinces) => {
            // Array untuk menyimpan semua data kota dari semua provinsi
            const allRegencies = [];

            // Loop melalui setiap provinsi
            Promise.all(
                provinces.map((province) => {
                    // Mengembalikan promise untuk setiap fetch kota
                    return fetch(
                        `https://kanglerian.github.io/api-wilayah-indonesia/api/regencies/${province.id}.json`
                    )
                        .then((response) => response.json())
                        .then((regencies) => {
                            // Menambahkan data kota dari provinsi tertentu ke dalam array
                            allRegencies.push(...regencies);
                        });
                })
            ).then(() => {
                // Setelah semua data kota terkumpul, Anda dapat menggunakannya untuk mengisi elemen <select>
                var provinsiSelect = document.getElementById("provinsi");
                provinsiSelect.innerHTML = "";

                var defaultOption = document.createElement("option");
                defaultOption.style.display = "none";
                defaultOption.textContent = "-- Pilih Kota --";
                defaultOption.value = "";
                provinsiSelect.appendChild(defaultOption);

                allRegencies.forEach((element) => {
                    var option = document.createElement("option");
                    option.dataset.reg = element.id;
                    option.value = element.name
                        .toLowerCase()
                        .replace(/\b\w/g, (l) => l.toUpperCase());
                    option.textContent = element.name
                        .toLowerCase()
                        .replace(/\b\w/g, (l) => l.toUpperCase());
                    provinsiSelect.appendChild(option);
                });
            });
        });
}

function APIKotaEdit() {
    fetch(
        "https://kanglerian.github.io/api-wilayah-indonesia/api/provinces.json"
    )
    .then((response) => response.json())
    .then((provinces) => {
        // Array untuk menyimpan semua data kota dari semua provinsi
        const allRegencies = [];

        // Loop melalui setiap provinsi
        Promise.all(
            provinces.map((province) => {
                // Mengembalikan promise untuk setiap fetch kota
                return fetch(
                    `https://kanglerian.github.io/api-wilayah-indonesia/api/regencies/${province.id}.json`
                )
                    .then((response) => response.json())
                    .then((regencies) => {
                        // Menambahkan data kota dari provinsi tertentu ke dalam array
                        allRegencies.push(...regencies);
                    });
            })
        ).then(() => {
            // Setelah semua data kota terkumpul, Anda dapat menggunakannya untuk mengisi elemen <select>
            var kotaSelect = document.getElementById("provinsi");
            kotaSelect.innerHTML = "";

            var dataKota = kotaSelect.dataset.domisili;

            allRegencies.forEach((element) => {
                var option = document.createElement("option");
                option.dataset.reg = element.id;
                option.value = element.name.toLowerCase().replace(/\b\w/g, (l) => l.toUpperCase());
                option.textContent = element.name.toLowerCase().replace(/\b\w/g, (l) => l.toUpperCase());
                kotaSelect.appendChild(option);

                if (option.value.toLowerCase() === dataKota.toLowerCase()) {
                    option.selected = true;
                }
            });
        });
    });
}
