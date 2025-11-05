<?php
include 'config/config.php';
$id_mobil = $_GET['id'];
$mobil = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM mobil WHERE id_mobil='$id_mobil'"));

if (isset($_POST['sewa'])) {
    $nama = $_POST['nama_peminjam'];
    $no_hp = $_POST['no_hp'];
    $tgl_pinjam = $_POST['tanggal_pinjam'];
    $tgl_kembali = $_POST['tanggal_kembali'];
    
    $tanggal1 = new DateTime($tgl_pinjam);
    $tanggal2 = new DateTime($tgl_kembali);
    $selisih = $tanggal2->diff($tanggal1)->days;
    if ($selisih == 0) $selisih = 1;
    $total = $mobil['harga_per_hari'] * $selisih;
    
    $query = "INSERT INTO peminjaman (id_mobil, lama_pinjam, nama_peminjam, no_hp, tanggal_pinjam, tanggal_kembali, total_harga, status)
              VALUES ('$id_mobil', '$selisih', '$nama', '$no_hp', '$tgl_pinjam', '$tgl_kembali', '$total', 'diproses')";
    
    if (mysqli_query($conn, $query)) {
        mysqli_query($conn, "UPDATE mobil SET status='disewa' WHERE id_mobil='$id_mobil'");
        echo "<script>alert('Peminjaman berhasil!'); window.location='index.php';</script>";
    } else {
        echo "<script>alert('Gagal menyimpan data');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sewa Mobil - <?= htmlspecialchars($mobil['nama_mobil']) ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', 'Segoe UI', sans-serif;
        }

        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --secondary: #8b5cf6;
            --dark: #0f172a;
            --light: #f8fafc;
            --gray: #64748b;
            --success: #10b981;
            --danger: #ef4444;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 40px 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .form-container {
            max-width: 900px;
            width: 100%;
            background: white;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            animation: fadeInUp 0.6s ease;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-header {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            padding: 40px;
            text-align: center;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .form-header::before {
            content: '';
            position: absolute;
            width: 200%;
            height: 200%;
            background: url('data:image/svg+xml,<svg width="60" height="60" xmlns="http://www.w3.org/2000/svg"><circle cx="30" cy="30" r="2" fill="rgba(255,255,255,0.1)"/></svg>');
            animation: float 20s linear infinite;
        }

        @keyframes float {
            to { transform: translate(-25%, -25%); }
        }

        .form-header-content {
            position: relative;
            z-index: 1;
        }

        .form-icon {
            width: 80px;
            height: 80px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 36px;
        }

        .form-header h2 {
            font-size: 32px;
            font-weight: 800;
            margin-bottom: 10px;
        }

        .form-header p {
            font-size: 16px;
            opacity: 0.9;
        }

        .form-body {
            padding: 40px;
        }

        .car-summary {
            display: grid;
            grid-template-columns: 120px 1fr;
            gap: 20px;
            background: linear-gradient(135deg, #f8fafc, #e2e8f0);
            padding: 20px;
            border-radius: 16px;
            margin-bottom: 35px;
            align-items: center;
        }

        .car-summary-image {
            width: 120px;
            height: 80px;
            object-fit: cover;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .car-summary-info h3 {
            font-size: 20px;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 8px;
        }

        .car-summary-details {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            font-size: 14px;
            color: var(--gray);
        }

        .car-summary-details span {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .price-highlight {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: 700;
            font-size: 18px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 25px;
        }

        .form-group {
            position: relative;
        }

        .form-group.full-width {
            grid-column: 1 / -1;
        }

        .form-label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-label i {
            color: var(--primary);
        }

        .form-input {
            width: 100%;
            padding: 14px 18px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 15px;
            transition: all 0.3s;
            background: white;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
        }

        .form-input:hover {
            border-color: #cbd5e1;
        }

        .calculation-box {
            background: linear-gradient(135deg, #f8fafc, #e2e8f0);
            padding: 25px;
            border-radius: 16px;
            margin-top: 30px;
        }

        .calculation-title {
            font-size: 16px;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .calculation-row {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid #cbd5e1;
            font-size: 15px;
        }

        .calculation-row:last-child {
            border-bottom: none;
            padding-top: 15px;
            margin-top: 10px;
            border-top: 2px solid var(--primary);
        }

        .calculation-label {
            color: var(--gray);
        }

        .calculation-value {
            font-weight: 700;
            color: var(--dark);
        }

        .calculation-row:last-child .calculation-value {
            font-size: 24px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .form-actions {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-top: 35px;
        }

        .btn {
            padding: 16px 32px;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            box-shadow: 0 10px 30px rgba(99, 102, 241, 0.4);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(99, 102, 241, 0.5);
        }

        .btn-secondary {
            background: white;
            color: var(--gray);
            border: 2px solid #e2e8f0;
        }

        .btn-secondary:hover {
            background: #f8fafc;
            border-color: var(--gray);
            color: var(--dark);
        }

        .info-box {
            background: #eff6ff;
            border-left: 4px solid var(--primary);
            padding: 16px 20px;
            border-radius: 8px;
            margin-bottom: 25px;
            display: flex;
            gap: 12px;
        }

        .info-box i {
            color: var(--primary);
            font-size: 20px;
            flex-shrink: 0;
        }

        .info-box-content {
            flex: 1;
        }

        .info-box-title {
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 4px;
        }

        .info-box-text {
            font-size: 14px;
            color: var(--gray);
            line-height: 1.5;
        }

        /* Responsive */
        @media (max-width: 768px) {
            body {
                padding: 20px 10px;
            }

            .form-header {
                padding: 30px 20px;
            }

            .form-header h2 {
                font-size: 24px;
            }

            .form-body {
                padding: 25px 20px;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .car-summary {
                grid-template-columns: 1fr;
                text-align: center;
            }

            .car-summary-image {
                margin: 0 auto;
            }

            .car-summary-details {
                justify-content: center;
            }

            .form-actions {
                grid-template-columns: 1fr;
            }
        }
    </style>
    <script>
        function calculateTotal() {
            const startDate = document.getElementById('tanggal_pinjam').value;
            const endDate = document.getElementById('tanggal_kembali').value;
            const pricePerDay = <?= $mobil['harga_per_hari'] ?>;

            if (startDate && endDate) {
                const start = new Date(startDate);
                const end = new Date(endDate);
                const diffTime = Math.abs(end - start);
                let diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                
                if (diffDays === 0) diffDays = 1;

                const total = pricePerDay * diffDays;

                document.getElementById('lama_hari').textContent = diffDays + ' Hari';
                document.getElementById('harga_per_hari').textContent = 'Rp ' + pricePerDay.toLocaleString('id-ID');
                document.getElementById('total_harga').textContent = 'Rp ' + total.toLocaleString('id-ID');
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('tanggal_pinjam').setAttribute('min', today);
            document.getElementById('tanggal_kembali').setAttribute('min', today);

            document.getElementById('tanggal_pinjam').addEventListener('change', function() {
                document.getElementById('tanggal_kembali').setAttribute('min', this.value);
                calculateTotal();
            });

            document.getElementById('tanggal_kembali').addEventListener('change', calculateTotal);
        });
    </script>
</head>
<body>

<div class="form-container">
    <div class="form-header">
        <div class="form-header-content">
            <div class="form-icon">
                <i class="fas fa-file-contract"></i>
            </div>
            <h2>Form Penyewaan Mobil</h2>
            <p>Lengkapi data di bawah untuk melanjutkan penyewaan</p>
        </div>
    </div>

    <form method="POST" class="form-body">
        <!-- Car Summary -->
        <div class="car-summary">
            <img src="assets/img/upload/<?= htmlspecialchars($mobil['gambar']) ?>" 
                 alt="<?= htmlspecialchars($mobil['nama_mobil']) ?>" 
                 class="car-summary-image">
            <div class="car-summary-info">
                <h3><?= htmlspecialchars($mobil['nama_mobil']) ?></h3>
                <div class="car-summary-details">
                    <span>
                        <i class="fas fa-calendar"></i>
                        <?= htmlspecialchars($mobil['tahun']) ?>
                    </span>
                    <span>
                        <i class="fas fa-users"></i>
                        <?= htmlspecialchars($mobil['kapasitas']) ?> Orang
                    </span>
                    <span>
                        <i class="fas fa-cog"></i>
                        <?= htmlspecialchars($mobil['transmisi']) ?>
                    </span>
                    <span class="price-highlight">
                        <i class="fas fa-tag"></i>
                        Rp <?= number_format($mobil['harga_per_hari'], 0, ',', '.') ?>/hari
                    </span>
                </div>
            </div>
        </div>

        <!-- Info Box -->
        <div class="info-box">
            <i class="fas fa-info-circle"></i>
            <div class="info-box-content">
                <div class="info-box-title">Informasi Penting</div>
                <div class="info-box-text">
                    Pastikan data yang Anda masukkan sudah benar. Kami akan menghubungi Anda melalui nomor HP yang terdaftar untuk konfirmasi penyewaan.
                </div>
            </div>
        </div>

        <!-- Form Grid -->
        <div class="form-grid">
            <div class="form-group">
                <label class="form-label">
                    <i class="fas fa-user"></i>
                    Nama Lengkap
                </label>
                <input type="text" 
                       name="nama_peminjam" 
                       class="form-input" 
                       placeholder="Masukkan nama lengkap"
                       required>
            </div>

            <div class="form-group">
                <label class="form-label">
                    <i class="fas fa-phone"></i>
                    Nomor HP
                </label>
                <input type="tel" 
                       name="no_hp" 
                       class="form-input" 
                       placeholder="08xxxxxxxxxx"
                       pattern="[0-9]{10,13}"
                       required>
            </div>

            <div class="form-group">
                <label class="form-label">
                    <i class="fas fa-calendar-check"></i>
                    Tanggal Mulai Sewa
                </label>
                <input type="date" 
                       name="tanggal_pinjam" 
                       id="tanggal_pinjam"
                       class="form-input" 
                       required>
            </div>

            <div class="form-group">
                <label class="form-label">
                    <i class="fas fa-calendar-times"></i>
                    Tanggal Pengembalian
                </label>
                <input type="date" 
                       name="tanggal_kembali" 
                       id="tanggal_kembali"
                       class="form-input" 
                       required>
            </div>
        </div>

        <!-- Calculation Box -->
        <div class="calculation-box">
            <div class="calculation-title">
                <i class="fas fa-calculator"></i>
                Rincian Biaya
            </div>
            <div class="calculation-row">
                <span class="calculation-label">Lama Sewa</span>
                <span class="calculation-value" id="lama_hari">- Hari</span>
            </div>
            <div class="calculation-row">
                <span class="calculation-label">Harga per Hari</span>
                <span class="calculation-value" id="harga_per_hari">Rp <?= number_format($mobil['harga_per_hari'], 0, ',', '.') ?></span>
            </div>
            <div class="calculation-row">
                <span class="calculation-label">Total Pembayaran</span>
                <span class="calculation-value" id="total_harga">Rp 0</span>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="form-actions">
            <a href="detail.php?id=<?= $id_mobil ?>" class="btn btn-secondary">
                <i class="fas fa-times"></i>
                Batal
            </a>
            <button type="submit" name="sewa" class="btn btn-primary">
                <i class="fas fa-check-circle"></i>
                Konfirmasi Penyewaan
            </button>
        </div>
    </form>
</div>

</body>
</html>