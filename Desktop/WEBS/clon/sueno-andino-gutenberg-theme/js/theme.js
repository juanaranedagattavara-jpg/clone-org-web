// Sueño Andino Theme JavaScript
(function() {
    'use strict';

    // Mobile menu functionality
    function initMobileMenu() {
        const menuToggle = document.querySelector('.menu-toggle');
        const navigation = document.querySelector('.main-navigation');
        
        if (menuToggle && navigation) {
            menuToggle.addEventListener('click', function() {
                navigation.classList.toggle('toggled');
                const isExpanded = navigation.classList.contains('toggled');
                menuToggle.setAttribute('aria-expanded', isExpanded);
                
                // Update button text
                const buttonText = menuToggle.querySelector('.menu-toggle-text');
                if (buttonText) {
                    buttonText.textContent = isExpanded ? 'Cerrar' : 'Menú';
                }
            });
        }
    }

    // Smooth scrolling for anchor links
    function initSmoothScrolling() {
        const anchorLinks = document.querySelectorAll('a[href^="#"]');
        
        anchorLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                const targetId = this.getAttribute('href');
                if (targetId === '#') return;
                
                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    e.preventDefault();
                    targetElement.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    }

    // Lead magnet modal functionality
    function initLeadMagnetModal() {
        const modal = document.getElementById('leadMagnetModal');
        const closeBtn = document.querySelector('.close');
        const form = document.getElementById('leadMagnetForm');
        
        if (!modal) return;

        // Show modal after 3 seconds
        setTimeout(function() {
            modal.style.display = 'block';
            document.body.style.overflow = 'hidden';
        }, 3000);

        // Close modal functions
        function closeModal() {
            modal.style.display = 'none';
            document.body.style.overflow = 'auto';
        }

        // Close button
        if (closeBtn) {
            closeBtn.addEventListener('click', closeModal);
        }

        // Close when clicking outside
        window.addEventListener('click', function(event) {
            if (event.target === modal) {
                closeModal();
            }
        });

        // Close with Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape' && modal.style.display === 'block') {
                closeModal();
            }
        });

        // Form submission
        if (form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const formData = new FormData(form);
                const name = formData.get('name');
                const email = formData.get('email');
                
                // Basic validation
                if (!name || !email) {
                    alert('Por favor, completa todos los campos.');
                    return;
                }
                
                if (!isValidEmail(email)) {
                    alert('Por favor, ingresa un email válido.');
                    return;
                }
                
                // Show loading state
                const submitBtn = form.querySelector('button[type="submit"]');
                const originalText = submitBtn.textContent;
                submitBtn.textContent = 'Enviando...';
                submitBtn.disabled = true;
                
                // Simulate form submission (replace with actual AJAX call)
                setTimeout(function() {
                    alert('¡Gracias! Te enviaremos la guía pronto.');
                    closeModal();
                    form.reset();
                    submitBtn.textContent = originalText;
                    submitBtn.disabled = false;
                }, 1000);
            });
        }
    }

    // Email validation
    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    // Intersection Observer for animations
    function initScrollAnimations() {
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-in');
                }
            });
        }, observerOptions);

        // Observe elements for animation
        const animateElements = document.querySelectorAll('.service-card, .testimonial-card, .team-member, .anne-timeline-item');
        animateElements.forEach(el => {
            observer.observe(el);
        });
    }

    // Add CSS for animations
    function addAnimationStyles() {
        const style = document.createElement('style');
        style.textContent = `
            .service-card,
            .testimonial-card,
            .team-member,
            .anne-timeline-item {
                opacity: 0;
                transform: translateY(30px);
                transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
            }
            
            .service-card.animate-in,
            .testimonial-card.animate-in,
            .team-member.animate-in,
            .anne-timeline-item.animate-in {
                opacity: 1;
                transform: translateY(0);
            }
            
            .anne-timeline-item:nth-child(odd).animate-in {
                animation: slideInLeft 0.8s ease-out;
            }
            
            .anne-timeline-item:nth-child(even).animate-in {
                animation: slideInRight 0.8s ease-out;
            }
            
            @keyframes slideInLeft {
                from {
                    opacity: 0;
                    transform: translateX(-50px);
                }
                to {
                    opacity: 1;
                    transform: translateX(0);
                }
            }
            
            @keyframes slideInRight {
                from {
                    opacity: 0;
                    transform: translateX(50px);
                }
                to {
                    opacity: 1;
                    transform: translateX(0);
                }
            }
        `;
        document.head.appendChild(style);
    }

    // Initialize everything when DOM is ready
    function init() {
        initMobileMenu();
        initSmoothScrolling();
        initLeadMagnetModal();
        initScrollAnimations();
        addAnimationStyles();
    }

    // Start when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

})();
