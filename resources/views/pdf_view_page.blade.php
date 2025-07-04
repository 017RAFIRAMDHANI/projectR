<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visitor Permit</title>
    <script>
        // Menunggu halaman selesai dimuat dan kemudian mencetak halaman secara otomatis
        window.onload = function() {
            window.print();
        };
    </script>
</head>
<body>

    <h1>Visitor Permit</h1>

    <!-- Menampilkan konten HTML dari pdf_permit_v -->
    <div id="contentToPrint">
        {!! $htmlContent !!}
    </div>

    <!-- Tombol Print untuk mencetak halaman HTML (ini hanya sebagai cadangan) -->
    <button onclick="window.print()">Print this page</button>

</body>
</html>
