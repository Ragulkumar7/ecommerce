// Products data management for electro_store database
const productManager = {
    // Get all products from PHP data
    getAllProducts: function() {
        const productElements = document.querySelectorAll('.product-item');
        const products = [];
        
        productElements.forEach(element => {
            products.push({
                id: parseInt(element.dataset.id),
                name: element.dataset.name,
                price: parseFloat(element.dataset.price),
                category: element.dataset.category,
                brand: element.dataset.brand,
                rating: parseFloat(element.dataset.rating),
                stock: parseInt(element.dataset.stock),
                element: element
            });
        });
        
        return products;
    },
    
    // Get product by ID
    getProductById: function(id) {
        const products = this.getAllProducts();
        return products.find(product => product.id === parseInt(id));
    },
    
    // Get products by category
    getProductsByCategory: function(category) {
        const products = this.getAllProducts();
        return products.filter(product => product.category === category);
    },
    
    // Get products by brand
    getProductsByBrand: function(brand) {
        const products = this.getAllProducts();
        return products.filter(product => product.brand === brand);
    },
    
    // Search products
    searchProducts: function(query) {
        const products = this.getAllProducts();
        const lowerQuery = query.toLowerCase();
        
        return products.filter(product => 
            product.name.toLowerCase().includes(lowerQuery) ||
            product.category.toLowerCase().includes(lowerQuery) ||
            product.brand.toLowerCase().includes(lowerQuery)
        );
    },
    
    // Filter products by multiple criteria
    filterProducts: function(filters) {
        const products = this.getAllProducts();
        
        return products.filter(product => {
            let matches = true;
            
            // Category filter
            if (filters.categories && filters.categories.length > 0) {
                matches = matches && filters.categories.includes(product.category);
            }
            
            // Brand filter
            if (filters.brands && filters.brands.length > 0) {
                matches = matches && filters.brands.includes(product.brand);
            }
            
            // Price filter
            if (filters.maxPrice) {
                matches = matches && product.price <= filters.maxPrice;
            }
            
            // Stock filter
            if (filters.stockStatus && filters.stockStatus.length > 0) {
                if (filters.stockStatus.includes('instock')) {
                    matches = matches && product.stock > 0;
                }
                if (filters.stockStatus.includes('lowstock')) {
                    matches = matches && product.stock > 0 && product.stock <= 5;
                }
            }
            
            return matches;
        });
    },
    
    // Sort products
    sortProducts: function(products, sortBy) {
        const sortedProducts = [...products];
        
        switch(sortBy) {
            case 'price-low':
                return sortedProducts.sort((a, b) => a.price - b.price);
            case 'price-high':
                return sortedProducts.sort((a, b) => b.price - a.price);
            case 'name':
                return sortedProducts.sort((a, b) => a.name.localeCompare(b.name));
            case 'stock':
                return sortedProducts.sort((a, b) => b.stock - a.stock);
            case 'rating':
                return sortedProducts.sort((a, b) => b.rating - a.rating);
            default:
                return sortedProducts;
        }
    },
    
    // Update product display based on filtered results
    displayProducts: function(filteredProducts) {
        const allProducts = this.getAllProducts();
        
        // Hide all products first
        allProducts.forEach(product => {
            product.element.style.display = 'none';
        });
        
        // Show filtered products
        filteredProducts.forEach(product => {
            product.element.style.display = 'block';
        });
        
        // Reorder in DOM based on current sort
        this.reorderProducts(filteredProducts);
    },
    
    // Reorder products in DOM
    reorderProducts: function(products) {
        const container = document.getElementById('products-container');
        if (!container) return;
        
        products.forEach(product => {
            container.appendChild(product.element);
        });
    },
    
    // Get product statistics
    getProductStats: function() {
        const products = this.getAllProducts();
        
        const stats = {
            total: products.length,
            byCategory: {},
            byBrand: {},
            priceRange: {
                min: Math.min(...products.map(p => p.price)),
                max: Math.max(...products.map(p => p.price))
            },
            inStock: products.filter(p => p.stock > 0).length,
            lowStock: products.filter(p => p.stock > 0 && p.stock <= 5).length,
            outOfStock: products.filter(p => p.stock <= 0).length
        };
        
        // Count by category
        products.forEach(product => {
            stats.byCategory[product.category] = (stats.byCategory[product.category] || 0) + 1;
            stats.byBrand[product.brand] = (stats.byBrand[product.brand] || 0) + 1;
        });
        
        return stats;
    },
    
    // Update filter counts based on current products
    updateFilterCounts: function() {
        const stats = this.getProductStats();
        
        // Update category counts
        Object.keys(stats.byCategory).forEach(category => {
            const countElement = document.querySelector(`.filter-count[data-category="${category}"]`);
            if (countElement) {
                countElement.textContent = `(${stats.byCategory[category]})`;
            }
        });
        
        // Update brand counts
        Object.keys(stats.byBrand).forEach(brand => {
            const countElement = document.querySelector(`.filter-count[data-brand="${brand}"]`);
            if (countElement) {
                countElement.textContent = `(${stats.byBrand[brand]})`;
            }
        });
    }
};

