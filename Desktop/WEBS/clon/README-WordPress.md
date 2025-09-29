# Sueño Andino - Clon para WordPress/Gutenberg

## 📋 Descripción
Este es un clon de la landing page "Sueño Andino" con una similitud del 90%, optimizado para ser convertido a WordPress y editable con Gutenberg.

## 🎯 Características del Clon

### ✅ Secciones Implementadas
1. **Header** - Navegación con logo, menú y botón CTA
2. **Hero Section** - Título principal, descripción, botones y estadísticas
3. **About Section** - "¿Por qué Sueño Andino?" con 4 tarjetas
4. **Timeline Section** - Historia de la empresa con línea de tiempo
5. **Services Section** - Servicios con 3 tarjetas y CTA
6. **Cases Section** - Testimonios y casos de éxito
7. **Team Section** - Equipo dividido en Directorio y Equipo
8. **Contact Section** - Formulario de contacto e información
9. **Footer** - Enlaces, información de contacto y copyright

### 🎨 Diseño y Estilos
- **Paleta de colores**: Azul primario (#0e5e6f), Verde acento (#7fb069), Gris arena (#d9c8b4)
- **Tipografía**: Inter (sistema de fuentes)
- **Responsive**: Diseño adaptativo para móviles y tablets
- **Animaciones**: Hover effects y transiciones suaves

### 🔧 Funcionalidades
- Navegación suave entre secciones
- Formularios funcionales con validación
- Diseño responsive completo
- Estructura optimizada para Gutenberg

## 🚀 Cómo Convertir a WordPress

### 1. Crear un Tema Personalizado
```php
// style.css
/*
Theme Name: Sueño Andino
Description: Tema personalizado para Sueño Andino
Version: 1.0
*/

// functions.php
function sueno_andino_enqueue_styles() {
    wp_enqueue_style('sueno-andino-style', get_stylesheet_uri());
    wp_enqueue_style('inter-font', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
}
add_action('wp_enqueue_scripts', 'sueno_andino_enqueue_styles');
```

### 2. Crear Bloques de Gutenberg Personalizados

#### Hero Block
```php
// blocks/hero-block.php
register_block_type('sueno-andino/hero', array(
    'editor_script' => 'hero-block-editor',
    'editor_style' => 'hero-block-editor',
    'style' => 'hero-block',
    'render_callback' => 'render_hero_block',
));
```

#### Services Grid Block
```php
// blocks/services-grid.php
register_block_type('sueno-andino/services-grid', array(
    'editor_script' => 'services-grid-editor',
    'editor_style' => 'services-grid-editor',
    'style' => 'services-grid',
    'render_callback' => 'render_services_grid_block',
));
```

### 3. Estructura de Archivos Recomendada
```
sueno-andino-theme/
├── style.css
├── index.php
├── functions.php
├── blocks/
│   ├── hero-block.php
│   ├── about-cards.php
│   ├── timeline.php
│   ├── services-grid.php
│   ├── cases-section.php
│   ├── team-section.php
│   └── contact-form.php
├── templates/
│   ├── page-home.php
│   └── parts/
│       ├── header.php
│       └── footer.php
└── assets/
    ├── css/
    │   └── main.css
    └── js/
        └── main.js
```

### 4. Campos Personalizados (ACF)
```php
// Campos para el Hero Section
acf_add_local_field_group(array(
    'key' => 'group_hero_section',
    'title' => 'Hero Section',
    'fields' => array(
        array(
            'key' => 'field_hero_title',
            'label' => 'Título Principal',
            'name' => 'hero_title',
            'type' => 'text',
        ),
        array(
            'key' => 'field_hero_description',
            'label' => 'Descripción',
            'name' => 'hero_description',
            'type' => 'textarea',
        ),
        array(
            'key' => 'field_hero_stats',
            'label' => 'Estadísticas',
            'name' => 'hero_stats',
            'type' => 'repeater',
            'sub_fields' => array(
                array(
                    'key' => 'field_stat_number',
                    'label' => 'Número',
                    'name' => 'stat_number',
                    'type' => 'text',
                ),
                array(
                    'key' => 'field_stat_label',
                    'label' => 'Etiqueta',
                    'name' => 'stat_label',
                    'type' => 'text',
                ),
            ),
        ),
    ),
));
```

### 5. Plantillas de Página
```php
// page-home.php
<?php get_header(); ?>

<main id="main" class="site-main">
    <?php
    // Hero Section
    get_template_part('blocks/hero-block');
    
    // About Section
    get_template_part('blocks/about-cards');
    
    // Timeline Section
    get_template_part('blocks/timeline');
    
    // Services Section
    get_template_part('blocks/services-grid');
    
    // Cases Section
    get_template_part('blocks/cases-section');
    
    // Team Section
    get_template_part('blocks/team-section');
    
    // Contact Section
    get_template_part('blocks/contact-form');
    ?>
</main>

<?php get_footer(); ?>
```

## 📱 Responsive Design

### Breakpoints
- **Desktop**: 1200px+
- **Tablet**: 768px - 1199px
- **Mobile**: 320px - 767px

### Características Responsive
- Navegación colapsable en móviles
- Timeline adaptativa para pantallas pequeñas
- Grids que se convierten en columnas en móviles
- Botones de ancho completo en móviles

## 🎨 Personalización

### Variables CSS
```css
:root {
    --sa-primary: #0e5e6f;
    --sa-accent: #7fb069;
    --sa-sand: #d9c8b4;
    --sa-ink: #1c1c1e;
    --sa-cloud: #f5f6f7;
    --sa-white: #ffffff;
}
```

### Clases de Gutenberg
- `.wp-block-group` - Contenedores de bloques
- `.wp-block-columns` - Columnas
- `.wp-block-button` - Botones
- `.has-text-align-center` - Alineación de texto
- `.alignwide` - Ancho amplio
- `.alignfull` - Ancho completo

## 🔧 Plugins Recomendados

1. **Advanced Custom Fields (ACF)** - Para campos personalizados
2. **Gutenberg Blocks** - Para bloques adicionales
3. **Contact Form 7** - Para formularios de contacto
4. **Yoast SEO** - Para optimización SEO
5. **WP Rocket** - Para optimización de velocidad

## 📝 Notas de Implementación

### Consideraciones Importantes
1. **Imágenes**: Reemplazar placeholders con imágenes reales
2. **Iconos**: Implementar iconos SVG o fuente de iconos
3. **Formularios**: Conectar con sistema de email o CRM
4. **SEO**: Agregar meta tags y structured data
5. **Performance**: Optimizar CSS y JavaScript

### Próximos Pasos
1. Crear el tema de WordPress
2. Implementar bloques de Gutenberg
3. Configurar campos personalizados
4. Optimizar para SEO
5. Realizar pruebas de rendimiento

## 📞 Soporte

Para cualquier duda sobre la implementación, consulta la documentación de WordPress o contacta al desarrollador.

---
**Desarrollado con ❤️ para Sueño Andino**
