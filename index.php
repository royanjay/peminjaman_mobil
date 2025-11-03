<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sewa Mobil - Rental Mobil Terbaik</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { background-color: #f5f7fa; color: #333; }
        header { background-color: white; box-shadow: 0 2px 10px rgba(0,0,0,0.1); position: sticky; top: 0; z-index: 1000; }
        .navbar { max-width: 1200px; margin: 0 auto; padding: 15px 20px; display: flex; justify-content: space-between; align-items: center; }
        .logo { font-size: 24px; font-weight: bold; color: #2563eb; }
        .nav-links { display: flex; list-style: none; gap: 25px; }
        .nav-links a { text-decoration: none; color: #333; font-weight: 500; transition: color 0.3s; }
        .nav-links a:hover { color: #2563eb; }
        .hero { background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('assets/img/background/mobil.jpg'); background-size: cover; background-position: center; height: 400px; display: flex; align-items: center; justify-content: center; color: white; text-align: center; }
        .hero h1 { font-size: 48px; margin-bottom: 15px; }
        .hero p { font-size: 18px; max-width: 600px; margin: 0 auto; }
        .car-section { max-width: 1200px; margin: 50px auto; padding: 0 20px; }
        .section-title { text-align: center; font-size: 32px; margin-bottom: 40px; color: #2563eb; }
        .cars-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 30px; }
        .car-card { background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.1); transition: transform 0.3s ease; }
        .car-card:hover { transform: translateY(-5px); }
        .car-image { width: 100%; height: 200px; object-fit: cover; }
        .car-info { padding: 20px; }
        .car-name { font-size: 20px; font-weight: bold; margin-bottom: 10px; }
        .car-details { display: flex; justify-content: space-between; margin-bottom: 15px; color: #666; }
        .price { font-size: 22px; font-weight: bold; color: #2563eb; }
        .features { display: flex; gap: 15px; margin-bottom: 20px; flex-wrap: wrap; }
        .feature { display: flex; align-items: center; gap: 5px; font-size: 14px; color: #666; }
        .rent-btn { width: 100%; padding: 12px; background-color: #2563eb; color: white; border: none; border-radius: 6px; font-size: 16px; cursor: pointer; transition: background-color 0.3s; }
        .rent-btn:hover { background-color: #1e4bb9; }
        
        /* Testimonial Section Styles */
        .testimonial-section { margin: 60px auto; padding: 0 20px; }
        .testimonial-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(350px, 1fr)); gap: 30px; }
        .testimonial-card { background: white; border-radius: 12px; padding: 30px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); position: relative; }
        .testimonial-quote { font-size: 18px; line-height: 1.6; color: #555; margin-bottom: 25px; position: relative; padding-left: 30px; }
        .testimonial-quote::before { content: '"'; position: absolute; left: 0; top: 0; font-size: 60px; color: #e0e7ff; line-height: 1; }
        .testimonial-author { display: flex; align-items: center; gap: 15px; }
        .author-avatar { width: 50px; height: 50px; border-radius: 50%; object-fit: cover; border: 3px solid #e0e7ff; }
        .author-info h4 { font-size: 16px; margin-bottom: 5px; color: #333; }
        .author-info p { color: #666; font-size: 14px; }
        
        footer { 
            background-color: #1e293b; 
            color: white; 
            padding: 40px 20px; 
            margin-top: 60px; 
        }
        .footer-container { 
            max-width: 1200px; 
            margin: 0 auto; 
            display: grid; 
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); 
            gap: 30px; 
        }
        .footer-section h3 { 
            margin-bottom: 20px; 
            font-size: 18px; 
        }
        .footer-section p, .footer-section li { 
            margin-bottom: 10px; 
            color: #cbd5e1; 
        }
        .footer-section ul { 
            list-style: none; 
        }
        .social-icons { 
            display: flex; 
            gap: 15px; 
        }
        .social-icons i { 
            font-size: 20px; 
            color: #cbd5e1; 
            transition: color 0.3s; 
        }
        .social-icons i:hover { 
            color: white; 
        }
    </style>
</head>
<body>

<header>
    <div class="navbar">
        <div class="logo">RentalMobil</div>
        <ul class="nav-links">
            <li><a href="#home">Home</a></li>
            <li><a href="#cars">Cars</a></li>
            <li><a href="#about">About Us</a></li>
            <li><a href="#contact">Contact</a></li>
        </ul>
    </div>
</header>

<section id="home" class="hero">
    <div>
        <h1>Temukan Mobil Impian Anda</h1>
        <p>Rentalkan mobil premium dengan harga terjangkau dan layanan terbaik</p>
    </div>
</section>

<!-- Mobil Tersedia -->
<section id="cars" class="car-section">
    <h2 class="section-title">Mobil Tersedia</h2>

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
            <img src="assets/img/upload/<?= htmlspecialchars($row['gambar']) ?>" alt="<?= htmlspecialchars($row['nama_mobil']) ?>" class="car-image">
            <div class="car-info">
                <div class="car-name"><?= htmlspecialchars($row['nama_mobil']) ?></div>
                <div class="car-details">
                    <span><?= htmlspecialchars($row['tahun']) ?></span>
                    <span class="price">Rp <?= number_format($row['harga_per_hari'], 0, ',', '.') ?>/hari</span>
                </div>
                <div class="features">
                    <div class="feature"><i class="fas fa-user"></i> <?= $row['kapasitas'] ?> Orang</div>
                    <div class="feature"><i class="fas fa-gas-pump"></i> <?= htmlspecialchars($row['bahan_bakar']) ?></div>
                    <div class="feature"><i class="fas fa-cog"></i> <?= htmlspecialchars($row['transmisi']) ?></div>
                </div>
                <a href="detail.php?id=<?= $row['id_mobil'] ?>" class="rent-btn">Sewa Sekarang</a>
            </div>
        </div>
        <?php
            endwhile;
        else:
            echo "<p style='text-align:center;color:#666;'>Belum ada mobil yang tersedia saat ini.</p>";
        endif;
        ?>
    </div>
</section>

<!-- Testimonial Section -->
<section class="testimonial-section">
    <h2 class="section-title">Testimonial Pelanggan</h2>
    
    <div class="testimonial-grid">
        <!-- Testimonial 1 -->
        <div class="testimonial-card">
            <div class="testimonial-quote">
                Layanan sangat cepat dan mudah. Mobil yang disewa dalam kondisi prima dan bersih. Pasti akan menggunakan jasa mereka lagi!
            </div>
            <div class="testimonial-author">
                <img src="assets/img/upload/testemoni/gu" alt="Ahmad Susanto" class="author-avatar">
                <div class="author-info">
                    <h4>Ahmad Susanto</h4>
                    <p>Pelanggan Setia</p>
                </div>
            </div>
        </div>
        
        <!-- Testimonial 2 -->
        <div class="testimonial-card">
            <div class="testimonial-quote">
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
        
        <!-- Testimonial 3 -->
        <div class="testimonial-card">
            <div class="testimonial-quote">
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
</section>

<footer>
    <div class="footer-container">
        <div class="footer-section">
            <h3>Tentang Kami</h3>
            <p>Kami menyediakan layanan rental mobil dengan kualitas terbaik dan harga terjangkau.</p>
        </div>
        <div class="footer-section">
            <h3>Kontak</h3>
            <p><i class="fas fa-map-marker-alt"></i> Jl. Raya No. 123, Jakarta</p>
            <p><i class="fas fa-phone"></i> +62 21 1234 5678</p>
            <p><i class="fas fa-envelope"></i> info@rentalmobil.com</p>
        </div>
        <div class="footer-section">
            <h3>Jam Operasional</h3>
            <p>Senin - Sabtu: 08:00 - 20:00</p>
            <p>Minggu: 09:00 - 18:00</p>
        </div>
    </div>
</footer>

</body>
</html>