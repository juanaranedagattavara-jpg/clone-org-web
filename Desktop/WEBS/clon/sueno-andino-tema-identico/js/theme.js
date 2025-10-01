// Sueño Andino - JavaScript Idéntico
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
            // Aquí puedes agregar lógica para enviar el formulario
            alert('Mensaje enviado correctamente');
        });
    }
    
    // Manejar formulario de lead magnet
    const leadMagnetForm = document.getElementById('leadMagnetForm');
    if (leadMagnetForm) {
        leadMagnetForm.addEventListener('submit', function(e) {
            e.preventDefault();
            // Aquí puedes agregar lógica para el lead magnet
            alert('Guía enviada a tu email');
            closeGuideModal();
        });
    }
});