// Initialize product manager when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    // Update filter counts
    productManager.updateFilterCounts();
    
    // Set price range max value based on products
    const stats = productManager.getProductStats();
    const priceRange = document.getElementById('priceRange');
    if (priceRange) {
        priceRange.max = Math.ceil(stats.priceRange.max);
        priceRange.value = stats.priceRange.max;
        document.getElementById('priceRangeValue').textContent = `₹${stats.priceRange.max}`;
    }
});

// Export for use in other modules
if (typeof module !== 'undefined' && module.exports) {
    module.exports = { productManager };
}
 class ProductFilters {
    constructor() {
        this.productManager = window.productManager;
        this.products = this.productManager.getAllProducts();
        this.activeFilters = {
            categories: [],
            brands: [],
            maxPrice: 3000,
            stockStatus: ['instock', 'lowstock']
        };
        
        this.init();
    }
    
    init() {
        this.attachFilterListeners();
        this.updateResultsCount();
        this.applyFilters(); // Apply initial filters
    }
    
    attachFilterListeners() {
        // Category filter buttons
        document.querySelectorAll('.category-btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                this.handleCategoryFilter(e.target);
            });
        });
        
        // Checkbox filters
        document.querySelectorAll('.category-filter-check, .brand-filter, .stock-filter').forEach(checkbox => {
            checkbox.addEventListener('change', () => {
                this.applyFilters();
            });
        });
        
        // Price range filter
        const priceRange = document.getElementById('priceRange');
        if (priceRange) {
            priceRange.addEventListener('input', (e) => {
                document.getElementById('priceRangeValue').textContent = `₹${e.target.value}`;
                // Don't apply filters on every input change for better performance
            });
            
            // Apply filters when user stops sliding
            let priceTimeout;
            priceRange.addEventListener('change', (e) => {
                clearTimeout(priceTimeout);
                priceTimeout = setTimeout(() => {
                    this.applyFilters();
                }, 500);
            });
        }
        
        // Sort select
        const sortSelect = document.getElementById('sortSelect');
        if (sortSelect) {
            sortSelect.addEventListener('change', (e) => {
                this.sortProducts(e.target.value);
            });
        }
        
        // Apply filters button
        const applyBtn = document.getElementById('applyFilters');
        if (applyBtn) {
            applyBtn.addEventListener('click', () => {
                this.applyFilters();
            });
        }
        
        // Reset filters button
        const resetBtn = document.getElementById('resetFilters');
        if (resetBtn) {
            resetBtn.addEventListener('click', () => {
                this.resetFilters();
            });
        }
        
        // Search functionality
        const searchInput = document.querySelector('.search-input');
        if (searchInput) {
            let searchTimeout;
            searchInput.addEventListener('input', (e) => {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    this.handleSearch(e.target.value);
                }, 300);
            });
        }
    }
    
    handleCategoryFilter(button) {
        // Remove active class from all buttons
        document.querySelectorAll('.category-btn').forEach(btn => {
            btn.classList.remove('active');
        });
        
        // Add active class to clicked button
        button.classList.add('active');
        
        const category = button.dataset.category;
        
        if (category === 'all') {
            // Show all categories
            document.querySelectorAll('.category-filter-check').forEach(checkbox => {
                checkbox.checked = true;
            });
        } else {
            // Show only selected category
            document.querySelectorAll('.category-filter-check').forEach(checkbox => {
                checkbox.checked = (checkbox.value === category);
            });
        }
        
        this.applyFilters();
    }
    
    applyFilters() {
        this.updateActiveFilters();
        
        const filteredProducts = this.productManager.filterProducts(this.activeFilters);
        const sortedProducts = this.productManager.sortProducts(filteredProducts, 
            document.getElementById('sortSelect').value);
        
        this.productManager.displayProducts(sortedProducts);
        this.updateResultsCount();
    }
    
    updateActiveFilters() {
        // Get selected categories
        this.activeFilters.categories = Array.from(document.querySelectorAll('.category-filter-check:checked'))
            .map(checkbox => checkbox.value);
        
        // Get selected brands
        this.activeFilters.brands = Array.from(document.querySelectorAll('.brand-filter:checked'))
            .map(checkbox => checkbox.value);
        
        // Get selected stock status
        this.activeFilters.stockStatus = Array.from(document.querySelectorAll('.stock-filter:checked'))
            .map(checkbox => checkbox.value);
        
        // Get price range
        const priceRange = document.getElementById('priceRange');
        if (priceRange) {
            this.activeFilters.maxPrice = parseInt(priceRange.value);
        }
    }
    
    sortProducts(sortBy) {
        const filteredProducts = this.productManager.filterProducts(this.activeFilters);
        const sortedProducts = this.productManager.sortProducts(filteredProducts, sortBy);
        this.productManager.displayProducts(sortedProducts);
    }
    
    handleSearch(query) {
        const searchTerm = query.toLowerCase().trim();
        
        if (searchTerm === '') {
            this.applyFilters();
            return;
        }
        
        const searchResults = this.productManager.searchProducts(searchTerm);
        const filteredResults = searchResults.filter(product => {
            // Apply current filters to search results
            const matchesCategory = this.activeFilters.categories.length === 0 || 
                                  this.activeFilters.categories.includes(product.category);
            const matchesBrand = this.activeFilters.brands.length === 0 || 
                               this.activeFilters.brands.includes(product.brand);
            const matchesPrice = product.price <= this.activeFilters.maxPrice;
            const matchesStock = this.activeFilters.stockStatus.length === 0 || 
                               (this.activeFilters.stockStatus.includes('instock') && product.stock > 0) ||
                               (this.activeFilters.stockStatus.includes('lowstock') && product.stock > 0 && product.stock <= 5);
            
            return matchesCategory && matchesBrand && matchesPrice && matchesStock;
        });
        
        const sortedResults = this.productManager.sortProducts(filteredResults,
            document.getElementById('sortSelect').value);
        
        this.productManager.displayProducts(sortedResults);
        this.updateResultsCount();
    }
    
    resetFilters() {
        // Reset checkboxes
        document.querySelectorAll('.category-filter-check, .brand-filter, .stock-filter').forEach(checkbox => {
            checkbox.checked = true;
        });
        
        // Reset price range
        const stats = this.productManager.getProductStats();
        const priceRange = document.getElementById('priceRange');
        if (priceRange) {
            priceRange.value = stats.priceRange.max;
            document.getElementById('priceRangeValue').textContent = `₹${stats.priceRange.max}`;
        }
        
        // Reset category buttons
        document.querySelectorAll('.category-btn').forEach(btn => {
            btn.classList.remove('active');
        });
        document.querySelector('.category-btn[data-category="all"]').classList.add('active');
        
        // Reset sort
        document.getElementById('sortSelect').value = 'default';
        
        // Apply reset
        this.applyFilters();
    }
    
    updateResultsCount() {
        const visibleProducts = this.productManager.filterProducts(this.activeFilters);
        const totalCount = visibleProducts.length;
        const showingCount = Math.min(totalCount, 12); // Assuming 12 products per page
        
        const showingCountEl = document.getElementById('showing-count');
        const totalCountEl = document.getElementById('total-count');
        
        if (showingCountEl) {
            showingCountEl.textContent = totalCount > 0 ? `1-${showingCount}` : '0-0';
        }
        
        if (totalCountEl) {
            totalCountEl.textContent = totalCount;
        }
    }
}

