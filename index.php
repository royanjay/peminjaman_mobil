<?php
include 'config/config.php'; // pastikan $conn sudah diset di config.php

// Cek apakah koneksi database berhasil
if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RoyCar Rental - Sewa Mobil Premium</title>
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
        }

        body {
            background: var(--light);
            color: var(--dark);
            overflow-x: hidden;
        }

        /* Navbar */
        header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            animation: slideDown 0.5s ease;
        }

        @keyframes slideDown {
            from { transform: translateY(-100%); }
            to { transform: translateY(0); }
        }

        .navbar {
            max-width: 1400px;
            margin: 0 auto;
            padding: 20px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 28px;
            font-weight: 800;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo i {
            -webkit-text-fill-color: var(--primary);
        }

        .nav-links {
            display: flex;
            list-style: none;
            gap: 40px;
            align-items: center;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--dark);
            font-weight: 600;
            position: relative;
            transition: color 0.3s;
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            width: 0;
            height: 3px;
            bottom: -5px;
            left: 0;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            transition: width 0.3s;
            border-radius: 10px;
        }

        .nav-links a:hover {
            color: var(--primary);
        }

        .nav-links a:hover::after {
            width: 100%;
        }

        /* Hero Section */
        .hero {
            margin-top: 80px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 600px;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            width: 150%;
            height: 150%;
            background: url('data:image/svg+xml,<svg width="60" height="60" xmlns="http://www.w3.org/2000/svg"><circle cx="30" cy="30" r="2" fill="rgba(255,255,255,0.1)"/></svg>');
            animation: float 20s linear infinite;
        }

        @keyframes float {
            to { transform: translate(-20%, -20%); }
        }

        .hero-content {
            max-width: 1400px;
            margin: 0 auto;
            padding: 60px 40px;
            position: relative;
            z-index: 1;
        }

        .hero h1 {
            font-size: 64px;
            color: white;
            font-weight: 900;
            margin-bottom: 20px;
            line-height: 1.2;
            animation: fadeInUp 0.8s ease;
        }

        .hero p {
            font-size: 24px;
            color: rgba(255, 255, 255, 0.9);
            max-width: 600px;
            margin-bottom: 40px;
            animation: fadeInUp 0.8s ease 0.2s backwards;
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

        .hero-buttons {
            display: flex;
            gap: 20px;
            animation: fadeInUp 0.8s ease 0.4s backwards;
        }

        .btn {
            padding: 16px 40px;
            border-radius: 50px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary {
            background: white;
            color: var(--primary);
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
        }

        .btn-secondary {
            background: transparent;
            color: white;
            border: 2px solid white;
        }

        .btn-secondary:hover {
            background: white;
            color: var(--primary);
        }

        /* Features Section */
        .features {
            max-width: 1400px;
            margin: -80px auto 80px;
            padding: 0 40px;
            position: relative;
            z-index: 10;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
        }

        .feature-card {
            background: white;
            padding: 40px 30px;
            border-radius: 20px;
            text-align: center;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            transition: all 0.3s;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 20px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            color: white;
        }

        .feature-card h3 {
            font-size: 20px;
            margin-bottom: 10px;
            color: var(--dark);
        }

        .feature-card p {
            color: var(--gray);
            line-height: 1.6;
        }

        /* Cars Section */
        .car-section {
            max-width: 1400px;
            margin: 80px auto;
            padding: 0 40px;
        }

        .section-header {
            text-align: center;
            margin-bottom: 60px;
        }

        .section-header h2 {
            font-size: 48px;
            font-weight: 800;
            margin-bottom: 15px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .section-header p {
            font-size: 18px;
            color: var(--gray);
        }

        .cars-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 40px;
        }

        .car-card {
            background: white;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
            transition: all 0.4s;
            position: relative;
        }

        .car-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            transform: scaleX(0);
            transition: transform 0.4s;
        }

        .car-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        }

        .car-card:hover::before {
            transform: scaleX(1);
        }

        .car-image-wrapper {
            position: relative;
            height: 240px;
            background: linear-gradient(135deg, #f5f7fa 0%, #e9ecef 100%);
            overflow: hidden;
        }

        .car-badge {
            position: absolute;
            top: 20px;
            right: 20px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 8px 20px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            z-index: 1;
        }

        .car-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s;
        }

        .car-card:hover .car-image {
            transform: scale(1.1);
        }

        .car-info {
            padding: 30px;
        }

        .car-name {
            font-size: 24px;
            font-weight: 800;
            margin-bottom: 15px;
            color: var(--dark);
        }

        .car-specs {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .spec {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--gray);
            font-size: 14px;
        }

        .spec i {
            color: var(--primary);
        }

        .car-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 20px;
            border-top: 2px solid #f1f5f9;
        }

        .price {
            font-size: 28px;
            font-weight: 800;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .price-label {
            font-size: 14px;
            color: var(--gray);
            display: block;
        }

        .rent-btn {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border: none;
            padding: 14px 30px;
            border-radius: 50px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .rent-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 30px rgba(99, 102, 241, 0.4);
        }

        /* Testimonial Section */
        .testimonial-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 100px 40px;
            margin-top: 80px;
            position: relative;
            overflow: hidden;
        }

        .testimonial-section::before {
            content: '';
            position: absolute;
            width: 150%;
            height: 150%;
            background: url('data:image/svg+xml,<svg width="60" height="60" xmlns="http://www.w3.org/2000/svg"><circle cx="30" cy="30" r="2" fill="rgba(255,255,255,0.1)"/></svg>');
            animation: float 20s linear infinite;
        }

        .testimonial-container {
            max-width: 1400px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }

        .testimonial-section .section-header h2 {
            color: white;
            -webkit-text-fill-color: white;
        }

        .testimonial-section .section-header p {
            color: rgba(255, 255, 255, 0.9);
        }

        .testimonial-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 30px;
            margin-top: 60px;
        }

        .testimonial-card {
            background: white;
            border-radius: 24px;
            padding: 40px;
            position: relative;
            transition: all 0.3s;
        }

        .testimonial-card:hover {
            transform: translateY(-10px);
        }

        .quote-icon {
            position: absolute;
            top: 30px;
            right: 30px;
            font-size: 60px;
            color: #f1f5f9;
        }

        .stars {
            color: #fbbf24;
            font-size: 18px;
            margin-bottom: 20px;
        }

        .testimonial-text {
            color: var(--gray);
            line-height: 1.8;
            margin-bottom: 30px;
            font-size: 16px;
        }

        .testimonial-author {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .author-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #f1f5f9;
        }

        .author-info h4 {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 5px;
            color: var(--dark);
        }

        .author-info p {
            color: var(--gray);
            font-size: 14px;
        }

        /* Footer */
        footer {
            background: var(--dark);
            color: white;
            padding: 80px 40px 40px;
        }

        .footer-container {
            max-width: 1400px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 50px;
            margin-bottom: 40px;
        }

        .footer-section h3 {
            font-size: 20px;
            margin-bottom: 25px;
            font-weight: 700;
        }

        .footer-section p,
        .footer-section li {
            color: #94a3b8;
            margin-bottom: 15px;
            line-height: 1.6;
        }

        .footer-section ul {
            list-style: none;
        }

        .footer-section a {
            color: #94a3b8;
            text-decoration: none;
            transition: color 0.3s;
        }

        .footer-section a:hover {
            color: white;
        }

        .social-links {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }

        .social-link {
            width: 45px;
            height: 45px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
        }

        .social-link:hover {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            transform: translateY(-3px);
        }

        .footer-bottom {
            text-align: center;
            padding-top: 40px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: #94a3b8;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 42px;
            }

            .hero p {
                font-size: 18px;
            }

            .section-header h2 {
                font-size: 36px;
            }

            .cars-grid,
            .testimonial-grid {
                grid-template-columns: 1fr;
            }

            .navbar {
                padding: 15px 20px;
            }

            .nav-links {
                gap: 20px;
            }
        }
    </style>
