<?php
include('../config/config.php');

// Ambil data mobil yang tersedia
$query_mobil = mysqli_query($conn, "SELECT * FROM mobil WHERE status = 'tersedia' ORDER BY id_mobil DESC");

// Proses form tambah peminjam
if (isset($_POST['submit'])) {
    $nama_peminjam = $_POST['nama_peminjam'];
    $id_mobil = $_POST['id_mobil'];
    $lama_pinjam = $_POST['lama_pinjam'];
    $tgl_pinjam = $_POST['tanggal_pinjam'];
    $tgl_kembali = $_POST['tanggal_kembali'];

    // Simpan ke tabel peminjaman
    $insert = mysqli_query($conn, "INSERT INTO peminjaman (nama_peminjam, id_mobil, lama_pinjam, tanggal_pinjam, tanggal_kembali, status)
                                   VALUES ('$nama_peminjam', '$id_mobil', '$lama_pinjam', '$tanggal_pinjam', '$tanggal_kembali', 'dipinjam')");

    // Update status mobil
    mysqli_query($conn, "UPDATE mobil SET status='disewa' WHERE id_mobil='$id_mobil'");

    if ($insert) {
        echo "<script>alert('✅ Peminjaman berhasil ditambahkan'); window.location='peminjaman.php';</script>";
    } else {
        echo "<script>alert('❌ Gagal menambahkan peminjaman: " . mysqli_error($conn) . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Peminjaman - Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f5f7fa;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 95%;
            max-width: 700px;
            margin: 40px auto;
            background: white;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            color: #2563eb;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: 600;
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        input[type="text"],
        input[type="number"],
        input[type="date"],
        select {
            width: 100%;
            padding: 10px 12px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 15px;
            outline: none;
            transition: 0.2s;
        }

        input:focus, select:focus {
            border-color: #2563eb;
            box-shadow: 0 0 4px rgba(37,99,235,0.4);
        }

        button {
            width: 100%;
            background-color: #2563eb;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            font-weight: bold;
            transition: background 0.3s;
        }

        button:hover {
            background-color: #1e40af;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            text-decoration: none;
            color: #2563eb;
            font-weight: 500;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        /* Dropdown option styling */
        select option {
            padding: 8px;
        }

        /* Responsive */
        @media (max-width: 600px) {
            .container {
                padding: 20px;
            }

            h2 {
                font-size: 22px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h2><i class="fa-solid fa-car"></i> Tambah Peminjaman Mobil</h2>

    <form method="POST">
        <div class="form-group">
            <label>Nama Peminjam</label>
            <input type="text" name="nama_peminjam" required placeholder="Masukkan nama peminjam">
        </div>

        <div class="form-group">
            <label>Pilih Mobil</label>
            <select name="id_mobil" required>
                <option value="">-- Pilih Mobil --</option>
                <?php while ($row = mysqli_fetch_assoc($query_mobil)) { ?>
                    <option value="<?= $row['id_mobil']; ?>">
                        <?= $row['nama_mobil']; ?> - Rp<?= number_format($row['harga_per_hari']); ?>/hari
                    </option>
                <?php } ?>
            </select>
        </div>

        <div class="form-group">
            <label>Lama Pinjam (hari)</label>
            <input type="number" name="lama_pinjam" min="1" required placeholder="Masukkan lama pinjam">
        </div>

        <div class="form-group">
            <label>Tanggal Pinjam</label>
            <input type="date" name="tgl_pinjam" required>
        </div>

        <div class="form-group">
            <label>Tanggal Kembali</label>
            <input type="date" name="tgl_kembali" required>
        </div>

        <button type="submit" name="submit"><i class="fa-solid fa-plus"></i> Simpan Peminjaman</button>
    </form>

    <a href="peminjaman.php" class="back-link"><i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar Peminjaman</a>
</div>

</body>
</html>
