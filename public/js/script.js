        // Initialize Animations
        AOS.init({
            once: true,
            duration: 1000,
        });

        // URL Personalization Logic
        function getParameterByName(name) {
            name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
            var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
                results = regex.exec(location.search);
            return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
        }

        const guest = getParameterByName('to');
        if(guest) {
            document.getElementById('guestNameArea').innerText = guest;
        }

        // Open Invitation & Play Music
        function openInvitation() {
            const cover = document.getElementById('cover');
            const mainContent = document.getElementById('main-content');
            const music = document.getElementById('bgMusic');
            
            cover.classList.add('hidden');
            mainContent.classList.add('visible');
            
            // Enable scrolling
            document.body.style.overflowY = 'auto';
            
            // Play Music
            music.play().catch(error => console.log("Autoplay blocked"));
            document.getElementById('musicBtn').classList.add('playing');
        }

        // Music Toggle
        function toggleMusic() {
            const music = document.getElementById('bgMusic');
            const btn = document.getElementById('musicBtn');
            
            if (music.paused) {
                music.play();
                btn.classList.add('playing');
                btn.innerHTML = '<i class="fas fa-music"></i>';
            } else {
                music.pause();
                btn.classList.remove('playing');
                btn.innerHTML = '<i class="fas fa-pause"></i>';
            }
        }

        // Floating Hearts Animation
        function spamLove() {
            const heart = document.createElement('div');
            heart.innerHTML = '<i class="fas fa-heart"></i>';
            heart.style.position = 'fixed';
            heart.style.bottom = '100px';
            heart.style.right = '40px';
            heart.style.fontSize = (Math.random() * 20 + 15) + 'px';
            heart.style.color = '#ff4757';
            heart.style.zIndex = '1000';
            heart.style.animation = 'floatUp 2s ease-out forwards';
            
            document.body.appendChild(heart);
            setTimeout(() => heart.remove(), 2000);
        }

        // Keyframes for JS Animation
        const styleSheet = document.createElement("style");
        styleSheet.innerText = `
            @keyframes floatUp {
                0% { transform: translateY(0) scale(1); opacity: 1; }
                100% { transform: translateY(-200px) scale(0); opacity: 0; margin-right: ${Math.random() * 50 - 25}px; }
            }
        `;
        document.head.appendChild(styleSheet);

        // Toast Notification for Copy
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text);
            
            const toast = document.createElement('div');
            toast.innerText = "✅ Nomor Rekening Disalin!";
            toast.style.position = "fixed";
            toast.style.bottom = "20px";
            toast.style.left = "50%";
            toast.style.transform = "translateX(-50%)";
            toast.style.background = "rgba(0,0,0,0.8)";
            toast.style.color = "white";
            toast.style.padding = "12px 25px";
            toast.style.borderRadius = "30px";
            toast.style.zIndex = "9999";
            
            document.body.appendChild(toast);
            setTimeout(() => {
                toast.remove();
            }, 2000);
        }

        // Countdown Timer
        const weddingDate = new Date('December 31, 2025 08:00:00').getTime();
        setInterval(function() {
            const now = new Date().getTime();
            const distance = weddingDate - now;
            
            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);
            
            document.getElementById("days").innerText = days;
            document.getElementById("hours").innerText = hours;
            document.getElementById("minutes").innerText = minutes;
            document.getElementById("seconds").innerText = seconds;
        }, 1000);
