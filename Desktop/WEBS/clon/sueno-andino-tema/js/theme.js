/**
 * Sueño Andino Theme JavaScript
 * Funcionalidades del tema
 */

(function($) {
    'use strict';

    // Variables globales
    var $window = $(window);
    var $document = $(document);
    var $body = $('body');

    // Inicializar cuando el DOM esté listo
    $document.ready(function() {
        initMobileMenu();
        initSmoothScroll();
        initGuideModal();
        initAnimations();
    });

    // Inicializar cuando la ventana esté cargada
    $window.on('load', function() {
        initLazyLoading();
        initPreloader();
    });

    /**
     * Menú móvil
     */
    function initMobileMenu() {
        var $menuToggle = $('.menu-toggle');
        var $navMenu = $('.nav-menu');
        var $menuOverlay = $('.menu-overlay');

        $menuToggle.on('click', function(e) {
            e.preventDefault();
            $body.toggleClass('menu-open');
            $navMenu.toggleClass('active');
            $menuOverlay.toggleClass('active');
        });

        $menuOverlay.on('click', function() {
            $body.removeClass('menu-open');
            $navMenu.removeClass('active');
            $menuOverlay.removeClass('active');
        });

        // Cerrar menú al hacer clic en enlaces
        $navMenu.find('a').on('click', function() {
            $body.removeClass('menu-open');
            $navMenu.removeClass('active');
            $menuOverlay.removeClass('active');
        });
    }

    /**
     * Scroll suave
     */
    function initSmoothScroll() {
        $('a[href*="#"]:not([href="#"])').on('click', function(e) {
            var target = $(this.hash);
            if (target.length) {
                e.preventDefault();
                $('html, body').animate({
                    scrollTop: target.offset().top - 80
                }, 800, 'easeInOutCubic');
            }
        });
    }

    /**
     * Modal de guía
     */
    function initGuideModal() {
        var $modal = $('#guideModal');
        var $overlay = $('.modal-overlay');
        var $closeBtn = $('.modal-close');

        // Mostrar modal
        window.showGuideModal = function() {
            $modal.fadeIn(300);
            $body.addClass('modal-open');
        };

        // Cerrar modal
        window.closeGuideModal = function() {
            $modal.fadeOut(300);
            $body.removeClass('modal-open');
        };

        // Eventos de cierre
        $closeBtn.on('click', closeGuideModal);
        $overlay.on('click', closeGuideModal);

        // Cerrar con tecla ESC
        $(document).on('keydown', function(e) {
            if (e.keyCode === 27 && $modal.is(':visible')) {
                closeGuideModal();
            }
        });

        // Formulario de guía
        $('.guide-form-compact').on('submit', function(e) {
            e.preventDefault();
            handleGuideForm($(this));
        });

        // Formulario de newsletter
        $('.newsletter-form').on('submit', function(e) {
            e.preventDefault();
            handleNewsletterForm($(this));
        });

        // Formulario de contacto
        $('#contactoForm').on('submit', function(e) {
            e.preventDefault();
            handleContactForm($(this));
        });
    }

    /**
     * Manejar formulario de guía
     */
    function handleGuideForm($form) {
        var $button = $form.find('button[type="submit"]');
        var $originalText = $button.html();
        
        // Mostrar estado de carga
        $button.html('<span>⏳</span> Enviando...').prop('disabled', true);
        
        // Simular envío (aquí iría la lógica real de AJAX)
        setTimeout(function() {
            $button.html('<span>✅</span> ¡Enviado!').removeClass('btn-download').addClass('btn-success');
            
            setTimeout(function() {
                closeGuideModal();
                $form[0].reset();
                $button.html($originalText).removeClass('btn-success').addClass('btn-download').prop('disabled', false);
            }, 2000);
        }, 1500);
    }

    /**
     * Manejar formulario de newsletter
     */
    function handleNewsletterForm($form) {
        var $button = $form.find('button[type="submit"]');
        var $originalText = $button.html();
        
        // Mostrar estado de carga
        $button.html('⏳ Suscribiendo...').prop('disabled', true);
        
        // Simular envío
        setTimeout(function() {
            $button.html('✅ ¡Suscrito!').addClass('btn-success');
            showNotification('¡Te has suscrito exitosamente a nuestro newsletter!', 'success');
            
            setTimeout(function() {
                $form[0].reset();
                $button.html($originalText).removeClass('btn-success').prop('disabled', false);
            }, 3000);
        }, 1500);
    }

    /**
     * Manejar formulario de contacto
     */
    function handleContactForm($form) {
        var $button = $form.find('button[type="submit"]');
        var $originalText = $button.html();
        
        // Validar formulario
        var isValid = true;
        $form.find('input[required], textarea[required]').each(function() {
            if (!$(this).val().trim()) {
                $(this).addClass('error');
                isValid = false;
            } else {
                $(this).removeClass('error');
            }
        });
        
        if (!isValid) {
            showNotification('Por favor completa todos los campos requeridos.', 'error');
            return;
        }
        
        // Mostrar estado de carga
        $button.html('⏳ Enviando...').prop('disabled', true);
        
        // Simular envío
        setTimeout(function() {
            $button.html('✅ ¡Enviado!').addClass('btn-success');
            showNotification('¡Mensaje enviado exitosamente! Te contactaremos pronto.', 'success');
            
            setTimeout(function() {
                $form[0].reset();
                $button.html($originalText).removeClass('btn-success').prop('disabled', false);
            }, 3000);
        }, 2000);
    }

    /**
     * Animaciones
     */
    function initAnimations() {
        // Animación de entrada para elementos
        function animateOnScroll() {
            $('.service-card, .testimonial-card, .team-member, .anne-timeline-item').each(function() {
                var $this = $(this);
                var elementTop = $this.offset().top;
                var elementBottom = elementTop + $this.outerHeight();
                var viewportTop = $window.scrollTop();
                var viewportBottom = viewportTop + $window.height();

                if (elementBottom > viewportTop && elementTop < viewportBottom) {
                    $this.addClass('animate-in');
                }
            });
        }

        // Ejecutar animaciones
        $window.on('scroll', throttle(animateOnScroll, 100));
        animateOnScroll(); // Ejecutar una vez al cargar
    }

    /**
     * Lazy loading
     */
    function initLazyLoading() {
        if ('IntersectionObserver' in window) {
            var imageObserver = new IntersectionObserver(function(entries, observer) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        var img = entry.target;
                        img.src = img.dataset.src;
                        img.classList.remove('lazy');
                        imageObserver.unobserve(img);
                    }
                });
            });

            $('.lazy').each(function() {
                imageObserver.observe(this);
            });
        }
    }

    /**
     * Preloader
     */
    function initPreloader() {
        var $preloader = $('.preloader');
        if ($preloader.length) {
            $preloader.fadeOut(500);
        }
    }

    /**
     * Utilidades
     */
    function throttle(func, wait) {
        var timeout;
        return function executedFunction() {
            var later = function() {
                clearTimeout(timeout);
                func();
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }

    /**
     * Easing personalizado
     */
    $.easing.easeInOutCubic = function(x, t, b, c, d) {
        if ((t /= d / 2) < 1) return c / 2 * t * t * t + b;
        return c / 2 * ((t -= 2) * t * t + 2) + b;
    };

    /**
     * Notificaciones
     */
    function showNotification(message, type) {
        type = type || 'success';
        var $notification = $('<div class="notification notification-' + type + '">' + message + '</div>');
        
        $body.append($notification);
        
        setTimeout(function() {
            $notification.addClass('show');
        }, 100);
        
        setTimeout(function() {
            $notification.removeClass('show');
            setTimeout(function() {
                $notification.remove();
            }, 300);
        }, 3000);
    }

    // Exponer funciones globales
    window.showGuideModal = window.showGuideModal || function() {};
    window.closeGuideModal = window.closeGuideModal || function() {};
    window.showNotification = showNotification;

})(jQuery);

