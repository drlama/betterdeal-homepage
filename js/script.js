// BetterDeal Website JavaScript

document.addEventListener('DOMContentLoaded', function() {
    // Initialize all functionality
    initNavigation();
    initContactForm();
    initAnimations();
    initVideoPlayer();
});

// Navigation functionality
function initNavigation() {
    // Smooth scrolling for navigation links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                const offsetTop = target.offsetTop - 80; // Account for fixed navbar
                window.scrollTo({
                    top: offsetTop,
                    behavior: 'smooth'
                });
            }
        });
    });

    // Navbar background change on scroll
    window.addEventListener('scroll', function() {
        const navbar = document.querySelector('.navbar');
        if (window.scrollY > 50) {
            navbar.classList.add('bg-white', 'shadow');
        } else {
            navbar.classList.remove('shadow');
        }
    });

    // Mobile menu close on link click
    document.querySelectorAll('.navbar-nav .nav-link').forEach(link => {
        link.addEventListener('click', function() {
            const navbarCollapse = document.querySelector('.navbar-collapse');
            if (navbarCollapse.classList.contains('show')) {
                const bsCollapse = new bootstrap.Collapse(navbarCollapse);
                bsCollapse.hide();
            }
        });
    });
}

// Contact form with Ajax
function initContactForm() {
    const form = document.getElementById('contactForm');
    const messageDiv = document.getElementById('formMessage');
    const submitBtn = form.querySelector('button[type="submit"]');
    const spinner = document.getElementById('submitSpinner');

    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Reset previous validation states
        form.classList.remove('was-validated');
        messageDiv.innerHTML = '';
        
        // Check form validity
        if (!form.checkValidity()) {
            form.classList.add('was-validated');
            return;
        }

        // Prepare form data
        const formData = {
            vorname: document.getElementById('vorname').value.trim(),
            nachname: document.getElementById('nachname').value.trim(),
            email: document.getElementById('email').value.trim(),
            nachricht: document.getElementById('nachricht').value.trim()
        };

        // Show loading state
        setLoadingState(true);

        // Send Ajax request
        fetch('contact.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(formData)
        })
        .then(response => response.json())
        .then(data => {
            setLoadingState(false);
            
            if (data.success) {
                showMessage('success', data.message);
                form.reset();
                form.classList.remove('was-validated');
            } else {
                showMessage('error', data.errors.join('<br>'));
            }
        })
        .catch(error => {
            setLoadingState(false);
            console.error('Error:', error);
            showMessage('error', 'Ein Fehler ist aufgetreten. Bitte versuchen Sie es später erneut.');
        });
    });

    function setLoadingState(loading) {
        if (loading) {
            submitBtn.disabled = true;
            spinner.classList.remove('d-none');
            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Wird gesendet...';
        } else {
            submitBtn.disabled = false;
            spinner.classList.add('d-none');
            submitBtn.innerHTML = 'Nachricht senden';
        }
    }

    function showMessage(type, message) {
        const alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
        const icon = type === 'success' ? 'fas fa-check-circle' : 'fas fa-exclamation-triangle';
        
        messageDiv.innerHTML = `
            <div class="alert ${alertClass} alert-dismissible fade show" role="alert">
                <i class="${icon} me-2"></i>
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        `;
        
        // Scroll to message
        messageDiv.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }
}

// Animation on scroll
function initAnimations() {
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('fade-in-up');
            }
        });
    }, observerOptions);

    // Observe elements for animation
    document.querySelectorAll('.feature-card, .contact-form-container, .contact-info').forEach(el => {
        observer.observe(el);
    });
}

// Video player functionality
function initVideoPlayer() {
    window.playVideo = function() {
        const videoContainer = document.querySelector('.video-placeholder');
        
        // Create modal for video
        const modal = document.createElement('div');
        modal.className = 'modal fade';
        modal.innerHTML = `
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Wie BetterDeal funktioniert</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="ratio ratio-16x9">
                            <iframe src="https://www.youtube.com/embed/dQw4w9WgXcQ" 
                                    title="BetterDeal Erklärvideo" 
                                    allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
        `;
        
        document.body.appendChild(modal);
        const bsModal = new bootstrap.Modal(modal);
        bsModal.show();
        
        // Remove modal from DOM when hidden
        modal.addEventListener('hidden.bs.modal', function() {
            document.body.removeChild(modal);
        });
    };
}

// Utility function for smooth scrolling to sections
function scrollToSection(sectionId) {
    const section = document.getElementById(sectionId);
    if (section) {
        const offsetTop = section.offsetTop - 80;
        window.scrollTo({
            top: offsetTop,
            behavior: 'smooth'
        });
    }
}

// Form validation enhancement
function validateEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}

// Responsive image loading
function initResponsiveImages() {
    const images = document.querySelectorAll('img[data-src]');
    
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.src = img.dataset.src;
                img.classList.remove('lazy');
                imageObserver.unobserve(img);
            }
        });
    });

    images.forEach(img => imageObserver.observe(img));
}

// Performance optimization
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// Throttle function for scroll events
function throttle(func, limit) {
    let inThrottle;
    return function() {
        const args = arguments;
        const context = this;
        if (!inThrottle) {
            func.apply(context, args);
            inThrottle = true;
            setTimeout(() => inThrottle = false, limit);
        }
    }
}

// Error handling for Ajax requests
function handleAjaxError(error) {
    console.error('Ajax Error:', error);
    return {
        success: false,
        errors: ['Ein unerwarteter Fehler ist aufgetreten. Bitte versuchen Sie es später erneut.']
    };
}

// Accessibility improvements
function initAccessibility() {
    // Skip to main content link
    const skipLink = document.createElement('a');
    skipLink.href = '#main-content';
    skipLink.className = 'sr-only sr-only-focusable';
    skipLink.textContent = 'Zum Hauptinhalt springen';
    document.body.insertBefore(skipLink, document.body.firstChild);

    // Focus management for modals
    document.addEventListener('shown.bs.modal', function(e) {
        const modal = e.target;
        const focusableElements = modal.querySelectorAll('button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])');
        if (focusableElements.length > 0) {
            focusableElements[0].focus();
        }
    });
}

// Initialize accessibility features
initAccessibility();

// Console log for debugging
console.log('BetterDeal Website loaded successfully!');

