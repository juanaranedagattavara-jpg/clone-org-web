# 🎨 Guía de Instalación - Tema WordPress Sueño Andino

## 📋 Descripción del Proyecto

Este tema WordPress está basado en el diseño específico de `contenido-sueño-andino.html` y está optimizado para:

- ✅ **Diseño exacto** del archivo HTML original
- ✅ **Bloques Gutenberg** personalizados editables
- ✅ **Rendimiento optimizado** para WordPress
- ✅ **Formularios funcionales** con AJAX
- ✅ **Responsive design** para todos los dispositivos
- ✅ **SEO optimizado** y accesible

## 🚀 Instalación Rápida

### Paso 1: Subir el Tema
1. Ve a tu WordPress: **Apariencia > Temas**
2. Haz clic en **"Añadir nuevo"**
3. Selecciona **"Subir tema"**
4. Elige el archivo ZIP: `sueno-andino-wordpress-YYYYMMDD-HHMM.zip`
5. Haz clic en **"Instalar ahora"**

### Paso 2: Activar el Tema
1. Una vez instalado, haz clic en **"Activar"**
2. El tema se activará automáticamente
3. Se crearán las páginas necesarias automáticamente

### Paso 3: Configuración Inicial

#### 3.1 Configurar Menú Principal
1. Ve a **Apariencia > Menús**
2. Crea un nuevo menú llamado "Menú Principal"
3. Añade las páginas: Inicio, Servicios, Nosotros, Contacto
4. Asigna el menú a la ubicación "Menú Principal"

#### 3.2 Configurar Página de Inicio
1. Ve a **Ajustes > Lectura**
2. Selecciona **"Una página estática"**
3. Página de inicio: **"Inicio"**
4. Guarda los cambios

#### 3.3 Personalizar Colores
1. Ve a **Apariencia > Personalizar**
2. Selecciona **"Colores"**
3. Personaliza los colores según tu marca:
   - **Primario**: #0e5e6f (Azul oscuro)
   - **Acento**: #7fb069 (Verde)
   - **Arena**: #d9c8b4 (Beige)
   - **Tinta**: #1c1c1e (Negro)
   - **Nube**: #f5f6f7 (Gris claro)

## 🎛️ Uso de Bloques Gutenberg

### Bloques Disponibles

#### 1. Hero Section
- **Ubicación**: Categoría "Sueño Andino"
- **Funciones**: Título, descripción, botones, estadísticas
- **Editable**: Todo el contenido desde Gutenberg

#### 2. Timeline
- **Ubicación**: Categoría "Sueño Andino"
- **Funciones**: Historia de la empresa con años y eventos
- **Editable**: Título, descripción, elementos del timeline

#### 3. Services
- **Ubicación**: Categoría "Sueño Andino"
- **Funciones**: Servicios con iconos y descripciones
- **Editable**: Título, subtítulo, descripción, servicios

#### 4. Testimonials
- **Ubicación**: Categoría "Sueño Andino"
- **Funciones**: Testimonios de clientes
- **Editable**: Título, subtítulo, descripción, testimonios

#### 5. Team
- **Ubicación**: Categoría "Sueño Andino"
- **Funciones**: Equipo de trabajo
- **Editable**: Título, subtítulo, descripción, miembros

#### 6. Contact
- **Ubicación**: Categoría "Sueño Andino"
- **Funciones**: Sección de contacto con botones
- **Editable**: Título, descripción, botones

### Cómo Editar Contenido

1. **Editar Página Principal**:
   - Ve a **Páginas > Todas las páginas**
   - Edita la página "Inicio"
   - Usa los bloques de Gutenberg para modificar contenido

2. **Añadir Nuevas Secciones**:
   - En el editor de Gutenberg, busca la categoría "Sueño Andino"
   - Arrastra el bloque deseado a tu página
   - Configura los atributos en el panel lateral

3. **Personalizar Estilos**:
   - Usa el panel de estilos de Gutenberg
   - Ajusta colores, espaciado y tipografía
   - Los cambios se aplican en tiempo real

## 🔧 Funcionalidades Avanzadas

### Formularios AJAX
- **Lead Magnet**: Modal de descarga de guía
- **Contacto**: Formulario de contacto funcional
- **Notificaciones**: Feedback visual para el usuario

### Optimizaciones de Rendimiento
- **CSS crítico** para carga rápida
- **JavaScript optimizado** con lazy loading
- **Imágenes responsive** automáticas
- **Cache headers** configurados

### SEO y Accesibilidad
- **Estructura semántica** HTML5
- **Meta tags** optimizados
- **Alt text** para imágenes
- **Navegación por teclado** funcional

## 📱 Responsive Design

El tema está optimizado para:
- **Desktop**: 1200px+ (diseño completo)
- **Tablet**: 768px-1199px (adaptado)
- **Mobile**: <768px (optimizado para móvil)

### Breakpoints
- **Mobile**: < 768px
- **Tablet**: 768px - 1024px
- **Desktop**: > 1024px

## 🎨 Personalización Avanzada

### Colores del Tema
```css
:root {
    --sa-primary: #0e5e6f;    /* Azul principal */
    --sa-accent: #7fb069;     /* Verde acento */
    --sa-sand: #d9c8b4;       /* Arena */
    --sa-ink: #1c1c1e;        /* Tinta */
    --sa-cloud: #f5f6f7;      /* Nube */
    --sa-white: #ffffff;      /* Blanco */
}
```

### Tipografía
- **Fuente principal**: Inter (Google Fonts)
- **Fallbacks**: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto
- **Pesos**: 300, 400, 500, 600, 700

## 🐛 Solución de Problemas

### Problemas Comunes

#### 1. Los bloques no aparecen
- **Solución**: Asegúrate de que el tema esté activo
- **Verificar**: Apariencia > Temas > Sueño Andino activo

#### 2. Estilos no se cargan
- **Solución**: Limpia la caché del sitio
- **Plugin recomendado**: WP Rocket o W3 Total Cache

#### 3. Formularios no funcionan
- **Solución**: Verifica que JavaScript esté habilitado
- **Verificar**: Consola del navegador para errores

#### 4. Menú no aparece
- **Solución**: Configura el menú en Apariencia > Menús
- **Asignar**: Menú a ubicación "Menú Principal"

### Logs de Error
- **Ubicación**: wp-content/debug.log
- **Habilitar**: Añade `define('WP_DEBUG', true);` en wp-config.php

## 📞 Soporte Técnico

### Contacto
- **Email**: hola@sueñoandino.com
- **Sitio web**: [www.sueñoandino.com](https://www.sueñoandino.com)

### Documentación
- **WordPress Codex**: [codex.wordpress.org](https://codex.wordpress.org)
- **Gutenberg Handbook**: [developer.wordpress.org/block-editor](https://developer.wordpress.org/block-editor)

## 🔄 Actualizaciones

### Versión Actual
- **Tema**: 1.0.0
- **WordPress**: 5.0+ (recomendado 6.0+)
- **PHP**: 7.4+ (recomendado 8.0+)

### Próximas Versiones
- Mejoras en el editor de bloques
- Nuevos bloques personalizados
- Optimizaciones de rendimiento
- Mejoras de accesibilidad

## 📄 Licencia

Este tema está desarrollado específicamente para Sueño Andino y está optimizado para su uso en proyectos de desarrollo territorial regenerativo.

---

**¡Disfruta de tu nuevo sitio web optimizado! 🎉**

*Desarrollado con ❤️ para el desarrollo territorial regenerativo*