/**
 * CSS para notificaciones
 */
var notificationCSS = `
<style>
.notification {
    position: fixed;
    top: 20px;
    right: 20px;
    padding: 15px 20px;
    border-radius: 8px;
    color: white;
    font-weight: 600;
    z-index: 9999;
    transform: translateX(100%);
    transition: transform 0.3s ease;
    max-width: 300px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.notification.show {
    transform: translateX(0);
}

.notification-success {
    background: #4CAF50;
}

.notification-error {
    background: #f44336;
}

.notification-info {
    background: #2196F3;
}

.modal-open {
    overflow: hidden;
}

/* Animaciones CSS */
.service-card, .testimonial-card, .team-member, .anne-timeline-item {
    opacity: 0;
    transform: translateY(30px);
    transition: all 0.6s ease;
}

.service-card.animate-in, .testimonial-card.animate-in, .team-member.animate-in, .anne-timeline-item.animate-in {
    opacity: 1;
    transform: translateY(0);
}

/* Preloader */
.preloader {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: white;
    z-index: 9999;
    display: flex;
    align-items: center;
    justify-content: center;
}

.preloader::after {
    content: '';
    width: 40px;
    height: 40px;
    border: 4px solid #f3f3f3;
    border-top: 4px solid var(--sa-primary);
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* Estilos para formularios */
.form-group input.error,
.form-group textarea.error {
    border-color: #f44336;
    box-shadow: 0 0 0 2px rgba(244, 67, 54, 0.2);
}

.btn-success {
    background: #4CAF50 !important;
    color: white !important;
}

.btn-success:hover {
    background: #45a049 !important;
}

/* Estilos para notificaciones mejoradas */
.notification {
    border-radius: 12px;
    font-family: 'Inter', sans-serif;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
    backdrop-filter: blur(10px);
}

.notification-success {
    background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%);
}

.notification-error {
    background: linear-gradient(135deg, #f44336 0%, #d32f2f 100%);
}

.notification-info {
    background: linear-gradient(135deg, #2196F3 0%, #1976D2 100%);
}
</style>
`;

// Insertar CSS de notificaciones
document.head.insertAdjacentHTML('beforeend', notificationCSS);