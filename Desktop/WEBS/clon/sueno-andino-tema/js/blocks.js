/**
 * Sueño Andino Gutenberg Blocks
 * Scripts para el editor de bloques
 */

(function() {
    'use strict';

    // Registrar bloques
    wp.blocks.registerBlockType('sueno-andino/hero-section', {
        title: 'Hero Section',
        icon: 'admin-home',
        category: 'sueno-andino',
        attributes: {
            title: {
                type: 'string',
                default: 'Transformando Comunidades Sostenibles'
            },
            description: {
                type: 'string',
                default: 'Desarrollamos soluciones integrales para el crecimiento territorial sostenible, conectando comunidades con oportunidades de desarrollo.'
            },
            primaryButtonText: {
                type: 'string',
                default: 'Conoce Nuestros Servicios'
            },
            primaryButtonLink: {
                type: 'string',
                default: '#servicios'
            },
            secondaryButtonText: {
                type: 'string',
                default: 'Descarga Guía Gratuita'
            }
        },
        edit: function(props) {
            var attributes = props.attributes;
            var setAttributes = props.setAttributes;

            function updateAttribute(attribute, value) {
                setAttributes({ [attribute]: value });
            }

            return wp.element.createElement('div', { className: 'sueno-andino-hero-editor' },
                wp.element.createElement('h3', {}, 'Hero Section'),
                wp.element.createElement(wp.components.TextControl, {
                    label: 'Título',
                    value: attributes.title,
                    onChange: function(value) { updateAttribute('title', value); }
                }),
                wp.element.createElement(wp.components.TextareaControl, {
                    label: 'Descripción',
                    value: attributes.description,
                    onChange: function(value) { updateAttribute('description', value); }
                }),
                wp.element.createElement(wp.components.TextControl, {
                    label: 'Texto Botón Primario',
                    value: attributes.primaryButtonText,
                    onChange: function(value) { updateAttribute('primaryButtonText', value); }
                }),
                wp.element.createElement(wp.components.TextControl, {
                    label: 'Enlace Botón Primario',
                    value: attributes.primaryButtonLink,
                    onChange: function(value) { updateAttribute('primaryButtonLink', value); }
                }),
                wp.element.createElement(wp.components.TextControl, {
                    label: 'Texto Botón Secundario',
                    value: attributes.secondaryButtonText,
                    onChange: function(value) { updateAttribute('secondaryButtonText', value); }
                })
            );
        },
        save: function() {
            return null; // Renderizado en el servidor
        }
    });

    wp.blocks.registerBlockType('sueno-andino/timeline', {
        title: 'Timeline',
        icon: 'clock',
        category: 'sueno-andino',
        attributes: {
            title: {
                type: 'string',
                default: 'Nuestra Historia'
            },
            description: {
                type: 'string',
                default: 'Descubre los momentos importantes que han marcado nuestro camino de transformación territorial regenerativa'
            }
        },
        edit: function(props) {
            var attributes = props.attributes;
            var setAttributes = props.setAttributes;

            return wp.element.createElement('div', { className: 'sueno-andino-timeline-editor' },
                wp.element.createElement('h3', {}, 'Timeline'),
                wp.element.createElement(wp.components.TextControl, {
                    label: 'Título',
                    value: attributes.title,
                    onChange: function(value) { setAttributes({ title: value }); }
                }),
                wp.element.createElement(wp.components.TextareaControl, {
                    label: 'Descripción',
                    value: attributes.description,
                    onChange: function(value) { setAttributes({ description: value }); }
                })
            );
        },
        save: function() {
            return null; // Renderizado en el servidor
        }
    });

    wp.blocks.registerBlockType('sueno-andino/services', {
        title: 'Services',
        icon: 'admin-tools',
        category: 'sueno-andino',
        attributes: {
            title: {
                type: 'string',
                default: 'Nuestros Servicios'
            },
            subtitle: {
                type: 'string',
                default: 'Lo que Ofrecemos'
            },
            description: {
                type: 'string',
                default: 'Nuestros servicios están diseñados para generar impacto real en las comunidades, combinando sabiduría ancestral con metodologías modernas.'
            }
        },
        edit: function(props) {
            var attributes = props.attributes;
            var setAttributes = props.setAttributes;

            return wp.element.createElement('div', { className: 'sueno-andino-services-editor' },
                wp.element.createElement('h3', {}, 'Services'),
                wp.element.createElement(wp.components.TextControl, {
                    label: 'Subtítulo',
                    value: attributes.subtitle,
                    onChange: function(value) { setAttributes({ subtitle: value }); }
                }),
                wp.element.createElement(wp.components.TextControl, {
                    label: 'Título',
                    value: attributes.title,
                    onChange: function(value) { setAttributes({ title: value }); }
                }),
                wp.element.createElement(wp.components.TextareaControl, {
                    label: 'Descripción',
                    value: attributes.description,
                    onChange: function(value) { setAttributes({ description: value }); }
                })
            );
        },
        save: function() {
            return null; // Renderizado en el servidor
        }
    });

    wp.blocks.registerBlockType('sueno-andino/testimonials', {
        title: 'Testimonials',
        icon: 'format-quote',
        category: 'sueno-andino',
        attributes: {
            title: {
                type: 'string',
                default: 'Lo que Dicen Nuestras Comunidades'
            },
            subtitle: {
                type: 'string',
                default: 'Testimonios'
            },
            description: {
                type: 'string',
                default: 'Testimonios reales de comunidades que han transformado su territorio a través de nuestro acompañamiento regenerativo.'
            }
        },
        edit: function(props) {
            var attributes = props.attributes;
            var setAttributes = props.setAttributes;

            return wp.element.createElement('div', { className: 'sueno-andino-testimonials-editor' },
                wp.element.createElement('h3', {}, 'Testimonials'),
                wp.element.createElement(wp.components.TextControl, {
                    label: 'Subtítulo',
                    value: attributes.subtitle,
                    onChange: function(value) { setAttributes({ subtitle: value }); }
                }),
                wp.element.createElement(wp.components.TextControl, {
                    label: 'Título',
                    value: attributes.title,
                    onChange: function(value) { setAttributes({ title: value }); }
                }),
                wp.element.createElement(wp.components.TextareaControl, {
                    label: 'Descripción',
                    value: attributes.description,
                    onChange: function(value) { setAttributes({ description: value }); }
                })
            );
        },
        save: function() {
            return null; // Renderizado en el servidor
        }
    });

    wp.blocks.registerBlockType('sueno-andino/team', {
        title: 'Team',
        icon: 'groups',
        category: 'sueno-andino',
        attributes: {
            title: {
                type: 'string',
                default: 'Conoce Nuestro Equipo'
            },
            subtitle: {
                type: 'string',
                default: 'Nuestro Equipo'
            },
            description: {
                type: 'string',
                default: 'Un equipo comprometido con el desarrollo territorial y la transformación de comunidades.'
            }
        },
        edit: function(props) {
            var attributes = props.attributes;
            var setAttributes = props.setAttributes;

            return wp.element.createElement('div', { className: 'sueno-andino-team-editor' },
                wp.element.createElement('h3', {}, 'Team'),
                wp.element.createElement(wp.components.TextControl, {
                    label: 'Subtítulo',
                    value: attributes.subtitle,
                    onChange: function(value) { setAttributes({ subtitle: value }); }
                }),
                wp.element.createElement(wp.components.TextControl, {
                    label: 'Título',
                    value: attributes.title,
                    onChange: function(value) { setAttributes({ title: value }); }
                }),
                wp.element.createElement(wp.components.TextareaControl, {
                    label: 'Descripción',
                    value: attributes.description,
                    onChange: function(value) { setAttributes({ description: value }); }
                })
            );
        },
        save: function() {
            return null; // Renderizado en el servidor
        }
    });

    wp.blocks.registerBlockType('sueno-andino/contact', {
        title: 'Contact',
        icon: 'email',
        category: 'sueno-andino',
        attributes: {
            title: {
                type: 'string',
                default: '¿Listo para Transformar tu Comunidad?'
            },
            description: {
                type: 'string',
                default: 'Contáctanos y descubre cómo podemos ayudarte a desarrollar tu territorio de manera sostenible.'
            },
            primaryButtonText: {
                type: 'string',
                default: 'Contactar Ahora'
            },
            primaryButtonLink: {
                type: 'string',
                default: 'mailto:info@sueñoandino.org'
            },
            secondaryButtonText: {
                type: 'string',
                default: 'Descargar Guía'
            }
        },
        edit: function(props) {
            var attributes = props.attributes;
            var setAttributes = props.setAttributes;

            function updateAttribute(attribute, value) {
                setAttributes({ [attribute]: value });
            }

            return wp.element.createElement('div', { className: 'sueno-andino-contact-editor' },
                wp.element.createElement('h3', {}, 'Contact'),
                wp.element.createElement(wp.components.TextControl, {
                    label: 'Título',
                    value: attributes.title,
                    onChange: function(value) { updateAttribute('title', value); }
                }),
                wp.element.createElement(wp.components.TextareaControl, {
                    label: 'Descripción',
                    value: attributes.description,
                    onChange: function(value) { updateAttribute('description', value); }
                }),
                wp.element.createElement(wp.components.TextControl, {
                    label: 'Texto Botón Primario',
                    value: attributes.primaryButtonText,
                    onChange: function(value) { updateAttribute('primaryButtonText', value); }
                }),
                wp.element.createElement(wp.components.TextControl, {
                    label: 'Enlace Botón Primario',
                    value: attributes.primaryButtonLink,
                    onChange: function(value) { updateAttribute('primaryButtonLink', value); }
                }),
                wp.element.createElement(wp.components.TextControl, {
                    label: 'Texto Botón Secundario',
                    value: attributes.secondaryButtonText,
                    onChange: function(value) { updateAttribute('secondaryButtonText', value); }
                })
            );
        },
        save: function() {
            return null; // Renderizado en el servidor
        }
    });

    // Registrar categoría personalizada
    wp.blocks.registerBlockCategory('sueno-andino', {
        title: 'Sueño Andino',
        icon: 'admin-home'
    });

})();