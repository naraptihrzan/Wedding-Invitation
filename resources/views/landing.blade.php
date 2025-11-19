<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Wedding of Budi & Siti</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;1,400&family=Great+Vibes&family=Montserrat:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>
<body>

    <div id="cover">
        <div class="cover-content" data-aos="zoom-in" data-aos-duration="1500">
            <p>The Wedding Of</p>
            <h1 class="script-font" style="color: var(--secondary-color);">Budi & Siti</h1>
            <p>Kepada Yth. Bapak/Ibu/Saudara/i</p>
            <div class="guest-name" id="guestNameArea">Tamu Undangan</div>
            <button class="btn-gold" onclick="openInvitation()">
                <i class="fas fa-envelope-open-text"></i> Buka Undangan
            </button>
        </div>
    </div>

    <div id="main-content">
        
        <div class="music-control" id="musicBtn" onclick="toggleMusic()">
            <i class="fas fa-music"></i>
        </div>
        <button class="love-btn" onclick="spamLove()">
            <i class="fas fa-heart"></i>
        </button>
        
        <audio id="bgMusic" loop>
            <source src="https://cdn.pixabay.com/download/audio/2022/02/07/audio_183e313d99.mp3?filename=piano-moment-11305.mp3" type="audio/mp3">
        </audio>

        <section class="hero-section">
            <div class="hero-overlay" data-aos="fade-up">
                <div class="script-font" style="font-size: 2rem; color: var(--secondary-color); margin-bottom: 20px;">Save The Date</div>
                <h1 style="font-size: 3rem; margin-bottom: 10px;">Budi & Siti</h1>
                <p style="font-size: 1.2rem; margin-bottom: 30px; font-weight: 300;">Rabu, 31 Desember 2025</p>
                <div style="width: 50px; height: 2px; background: var(--secondary-color); margin: 0 auto;"></div>
                <p style="margin-top: 30px; font-style: italic;">"Dan di antara tanda-tanda (kebesaran)-Nya ialah Dia menciptakan pasangan-pasangan untukmu dari jenismu sendiri, agar kamu cenderung dan merasa tenteram kepadanya..."</p>
                <p><strong>(QS. Ar-Rum: 21)</strong></p>
            </div>
        </section>

        <section class="section-padding container">
            <div class="text-center" style="text-align: center; margin-bottom: 50px;">
                <h2 class="script-font" style="font-size: 3rem; color: var(--primary-color);" data-aos="fade-down">Mempelai</h2>
            </div>
            
            <div class="couple-grid">
                <div class="couple-card" data-aos="fade-right">
                    <img src="https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Budi" class="couple-img">
                    <h3 style="font-size: 2rem;">Budi Santoso</h3>
                    <p>Putra dari Bpk. Ahmad & Ibu Ratna</p>
                    <div class="couple-socials" style="margin-top: 15px;">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
                
                <div class="text-center" style="display: flex; align-items: center; justify-content: center;">
                    <h1 class="script-font" style="font-size: 4rem; color: var(--secondary-color);">&</h1>
                </div>

                <div class="couple-card" data-aos="fade-left">
                    <img src="https://images.unsplash.com/photo-1531746020798-e6953c6e8e04?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Siti" class="couple-img">
                    <h3 style="font-size: 2rem;">Siti Aminah</h3>
                    <p>Putri dari Bpk. Hasan & Ibu Dewi</p>
                    <div class="couple-socials" style="margin-top: 15px;">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
            </div>
        </section>

        <div class="countdown-wrapper">
            <h2 data-aos="zoom-in">Menuju Hari Bahagia</h2>
            <div class="countdown-timer" id="countdown">
                <div class="timer-box">
                    <div class="timer-number" id="days">00</div>
                    <div>Hari</div>
                </div>
                <div class="timer-box">
                    <div class="timer-number" id="hours">00</div>
                    <div>Jam</div>
                </div>
                <div class="timer-box">
                    <div class="timer-number" id="minutes">00</div>
                    <div>Menit</div>
                </div>
                <div class="timer-box">
                    <div class="timer-number" id="seconds">00</div>
                    <div>Detik</div>
                </div>
            </div>
            <div style="margin-top: 40px;">
                <a href="https://calendar.google.com/calendar/render?action=TEMPLATE&text=Pernikahan+Budi+%26+Siti&dates=20251231T080000/20251231T150000" target="_blank" class="btn-gold" style="background: white; color: var(--primary-color);">
                    <i class="far fa-calendar-plus"></i> Simpan Tanggal
                </a>
            </div>
        </div>

        <section class="section-padding container">
            <h2 class="script-font" style="text-align: center; font-size: 3rem; color: var(--primary-color); margin-bottom: 50px;" data-aos="fade-up">Rangkaian Acara</h2>
            
            <div class="glass-card event-card" data-aos="fade-up" data-aos-delay="100">
                <div style="display: flex; flex-wrap: wrap; align-items: center; gap: 30px;">
                    <div style="flex: 1; min-width: 250px;">
                        <i class="fas fa-handshake event-icon"></i>
                        <h3>Akad Nikah</h3>
                        <p style="margin-top: 10px;"><strong>Rabu, 31 Desember 2025</strong></p>
                        <p>Pukul 08.00 WIB - Selesai</p>
                        <hr style="border: 0; border-top: 1px solid #ddd; margin: 15px 0;">
                        <p><i class="fas fa-map-marker-alt"></i> <strong>Kediaman Mempelai Wanita</strong></p>
                        <p style="font-size: 0.9rem; color: #666;">Jl. Melati No. 123, Jakarta Selatan</p>
                    </div>
                    <div>
                        <a href="#" class="btn-gold"><i class="fas fa-location-arrow"></i> Google Maps</a>
                    </div>
                </div>
            </div>

            <div class="glass-card event-card" data-aos="fade-up" data-aos-delay="200">
                <div style="display: flex; flex-wrap: wrap; align-items: center; gap: 30px;">
                    <div style="flex: 1; min-width: 250px;">
                        <i class="fas fa-glass-cheers event-icon"></i>
                        <h3>Resepsi Pernikahan</h3>
                        <p style="margin-top: 10px;"><strong>Rabu, 31 Desember 2025</strong></p>
                        <p>Pukul 11.00 WIB - 15.00 WIB</p>
                        <hr style="border: 0; border-top: 1px solid #ddd; margin: 15px 0;">
                        <p><i class="fas fa-map-marker-alt"></i> <strong>Grand Ballroom Hotel Mulia</strong></p>
                        <p style="font-size: 0.9rem; color: #666;">Jl. Asia Afrika, Senayan, Jakarta</p>
                    </div>
                    <div>
                        <a href="#" class="btn-gold"><i class="fas fa-location-arrow"></i> Google Maps</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-padding" style="background-color: #fff;">
            <div class="container">
                <h2 class="script-font" style="text-align: center; font-size: 3rem; color: var(--primary-color); margin-bottom: 40px;" data-aos="fade-up">Galeri Foto</h2>
                <div class="gallery-grid">
                    <div class="gallery-item" data-aos="zoom-in">
                        <img src="https://images.unsplash.com/photo-1583939003579-730e3918a45a?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Gallery 1">
                    </div>
                    <div class="gallery-item" data-aos="zoom-in" data-aos-delay="100">
                        <img src="https://images.unsplash.com/photo-1519225448526-0f85151d27df?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Gallery 2">
                    </div>
                    <div class="gallery-item" data-aos="zoom-in" data-aos-delay="200">
                        <img src="https://images.unsplash.com/photo-1511285560982-1356c11d4606?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Gallery 3">
                    </div>
                    <div class="gallery-item" data-aos="zoom-in" data-aos-delay="300">
                        <img src="https://images.unsplash.com/photo-1520854221250-85d30221754b?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Gallery 4">
                    </div>
                </div>
            </div>
        </section>

        <section class="section-padding container" style="text-align: center;">
            <h2 class="script-font" style="font-size: 3rem; color: var(--primary-color);" data-aos="fade-up">Wedding Gift</h2>
            <p style="margin-bottom: 40px;" data-aos="fade-up">Doa restu Anda merupakan karunia yang sangat berarti bagi kami. Namun jika memberi adalah ungkapan tanda kasih Anda, kami menerima kado secara cashless.</p>
            
            <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 20px;">
                <div class="glass-card" style="flex: 1; min-width: 280px; max-width: 350px;" data-aos="flip-left">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5c/Bank_Central_Asia.svg/2560px-Bank_Central_Asia.svg.png" alt="BCA" style="height: 40px; margin-bottom: 20px;">
                    <p style="font-size: 1.2rem; font-weight: bold; letter-spacing: 2px;">123 456 7890</p>
                    <p style="margin-bottom: 20px;">a.n Budi Santoso</p>
                    <button class="btn-gold" style="font-size: 0.9rem; padding: 8px 20px;" onclick="copyToClipboard('1234567890')">
                        <i class="far fa-copy"></i> Salin Rekening
                    </button>
                </div>
                <div class="glass-card" style="flex: 1; min-width: 280px; max-width: 350px;" data-aos="flip-right">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/ad/Bank_Mandiri_logo_2016.svg/2560px-Bank_Mandiri_logo_2016.svg.png" alt="Mandiri" style="height: 40px; margin-bottom: 20px;">
                    <p style="font-size: 1.2rem; font-weight: bold; letter-spacing: 2px;">987 654 3210</p>
                    <p style="margin-bottom: 20px;">a.n Siti Aminah</p>
                    <button class="btn-gold" style="font-size: 0.9rem; padding: 8px 20px;" onclick="copyToClipboard('9876543210')">
                        <i class="far fa-copy"></i> Salin Rekening
                    </button>
                </div>
            </div>
        </section>

        <section class="section-padding" style="background: #1B4D3E; color: white;">
            <div class="container text-center">
                <h2 class="script-font" style="font-size: 3rem; margin-bottom: 30px; color: var(--secondary-color);">RSVP</h2>
                <p style="margin-bottom: 30px;">Mohon konfirmasi kehadiran Bapak/Ibu/Saudara/i untuk membantu kami mempersiapkan acara dengan lebih baik.</p>
                
                <form class="glass-card" style="background: rgba(255,255,255,0.1); color: white; text-align: left; max-width: 600px; margin: 0 auto;" onsubmit="alert('Terima kasih! Konfirmasi Anda telah terkirim.'); return false;">
                    <div style="margin-bottom: 15px;">
                        <label>Nama Lengkap</label>
                        <input type="text" style="width: 100%; padding: 10px; border-radius: 5px; border: none; margin-top: 5px;" placeholder="Nama Anda">
                    </div>
                    <div style="margin-bottom: 15px;">
                        <label>Jumlah Tamu</label>
                        <select style="width: 100%; padding: 10px; border-radius: 5px; border: none; margin-top: 5px;">
                            <option>1 Orang</option>
                            <option>2 Orang</option>
                        </select>
                    </div>
                    <div style="margin-bottom: 15px;">
                        <label>Konfirmasi</label>
                        <select style="width: 100%; padding: 10px; border-radius: 5px; border: none; margin-top: 5px;">
                            <option>Hadir</option>
                            <option>Maaf, Tidak Bisa Hadir</option>
                        </select>
                    </div>
                    <div style="margin-bottom: 20px;">
                        <label>Pesan / Doa</label>
                        <textarea rows="3" style="width: 100%; padding: 10px; border-radius: 5px; border: none; margin-top: 5px;" placeholder="Ucapan untuk mempelai..."></textarea>
                    </div>
                    <button type="submit" class="btn-gold" style="width: 100%;">Kirim Konfirmasi</button>
                </form>
            </div>
        </section>

        <footer style="background: #0F2027; color: white; padding: 30px; text-align: center;">
            <h2 class="script-font" style="font-size: 2.5rem; color: var(--secondary-color);">Budi & Siti</h2>
            <p style="font-size: 0.8rem; margin-top: 10px; opacity: 0.7;">Created with ❤ using HTML & CSS</p>
        </footer>

    </div>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>