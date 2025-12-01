const galleryImages = [
    '/image/foto1.jpg',
    '/image/foto2.jpg',
    '/image/foto3.jpg',
    '/image/foto4.jpg',
    '/image/foto5.jpg',
    '/image/foto6.jpg'
];

// Open invitation
function openInvitation() {
    const content = document.getElementById('invitation-content');
    if (content) {
        content.classList.remove('hidden');
        content.classList.add('fade-in');

        // Play Music
        const audio = document.getElementById('bg-music');
        const musicBtn = document.getElementById('music-control');

        if (audio) {
            audio.play().then(() => {
                musicBtn.classList.remove('hidden');
            }).catch(error => {
                console.log("Audio play failed:", error);
            });
        }

        // Smooth scroll to couple section
        setTimeout(() => {
            const coupleSection = document.getElementById('couple');
            if (coupleSection) {
                coupleSection.scrollIntoView({ behavior: 'smooth' });
            }
        }, 300);
    }
}

// Music Control
function toggleMusic() {
    const audio = document.getElementById('bg-music');
    const iconPause = document.getElementById('icon-pause');
    const iconPlay = document.getElementById('icon-play');
    const musicBtn = document.getElementById('music-control');

    if (audio.paused) {
        audio.play();
        iconPause.classList.remove('hidden');
        iconPlay.classList.add('hidden');
        musicBtn.classList.remove('paused');
    } else {
        audio.pause();
        iconPause.classList.add('hidden');
        iconPlay.classList.remove('hidden');
        musicBtn.classList.add('paused');
    }
}

// Gallery lightbox
function openLightbox(index) {
    const lightbox = document.getElementById('lightbox');
    const lightboxImg = document.getElementById('lightbox-img');
    lightboxImg.src = galleryImages[index];
    lightbox.classList.add('active');
}

function closeLightbox() {
    const lightbox = document.getElementById('lightbox');
    lightbox.classList.remove('active');
}

function scrollToSection(sectionId) {
    const section = document.getElementById(sectionId);
    if (!section) return;

    const offset = 70;
    const top = section.getBoundingClientRect().top + window.pageYOffset - offset;
    window.scrollTo({ top, behavior: 'smooth' });
}

// --- RSVP SUBMIT WITHOUT REDIRECT (AJAX) ---
// Old handleRSVPSubmit removed - replaced by new implementation at the bottom

// Pasang listener agar work untuk form rsvp
document.addEventListener("DOMContentLoaded", () => {
    const rsvpForm = document.getElementById("rsvpForm");
    if (rsvpForm) {
        rsvpForm.addEventListener("submit", handleRSVPSubmit);
    }
});


// Scroll to top button
const scrollTopBtn = document.getElementById('scroll-top');

window.addEventListener('scroll', () => {
    const currentY = window.pageYOffset;

    if (currentY > 300) {
        scrollTopBtn.classList.add('visible');
    } else {
        scrollTopBtn.classList.remove('visible');
    }

    if (floatingNav) {
        if (currentY > lastScrollY && currentY > 120) {
            floatingNav.style.transform = 'translateY(-120%)';
        } else {
            floatingNav.style.transform = 'translateY(0)';
        }
    }

    lastScrollY = currentY;
});

function scrollToTop() {
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

// Countdown to 2 December
const countdownElements = {
    days: document.getElementById('countdown-days'),
    hours: document.getElementById('countdown-hours'),
    minutes: document.getElementById('countdown-minutes'),
    seconds: document.getElementById('countdown-seconds'),
};

function getNextCountdownDate() {
    const now = new Date();
    const currentYear = now.getFullYear();
    let target = new Date(currentYear, 11, 2, 0, 0, 0); // 2 December

    if (target.getTime() <= now.getTime()) {
        target = new Date(currentYear + 1, 11, 2, 0, 0, 0);
    }

    // Tambah 10 jam
    target.setHours(target.getHours() + 10);

    return target;
}

const countdownTargetDate = getNextCountdownDate();
const countdownTitleEl = document.getElementById('countdown-date');

if (countdownTitleEl) {
    const options = { day: 'numeric', month: 'long', year: 'numeric' };
    countdownTitleEl.textContent = `Towards ${countdownTargetDate.toLocaleDateString('id-ID', options)}`;
}

function padTime(value) {
    return String(value).padStart(2, '0');
}

function updateCountdown() {
    if (!countdownElements.days) return;

    const now = new Date().getTime();
    const distance = countdownTargetDate.getTime() - now;

    if (distance <= 0) {
        countdownElements.days.textContent = '00';
        countdownElements.hours.textContent = '00';
        countdownElements.minutes.textContent = '00';
        countdownElements.seconds.textContent = '00';
        return;
    }

    const days = Math.floor(distance / (1000 * 60 * 60 * 24));
    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((distance % (1000 * 60)) / 1000);

    countdownElements.days.textContent = padTime(days);
    countdownElements.hours.textContent = padTime(hours);
    countdownElements.minutes.textContent = padTime(minutes);
    countdownElements.seconds.textContent = padTime(seconds);
}

if (countdownElements.days) {
    updateCountdown();
    setInterval(updateCountdown, 1000);
}

// Navigation interactions
const navLinksContainer = document.getElementById('nav-links');
const navToggle = document.getElementById('nav-toggle');
const navAnchors = document.querySelectorAll('.nav-links a');
const floatingNav = document.getElementById('floating-nav');

if (navToggle && navLinksContainer) {
    navToggle.addEventListener('click', () => {
        navLinksContainer.classList.toggle('open');
    });
}

navAnchors.forEach((link) => {
    link.addEventListener('click', () => {
        navLinksContainer?.classList.remove('open');
    });
});

const sections = document.querySelectorAll('[data-section]');

if ('IntersectionObserver' in window && sections.length) {
    const navObserver = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) return;
                const id = entry.target.getAttribute('id');
                if (!id) return;

                const activeLink = Array.from(navAnchors).find((link) => link.dataset.nav === id);
                if (!activeLink) return;

                navAnchors.forEach((link) => {
                    link.classList.toggle('active', link === activeLink);
                });
            });
        },
        { threshold: 0.5 }
    );

    sections.forEach((section) => navObserver.observe(section));
}

