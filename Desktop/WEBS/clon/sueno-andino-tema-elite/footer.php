<footer class="site-footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-brand">
                    <a href="file:///C:/Users/Juan/Desktop/WEBS/clon/sue%C3%B1o-andino-wordpress.html#" class="site-logo">
                        <div class="footer-logo">SA</div>
                        <span class="footer-title">Sueño Andino</span>
                    </a>
                    <p class="footer-description">
                        Organización para el desarrollo territorial regenerativo
                    </p>
                </div>

                <div class="footer-section">
                    <h3>Navegación</h3>
                    <ul class="footer-menu">
                        <li><a href="file:///C:/Users/Juan/Desktop/WEBS/clon/sue%C3%B1o-andino-wordpress.html#servicios">Servicios</a></li>
                        <li><a href="file:///C:/Users/Juan/Desktop/WEBS/clon/sue%C3%B1o-andino-wordpress.html#nosotros">Nosotros</a></li>
                        <li><a href="file:///C:/Users/Juan/Desktop/WEBS/clon/sue%C3%B1o-andino-wordpress.html#equipo">Equipo</a></li>
                        <li><a href="file:///C:/Users/Juan/Desktop/WEBS/clon/sue%C3%B1o-andino-wordpress.html#contacto">Contacto</a></li>
                        <li><a href="file:///C:/Users/Juan/Desktop/WEBS/clon/blog-sue%C3%B1o-andino.html">Blog</a></li>
                        <li><a href="file:///C:/Users/Juan/Desktop/WEBS/clon/sue%C3%B1o-andino-wordpress.html#guia">Guía Gratuita</a></li>
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
                <p>© 2024 Sueño Andino. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>

<!-- POPUP LEAD MAGNET COMPACTO -->
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
