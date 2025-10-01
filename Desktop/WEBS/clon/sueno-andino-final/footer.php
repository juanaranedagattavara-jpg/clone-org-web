<footer class="site-footer">
    <div class="container">
        <div class="footer-content">
            <div class="footer-brand">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo">
                    <div class="footer-logo">SA</div>
                    <span class="footer-title"><?php bloginfo('name'); ?></span>
                </a>
                <p class="footer-description">Organización para el desarrollo territorial regenerativo</p>
            </div>
            <div class="footer-section">
                <h3>Navegación</h3>
                <ul class="footer-menu">
                    <li><a href="<?php echo esc_url(home_url('/')); ?>#servicios">Servicios</a></li>
                    <li><a href="<?php echo esc_url(home_url('/')); ?>#nosotros">Nosotros</a></li>
                    <li><a href="<?php echo esc_url(home_url('/')); ?>#equipo">Equipo</a></li>
                    <li><a href="<?php echo esc_url(home_url('/')); ?>#contacto">Contacto</a></li>
                    <li><a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>">Blog</a></li>
                    <li><a href="#" onclick="showGuideModal(); return false;">Guía Gratuita</a></li>
                </ul>
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
            <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. Todos los derechos reservados.</p>
        </div>
    </div>
</footer>

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
                <form class="guide-form-compact" id="leadMagnetForm">
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