</head>
<body>

<header>
    <div class="navbar">
        <div class="logo">
            <i class="fas fa-car"></i>
            RoyCar Rental
        </div>
        <ul class="nav-links">
            <li><a href="#home">Home</a></li>
            <li><a href="#cars">Mobil</a></li>
            <li><a href="#testimonial">Testimoni</a></li>
            <li><a href="#contact">Kontak</a></li>
        </ul>
    </div>
</header>

<section id="home" class="hero">
    <div class="hero-content">
        <h1>Temukan Mobil<br>Impian Anda</h1>
        <p>Sewa mobil premium dengan harga terjangkau dan pelayanan terbaik di Indonesia</p>
        <div class="hero-buttons">
            <a href="#cars" class="btn btn-primary">Lihat Mobil</a>
            <a href="#contact" class="btn btn-secondary">Hubungi Kami</a>
        </div>
    </div>
</section>

<section class="features">
    <div class="features-grid">
        <div class="feature-card">
            <div class="feature-icon">
                <i class="fas fa-shield-alt"></i>
            </div>
            <h3>Asuransi Penuh</h3>
            <p>Semua mobil dilindungi asuransi komprehensif untuk keamanan Anda</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon">
                <i class="fas fa-clock"></i>
            </div>
            <h3>Layanan 24/7</h3>
            <p>Customer service siap membantu Anda kapan saja</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon">
                <i class="fas fa-tag"></i>
            </div>
            <h3>Harga Terbaik</h3>
            <p>Harga kompetitif dengan kualitas pelayanan premium</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon">
                <i class="fas fa-car-side"></i>
            </div>
            <h3>Mobil Terawat</h3>
            <p>Semua mobil dalam kondisi prima dan bersih</p>
        </div>
    </div>
