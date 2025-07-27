// resources/js/app.js

import './bootstrap';
import Alpine from 'alpinejs';

// Make Alpine available globally
window.Alpine = Alpine;

// Modern Animation Controller
class AnimationController {
    constructor() {
        this.init();
    }

    init() {
        this.setupScrollReveal();
        this.setupParticles();
        this.setupMagneticEffect();
        this.setupRippleEffect();
        this.setupSmoothScroll();
        this.setupPageTransitions();
        this.setupAdvancedHovers();
    }

    // Advanced Scroll Reveal Animation
    setupScrollReveal() {
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('revealed');
                    
                    // Add stagger effect for children
                    const children = entry.target.querySelectorAll('.stagger-child');
                    children.forEach((child, index) => {
                        setTimeout(() => {
                            child.style.animation = `fadeInUp 0.8s cubic-bezier(0.68, -0.55, 0.265, 1.55) forwards`;
                            child.style.animationDelay = `${index * 0.1}s`;
                        }, index * 100);
                    });
                }
            });
        }, observerOptions);

        document.querySelectorAll('.scroll-reveal').forEach(el => {
            observer.observe(el);
        });
    }

    // Floating Particles Background
    setupParticles() {
        const particlesContainer = document.createElement('div');
        particlesContainer.className = 'particles-bg';
        document.body.appendChild(particlesContainer);

        for (let i = 0; i < 50; i++) {
            this.createParticle(particlesContainer);
        }

        // Continuously create new particles
        setInterval(() => {
            if (particlesContainer.children.length < 50) {
                this.createParticle(particlesContainer);
            }
        }, 3000);
    }

    createParticle(container) {
        const particle = document.createElement('div');
        particle.className = 'particle';
        
        const size = Math.random() * 4 + 2;
        const startX = Math.random() * window.innerWidth;
        const duration = Math.random() * 10 + 10;
        
        particle.style.width = `${size}px`;
        particle.style.height = `${size}px`;
        particle.style.left = `${startX}px`;
        particle.style.animationDuration = `${duration}s`;
        particle.style.animationDelay = `${Math.random() * 5}s`;
        
        container.appendChild(particle);
        
        // Remove particle after animation
        setTimeout(() => {
            if (particle.parentNode) {
                particle.parentNode.removeChild(particle);
            }
        }, duration * 1000);
    }

    // Magnetic Effect for Interactive Elements
    setupMagneticEffect() {
        document.querySelectorAll('.magnetic').forEach(element => {
            element.addEventListener('mousemove', (e) => {
                const rect = element.getBoundingClientRect();
                const x = e.clientX - rect.left - rect.width / 2;
                const y = e.clientY - rect.top - rect.height / 2;
                
                const moveX = x * 0.1;
                const moveY = y * 0.1;
                
                element.style.transform = `translate(${moveX}px, ${moveY}px)`;
            });
            
            element.addEventListener('mouseleave', () => {
                element.style.transform = 'translate(0, 0)';
            });
        });
    }

    // Ripple Effect for Buttons
    setupRippleEffect() {
        document.addEventListener('click', (e) => {
            if (e.target.classList.contains('ripple')) {
                const ripple = document.createElement('span');
                const rect = e.target.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;
                
                ripple.style.width = ripple.style.height = size + 'px';
                ripple.style.left = x + 'px';
                ripple.style.top = y + 'px';
                ripple.classList.add('ripple-effect');
                
                e.target.appendChild(ripple);
                
                setTimeout(() => {
                    ripple.remove();
                }, 600);
            }
        });
    }

    // Smooth Scroll with Easing
    setupSmoothScroll() {
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    }

    // Page Transition Effects
    setupPageTransitions() {
        // Add page transition class to main content
        const mainContent = document.querySelector('main');
        if (mainContent) {
            mainContent.classList.add('page-transition');
        }

        // Handle navigation transitions
        document.addEventListener('click', (e) => {
            const link = e.target.closest('a[href]');
            if (link && !link.getAttribute('href').startsWith('#') && !link.hasAttribute('download')) {
                const href = link.getAttribute('href');
                if (href.startsWith('/') || href.includes(window.location.hostname)) {
                    e.preventDefault();
                    
                    // Add exit animation
                    document.body.style.opacity = '0';
                    document.body.style.transform = 'translateY(-20px)';
                    
                    setTimeout(() => {
                        window.location.href = href;
                    }, 300);
                }
            }
        });
    }

    // Advanced Hover Effects
    setupAdvancedHovers() {
        // 3D Tilt Effect
        document.querySelectorAll('.tilt-3d').forEach(element => {
            element.addEventListener('mousemove', (e) => {
                const rect = element.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                
                const centerX = rect.width / 2;
                const centerY = rect.height / 2;
                
                const rotateX = (y - centerY) / 10;
                const rotateY = (centerX - x) / 10;
                
                element.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale3d(1.05, 1.05, 1.05)`;
            });
            
            element.addEventListener('mouseleave', () => {
                element.style.transform = 'perspective(1000px) rotateX(0) rotateY(0) scale3d(1, 1, 1)';
            });
        });

        // Morphing hover effect
        document.querySelectorAll('.morph-hover').forEach(element => {
            element.addEventListener('mouseenter', () => {
                element.style.animation = 'morphing 0.5s ease-in-out';
            });
            
            element.addEventListener('mouseleave', () => {
                element.style.animation = '';
            });
        });
    }
}

// Enhanced Toast Notifications
window.showToast = function(message, type = 'success', duration = 5000) {
    const toast = document.createElement('div');
    toast.className = `toast-modern fixed top-4 right-4 z-50 p-4 max-w-sm transform transition-all duration-500`;
    
    const icon = type === 'success' 
        ? '<svg class="w-6 h-6 text-green-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>'
        : '<svg class="w-6 h-6 text-red-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path></svg>';
    
    toast.innerHTML = `
        <div class="flex items-center space-x-3">
            <div class="flex-shrink-0">
                ${icon}
            </div>
            <div class="flex-1">
                <p class="text-sm font-medium text-gray-900">${message}</p>
            </div>
            <button onclick="this.parentElement.parentElement.remove()" class="text-gray-400 hover:text-gray-600 transition-colors">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>
        <div class="progress-bar mt-2"></div>
    `;
    
    document.body.appendChild(toast);
    
    // Animate progress bar
    const progressBar = toast.querySelector('.progress-bar');
    progressBar.style.width = '100%';
    setTimeout(() => {
        progressBar.style.width = '0%';
        progressBar.style.transition = `width ${duration}ms linear`;
    }, 100);
    
    // Auto remove
    setTimeout(() => {
        toast.style.transform = 'translateX(100%) scale(0.8)';
        toast.style.opacity = '0';
        setTimeout(() => {
            if (toast.parentElement) {
                toast.remove();
            }
        }, 300);
    }, duration);
};

// Alpine.js components with enhanced animations
Alpine.data('cart', () => ({
    isOpen: false,
    items: [],
    total: 0,
    
    init() {
        this.loadCartItems();
    },
    
    async loadCartItems() {
        try {
            const response = await fetch('/cart/items');
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            const data = await response.json();
            if (data.success) {
                this.items = data.items;
                this.total = data.total;
                this.animateCartItems();
            } else {
                console.error('Cart API error:', data.message);
                this.items = [];
                this.total = 0;
            }
        } catch (error) {
            console.error('Error loading cart items:', error);
            this.items = [];
            this.total = 0;
        }
    },
    
    animateCartItems() {
        this.$nextTick(() => {
            const items = document.querySelectorAll('.cart-item');
            items.forEach((item, index) => {
                item.style.animation = `slideInRight 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55) forwards`;
                item.style.animationDelay = `${index * 0.1}s`;
            });
        });
    },
    
    async addItem(bookId, quantity = 1) {
        try {
            const response = await fetch(`/cart/add/${bookId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ quantity })
            });
            
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            
            const data = await response.json();
            if (data.success) {
                await this.loadCartItems();
                showToast('Book added to cart with style! ✨', 'success');
                this.pulseCartIcon();
                this.updateCartBadge(data.cart_count);
            } else {
                showToast(data.message || 'Error adding to cart', 'error');
            }
        } catch (error) {
            console.error('Cart error:', error);
            showToast('Error adding to cart', 'error');
        }
    },
    
    updateCartBadge(count) {
        const cartBadges = document.querySelectorAll('.cart-count');
        cartBadges.forEach(badge => {
            badge.textContent = count;
            if (count > 0) {
                badge.classList.remove('hidden');
            } else {
                badge.classList.add('hidden');
            }
        });
    },
    
    pulseCartIcon() {
        const cartIcon = document.querySelector('.cart-icon');
        if (cartIcon) {
            cartIcon.style.animation = 'pulse3D 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55)';
            setTimeout(() => {
                cartIcon.style.animation = '';
            }, 600);
        }
    },
    
    async removeItem(itemId) {
        const item = document.querySelector(`[data-item-id="${itemId}"]`);
        if (item) {
            item.style.animation = 'slideInLeft 0.3s ease-in forwards';
            setTimeout(async () => {
                try {
                    const response = await fetch(`/cart/remove/${itemId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    });
                    
                    const data = await response.json();
                    if (data.success) {
                        await this.loadCartItems();
                        showToast('Item removed from cart', 'success');
                    }
                } catch (error) {
                    showToast('Error removing item', 'error');
                }
            }, 300);
        }
    }
}));

Alpine.data('search', () => ({
    query: '',
    results: [],
    isLoading: false,
    showResults: false,
    
    async search() {
        if (this.query.length < 2) {
            this.results = [];
            this.showResults = false;
            return;
        }
        
        this.isLoading = true;
        
        try {
            const response = await fetch(`/search?q=${encodeURIComponent(this.query)}`);
            const data = await response.json();
            this.results = data.books || [];
            this.showResults = true;
            
            // Animate results
            this.$nextTick(() => {
                const resultItems = document.querySelectorAll('.search-result-item');
                resultItems.forEach((item, index) => {
                    item.style.animation = `fadeInUp 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55) forwards`;
                    item.style.animationDelay = `${index * 0.05}s`;
                });
            });
        } catch (error) {
            console.error('Search error:', error);
        } finally {
            this.isLoading = false;
        }
    }
}));

// Enhanced Loading States
class LoadingManager {
    static show(element, text = 'Loading') {
        element.innerHTML = `
            <div class="flex items-center justify-center space-x-2">
                <div class="animate-spin rounded-full h-6 w-6 border-b-2 border-blue-500"></div>
                <span class="loading-dots">${text}</span>
            </div>
        `;
    }
    
    static hide(element, content) {
        element.style.opacity = '0';
        setTimeout(() => {
            element.innerHTML = content;
            element.style.opacity = '1';
        }, 150);
    }
}

// Intersection Observer for Performance
const createObserver = (callback, options = {}) => {
    const defaultOptions = {
        threshold: 0.1,
        rootMargin: '50px'
    };
    
    return new IntersectionObserver(callback, { ...defaultOptions, ...options });
};

// Initialize Animation Controller
document.addEventListener('DOMContentLoaded', () => {
    new AnimationController();
    
    // Add loading class to body
    document.body.classList.add('loading');
    
    // Remove loading class after page load
    window.addEventListener('load', () => {
        setTimeout(() => {
            document.body.classList.remove('loading');
            document.body.classList.add('loaded');
        }, 500);
    });
});

// Initialize Alpine
Alpine.start();

// Enhanced Form Interactions
document.addEventListener('DOMContentLoaded', function() {
    // Floating label effect
    document.querySelectorAll('.input-field').forEach(input => {
        const label = input.previousElementSibling;
        if (label && label.tagName === 'LABEL') {
            input.addEventListener('focus', () => {
                label.style.transform = 'translateY(-25px) scale(0.8)';
                label.style.color = '#3b82f6';
            });
            
            input.addEventListener('blur', () => {
                if (!input.value) {
                    label.style.transform = 'translateY(0) scale(1)';
                    label.style.color = '#6b7280';
                }
            });
        }
    });
    
    // Enhanced form submission
    const forms = document.querySelectorAll('form[data-loading]');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const submitButton = form.querySelector('button[type="submit"]');
            if (submitButton) {
                submitButton.disabled = true;
                submitButton.innerHTML = `
                    <div class="flex items-center space-x-2">
                        <div class="animate-spin rounded-full h-4 w-4 border-b-2 border-white"></div>
                        <span>Processing...</span>
                    </div>
                `;
                
                // Add loading animation to form
                form.style.opacity = '0.7';
                form.style.pointerEvents = 'none';
            }
        });
    });
});

// Advanced Image Loading with Blur Effect
document.addEventListener('DOMContentLoaded', function() {
    const images = document.querySelectorAll('img[loading="lazy"]');
    
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    
                    // Create a low-quality placeholder
                    const placeholder = document.createElement('div');
                    placeholder.className = 'absolute inset-0 bg-gradient-to-br from-gray-200 to-gray-300 animate-pulse';
                    img.parentNode.style.position = 'relative';
                    img.parentNode.insertBefore(placeholder, img);
                    
                    img.style.opacity = '0';
                    img.src = img.dataset.src || img.src;
                    
                    img.onload = () => {
                        img.style.transition = 'opacity 0.5s ease-in-out';
                        img.style.opacity = '1';
                        placeholder.style.opacity = '0';
                        setTimeout(() => {
                            if (placeholder.parentNode) {
                                placeholder.parentNode.removeChild(placeholder);
                            }
                        }, 500);
                    };
                    
                    imageObserver.unobserve(img);
                }
            });
        });

        images.forEach(img => imageObserver.observe(img));
    }
});

// Export for global use
window.AnimationController = AnimationController;
window.LoadingManager = LoadingManager;
window.createObserver = createObserver;