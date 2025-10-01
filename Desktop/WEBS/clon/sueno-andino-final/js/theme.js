// Sueño Andino Final - JavaScript
document.addEventListener('DOMContentLoaded', function() {
    // Smooth scroll
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });
    
    // Modal functions
    window.showGuideModal = function() {
        const modal = document.getElementById('guideModal');
        if (modal) {
            modal.style.display = 'block';
            document.body.style.overflow = 'hidden';
        }
    };
    
    window.closeGuideModal = function() {
        const modal = document.getElementById('guideModal');
        if (modal) {
            modal.style.display = 'none';
            document.body.style.overflow = 'auto';
        }
    };
    
    // Form handlers
    const contactForm = document.getElementById('contactForm');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Mensaje enviado correctamente');
        });
    }
    
    const leadMagnetForm = document.getElementById('leadMagnetForm');
    if (leadMagnetForm) {
        leadMagnetForm.addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Guía enviada a tu email');
            closeGuideModal();
        });
    }
});
