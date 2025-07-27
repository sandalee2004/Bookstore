// resources/js/app.js

import './bootstrap';
import Alpine from 'alpinejs';

// Make Alpine available globally
window.Alpine = Alpine;

// Advanced Animation Controller with Modern Effects
class ModernAnimationController {
    constructor() {
        this.init();
        this.setupPerformanceOptimizations();
    }

    init() {
        this.setupAdvancedScrollReveal();
        this.setupEnhancedParticles();
        this.setupMagneticEffect();
        this.setupAdvancedRippleEffect();
        this.setupSmoothScroll();
        this.setupPageTransitions();
        this.setupAdvancedHovers();
        this.setupParallaxEffects();
        this.setupIntersectionObserver();
        this.setupCursorEffects();
    }

    setupPerformanceOptimizations() {
        // Use requestAnimationFrame for smooth animations
        this.rafId = null;
        this.isAnimating = false;
        
        // Throttle resize events
        let resizeTimeout;
        window.addEventListener('resize', () => {
            clearTimeout(resizeTimeout);
            resizeTimeout = setTimeout(() => {
                this.handleResize();
            }, 100);
        });
    }

    // Enhanced Scroll Reveal with Intersection Observer
    setupAdvancedScrollReveal() {
        const observerOptions = {
            threshold: [0, 0.1, 0.5, 1],
            rootMargin: '0px 0px -100px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const element = entry.target;
                    element.classList.add('revealed');
                    
                    // Add progressive reveal for children
                    const children = element.querySelectorAll('.stagger-child');
                    children.forEach((child, index) => {
                        setTimeout(() => {
                            child.style.animation = `fadeInUp 1s cubic-bezier(0.68, -0.55, 0.265, 1.55) forwards`;
                            child.style.animationDelay = `${index * 0.15}s`;
                            child.style.opacity = '0';
                        }, index * 150);
                    });

                    // Trigger custom animations based on data attributes
                    const animationType = element.dataset.animation;
                    if (animationType) {
                        this.triggerCustomAnimation(element, animationType);
                    }
                }
            });
        }, observerOptions);

        document.querySelectorAll('.scroll-reveal').forEach(el => {
            observer.observe(el);
        });
    }

    triggerCustomAnimation(element, type) {
        switch (type) {
            case 'slideInLeft':
                element.style.animation = 'slideInLeft 0.8s ease-out forwards';
                break;
            case 'slideInRight':
                element.style.animation = 'slideInRight 0.8s ease-out forwards';
                break;
            case 'scaleIn':
                element.style.animation = 'scaleIn 0.6s ease-out forwards';
                break;
            case 'rotateIn':
                element.style.animation = 'rotateIn 0.8s ease-out forwards';
                break;
        }
    }

    // Enhanced Particle System
    setupEnhancedParticles() {
        const particlesContainer = document.createElement('div');
        particlesContainer.className = 'particles-bg';
        document.body.appendChild(particlesContainer);

        const particleCount = window.innerWidth > 768 ? 80 : 40;
        
        for (let i = 0; i < particleCount; i++) {
            this.createAdvancedParticle(particlesContainer);
        }

        // Continuously create new particles
        setInterval(() => {
            if (particlesContainer.children.length < particleCount) {
                this.createAdvancedParticle(particlesContainer);
            }
        }, 4000);
    }

    createAdvancedParticle(container) {
        const particle = document.createElement('div');
        particle.className = 'particle';
        
        const size = Math.random() * 6 + 3;
        const startX = Math.random() * window.innerWidth;
        const duration = Math.random() * 15 + 15;
        const hue = Math.random() * 60 + 200; // Blue to purple range
        
        particle.style.width = `${size}px`;
        particle.style.height = `${size}px`;
        particle.style.left = `${startX}px`;
        particle.style.animationDuration = `${duration}s`;
        particle.style.animationDelay = `${Math.random() * 5}s`;
        particle.style.background = `radial-gradient(circle, hsla(${hue}, 70%, 60%, 0.6) 0%, transparent 70%)`;
        
        container.appendChild(particle);
        
        // Remove particle after animation
        setTimeout(() => {
            if (particle.parentNode) {
                particle.parentNode.removeChild(particle);
            }
        }, duration * 1000);
    }

    // Enhanced Magnetic Effect with Physics
    setupMagneticEffect() {
        document.querySelectorAll('.magnetic').forEach(element => {
            let isHovering = false;
            
            element.addEventListener('mouseenter', () => {
                isHovering = true;
                element.style.transition = 'transform 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55)';
            });
            
            element.addEventListener('mousemove', (e) => {
                if (!isHovering) return;
                
                const rect = element.getBoundingClientRect();
                const x = e.clientX - rect.left - rect.width / 2;
                const y = e.clientY - rect.top - rect.height / 2;
                
                const moveX = x * 0.15;
                const moveY = y * 0.15;
                const rotateX = y * 0.05;
                const rotateY = x * 0.05;
                
                element.style.transform = `translate(${moveX}px, ${moveY}px) rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;
            });
            
            element.addEventListener('mouseleave', () => {
                isHovering = false;
                element.style.transition = 'transform 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55)';
                element.style.transform = 'translate(0, 0) rotateX(0deg) rotateY(0deg)';
            });
        });
    }

    // Advanced Ripple Effect
    setupAdvancedRippleEffect() {
        document.addEventListener('click', (e) => {
            if (e.target.classList.contains('ripple')) {
                const ripple = document.createElement('span');
                const rect = e.target.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height) * 2;
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;
                
                ripple.style.width = ripple.style.height = size + 'px';
                ripple.style.left = x + 'px';
                ripple.style.top = y + 'px';
                ripple.style.position = 'absolute';
                ripple.style.borderRadius = '50%';
                ripple.style.background = 'rgba(255, 255, 255, 0.6)';
                ripple.style.transform = 'scale(0)';
                ripple.style.animation = 'rippleEffect 0.8s ease-out';
                ripple.style.pointerEvents = 'none';
                
                e.target.appendChild(ripple);
                
                setTimeout(() => {
                    ripple.remove();
                }, 800);
            }
        });

        // Add ripple animation keyframes
        const style = document.createElement('style');
        style.textContent = `
            @keyframes rippleEffect {
                to {
                    transform: scale(1);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);
    }

    // Smooth Scroll with Easing
    setupSmoothScroll() {
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    const offsetTop = target.offsetTop - 100;
                    window.scrollTo({
                        top: offsetTop,
                        behavior: 'smooth'
                    });
                }
            });
        });
    }

    // Enhanced Page Transitions
    setupPageTransitions() {
        const mainContent = document.querySelector('main');
        if (mainContent) {
            mainContent.classList.add('page-transition');
        }

        // Handle navigation with smooth transitions
        document.addEventListener('click', (e) => {
            const link = e.target.closest('a[href]');
            if (link && !link.getAttribute('href').startsWith('#') && 
                !link.hasAttribute('download') && !link.hasAttribute('target')) {
                const href = link.getAttribute('href');
                if (href.startsWith('/') || href.includes(window.location.hostname)) {
                    e.preventDefault();
                    
                    // Add exit animation
                    document.body.style.opacity = '0';
                    document.body.style.transform = 'translateY(-30px) scale(0.98)';
                    document.body.style.transition = 'all 0.4s ease-out';
                    
                    setTimeout(() => {
                        window.location.href = href;
                    }, 400);
                }
            }
        });
    }

    // Advanced 3D Hover Effects
    setupAdvancedHovers() {
        // Enhanced 3D Tilt Effect
        document.querySelectorAll('.tilt-3d').forEach(element => {
            element.addEventListener('mousemove', (e) => {
                const rect = element.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                
                const centerX = rect.width / 2;
                const centerY = rect.height / 2;
                
                const rotateX = (y - centerY) / 8;
                const rotateY = (centerX - x) / 8;
                
                element.style.transform = `
                    perspective(1000px) 
                    rotateX(${rotateX}deg) 
                    rotateY(${rotateY}deg) 
                    scale3d(1.05, 1.05, 1.05)
                `;
                element.style.boxShadow = `
                    ${rotateY * 2}px ${rotateX * 2}px 40px rgba(0, 0, 0, 0.2)
                `;
            });
            
            element.addEventListener('mouseleave', () => {
                element.style.transform = 'perspective(1000px) rotateX(0) rotateY(0) scale3d(1, 1, 1)';
                element.style.boxShadow = '';
            });
        });

        // Morphing hover effect
        document.querySelectorAll('.morph-hover').forEach(element => {
            element.addEventListener('mouseenter', () => {
                element.style.borderRadius = '30% 70% 70% 30% / 30% 30% 70% 70%';
                element.style.transform = 'scale(1.05) rotate(2deg)';
            });
            
            element.addEventListener('mouseleave', () => {
                element.style.borderRadius = '';
                element.style.transform = '';
            });
        });
    }

    // Parallax Effects
    setupParallaxEffects() {
        const parallaxElements = document.querySelectorAll('[data-parallax]');
        
        const updateParallax = () => {
            const scrolled = window.pageYOffset;
            
            parallaxElements.forEach(element => {
                const rate = scrolled * (element.dataset.parallax || 0.5);
                element.style.transform = `translateY(${rate}px)`;
            });
        };

        window.addEventListener('scroll', () => {
            if (!this.isAnimating) {
                this.rafId = requestAnimationFrame(() => {
                    updateParallax();
                    this.isAnimating = false;
                });
                this.isAnimating = true;
            }
        });
    }

    // Intersection Observer for Performance
    setupIntersectionObserver() {
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '50px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('in-view');
                } else {
                    entry.target.classList.remove('in-view');
                }
            });
        }, observerOptions);

        document.querySelectorAll('.observe-me').forEach(el => {
            observer.observe(el);
        });
    }

    // Custom Cursor Effects
    setupCursorEffects() {
        if (window.innerWidth > 768) { // Only on desktop
            const cursor = document.createElement('div');
            cursor.className = 'custom-cursor';
            cursor.style.cssText = `
                position: fixed;
                width: 20px;
                height: 20px;
                background: linear-gradient(135deg, #667eea, #764ba2);
                border-radius: 50%;
                pointer-events: none;
                z-index: 9999;
                transition: transform 0.1s ease;
                mix-blend-mode: difference;
            `;
            document.body.appendChild(cursor);

            document.addEventListener('mousemove', (e) => {
                cursor.style.left = e.clientX - 10 + 'px';
                cursor.style.top = e.clientY - 10 + 'px';
            });

            document.addEventListener('mousedown', () => {
                cursor.style.transform = 'scale(0.8)';
            });

            document.addEventListener('mouseup', () => {
                cursor.style.transform = 'scale(1)';
            });
        }
    }

    handleResize() {
        // Recalculate particle count based on screen size
        const particlesContainer = document.querySelector('.particles-bg');
        if (particlesContainer) {
            const currentCount = particlesContainer.children.length;
            const targetCount = window.innerWidth > 768 ? 80 : 40;
            
            if (currentCount > targetCount) {
                // Remove excess particles
                for (let i = currentCount - 1; i >= targetCount; i--) {
                    particlesContainer.children[i].remove();
                }
            }
        }
    }
}

