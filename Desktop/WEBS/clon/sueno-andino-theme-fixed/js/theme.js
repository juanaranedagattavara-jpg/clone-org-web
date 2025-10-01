jQuery(document).ready(function($) {
    // Smooth scroll para enlaces internos
    $('a[href^="#"]').on('click', function(e) {
        e.preventDefault();
        
        var target = $(this.getAttribute('href'));
        if (target.length) {
            $('html, body').animate({
                scrollTop: target.offset().top - 80
            }, 1000);
        }
    });
    
    // Formulario de contacto
    $('#contact-form').on('submit', function(e) {
        e.preventDefault();
        
        var form = $(this);
        var submitBtn = form.find('.submit-btn');
        var originalText = submitBtn.text();
        
        // Mostrar estado de carga
        submitBtn.text('Enviando...').prop('disabled', true);
        
        // Enviar datos via AJAX
        $.ajax({
            url: sueno_andino_ajax.ajax_url,
            type: 'POST',
            data: {
                action: 'contact_form',
                name: form.find('#name').val(),
                email: form.find('#email').val(),
                message: form.find('#message').val(),
                nonce: sueno_andino_ajax.nonce
            },
            success: function(response) {
                if (response.success) {
                    showNotification('Mensaje enviado correctamente', 'success');
                    form[0].reset();
                } else {
                    showNotification(response.data || 'Error al enviar el mensaje', 'error');
                }
            },
            error: function() {
                showNotification('Error de conexión', 'error');
            },
            complete: function() {
                submitBtn.text(originalText).prop('disabled', false);
            }
        });
    });
    
    // Función para mostrar notificaciones
    function showNotification(message, type) {
        var notification = $('<div class="notification notification-' + type + '">' + message + '</div>');
        
        // Agregar estilos si no existen
        if (!$('#notification-styles').length) {
            $('head').append(`
                <style id="notification-styles">
                    .notification {
                        position: fixed;
                        top: 20px;
                        right: 20px;
                        padding: 15px 20px;
                        border-radius: 5px;
                        color: white;
                        font-weight: 600;
                        z-index: 9999;
                        animation: slideIn 0.3s ease;
                    }
                    .notification-success {
                        background: #28a745;
                    }
                    .notification-error {
                        background: #dc3545;
                    }
                    @keyframes slideIn {
                        from { transform: translateX(100%); }
                        to { transform: translateX(0); }
                    }
                </style>
            `);
        }
        
        $('body').append(notification);
        
        // Remover después de 5 segundos
        setTimeout(function() {
            notification.fadeOut(300, function() {
                $(this).remove();
            });
        }, 5000);
    }
    
    // Animaciones al hacer scroll
    $(window).on('scroll', function() {
        var scrollTop = $(this).scrollTop();
        
        // Header fijo
        if (scrollTop > 100) {
            $('.site-header').addClass('scrolled');
        } else {
            $('.site-header').removeClass('scrolled');
        }
        
        // Animaciones de elementos
        $('.service-card, .testimonial-card, .team-member').each(function() {
            var elementTop = $(this).offset().top;
            var elementBottom = elementTop + $(this).outerHeight();
            var viewportTop = $(window).scrollTop();
            var viewportBottom = viewportTop + $(window).height();
            
            if (elementBottom > viewportTop && elementTop < viewportBottom) {
                $(this).addClass('animate-in');
            }
        });
    });
    
    // Menú móvil
    $('.menu-toggle').on('click', function() {
        $('.main-navigation').toggleClass('active');
        $(this).toggleClass('active');
    });
    
    // Cerrar menú móvil al hacer clic en un enlace
    $('.main-navigation a').on('click', function() {
        $('.main-navigation').removeClass('active');
        $('.menu-toggle').removeClass('active');
    });
});