// Initialize filters when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    // Wait for productManager to be available
    if (window.productManager) {
        window.productFilters = new ProductFilters();
    } else {
        console.error('Product manager not found');
    }
});
    // Simple product filter system
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Filter system initialized');
        
        const productItems = document.querySelectorAll('.product-item');
        const categoryCheckboxes = document.querySelectorAll('.category-filter-check');
        const brandCheckboxes = document.querySelectorAll('.brand-filter');
        const stockCheckboxes = document.querySelectorAll('.stock-filter');
        const priceRange = document.getElementById('priceRange');
        const sortSelect = document.getElementById('sortSelect');
        const applyFiltersBtn = document.getElementById('applyFilters');
        const resetFiltersBtn = document.getElementById('resetFilters');
        const searchInput = document.querySelector('.search-input');
        
        function applyFilters() {
            console.log('Applying filters...');
            
            const selectedCategories = Array.from(categoryCheckboxes)
                .filter(cb => cb.checked)
                .map(cb => cb.value);
                
            const selectedBrands = Array.from(brandCheckboxes)
                .filter(cb => cb.checked)
                .map(cb => cb.value);
                
            const selectedStock = Array.from(stockCheckboxes)
                .filter(cb => cb.checked)
                .map(cb => cb.value);
                
            const maxPrice = parseInt(priceRange.value);
            const searchTerm = searchInput ? searchInput.value.toLowerCase() : '';
            
            let visibleCount = 0;
            
            productItems.forEach(item => {
                const category = item.dataset.category;
                const brand = item.dataset.brand;
                const price = parseFloat(item.dataset.price);
                const stock = parseInt(item.dataset.stock);
                const name = item.dataset.name.toLowerCase();
                
                // Check if product matches filters
                const matchesCategory = selectedCategories.length === 0 || selectedCategories.includes(category);
                const matchesBrand = selectedBrands.length === 0 || selectedBrands.includes(brand);
                const matchesPrice = price <= maxPrice;
                const matchesStock = selectedStock.length === 0 || 
                    (selectedStock.includes('instock') && stock > 0) ||
                    (selectedStock.includes('lowstock') && stock > 0 && stock <= 5);
                const matchesSearch = !searchTerm || name.includes(searchTerm);
                
                const shouldShow = matchesCategory && matchesBrand && matchesPrice && matchesStock && matchesSearch;
                
                if (shouldShow) {
                    item.style.display = 'block';
                    visibleCount++;
                } else {
                    item.style.display = 'none';
                }
            });
            
            // Update results count
            const showingCountEl = document.getElementById('showing-count');
            const totalCountEl = document.getElementById('total-count');
            
            if (showingCountEl) {
                showingCountEl.textContent = `1-${visibleCount}`;
            }
            if (totalCountEl) {
                totalCountEl.textContent = visibleCount;
            }
            
            console.log(`Showing ${visibleCount} products`);
        }
        
        // Event listeners
        if (applyFiltersBtn) {
            applyFiltersBtn.addEventListener('click', applyFilters);
        }
        
        if (resetFiltersBtn) {
            resetFiltersBtn.addEventListener('click', function() {
                // Reset all checkboxes
                categoryCheckboxes.forEach(cb => cb.checked = true);
                brandCheckboxes.forEach(cb => cb.checked = true);
                stockCheckboxes.forEach(cb => cb.checked = true);
                
                // Reset price range
                if (priceRange) {
                    priceRange.value = 3000;
                    document.getElementById('priceRangeValue').textContent = '₹3000';
                }
                
                // Reset search
                if (searchInput) {
                    searchInput.value = '';
                }
                
                // Reset sort
                if (sortSelect) {
                    sortSelect.value = 'default';
                }
                
                // Apply filters
                applyFilters();
            });
        }
        
        // Category button handlers
        document.querySelectorAll('.category-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                // Remove active class from all buttons
                document.querySelectorAll('.category-btn').forEach(b => b.classList.remove('active'));
                // Add active class to clicked button
                this.classList.add('active');
                
                const category = this.dataset.category;
                
                if (category === 'all') {
                    // Check all categories
                    categoryCheckboxes.forEach(cb => cb.checked = true);
                } else {
                    // Uncheck all, then check the selected category
                    categoryCheckboxes.forEach(cb => cb.checked = false);
                    const targetCheckbox = document.querySelector(`.category-filter-check[value="${category}"]`);
                    if (targetCheckbox) {
                        targetCheckbox.checked = true;
                    }
                }
                
                applyFilters();
            });
        });
        
        // Price range update
        if (priceRange) {
            priceRange.addEventListener('input', function() {
                document.getElementById('priceRangeValue').textContent = '₹' + this.value;
            });
            
            priceRange.addEventListener('change', applyFilters);
        }
        
        // Sort functionality
        if (sortSelect) {
            sortSelect.addEventListener('change', function() {
                const sortBy = this.value;
                const container = document.getElementById('products-container');
                const visibleItems = Array.from(productItems).filter(item => item.style.display !== 'none');
                
                visibleItems.sort((a, b) => {
                    switch(sortBy) {
                        case 'price-low':
                            return parseFloat(a.dataset.price) - parseFloat(b.dataset.price);
                        case 'price-high':
                            return parseFloat(b.dataset.price) - parseFloat(a.dataset.price);
                        case 'name':
                            return a.dataset.name.localeCompare(b.dataset.name);
                        case 'stock':
                            return parseInt(b.dataset.stock) - parseInt(a.dataset.stock);
                        case 'rating':
                            return parseFloat(b.dataset.rating) - parseFloat(a.dataset.rating);
                        default:
                            return 0;
                    }
                });
                
                // Reorder in DOM
                visibleItems.forEach(item => container.appendChild(item));
            });
        }
        
        // Search functionality
        if (searchInput) {
            let searchTimeout;
            searchInput.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(applyFilters, 300);
            });
        }
        
        // Apply filters on page load
        applyFilters();
    });