// Enhanced Toast Notifications with Modern Design
window.showToast = function(message, type = 'success', duration = 6000) {
    const toast = document.createElement('div');
    toast.className = `toast-modern fixed top-6 right-6 z-50 p-6 max-w-sm transform transition-all duration-700`;
    
    const icons = {
        success: `<svg class="w-7 h-7 text-green-500" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
        </svg>`,
        error: `<svg class="w-7 h-7 text-red-500" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
        </svg>`,
        info: `<svg class="w-7 h-7 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
        </svg>`,
        warning: `<svg class="w-7 h-7 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
        </svg>`
    };
    
    toast.innerHTML = `
        <div class="flex items-start space-x-4">
            <div class="flex-shrink-0">
                ${icons[type] || icons.info}
            </div>
            <div class="flex-1">
                <p class="text-sm font-semibold text-gray-900">${message}</p>
            </div>
            <button onclick="this.parentElement.parentElement.remove()" 
                    class="text-gray-400 hover:text-gray-600 transition-colors ml-4">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>
        <div class="progress-bar mt-4 h-1"></div>
    `;
    
    document.body.appendChild(toast);
    
    // Animate progress bar
    const progressBar = toast.querySelector('.progress-bar');
    progressBar.style.width = '100%';
    setTimeout(() => {
        progressBar.style.width = '0%';
        progressBar.style.transition = `width ${duration}ms linear`;
    }, 100);
    
    // Auto remove with enhanced animation
    setTimeout(() => {
        toast.style.transform = 'translateX(100%) scale(0.8) rotateY(20deg)';
        toast.style.opacity = '0';
        setTimeout(() => {
            if (toast.parentElement) {
                toast.remove();
            }
        }, 400);
    }, duration);
};

