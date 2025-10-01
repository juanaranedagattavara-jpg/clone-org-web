(function(blocks, element, blockEditor, components, i18n) {
    const { registerBlockType } = blocks;
    const { createElement: el } = element;
    const { InspectorControls, RichText, MediaUpload, MediaUploadCheck } = blockEditor;
    const { PanelBody, TextControl, TextareaControl, Button, Placeholder } = components;
    const { __ } = i18n;

    // Hero Section Block
    registerBlockType('sueno-andino/hero-section', {
        title: __('Hero Section', 'sueno-andino'),
        icon: 'admin-site',
        category: 'sueno-andino',
        description: __('A hero section with title, description, buttons and stats', 'sueno-andino'),
        supports: {
            align: ['full'],
        },
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
            primaryButtonUrl: {
                type: 'string',
                default: '#servicios'
            },
            secondaryButtonText: {
                type: 'string',
                default: 'Descarga Guía Gratuita'
            },
            secondaryButtonUrl: {
                type: 'string',
                default: '#'
            },
            stats: {
                type: 'array',
                default: [
                    { number: '50+', label: 'Proyectos Completados' },
                    { number: '15', label: 'Años de Experiencia' },
                    { number: '200+', label: 'Comunidades Beneficiadas' }
                ]
            }
        },
        edit: function(props) {
            const { attributes, setAttributes } = props;
            const { title, description, primaryButtonText, primaryButtonUrl, secondaryButtonText, secondaryButtonUrl, stats } = attributes;

            return el('div', { className: 'sueno-andino-hero-edit' },
                el(InspectorControls, {},
                    el(PanelBody, { title: __('Hero Settings', 'sueno-andino') },
                        el(TextControl, {
                            label: __('Title', 'sueno-andino'),
                            value: title,
                            onChange: (value) => setAttributes({ title: value })
                        }),
                        el(TextareaControl, {
                            label: __('Description', 'sueno-andino'),
                            value: description,
                            onChange: (value) => setAttributes({ description: value })
                        }),
                        el(TextControl, {
                            label: __('Primary Button Text', 'sueno-andino'),
                            value: primaryButtonText,
                            onChange: (value) => setAttributes({ primaryButtonText: value })
                        }),
                        el(TextControl, {
                            label: __('Primary Button URL', 'sueno-andino'),
                            value: primaryButtonUrl,
                            onChange: (value) => setAttributes({ primaryButtonUrl: value })
                        }),
                        el(TextControl, {
                            label: __('Secondary Button Text', 'sueno-andino'),
                            value: secondaryButtonText,
                            onChange: (value) => setAttributes({ secondaryButtonText: value })
                        }),
                        el(TextControl, {
                            label: __('Secondary Button URL', 'sueno-andino'),
                            value: secondaryButtonUrl,
                            onChange: (value) => setAttributes({ secondaryButtonUrl: value })
                        })
                    )
                ),
                el('section', { className: 'wp-block-group hero-section' },
                    el('div', { className: 'hero-content' },
                        el('h1', { className: 'hero-title' }, title),
                        el('p', { className: 'hero-description' }, description),
                        el('div', { className: 'hero-buttons' },
                            el('a', { 
                                href: primaryButtonUrl, 
                                className: 'wp-block-button is-style-primary' 
                            }, el('span', { className: 'wp-block-button__link' }, primaryButtonText)),
                            el('a', { 
                                href: secondaryButtonUrl, 
                                className: 'wp-block-button is-style-secondary' 
                            }, el('span', { className: 'wp-block-button__link' }, secondaryButtonText))
                        ),
                        el('div', { className: 'hero-stats' },
                            stats.map((stat, index) => 
                                el('div', { key: index, className: 'stat-item' },
                                    el('div', { className: 'stat-number' }, stat.number),
                                    el('div', { className: 'stat-label' }, stat.label)
                                )
                            )
                        )
                    )
                )
            );
        },
        save: function() {
            return null; // Server-side rendering
        }
    });

    // Timeline Block
    registerBlockType('sueno-andino/timeline', {
        title: __('Timeline', 'sueno-andino'),
        icon: 'clock',
        category: 'sueno-andino',
        description: __('A timeline section with years and events', 'sueno-andino'),
        supports: {
            align: ['full'],
        },
        attributes: {
            timelineItems: {
                type: 'array',
                default: [
                    {
                        year: '2010',
                        title: 'Fundación de Sueño Andino',
                        description: 'Iniciamos nuestro compromiso con el desarrollo territorial sostenible en Chile.'
                    },
                    {
                        year: '2015',
                        title: 'Expansión Regional',
                        description: 'Ampliamos nuestros servicios a 5 regiones del país, impactando a más de 50 comunidades.'
                    },
                    {
                        year: '2020',
                        title: 'Innovación Digital',
                        description: 'Implementamos tecnologías digitales para optimizar nuestros procesos de desarrollo territorial.'
                    },
                    {
                        year: '2024',
                        title: 'Liderazgo Nacional',
                        description: 'Nos consolidamos como referentes en desarrollo territorial sostenible a nivel nacional.'
                    }
                ]
            }
        },
        edit: function(props) {
            const { attributes, setAttributes } = props;
            const { timelineItems } = attributes;

            const updateTimelineItem = (index, field, value) => {
                const newItems = [...timelineItems];
                newItems[index] = { ...newItems[index], [field]: value };
                setAttributes({ timelineItems: newItems });
            };

            return el('div', { className: 'sueno-andino-timeline-edit' },
                el(InspectorControls, {},
                    el(PanelBody, { title: __('Timeline Items', 'sueno-andino') },
                        timelineItems.map((item, index) => 
                            el('div', { key: index, style: { marginBottom: '20px', padding: '10px', border: '1px solid #ddd', borderRadius: '4px' } },
                                el(TextControl, {
                                    label: `Year ${index + 1}`,
                                    value: item.year,
                                    onChange: (value) => updateTimelineItem(index, 'year', value)
                                }),
                                el(TextControl, {
                                    label: `Title ${index + 1}`,
                                    value: item.title,
                                    onChange: (value) => updateTimelineItem(index, 'title', value)
                                }),
                                el(TextareaControl, {
                                    label: `Description ${index + 1}`,
                                    value: item.description,
                                    onChange: (value) => updateTimelineItem(index, 'description', value)
                                })
                            )
                        )
                    )
                ),
                el('section', { className: 'wp-block-group timeline-section' },
                    el('div', { className: 'anne-timeline' },
                        timelineItems.map((item, index) => 
                            el('div', { key: index, className: 'anne-timeline-item' },
                                el('div', { className: 'anne-timeline-image' },
                                    el('div', { className: 'image-placeholder' },
                                        el('div', { className: 'placeholder-content' },
                                            el('div', { className: 'placeholder-icon' }, '📅')
                                        )
                                    )
                                ),
                                el('div', { className: 'anne-timeline-dot' }),
                                el('div', { className: 'anne-timeline-content' },
                                    el('span', { className: 'anne-year' }, item.year),
                                    el('h3', {}, item.title),
                                    el('p', {}, item.description)
                                )
                            )
                        )
                    )
                )
            );
        },
        save: function() {
            return null; // Server-side rendering
        }
    });

    // Services Block
    registerBlockType('sueno-andino/services', {
        title: __('Services', 'sueno-andino'),
        icon: 'admin-tools',
        category: 'sueno-andino',
        description: __('A services section with icons and descriptions', 'sueno-andino'),
        supports: {
            align: ['full'],
        },
        attributes: {
            services: {
                type: 'array',
                default: [
                    {
                        icon: '🏗️',
                        title: 'Desarrollo Territorial',
                        description: 'Planificación y ejecución de proyectos de desarrollo territorial sostenible.'
                    },
                    {
                        icon: '🌱',
                        title: 'Sostenibilidad Ambiental',
                        description: 'Implementación de prácticas ambientales responsables y sostenibles.'
                    },
                    {
                        icon: '🤝',
                        title: 'Participación Comunitaria',
                        description: 'Fortalecimiento del tejido social y participación ciudadana activa.'
                    }
                ]
            }
        },
        edit: function(props) {
            const { attributes, setAttributes } = props;
            const { services } = attributes;

            const updateService = (index, field, value) => {
                const newServices = [...services];
                newServices[index] = { ...newServices[index], [field]: value };
                setAttributes({ services: newServices });
            };

            return el('div', { className: 'sueno-andino-services-edit' },
                el(InspectorControls, {},
                    el(PanelBody, { title: __('Services', 'sueno-andino') },
                        services.map((service, index) => 
                            el('div', { key: index, style: { marginBottom: '20px', padding: '10px', border: '1px solid #ddd', borderRadius: '4px' } },
                                el(TextControl, {
                                    label: `Icon ${index + 1}`,
                                    value: service.icon,
                                    onChange: (value) => updateService(index, 'icon', value)
                                }),
                                el(TextControl, {
                                    label: `Title ${index + 1}`,
                                    value: service.title,
                                    onChange: (value) => updateService(index, 'title', value)
                                }),
                                el(TextareaControl, {
                                    label: `Description ${index + 1}`,
                                    value: service.description,
                                    onChange: (value) => updateService(index, 'description', value)
                                })
                            )
                        )
                    )
                ),
                el('section', { className: 'wp-block-group services-section' },
                    el('div', { className: 'services-grid' },
                        services.map((service, index) => 
                            el('div', { key: index, className: 'service-card' },
                                el('div', { className: 'service-icon-wrapper' },
                                    el('div', { className: 'service-icon' }, service.icon)
                                ),
                                el('h3', {}, service.title),
                                el('p', {}, service.description)
                            )
                        )
                    )
                )
            );
        },
        save: function() {
            return null; // Server-side rendering
        }
    });

    // Testimonials Block
    registerBlockType('sueno-andino/testimonials', {
        title: __('Testimonials', 'sueno-andino'),
        icon: 'format-quote',
        category: 'sueno-andino',
        description: __('A testimonials section with customer feedback', 'sueno-andino'),
        supports: {
            align: ['full'],
        },
        attributes: {
            testimonials: {
                type: 'array',
                default: [
                    {
                        name: 'María González',
                        position: 'Alcaldesa de Valparaíso',
                        content: 'Sueño Andino transformó completamente nuestra visión del desarrollo territorial. Su enfoque sostenible y participativo ha sido clave para el crecimiento de nuestra comuna.'
                    },
                    {
                        name: 'Carlos Mendoza',
                        position: 'Director de Desarrollo Rural',
                        content: 'La metodología de Sueño Andino es innovadora y efectiva. Han logrado resultados excepcionales en comunidades que antes parecían sin esperanza de desarrollo.'
                    },
                    {
                        name: 'Ana Rodríguez',
                        position: 'Líder Comunitaria',
                        content: 'Gracias a Sueño Andino, nuestra comunidad ahora tiene un plan de desarrollo claro y sostenible. Han sido un verdadero socio en nuestro crecimiento.'
                    }
                ]
            }
        },
        edit: function(props) {
            const { attributes, setAttributes } = props;
            const { testimonials } = attributes;

            const updateTestimonial = (index, field, value) => {
                const newTestimonials = [...testimonials];
                newTestimonials[index] = { ...newTestimonials[index], [field]: value };
                setAttributes({ testimonials: newTestimonials });
            };

            return el('div', { className: 'sueno-andino-testimonials-edit' },
                el(InspectorControls, {},
                    el(PanelBody, { title: __('Testimonials', 'sueno-andino') },
                        testimonials.map((testimonial, index) => 
                            el('div', { key: index, style: { marginBottom: '20px', padding: '10px', border: '1px solid #ddd', borderRadius: '4px' } },
                                el(TextControl, {
                                    label: `Name ${index + 1}`,
                                    value: testimonial.name,
                                    onChange: (value) => updateTestimonial(index, 'name', value)
                                }),
                                el(TextControl, {
                                    label: `Position ${index + 1}`,
                                    value: testimonial.position,
                                    onChange: (value) => updateTestimonial(index, 'position', value)
                                }),
                                el(TextareaControl, {
                                    label: `Content ${index + 1}`,
                                    value: testimonial.content,
                                    onChange: (value) => updateTestimonial(index, 'content', value)
                                })
                            )
                        )
                    )
                ),
                el('section', { className: 'wp-block-group testimonials-section' },
                    el('div', { className: 'testimonials-grid' },
                        testimonials.map((testimonial, index) => 
                            el('div', { key: index, className: 'testimonial-card' },
                                el('div', { className: 'testimonial-header' },
                                    el('div', { className: 'testimonial-avatar' },
                                        el('div', { className: 'avatar-placeholder' }, testimonial.name.charAt(0))
                                    ),
                                    el('div', { className: 'testimonial-info' },
                                        el('h4', {}, testimonial.name),
                                        el('p', {}, testimonial.position)
                                    )
                                ),
                                el('blockquote', {}, testimonial.content)
                            )
                        )
                    )
                )
            );
        },
        save: function() {
            return null; // Server-side rendering
        }
    });

    // Team Block
    registerBlockType('sueno-andino/team', {
        title: __('Team', 'sueno-andino'),
        icon: 'groups',
        category: 'sueno-andino',
        description: __('A team section with member profiles', 'sueno-andino'),
        supports: {
            align: ['full'],
        },
        attributes: {
            teamMembers: {
                type: 'array',
                default: [
                    {
                        name: 'Juan Pérez',
                        position: 'Director Ejecutivo'
                    },
                    {
                        name: 'María Silva',
                        position: 'Coordinadora de Proyectos'
                    },
                    {
                        name: 'Carlos López',
                        position: 'Especialista en Sostenibilidad'
                    }
                ]
            }
        },
        edit: function(props) {
            const { attributes, setAttributes } = props;
            const { teamMembers } = attributes;

            const updateTeamMember = (index, field, value) => {
                const newMembers = [...teamMembers];
                newMembers[index] = { ...newMembers[index], [field]: value };
                setAttributes({ teamMembers: newMembers });
            };

            return el('div', { className: 'sueno-andino-team-edit' },
                el(InspectorControls, {},
                    el(PanelBody, { title: __('Team Members', 'sueno-andino') },
                        teamMembers.map((member, index) => 
                            el('div', { key: index, style: { marginBottom: '20px', padding: '10px', border: '1px solid #ddd', borderRadius: '4px' } },
                                el(TextControl, {
                                    label: `Name ${index + 1}`,
                                    value: member.name,
                                    onChange: (value) => updateTeamMember(index, 'name', value)
                                }),
                                el(TextControl, {
                                    label: `Position ${index + 1}`,
                                    value: member.position,
                                    onChange: (value) => updateTeamMember(index, 'position', value)
                                })
                            )
                        )
                    )
                ),
                el('section', { className: 'wp-block-group team-section' },
                    el('div', { className: 'team-grid' },
                        teamMembers.map((member, index) => 
                            el('div', { key: index, className: 'team-member' },
                                el('div', { className: 'member-image' },
                                    el('div', { className: 'image-placeholder' },
                                        el('div', { className: 'placeholder-content' },
                                            el('div', { className: 'placeholder-icon' }, '👤')
                                        )
                                    ),
                                    el('div', { className: 'decorative-dots' }),
                                    el('div', { className: 'decorative-shape' })
                                ),
                                el('h4', {}, member.name),
                                el('p', {}, member.position)
                            )
                        )
                    )
                )
            );
        },
        save: function() {
            return null; // Server-side rendering
        }
    });

})(window.wp.blocks, window.wp.element, window.wp.blockEditor, window.wp.components, window.wp.i18n);
