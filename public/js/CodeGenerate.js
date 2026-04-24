function generateQRCode(id, matkul, jam, hari, kelas, semester, tglJadwal) {
    // Pastikan data yang akan di-encode tidak kosong
    if (!id || !matkul || !jam || !hari || !kelas || !semester || !tglJadwal) {
        console.error('Data cannot be empty');
        return;
    }

    // Clear the existing content inside the 'qrcode' element
    var qrcodeContainer = document.getElementById('qrcode-'+ id);
    if (qrcodeContainer) {
        qrcodeContainer.innerHTML = '';

        // Generate the new QR code
        var qrcode = new QRCode(qrcodeContainer, {
            text: kelas + ', ' + semester + ', ' + matkul + ', ' + tglJadwal +  ', ' + jam + ', ' + hari,
            width: 270,
            height: 270,
        });

        // Menambahkan lapisan (div) di atas QR code untuk gambar
        var overlayDiv = document.createElement('div');
        overlayDiv.style.position = 'block';
        overlayDiv.style.width = '100%';
        overlayDiv.style.height = '100%';

        var img = document.createElement('img');
        img.src = 'img/polinema_logo.png';
        img.style.position = 'absolute';
        img.style.top = '50%';
        img.style.left = '50%';
        img.style.transform = 'translate(-50%, -50%)'; // Perbaikan pada bagian transform
        img.style.width = '65px';
        overlayDiv.appendChild(img);

        // Menambahkan lapisan ke elemen QR code
        qrcodeContainer.appendChild(overlayDiv);
    } else {
        console.error('QR Code container not found');
    }
}


function downloadQRCode(id) {
    // Mengonversi elemen QR code menjadi gambar menggunakan html2canvas
    var qrcode = document.getElementById("qrcode-" + id);
    html2canvas(qrcode).then(function(canvas) {
        // Mengubah canvas menjadi data URL
        var imgDataUrl = canvas.toDataURL('image/png');

        // Membuat tautan unduh
        var downloadLink = document.createElement('a');
        downloadLink.href = imgDataUrl;
        downloadLink.download = 'qrcode.png';

        // Menjalankan tautan unduh
        downloadLink.click();
    });
}