// Enhanced Alpine.js Components
Alpine.data('modernCart', () => ({
    isOpen: false,
    items: [],
    total: 0,
    isLoading: false,
    
    init() {
        this.loadCartItems();
        this.setupCartAnimations();
    },
    
    setupCartAnimations() {
        this.$nextTick(() => {
            const cartItems = document.querySelectorAll('.cart-item');
            cartItems.forEach((item, index) => {
                item.style.animation = `slideInRight 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55) forwards`;
                item.style.animationDelay = `${index * 0.1}s`;
                item.style.opacity = '0';
            });
        });
    },
    
    async loadCartItems() {
        this.isLoading = true;
        try {
            const response = await fetch('/cart/items');
            if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
            
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
        } finally {
            this.isLoading = false;
        }
    },
    
    animateCartItems() {
        this.$nextTick(() => {
            const items = document.querySelectorAll('.cart-item');
            items.forEach((item, index) => {
                item.style.animation = `slideInRight 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55) forwards`;
                item.style.animationDelay = `${index * 0.1}s`;
                item.style.opacity = '0';
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
            
            if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
            
            const data = await response.json();
            if (data.success) {
                await this.loadCartItems();
                showToast('✨ Book added to cart with style!', 'success');
                this.pulseCartIcon();
                this.updateCartBadge(data.cart_count);
            } else {
                showToast(data.message || 'Error adding to cart', 'error');
            }
        } catch (error) {
            console.error('Cart error:', error);
            showToast('Oops! Something went wrong 😅', 'error');
        }
    },
    
    updateCartBadge(count) {
        const cartBadges = document.querySelectorAll('.cart-count');
        cartBadges.forEach(badge => {
            badge.textContent = count;
            badge.style.animation = 'pulse3D 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55)';
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
            cartIcon.style.animation = 'pulse3D 0.8s cubic-bezier(0.68, -0.55, 0.265, 1.55)';
            setTimeout(() => {
                cartIcon.style.animation = '';
            }, 800);
        }
    },
    
    async removeItem(itemId) {
        const item = document.querySelector(`[data-item-id="${itemId}"]`);
        if (item) {
            item.style.animation = 'slideInLeft 0.4s ease-in forwards';
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
            }, 400);
        }
    }
}));

Alpine.data('modernSearch', () => ({
    query: '',
    results: [],
    isLoading: false,
    showResults: false,
    selectedIndex: -1,
    
    async search() {
        if (this.query.length < 2) {
            this.results = [];
            this.showResults = false;
            return;
        }
        
        this.isLoading = true;
        this.selectedIndex = -1;
        
        try {
            const response = await fetch(`/search?q=${encodeURIComponent(this.query)}`);
            const data = await response.json();
            this.results = data.books || [];
            this.showResults = true;
            
            // Animate results with stagger
            this.$nextTick(() => {
                const resultItems = document.querySelectorAll('.search-result-item');
                resultItems.forEach((item, index) => {
                    item.style.animation = `fadeInUp 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55) forwards`;
                    item.style.animationDelay = `${index * 0.05}s`;
                    item.style.opacity = '0';
                });
            });
        } catch (error) {
            console.error('Search error:', error);
            showToast('Search error occurred', 'error');
        } finally {
            this.isLoading = false;
        }
    },
    
    handleKeydown(event) {
        if (!this.showResults) return;
        
        switch (event.key) {
            case 'ArrowDown':
                event.preventDefault();
                this.selectedIndex = Math.min(this.selectedIndex + 1, this.results.length - 1);
                break;
            case 'ArrowUp':
                event.preventDefault();
                this.selectedIndex = Math.max(this.selectedIndex - 1, -1);
                break;
            case 'Enter':
                event.preventDefault();
                if (this.selectedIndex >= 0) {
                    window.location.href = `/books/${this.results[this.selectedIndex].slug}`;
                }
                break;
            case 'Escape':
                this.showResults = false;
                this.selectedIndex = -1;
                break;
        }
    }
}));

// Enhanced Loading Manager with Modern Animations
class ModernLoadingManager {
    static show(element, text = 'Loading') {
        element.innerHTML = `
            <div class="flex items-center justify-center space-x-3 p-8">
                <div class="relative">
                    <div class="w-8 h-8 border-4 border-blue-200 rounded-full animate-spin"></div>
                    <div class="absolute top-0 left-0 w-8 h-8 border-4 border-transparent border-t-blue-500 rounded-full animate-spin"></div>
                </div>
                <span class="loading-dots text-gray-600 font-medium">${text}</span>
            </div>
        `;
    }
    
    static hide(element, content) {
        element.style.opacity = '0';
        element.style.transform = 'scale(0.95)';
        setTimeout(() => {
            element.innerHTML = content;
            element.style.opacity = '1';
            element.style.transform = 'scale(1)';
        }, 200);
    }
    
    static showSkeleton(element, type = 'card') {
        const skeletons = {
            card: `
                <div class="animate-pulse">
                    <div class="bg-gray-300 h-48 rounded-t-xl"></div>
                    <div class="p-4 space-y-3">
                        <div class="h-4 bg-gray-300 rounded w-3/4"></div>
                        <div class="h-4 bg-gray-300 rounded w-1/2"></div>
                        <div class="h-4 bg-gray-300 rounded w-full"></div>
                    </div>
                </div>
            `,
            list: `
                <div class="animate-pulse flex space-x-4 p-4">
                    <div class="bg-gray-300 h-16 w-16 rounded"></div>
                    <div class="flex-1 space-y-2">
                        <div class="h-4 bg-gray-300 rounded w-3/4"></div>
                        <div class="h-4 bg-gray-300 rounded w-1/2"></div>
                    </div>
                </div>
            `
        };
        
        element.innerHTML = skeletons[type] || skeletons.card;
    }
}

// Initialize Modern Animation Controller
document.addEventListener('DOMContentLoaded', () => {
    new ModernAnimationController();
    
    // Add loading class to body
    document.body.classList.add('loading');
    
    // Remove loading class after page load with enhanced animation
    window.addEventListener('load', () => {
        setTimeout(() => {
            document.body.classList.remove('loading');
            document.body.classList.add('loaded');
            
            // Trigger entrance animations
            document.querySelectorAll('.animate-on-load').forEach((el, index) => {
                setTimeout(() => {
                    el.classList.add('animate-in');
                }, index * 100);
            });
        }, 600);
    });
});

// Initialize Alpine
Alpine.start();

// Enhanced Form Interactions
document.addEventListener('DOMContentLoaded', function() {
    // Modern floating label effect
    document.querySelectorAll('.form-floating input').forEach(input => {
        const updateLabel = () => {
            const label = input.nextElementSibling;
            if (label && label.tagName === 'LABEL') {
                if (input.value || input === document.activeElement) {
                    label.style.transform = 'scale(0.85) translateY(-0.75rem)';
                    label.style.color = '#3b82f6';
                } else {
                    label.style.transform = 'scale(1) translateY(0)';
                    label.style.color = '#6b7280';
                }
            }
        };
        
        input.addEventListener('focus', updateLabel);
        input.addEventListener('blur', updateLabel);
        input.addEventListener('input', updateLabel);
        
        // Initial check
        updateLabel();
    });
    
    // Enhanced form submission with loading states
    const forms = document.querySelectorAll('form[data-loading]');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const submitButton = form.querySelector('button[type="submit"]');
            if (submitButton) {
                submitButton.disabled = true;
                submitButton.innerHTML = `
                    <div class="flex items-center space-x-3">
                        <div class="relative">
                            <div class="w-5 h-5 border-2 border-white/30 rounded-full animate-spin"></div>
                            <div class="absolute top-0 left-0 w-5 h-5 border-2 border-transparent border-t-white rounded-full animate-spin"></div>
                        </div>
                        <span>Processing...</span>
                    </div>
                `;
                
                // Add loading animation to form
                form.style.opacity = '0.8';
                form.style.pointerEvents = 'none';
                form.style.filter = 'blur(1px)';
            }
        });
    });
});

