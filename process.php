<?php
// Koneksi ke database
$servername = "localhost";
$username = "root"; // Ganti sesuai pengaturan database Anda
$password = ""; // Ganti sesuai pengaturan database Anda
$dbname = "db_nilai";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Mengecek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $nilai = $_POST['nilai'];

    // Konversi Nilai Angka ke Huruf
    if ($nilai >= 85) {
        $grade = 'A';
    } elseif ($nilai >= 80) {
        $grade = 'B+';
    } elseif ($nilai >= 75) {
        $grade = 'B';
    } elseif ($nilai >= 70) {
        $grade = 'C+';
    } elseif ($nilai >= 65) {
        $grade = 'C';
    } elseif ($nilai >= 50) {
        $grade = 'D';
    } else {
        $grade = 'E';
    }

    // Menyimpan ke database
    $sql = "INSERT INTO nilai_mahasiswa (nama, nim, nilai_angka, nilai_huruf) VALUES ('$nama', '$nim', '$nilai', '$grade')";

    if ($conn->query($sql) === TRUE) {
        $message = "<h3>Data berhasil disimpan!</h3>
                    <p>Nama: $nama</p>
                    <p>NIM: $nim</p>
                    <p>Nilai Angka: $nilai</p>
                    <p>Nilai Huruf: $grade</p>";
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
    }

    // Menutup koneksi
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Penilaian</title>
    <style>
        body {
            background-color: #fce4ec; /* Warna latar belakang pink pastel */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; /* Font yang lebih formal */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .result-container {
            background-color: #f8bbd0; /* Kotak hasil pink pastel */
            padding: 30px;
            border-radius: 15px;
            width: 350px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Bayangan lembut */
        }

        .result-container h3 {
            color: #ec407a; /* Judul hasil pink cerah */
            font-size: 26px;
            margin-bottom: 20px;
        }

        .result-container p {
            color: #d81b60; /* Teks hasil pink gelap */
            margin: 10px 0;
        }

        .result-container a {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 24px;
            background-color: #ec407a; /* Tombol kembali pink cerah */
            color: white;
            text-decoration: none;
            border-radius: 10px;
            font-size: 16px;
            transition: background-color 0.3s ease; /* Transisi warna tombol kembali */
        }

        .result-container a:hover {
            background-color: #d81b60; /* Tombol kembali pink gelap saat hover */
        }
    </style>
</head>
<body>
    <div class="result-container">
        <?php echo $message; ?>
        <a href="index.html">Kembali ke Form</a>
    </div>
</body>
</html>
