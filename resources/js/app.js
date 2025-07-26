// resources/js/app.js

import './bootstrap';
import Alpine from 'alpinejs';

// Make Alpine available globally
window.Alpine = Alpine;

// Alpine.js components
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
            const data = await response.json();
            if (data.success) {
                this.items = data.items;
                this.total = data.total;
            }
        } catch (error) {
            console.error('Error loading cart items:', error);
        }
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
            
            const data = await response.json();
            if (data.success) {
                await this.loadCartItems();
                showToast('Book added to cart!', 'success');
            } else {
                showToast(data.message || 'Error adding to cart', 'error');
            }
        } catch (error) {
            showToast('Error adding to cart', 'error');
        }
    },
    
    async removeItem(itemId) {
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
    },
    
    async updateQuantity(itemId, quantity) {
        try {
            const response = await fetch(`/cart/update/${itemId}`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ quantity })
            });
            
            const data = await response.json();
            if (data.success) {
                await this.loadCartItems();
            } else {
                showToast(data.message || 'Error updating cart', 'error');
            }
        } catch (error) {
            showToast('Error updating cart', 'error');
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
        } catch (error) {
            console.error('Search error:', error);
        } finally {
            this.isLoading = false;
        }
    },
    
    selectResult(book) {
        window.location.href = `/books/${book.slug}`;
    }
}));

Alpine.data('bookFilter', () => ({
    filters: {
        category: '',
        author: '',
        minPrice: '',
        maxPrice: '',
        search: '',
        sort: 'title'
    },
    
    applyFilters() {
        const url = new URL(window.location);
        
        Object.keys(this.filters).forEach(key => {
            if (this.filters[key]) {
                url.searchParams.set(key, this.filters[key]);
            } else {
                url.searchParams.delete(key);
            }
        });
        
        window.location.href = url.toString();
    },
    
    clearFilters() {
        this.filters = {
            category: '',
            author: '',
            minPrice: '',
            maxPrice: '',
            search: '',
            sort: 'title'
        };
        window.location.href = window.location.pathname;
    }
}));

// Global functions
window.showToast = function(message, type = 'success') {
    const toast = document.createElement('div');
    toast.className = `animate-slide-up bg-white border-l-4 ${type === 'success' ? 'border-green-500' : 'border-red-500'} rounded-lg shadow-lg p-4 max-w-sm`;
    toast.innerHTML = `
        <div class="flex items-center">
            <div class="flex-shrink-0">
                ${type === 'success' ? 
                    '<svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>' :
                    '<svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path></svg>'
                }
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium text-gray-900">${message}</p>
            </div>
            <div class="ml-auto pl-3">
                <button onclick="this.parentElement.parentElement.parentElement.remove()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
        </div>
    `;
    
    const container = document.getElementById('toast-container');
    if (container) {
        container.appendChild(toast);
        
        // Auto remove after 5 seconds
        setTimeout(() => {
            if (toast.parentElement) {
                toast.remove();
            }
        }, 5000);
    }
};

// Initialize Alpine
Alpine.start();

// Smooth scrolling for anchor links
document.addEventListener('DOMContentLoaded', function() {
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
});

// Loading state for forms
document.addEventListener('DOMContentLoaded', function() {
    const forms = document.querySelectorAll('form[data-loading]');
    forms.forEach(form => {
        form.addEventListener('submit', function() {
            const submitButton = form.querySelector('button[type="submit"]');
            if (submitButton) {
                submitButton.disabled = true;
                submitButton.innerHTML = '<svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Processing...';
            }
        });
    });
});

// Image lazy loading
document.addEventListener('DOMContentLoaded', function() {
    const images = document.querySelectorAll('img[loading="lazy"]');
    
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src || img.src;
                    img.classList.remove('loading');
                    imageObserver.unobserve(img);
                }
            });
        });

        images.forEach(img => imageObserver.observe(img));
    }
});