// Element reveal animations
const animatedElements = document.querySelectorAll('[data-animate]');

if ('IntersectionObserver' in window && animatedElements.length) {
    const animateObserver = new IntersectionObserver(
        (entries, obs) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) return;

                const delay = entry.target.dataset.delay;
                if (delay) entry.target.style.transitionDelay = `${delay}ms`;

                entry.target.classList.add('is-visible');
                obs.unobserve(entry.target);
            });
        },
        { threshold: 0.2, rootMargin: '0px 0px -50px 0px' }
    );

    animatedElements.forEach((el) => animateObserver.observe(el));
}

let lastScrollY = window.pageYOffset;

// Smooth fade-in on load
window.addEventListener('load', () => {
    document.body.style.opacity = '1';
});

// --- TOAST NOTIFICATION SYSTEM ---
class NotificationSystem {
    constructor() {
        this.container = document.createElement('div');
        this.container.className = 'notification-container';
        document.body.appendChild(this.container);
    }

    show(message, type = 'info', duration = 5000) {
        const toast = document.createElement('div');
        toast.className = `notification-toast ${type}`;

        const icon = this.getIcon(type);

        toast.innerHTML = `
            <div class="notification-icon">${icon}</div>
            <div class="notification-content">
                <div class="notification-title">${this.getTitle(type)}</div>
                <div class="notification-message">${message}</div>
            </div>
            <button class="notification-close" onclick="this.parentElement.remove()">×</button>
            <div class="notification-progress" style="animation-duration: ${duration}ms"></div>
        `;

        this.container.appendChild(toast);

        // Trigger animation
        requestAnimationFrame(() => {
            toast.classList.add('show');
        });

        // Auto remove
        setTimeout(() => {
            toast.classList.add('hide');
            toast.addEventListener('transitionend', () => {
                toast.remove();
            });
        }, duration);
    }

    getIcon(type) {
        switch (type) {
            case 'success':
                return `<svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>`;
            case 'error':
                return `<svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>`;
            default:
                return `<svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>`;
        }
    }

    getTitle(type) {
        switch (type) {
            case 'success': return 'Success';
            case 'error': return 'Error';
            default: return 'Information';
        }
    }
}

const notifications = new NotificationSystem();

// --- RSVP SUBMIT WITH TOAST ---
function handleRSVPSubmit(event) {
    event.preventDefault();

    const form = event.target;
    const submitBtn = document.getElementById('submit-btn');

    submitBtn.classList.add('loading');
    submitBtn.disabled = true;

    const formData = new FormData(form);

    fetch(form.action, {
        method: "POST",
        body: formData,
        headers: {
            "X-Requested-With": "XMLHttpRequest",
            "Accept": "application/json"
        }
    })
        .then(async (res) => {
            const data = await res.json();

            if (res.ok) {
                notifications.show(data.message || "Konfirmasi kehadiran berhasil dikirim!", 'success');
                form.reset();
            } else {
                if (data.errors) {
                    let errorText = "";
                    Object.keys(data.errors).forEach(key => {
                        errorText += `${data.errors[key][0]}\n`;
                    });
                    notifications.show(errorText, 'error');
                } else {
                    notifications.show("Terjadi kesalahan, silakan coba lagi.", 'error');
                }
            }
        })
        .catch(() => {
            notifications.show("Terjadi kesalahan jaringan. Periksa koneksi Anda.", 'error');
        })
        .finally(() => {
            submitBtn.classList.remove('loading');
            submitBtn.disabled = false;
        });
}