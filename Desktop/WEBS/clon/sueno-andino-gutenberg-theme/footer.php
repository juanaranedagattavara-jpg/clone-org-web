    </div><!-- #content -->

    <footer id="colophon" class="site-footer">
        <div class="footer-container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3><?php bloginfo('name'); ?></h3>
                    <p>Transformando comunidades a través del desarrollo territorial sostenible.</p>
                </div>
                
                <div class="footer-section">
                    <h4>Enlaces Rápidos</h4>
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'footer',
                        'menu_class'     => 'footer-menu',
                        'container'      => false,
                        'fallback_cb'    => false,
                    ));
                    ?>
                </div>
                
                <div class="footer-section">
                    <h4>Contacto</h4>
                    <p>Email: info@sueñoandino.org</p>
                    <p>Teléfono: +56 9 1234 5678</p>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>

    <!-- Lead Magnet Modal -->
    <div id="leadMagnetModal" class="modal" style="display: none;">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h3>Descarga tu Guía Gratuita</h3>
            <p>Obtén acceso a nuestra guía completa de desarrollo territorial sostenible.</p>
            <form id="leadMagnetForm">
                <input type="text" name="name" placeholder="Tu nombre" required>
                <input type="email" name="email" placeholder="Tu email" required>
                <button type="submit" class="btn btn-primary">Descargar Guía</button>
            </form>
        </div>
    </div>

</div><!-- #page -->

<?php wp_footer(); ?>

<script>
// Mobile menu toggle
document.addEventListener('DOMContentLoaded', function() {
    const menuToggle = document.querySelector('.menu-toggle');
    const navigation = document.querySelector('.main-navigation');
    
    if (menuToggle && navigation) {
        menuToggle.addEventListener('click', function() {
            navigation.classList.toggle('toggled');
            menuToggle.setAttribute('aria-expanded', 
                menuToggle.getAttribute('aria-expanded') === 'false' ? 'true' : 'false'
            );
        });
    }
    
    // Lead magnet modal
    const modal = document.getElementById('leadMagnetModal');
    const closeBtn = document.querySelector('.close');
    const form = document.getElementById('leadMagnetForm');
    
    // Show modal after 3 seconds
    setTimeout(function() {
        if (modal) {
            modal.style.display = 'block';
        }
    }, 3000);
    
    // Close modal
    if (closeBtn) {
        closeBtn.addEventListener('click', function() {
            modal.style.display = 'none';
        });
    }
    
    // Close modal when clicking outside
    window.addEventListener('click', function(event) {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });
    
    // Form submission
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(form);
            formData.append('action', 'sueno_andino_lead_magnet');
            formData.append('nonce', suenoAndino.nonce);
            
            fetch(suenoAndino.ajaxUrl, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('¡Gracias! Te enviaremos la guía pronto.');
                    modal.style.display = 'none';
                    form.reset();
                } else {
                    alert('Error: ' + data.data);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Hubo un error. Por favor, inténtalo de nuevo.');
            });
        });
    }
});
</script>

</body>
</html>
