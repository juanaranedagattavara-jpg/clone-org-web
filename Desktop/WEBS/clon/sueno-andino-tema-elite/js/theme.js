// Sueño Andino Elite - JavaScript Exacto
document.addEventListener('DOMContentLoaded', function() {
    // Smooth scroll para enlaces internos
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
    
    // Función para mostrar modal de guía
    window.showGuideModal = function() {
        const modal = document.getElementById('guideModal');
        if (modal) {
            modal.style.display = 'block';
            document.body.style.overflow = 'hidden';
        }
    };
    
    // Función para cerrar modal
    window.closeGuideModal = function() {
        const modal = document.getElementById('guideModal');
        if (modal) {
            modal.style.display = 'none';
            document.body.style.overflow = 'auto';
        }
    };
    
    // Manejar formulario de contacto
    const contactForm = document.getElementById('contactForm');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            formData.append('action', 'contact_form');
            formData.append('nonce', suenoAndinoAjax.nonce);
            
            fetch(suenoAndinoAjax.ajax_url, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Mensaje enviado correctamente');
                    this.reset();
                } else {
                    alert('Error al enviar el mensaje');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error al enviar el mensaje');
            });
        });
    }
    
    // Manejar formulario de lead magnet
    const leadMagnetForm = document.getElementById('leadMagnetForm');
    if (leadMagnetForm) {
        leadMagnetForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            formData.append('action', 'lead_magnet');
            formData.append('nonce', suenoAndinoAjax.nonce);
            
            fetch(suenoAndinoAjax.ajax_url, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Guía enviada a tu email');
                    closeGuideModal();
                    this.reset();
                } else {
                    alert('Error al enviar la guía');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error al enviar la guía');
            });
        });
    }
    
    // Animaciones de entrada
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);
    
    // Observar elementos para animaciones
    document.querySelectorAll('.service-card, .testimonial-card, .team-member').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(30px)';
        el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(el);
    });
});