// Advanced Image Loading with Progressive Enhancement
document.addEventListener('DOMContentLoaded', function() {
    const images = document.querySelectorAll('img[loading="lazy"]');
    
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    
                    // Create enhanced placeholder
                    const placeholder = document.createElement('div');
                    placeholder.className = 'absolute inset-0 bg-gradient-to-br from-gray-200 via-gray-100 to-gray-300 animate-pulse';
                    placeholder.style.borderRadius = 'inherit';
                    
                    if (img.parentNode.style.position !== 'relative') {
                        img.parentNode.style.position = 'relative';
                    }
                    img.parentNode.insertBefore(placeholder, img);
                    
                    img.style.opacity = '0';
                    img.style.transform = 'scale(1.1)';
                    img.src = img.dataset.src || img.src;
                    
                    img.onload = () => {
                        img.style.transition = 'all 0.6s ease-out';
                        img.style.opacity = '1';
                        img.style.transform = 'scale(1)';
                        
                        setTimeout(() => {
                            placeholder.style.opacity = '0';
                            setTimeout(() => {
                                if (placeholder.parentNode) {
                                    placeholder.parentNode.removeChild(placeholder);
                                }
                            }, 300);
                        }, 200);
                    };
                    
                    imageObserver.unobserve(img);
                }
            });
        });

        images.forEach(img => imageObserver.observe(img));
    }
});

// Export for global use
window.ModernAnimationController = ModernAnimationController;
window.ModernLoadingManager = ModernLoadingManager;