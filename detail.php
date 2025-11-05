<?php
include 'config/config.php';
$id = $_GET['id'];
$data = mysqli_query($conn, "SELECT * FROM mobil WHERE id_mobil='$id'");
$mobil = mysqli_fetch_assoc($data);
if (!$mobil) {
    echo "<script>alert('Mobil tidak ditemukan!'); window.location='index.php';</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Mobil - <?= htmlspecialchars($mobil['nama_mobil']) ?></title>
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
        }

        /* Back Button */
        .back-button {
            max-width: 1200px;
            margin: 0 auto 20px;
            animation: fadeInDown 0.5s ease;
        }

        .back-button a {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 12px 24px;
            background: rgba(255, 255, 255, 0.95);
            color: var(--dark);
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .back-button a:hover {
            background: white;
            transform: translateX(-5px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }

        /* Main Container */
        .detail-container {
            max-width: 1200px;
            margin: 0 auto;
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

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Grid Layout */
        .detail-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0;
        }

        /* Image Section */
        .image-section {
            position: relative;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            padding: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .status-badge {
            position: absolute;
            top: 30px;
            right: 30px;
            padding: 12px 24px;
            background: linear-gradient(135deg, var(--success), #059669);
            color: white;
            border-radius: 50px;
            font-weight: 700;
            font-size: 14px;
            text-transform: uppercase;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.4);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .car-image {
            width: 100%;
            max-width: 500px;
            height: auto;
            border-radius: 16px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
            transition: transform 0.3s;
        }

        .car-image:hover {
            transform: scale(1.02);
        }

        /* Info Section */
        .info-section {
            padding: 50px;
        }

        .car-header {
            margin-bottom: 30px;
            padding-bottom: 30px;
            border-bottom: 3px solid #f1f5f9;
        }

        .car-title {
            font-size: 36px;
            font-weight: 800;
            color: var(--dark);
            margin-bottom: 10px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .car-subtitle {
            font-size: 18px;
            color: var(--gray);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* Price Section */
        .price-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 25px;
            border-radius: 16px;
            margin-bottom: 30px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
        }

        .price-label {
            color: rgba(255, 255, 255, 0.9);
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 5px;
        }

        .price {
            font-size: 42px;
            font-weight: 900;
            color: white;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }

        .price-suffix {
            font-size: 18px;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.9);
        }

        /* Specifications */
        .specs-section {
            margin-bottom: 35px;
        }

        .section-title {
            font-size: 20px;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .specs-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .spec-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 20px;
            background: #f8fafc;
            border-radius: 12px;
            transition: all 0.3s;
        }

        .spec-item:hover {
            background: #f1f5f9;
            transform: translateX(5px);
        }

        .spec-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 20px;
            flex-shrink: 0;
        }

        .spec-content {
            flex: 1;
        }

        .spec-label {
            font-size: 12px;
            color: var(--gray);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
        }

        .spec-value {
            font-size: 16px;
            font-weight: 700;
            color: var(--dark);
        }

        /* Features */
        .features-section {
            margin-bottom: 35px;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 16px;
            background: #f8fafc;
            border-radius: 8px;
            font-size: 14px;
            color: var(--gray);
        }

        .feature-item i {
            color: var(--success);
            font-size: 16px;
        }

        /* Action Buttons */
        .action-section {
            display: flex;
            gap: 15px;
            margin-top: 35px;
            padding-top: 35px;
            border-top: 3px solid #f1f5f9;
        }

        .btn {
            flex: 1;
            padding: 18px 32px;
            border: none;
            border-radius: 50px;
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

        .btn-rent {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            box-shadow: 0 10px 30px rgba(99, 102, 241, 0.4);
        }

        .btn-rent:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(99, 102, 241, 0.5);
        }

        .btn-cancel {
            background: white;
            color: var(--gray);
            border: 2px solid #e2e8f0;
        }

        .btn-cancel:hover {
            background: #f8fafc;
            border-color: var(--gray);
            color: var(--dark);
        }

        /* Info Cards */
        .info-cards {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-bottom: 30px;
        }

        .info-card {
            background: linear-gradient(135deg, #f8fafc, #e2e8f0);
            padding: 20px;
            border-radius: 12px;
            text-align: center;
        }

        .info-card-icon {
            font-size: 24px;
            margin-bottom: 10px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .info-card-label {
            font-size: 12px;
            color: var(--gray);
            margin-bottom: 5px;
        }

        .info-card-value {
            font-size: 18px;
            font-weight: 700;
            color: var(--dark);
        }

        /* Responsive */
        @media (max-width: 968px) {
            .detail-grid {
                grid-template-columns: 1fr;
            }

            .image-section {
                padding: 30px;
            }

            .info-section {
                padding: 30px;
            }

            .car-title {
                font-size: 28px;
            }

            .specs-grid,
            .features-grid {
                grid-template-columns: 1fr;
            }

            .info-cards {
                grid-template-columns: 1fr;
            }

            .action-section {
                flex-direction: column;
            }
        }

        @media (max-width: 576px) {
            body {
                padding: 20px 10px;
            }

            .price {
                font-size: 32px;
            }

            .car-title {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>

<div class="back-button">
    <a href="index.php">
        <i class="fas fa-arrow-left"></i>
        Kembali ke Beranda
    </a>
</div>

<div class="detail-container">
    <div class="detail-grid">
        <!-- Image Section -->
        <div class="image-section">
            <span class="status-badge">
                <i class="fas fa-check-circle"></i> <?= ucfirst(htmlspecialchars($mobil['status'])) ?>
            </span>
            <img src="assets/img/upload/<?= htmlspecialchars($mobil['gambar']) ?>" 
                 alt="<?= htmlspecialchars($mobil['nama_mobil']) ?>" 
                 class="car-image">
        </div>

        <!-- Info Section -->
        <div class="info-section">
            <div class="car-header">
                <h1 class="car-title"><?= htmlspecialchars($mobil['nama_mobil']) ?></h1>
                <div class="car-subtitle">
                    <i class="fas fa-building"></i>
                    <?= htmlspecialchars($mobil['merk']) ?>
                </div>
            </div>

            <!-- Price Section -->
            <div class="price-section">
                <div class="price-label">Harga Sewa</div>
                <div class="price">Rp <?= number_format($mobil['harga_per_hari'], 0, ',', '.') ?></div>
                <div class="price-suffix">per hari</div>
            </div>

            <!-- Info Cards -->
            <div class="info-cards">
                <div class="info-card">
                    <div class="info-card-icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div class="info-card-label">Tahun</div>
                    <div class="info-card-value"><?= htmlspecialchars($mobil['tahun']) ?></div>
                </div>
                <div class="info-card">
                    <div class="info-card-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="info-card-label">Kapasitas</div>
                    <div class="info-card-value"><?= htmlspecialchars($mobil['kapasitas']) ?> Orang</div>
                </div>
                <div class="info-card">
                    <div class="info-card-icon">
                        <i class="fas fa-cog"></i>
                    </div>
                    <div class="info-card-label">Transmisi</div>
                    <div class="info-card-value"><?= htmlspecialchars($mobil['transmisi']) ?></div>
                </div>
            </div>

            <!-- Specifications -->
            <div class="specs-section">
                <h3 class="section-title">
                    <i class="fas fa-list-check"></i>
                    Spesifikasi
                </h3>
                <div class="specs-grid">
                    <div class="spec-item">
                        <div class="spec-icon">
                            <i class="fas fa-gas-pump"></i>
                        </div>
                        <div class="spec-content">
                            <div class="spec-label">Bahan Bakar</div>
                            <div class="spec-value"><?= htmlspecialchars($mobil['bahan_bakar']) ?></div>
                        </div>
                    </div>
                    <div class="spec-item">
                        <div class="spec-icon">
                            <i class="fas fa-cogs"></i>
                        </div>
                        <div class="spec-content">
                            <div class="spec-label">Transmisi</div>
                            <div class="spec-value"><?= htmlspecialchars($mobil['transmisi']) ?></div>
                        </div>
                    </div>
                    <div class="spec-item">
                        <div class="spec-icon">
                            <i class="fas fa-chair"></i>
                        </div>
                        <div class="spec-content">
                            <div class="spec-label">Kapasitas</div>
                            <div class="spec-value"><?= htmlspecialchars($mobil['kapasitas']) ?> Penumpang</div>
                        </div>
                    </div>
                    <div class="spec-item">
                        <div class="spec-icon">
                            <i class="fas fa-calendar"></i>
                        </div>
                        <div class="spec-content">
                            <div class="spec-label">Tahun Produksi</div>
                            <div class="spec-value"><?= htmlspecialchars($mobil['tahun']) ?></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Features -->
            <div class="features-section">
                <h3 class="section-title">
                    <i class="fas fa-star"></i>
                    Fitur & Fasilitas
                </h3>
                <div class="features-grid">
                    <div class="feature-item">
                        <i class="fas fa-check-circle"></i>
                        AC & Audio System
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-check-circle"></i>
                        Asuransi Lengkap
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-check-circle"></i>
                        Kondisi Prima
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-check-circle"></i>
                        Bersih & Terawat
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-check-circle"></i>
                        GPS Navigation
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-check-circle"></i>
                        24/7 Support
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="action-section">
                <a href="form_sewa.php?id=<?= $mobil['id_mobil'] ?>" class="btn btn-rent">
                    <i class="fas fa-car"></i>
                    Sewa Sekarang
                </a>
                <a href="index.php" class="btn btn-cancel">
                    <i class="fas fa-times"></i>
                    Batal
                </a>
            </div>
        </div>
    </div>
</div>

</body>
</html>