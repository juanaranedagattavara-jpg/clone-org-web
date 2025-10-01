// Sueño Andino - JavaScript
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
        alert('¡Gracias por tu interés! La guía estará disponible próximamente.');
    };
    
    // Función para cerrar modal
    window.closeGuideModal = function() {
        // Implementar lógica de cierre de modal si es necesario
    };
});
