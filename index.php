<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sewa Mobil - Rental Mobil Terbaik</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f5f7fa;
            color: #333;
        }

        /* Header */
        header {
            background-color: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar {
            max-width: 1200px;
            margin: 0 auto;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #2563eb;
        }

        .nav-links {
            display: flex;
            list-style: none;
            gap: 25px;
        }

        .nav-links a {
            text-decoration: none;
            color: #333;
            font-weight: 500;
            transition: color 0.3s;
        }

        .nav-links a:hover {
            color: #2563eb;
        }

        /* Hero Section */
        .hero {
  background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)),
              url('../img/background/mobil.jpg');
  background-size: cover;
  background-position: center;
  height: 400px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
}


        .hero h1 {
            font-size: 48px;
            margin-bottom: 15px;
        }

        .hero p {
            font-size: 18px;
            max-width: 600px;
            margin: 0 auto;
        }

        /* Car Listings */
        .car-section {
            max-width: 1200px;
            margin: 50px auto;
            padding: 0 20px;
        }

        .section-title {
            text-align: center;
            font-size: 32px;
            margin-bottom: 40px;
            color: #2563eb;
        }

        .cars-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 30px;
        }

        .car-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }

        .car-card:hover {
            transform: translateY(-5px);
        }

        .car-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .car-info {
            padding: 20px;
        }

        .car-name {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .car-details {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            color: #666;
        }

        .price {
            font-size: 22px;
            font-weight: bold;
            color: #2563eb;
        }

        .features {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
        }

        .feature {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 14px;
            color: #666;
        }

        .rent-btn {
            width: 100%;
            padding: 12px;
            background-color: #2563eb;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .rent-btn:hover {
            background-color: #1e4bb9;
        }

        /* About Section */
        .about-section {
            max-width: 1200px;
            margin: 80px auto;
            padding: 0 20px;
            background: white;
            padding: 60px 20px;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .about-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 40px;
        }

        .about-text h3 {
            font-size: 28px;
            margin-bottom: 20px;
            color: #2563eb;
        }

        .about-text p {
            line-height: 1.6;
            margin-bottom: 15px;
            color: #555;
        }

        /* Contact Section */
        .contact-section {
            max-width: 1200px;
            margin: 80px auto;
            padding: 0 20px;
            background: white;
            padding: 60px 20px;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .contact-form {
            max-width: 600px;
            margin: 0 auto;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 16px;
        }

        .submit-btn {
            background-color: #2563eb;
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .submit-btn:hover {
            background-color: #1e4bb9;
        }

        /* Footer */
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

        /* Responsive Design */
        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                gap: 15px;
            }
            
            .nav-links {
                flex-wrap: wrap;
                justify-content: center;
            }
            
            .hero h1 {
                font-size: 36px;
            }
            
            .hero p {
                font-size: 16px;
            }
            
            .section-title {
                font-size: 28px;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
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

    <!-- Hero Section / Home -->
    <section id="home" class="hero">
        <div>
            <h1>Temukan Mobil Impian Anda</h1>
            <p>Rentalkan mobil premium dengan harga terjangkau dan layanan terbaik</p>
        </div>
    </section>

    <!-- Car Listings -->
    <section id="cars" class="car-section">
        <h2 class="section-title">Mobil Tersedia</h2>
        
        <div class="cars-grid">
            <!-- Car Card 1 -->
            <div class="car-card">
                <img src="img/mobil/Toyota Avanza G.jpg" alt="Toyota Avanza" class="car-image">
                <div class="car-info">
                    <div class="car-name">Toyota Avanza G</div>
                    <div class="car-details">
                        <span>2022</span>
                        <span class="price">Rp 350.000/hari</span>
                    </div>
                    <div class="features">
                        <div class="feature"><i class="fas fa-user"></i> 7 Orang</div>
                        <div class="feature"><i class="fas fa-gas-pump"></i> Bensin</div>
                        <div class="feature"><i class="fas fa-cog"></i> Manual</div>
                    </div>
                    <button class="rent-btn">Sewa Sekarang</button>
                </div>
            </div>

            <!-- Car Card 2 -->
            <div class="car-card">
                <img src="img/mobil/Honda Jazz RS.jpg" alt="Honda Jazz" class="car-image">
                <div class="car-info">
                    <div class="car-name">Honda Jazz RS</div>
                    <div class="car-details">
                        <span>2023</span>
                        <span class="price">Rp 280.000/hari</span>
                    </div>
                    <div class="features">
                        <div class="feature"><i class="fas fa-user"></i> 5 Orang</div>
                        <div class="feature"><i class="fas fa-gas-pump"></i> Bensin</div>
                        <div class="feature"><i class="fas fa-cog"></i> Matic</div>
                    </div>
                    <button class="rent-btn">Sewa Sekarang</button>
                </div>
            </div>

            <!-- Car Card 3 -->
            <div class="car-card">
                <img src="img/mobil/Suzuki Ertiga GL.jpg" alt="Suzuki Ertiga" class="car-image">
                <div class="car-info">
                    <div class="car-name">Suzuki Ertiga GL</div>
                    <div class="car-details">
                        <span>2022</span>
                        <span class="price">Rp 320.000/hari</span>
                    </div>
                    <div class="features">
                        <div class="feature"><i class="fas fa-user"></i> 7 Orang</div>
                        <div class="feature"><i class="fas fa-gas-pump"></i> Bensin</div>
                        <div class="feature"><i class="fas fa-cog"></i> Manual</div>
                    </div>
                    <button class="rent-btn">Sewa Sekarang</button>
                </div>
            </div>

            <!-- Car Card 4 -->
            <div class="car-card">
                <img src="img/mobil/Daihatsu Xenia R.jpg" alt="Daihatsu Xenia" class="car-image">
                <div class="car-info">
                    <div class="car-name">Daihatsu Xenia R</div>
                    <div class="car-details">
                        <span>2023</span>
                        <span class="price">Rp 260.000/hari</span>
                    </div>
                    <div class="features">
                        <div class="feature"><i class="fas fa-user"></i> 5 Orang</div>
                        <div class="feature"><i class="fas fa-gas-pump"></i> Bensin</div>
                        <div class="feature"><i class="fas fa-cog"></i> Manual</div>
                    </div>
                    <button class="rent-btn">Sewa Sekarang</button>
                </div>
            </div>

            <!-- Car Card 5 -->
            <div class="car-card">
                <img src="img/mobil/Mitsubishi Xpander ULT.jpeg" alt="Mitsubishi Xpander" class="car-image">
                <div class="car-info">
                    <div class="car-name">Mitsubishi Xpander ULT</div>
                    <div class="car-details">
                        <span>2023</span>
                        <span class="price">Rp 380.000/hari</span>
                    </div>
                    <div class="features">
                        <div class="feature"><i class="fas fa-user"></i> 7 Orang</div>
                        <div class="feature"><i class="fas fa-gas-pump"></i> Bensin</div>
                        <div class="feature"><i class="fas fa-cog"></i> Matic</div>
                    </div>
                    <button class="rent-btn">Sewa Sekarang</button>
                </div>
            </div>

            <!-- Car Card 6 -->
            <div class="car-card">
                <img src="img/mobil/Nissan Kicks SV.jpg" alt="Nissan Kicks" clpgass="car-image">
                <div class="car-info">
                    <div class="car-name">Nissan Kicks SV</div>
                    <div class="car-details">
                        <span>2022</span>
                        <span class="price">Rp 310.000/hari</span>
                    </div>
                    <div class="features">
                        <div class="feature"><i class="fas fa-user"></i> 5 Orang</div>
                        <div class="feature"><i class="fas fa-gas-pump"></i> Bensin</div>
                        <div class="feature"><i class="fas fa-cog"></i> Matic</div>
                    </div>
                    <button class="rent-btn">Sewa Sekarang</button>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="about-section">
        <div class="about-content">
            <div class="about-text">
                <h3>Tentang Kami</h3>
                <p>RentalMobil adalah penyedia jasa rental mobil terpercaya dengan armada modern dan harga kompetitif. Kami berkomitmen memberikan pengalaman berkendara yang nyaman dan aman bagi semua pelanggan kami.</p>
                <p>Dengan lebih dari 10 tahun pengalaman di industri rental mobil, kami telah melayani ribuan pelanggan dengan berbagai kebutuhan transportasi, mulai dari bisnis, liburan, hingga keperluan harian.</p>
            </div>
            <div class="about-text">
                <h3>Visi & Misi</h3>
                <p><strong>Visi:</strong> Menjadi penyedia jasa rental mobil terdepan dengan standar pelayanan prima dan inovatif.</p>
                <p><strong>Misi:</strong></p>
                <ul>
                    <li>Menyediakan armada mobil yang selalu terawat dan aman</li>
                    <li>Memberikan pelayanan yang ramah dan profesional</li>
                    <li>Mengembangkan teknologi untuk meningkatkan kenyamanan pelanggan</li>
                    <li>Berupaya memenuhi kebutuhan transportasi dengan fleksibilitas</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact-section">
        <h2 class="section-title">Hubungi Kami</h2>
        <div class="contact-form">
            <form>
                <div class="form-group">
                    <label for="name">Nama Lengkap</label>
                    <input type="text" id="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" required>
                </div>
                <div class="form-group">
                    <label for="phone">Nomor Telepon</label>
                    <input type="tel" id="phone" required>
                </div>
                <div class="form-group">
                    <label for="message">Pesan</label>
                    <textarea id="message" rows="5" required></textarea>
                </div>
                <button type="submit" class="submit-btn">Kirim Pesan</button>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="footer-container">
            <div class="footer-section">
                <h3>Tentang Kami</h3>
                <p>Kami menyediakan layanan rental mobil dengan kualitas terbaik dan harga terjangkau.</p>
            </div>
            <div class="footer-section">
                <h3>Informasi Kontak</h3>
                <p><i class="fas fa-map-marker-alt"></i> Jl. Raya No. 123, Jakarta</p>
                <p><i class="fas fa-phone"></i> +62 21 1234 5678</p>
                <p><i class="fas fa-envelope"></i> info@rentalmobil.com</p>
            </div>
            <div class="footer-section">
                <h3>Jam Operasional</h3>
                <p>Senin - Sabtu: 08:00 - 20:00</p>
                <p>Minggu: 09:00 - 18:00</p>
            </div>
            <div class="footer-section">
                <h3>Sosial Media</h3>
                <div class="social-icons">
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Smooth scrolling untuk navigasi
        document.querySelectorAll('.nav-links a').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                
                const targetId = this.getAttribute('href');
                const targetElement = document.querySelector(targetId);
                
                if (targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 70, // Offset untuk navbar fixed
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Form submission handling
        document.querySelector('.contact-form form').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Simpan data form atau kirim ke server
            alert('Terima kasih! Pesan Anda telah terkirim.');
            this.reset();
        });
    </script>
</body>
</html>