</section>

<section id="cars" class="car-section">
    <div class="section-header">
        <h2>Mobil Tersedia</h2>
        <p>Pilih mobil impian Anda dari koleksi kami yang beragam</p>
    </div>

    <div class="cars-grid">
        <?php
        // Koneksi ke database
        include 'config/config.php';
        
        // Query untuk mendapatkan semua mobil yang tersedia
        $query = mysqli_query($conn, "SELECT * FROM mobil WHERE status='tersedia' ORDER BY id_mobil DESC");
        
        if (mysqli_num_rows($query) > 0):
            while ($row = mysqli_fetch_assoc($query)):
        ?>
        <div class="car-card">
            <div class="car-image-wrapper">
                <span class="car-badge">Tersedia</span>
                <img src="assets/img/upload/<?= htmlspecialchars($row['gambar']) ?>" alt="<?= htmlspecialchars($row['nama_mobil']) ?>" class="car-image">
            </div>
            <div class="car-info">
                <div class="car-name"><?= htmlspecialchars($row['nama_mobil']) ?></div>
                <div class="car-specs">
                    <div class="spec">
                        <i class="fas fa-calendar"></i>
                        <span><?= htmlspecialchars($row['tahun']) ?></span>
                    </div>
                    <div class="spec">
                        <i class="fas fa-users"></i>
                        <span><?= $row['kapasitas'] ?> Orang</span>
                    </div>
                    <div class="spec">
                        <i class="fas fa-gas-pump"></i>
                        <span><?= htmlspecialchars($row['bahan_bakar']) ?></span>
                    </div>
                    <div class="spec">
                        <i class="fas fa-cog"></i>
                        <span><?= htmlspecialchars($row['transmisi']) ?></span>
                    </div>
                </div>
                <div class="car-footer">
                    <div>
                        <span class="price-label">Mulai dari</span>
                        <div class="price">Rp <?= number_format($row['harga_per_hari'], 0, ',', '.') ?></div>
                        <span class="price-label">per hari</span>
                    </div>
                    <a href="detail.php?id=<?= $row['id_mobil'] ?>" class="rent-btn">Sewa</a>
                </div>
            </div>
        </div>
        <?php
            endwhile;
        else:
            echo "<p style='text-align:center;color:#666;grid-column:1/-1;'>Belum ada mobil yang tersedia saat ini.</p>";
        endif;
        ?>
    </div>
