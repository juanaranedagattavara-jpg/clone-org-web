<footer class="site-footer">
    <div class="footer-container">
        <div class="footer-content">
            <div class="footer-section">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="site-title">
                    SA Sueño Andino
                </a>
                <p>Organización para el desarrollo territorial regenerativo</p>
            </div>
            
            <div class="footer-section">
                <h3>Navegación</h3>
                <ul>
                    <li><a href="#servicios">Servicios</a></li>
                    <li><a href="#equipo">Nosotros</a></li>
                    <li><a href="#contacto">Contacto</a></li>
                    <li><a href="<?php echo esc_url(home_url('/blog')); ?>">Blog</a></li>
                    <li><a href="#guia">Guía Gratuita</a></li>
                </ul>
            </div>
            
            <div class="footer-section">
                <h3>Contacto</h3>
                <ul>
                    <li>Lima, Perú</li>
                    <li>+51-999-888-777</li>
                    <li>hola@sueñoandino.com</li>
                </ul>
            </div>
        </div>
        
        <div class="footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> Sueño Andino. Todos los derechos reservados.</p>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
