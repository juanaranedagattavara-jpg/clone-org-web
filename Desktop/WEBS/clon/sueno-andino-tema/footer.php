<footer class="site-footer">
    <div class="container">
        <div class="footer-content">
            <div class="footer-section">
                <h3><?php bloginfo('name'); ?></h3>
                <p><?php bloginfo('description'); ?></p>
                <div class="social-links">
                    <a href="#" class="social-link" aria-label="Facebook">📘</a>
                    <a href="#" class="social-link" aria-label="Twitter">🐦</a>
                    <a href="#" class="social-link" aria-label="LinkedIn">💼</a>
                    <a href="#" class="social-link" aria-label="Instagram">📷</a>
                </div>
            </div>

            <div class="footer-section">
                <h3>Navegación</h3>
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
                <h3>Contacto</h3>
                <ul class="footer-menu">
                    <li>Lima, Perú</li>
                    <li>+51-999-888-777</li>
                    <li>hola@sueñoandino.com</li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. <?php _e('Todos los derechos reservados.', 'sueno-andino'); ?></p>
        </div>
    </div>
</footer>

<!-- Modal Lead Magnet -->
<div id="guideModal" class="guide-modal" style="display: none;">
    <div class="modal-overlay" onclick="closeGuideModal()">
        <div class="modal-content" onclick="event.stopPropagation()">
            <div class="modal-header">
                <div class="modal-icon">📚</div>
                <h3>¡Guía Gratuita!</h3>
                <p class="modal-subtitle">Metodologías Regenerativas para Comunidades Andinas</p>
                <button class="modal-close" onclick="closeGuideModal()">×</button>
            </div>
            <div class="modal-body">
                <div class="guide-benefits-compact">
                    <div class="benefit-compact">✅ Metodologías paso a paso</div>
                    <div class="benefit-compact">✅ Casos de éxito reales</div>
                    <div class="benefit-compact">✅ Herramientas prácticas</div>
                </div>
                
                <form class="guide-form-compact">
                    <div class="form-row">
                        <input type="text" name="name" placeholder="Tu nombre" required>
                        <input type="email" name="email" placeholder="Email" required>
                    </div>
                    <button type="submit" class="btn-download">
                        <span>📥</span> Descargar Guía
                    </button>
                    <p class="privacy-note">🔒 Privacidad garantizada</p>
                </form>
            </div>
        </div>
    </div>
</div>

<?php wp_footer(); ?>

</body>
</html>