</section>

<section id="testimonial" class="testimonial-section">
    <div class="testimonial-container">
        <div class="section-header">
            <h2>Apa Kata Mereka?</h2>
            <p>Testimoni dari pelanggan setia kami</p>
        </div>
        
        <div class="testimonial-grid">
            <div class="testimonial-card">
                <i class="fas fa-quote-right quote-icon"></i>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <div class="testimonial-text">
                    Layanan sangat cepat dan mudah. Mobil yang disewa dalam kondisi prima dan bersih. Pasti akan menggunakan jasa mereka lagi!
                </div>
                <div class="testimonial-author">
                    <img src="assets/img/upload/testemoni/guntur.jpeg" alt="Ahmad Susanto" class="author-avatar">
                    <div class="author-info">
                        <h4>Ahmad Susanto</h4>
                        <p>Pelanggan Setia</p>
                    </div>
                </div>
            </div>
            
            <div class="testimonial-card">
                <i class="fas fa-quote-right quote-icon"></i>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <div class="testimonial-text">
                    Harga kompetitif dan staf yang ramah. Proses penyewaan sangat cepat dan tidak ribet. Sangat direkomendasikan!
                </div>
                <div class="testimonial-author">
                    <img src="assets/img/upload/testemoni/andre.jpeg" alt="Siti Nurhaliza" class="author-avatar">
                    <div class="author-info">
                        <h4>Siti Nurhaliza</h4>
                        <p>Bisnis Travel</p>
                    </div>
                </div>
            </div>
            
            <div class="testimonial-card">
                <i class="fas fa-quote-right quote-icon"></i>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <div class="testimonial-text">
                    Mobilnya nyaman dan cocok untuk keluarga. Pelayanan customer service sangat membantu ketika kami butuh bantuan.
                </div>
                <div class="testimonial-author">
                    <img src="assets/img/upload/testemoni/rama.jpeg" alt="Dwi Putri" class="author-avatar">
                    <div class="author-info">
                        <h4>Dwi Putri</h4>
                        <p>Pelanggan Baru</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<footer id="contact">
    <div class="footer-container">
        <div class="footer-section">
            <h3>RoyCar Rental</h3>
            <p>Kami menyediakan layanan rental mobil dengan kualitas terbaik dan harga terjangkau untuk memenuhi kebutuhan perjalanan Anda.</p>
            <div class="social-links">
                <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                <a href="#" class="social-link"><i class="fab fa-whatsapp"></i></a>
            </div>
        </div>
        
        <div class="footer-section">
            <h3>Kontak Kami</h3>
            <p><i class="fas fa-map-marker-alt"></i> Jl. Raya Pacitan-Ponorogo Desa Slahung, Ponorogo</p>
            <p><i class="fas fa-phone"></i> +62 85 7313 34627</p>
            <p><i class="fas fa-envelope"></i> info@RoyCar Rental.com</p>
        </div>
        
        <div class="footer-section">
            <h3>Jam Operasional</h3>
            <p>Senin - Jumat<br>08:00 - 20:00</p>
            <p>Sabtu<br>08:00 - 18:00</p>
            <p>Minggu<br>09:00 - 17:00</p>
        </div>
        
        <div class="footer-section">
            <h3>Link Cepat</h3>
            <ul>
                <li><a href="#home">Home</a></li>
                <li><a href="#cars">Mobil Tersedia</a></li>
                <li><a href="#testimonial">Testimoni</a></li>
                <li><a href="#contact">Kontak</a></li>
            </ul>
        </div>
    </div>
    
    <div class="footer-bottom">
        <p>&copy; 2024 RoyCar Rental. All rights reserved.</p>
    </div>
</footer>

</body>
</html>