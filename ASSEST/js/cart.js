// Cart functionality using localStorage
document.addEventListener('DOMContentLoaded', function () {
  // ✅ Initialize toast
  const toastEl = document.getElementById('liveToast');
  const toast = toastEl ? new bootstrap.Toast(toastEl, { delay: 3000 }) : null;

  // ✅ Cart object
  const cart = {
    items: JSON.parse(localStorage.getItem('cart')) || [],

    // Save cart
    save() {
      localStorage.setItem('cart', JSON.stringify(this.items));
      this.updateUI();
    },

    // Add item
    addItem(product) {
      const existingItem = this.items.find(item => item.id === product.id);
      if (existingItem) {
        existingItem.quantity += 1;
        this.showToast(`Increased quantity of ${product.name}`);
      } else {
        this.items.push({
          id: product.id,
          name: product.name,
          price: parseFloat(product.price),
          image: product.image,
          quantity: 1
        });
        this.showToast(`${product.name} added to your cart!`);
      }
      this.save();
    },

    // Remove item
    removeItem(id) {
      const item = this.items.find(i => i.id === id);
      if (item) {
        this.items = this.items.filter(i => i.id !== id);
        this.showToast(`${item.name} removed from your cart!`);
        this.save();
      }
    },

    // Update quantity
    updateQuantity(id, quantity) {
      const item = this.items.find(i => i.id === id);
      if (item) {
        item.quantity = quantity;
        if (item.quantity <= 0) {
          this.removeItem(id);
        } else {
          this.save();
        }
      }
    },

    // Totals
    calculateTotals() {
      const subtotal = this.items.reduce((s, i) => s + i.price * i.quantity, 0);
      const shipping = subtotal > 0 ? 20 : 0;
      const tax = subtotal * 0.08;
      const total = subtotal + shipping + tax;
      return {
        subtotal: subtotal.toFixed(2),
        shipping: shipping.toFixed(2),
        tax: tax.toFixed(2),
        total: total.toFixed(2)
      };
    },

    // Update UI
    updateUI() {
      const cartItems = document.getElementById('cart-items');
      const emptyCart = document.getElementById('empty-cart');
      const continueShopping = document.getElementById('continue-shopping');
      const cartCount = document.getElementById('header-cart-count');
      const headerTotal = document.getElementById('header-total');

      if (cartItems) cartItems.innerHTML = '';

      if (this.items.length === 0) {
        if (emptyCart) emptyCart.classList.remove('d-none');
        if (continueShopping) continueShopping.classList.add('d-none');
      } else {
        if (emptyCart) emptyCart.classList.add('d-none');
        if (continueShopping) continueShopping.classList.remove('d-none');

        this.items.forEach(item => {
          const subtotal = (item.price * item.quantity).toFixed(2);
          const row = document.createElement('tr');
          row.innerHTML = `
            <td class="d-flex align-items-center gap-3">
              <img src="${item.image}" alt="${item.name}">
              <span>${item.name}</span>
            </td>
            <td>₹${item.price.toFixed(2)}</td>
            <td>
              <div class="quantity-control">
                <button class="decrement" data-id="${item.id}">-</button>
                <input type="text" value="${item.quantity}" class="form-control text-center quantity-input" style="width:50px;" data-id="${item.id}">
                <button class="increment" data-id="${item.id}">+</button>
              </div>
            </td>
            <td>₹${subtotal}</td>
            <td><button class="btn btn-sm btn-outline-danger remove-item" data-id="${item.id}"><i class="bi bi-trash"></i></button></td>
          `;
          if (cartItems) cartItems.appendChild(row);
        });
      }

      // Update cart count and total
      const totalItems = this.items.reduce((s, i) => s + i.quantity, 0);
      if (cartCount) cartCount.textContent = totalItems;

      const totals = this.calculateTotals();
      if (headerTotal) headerTotal.textContent = totals.total;

      // Update summary
      const setText = (id, value) => {
        const el = document.getElementById(id);
        if (el) el.textContent = value;
      };

      setText('summary-subtotal', totals.subtotal);
      setText('summary-shipping', totals.shipping);
      setText('summary-tax', totals.tax);
      setText('summary-total', totals.total);

      this.addEventListeners();
    },

    // Event listeners
    addEventListeners() {
      // Remove
      document.querySelectorAll('.remove-item').forEach(button => {
        button.addEventListener('click', () => {
          this.removeItem(button.dataset.id);
        });
      });

      // Increment
      document.querySelectorAll('.increment').forEach(button => {
        button.addEventListener('click', () => {
          const item = this.items.find(i => i.id === button.dataset.id);
          if (item) this.updateQuantity(button.dataset.id, item.quantity + 1);
        });
      });

      // Decrement
      document.querySelectorAll('.decrement').forEach(button => {
        button.addEventListener('click', () => {
          const item = this.items.find(i => i.id === button.dataset.id);
          if (item) this.updateQuantity(button.dataset.id, item.quantity - 1);
        });
      });

      // Quantity inputs
      document.querySelectorAll('.quantity-input').forEach(input => {
        input.addEventListener('change', (e) => {
          const id = e.target.dataset.id;
          const qty = parseInt(e.target.value) || 1;
          this.updateQuantity(id, qty);
        });
      });
    },

    // Toast
    showToast(msg) {
      const toastMsg = document.getElementById('toast-message');
      if (toastMsg) toastMsg.textContent = msg;
      if (toast) toast.show();
    }
  };

  // ✅ Checkout
  const checkoutBtn = document.getElementById('checkout-btn');
  if (checkoutBtn) {
    checkoutBtn.addEventListener('click', () => {
      if (cart.items.length === 0) {
        cart.showToast('Your cart is empty! Add some products first.');
      } else {
        window.location.href = 'checkout.html';
      }
    });
  }

  // ✅ Initialize
  cart.updateUI();
});
// Load cart from localStorage or initialize
let cart = JSON.parse(localStorage.getItem('cart')) || [];

// Save cart to localStorage
function saveCart() {
  localStorage.setItem('cart', JSON.stringify(cart));
  updateCartCount();
}

// Update cart count badge
function updateCartCount() {
  const count = cart.reduce((sum, item) => sum + item.quantity, 0);
  const cartCountEl = document.getElementById('header-cart-count');
  if (cartCountEl) {
    cartCountEl.textContent = count;
  }
}

// Render cart items in the table
function renderCartItems() {
  const cartContainer = document.getElementById('cart-items');
  if (!cartContainer) return;

  if (cart.length === 0) {
    cartContainer.innerHTML = '<tr><td colspan="5" class="text-center">Your cart is empty</td></tr>';
    return;
  }

  cartContainer.innerHTML = '';

  cart.forEach(item => {
    const subtotal = (item.price * item.quantity).toFixed(2);
    cartContainer.innerHTML += `
      <tr>
        <td>${item.name}</td>
        <td>₹${parseFloat(item.price).toFixed(2)}</td>
        <td><input type="number" min="1" value="${item.quantity}" data-id="${item.id}" class="form-control quantity-input" style="width:70px;"></td>
        <td>₹${subtotal}</td>
        <td><button class="btn btn-danger btn-sm remove-btn" data-id="${item.id}">Remove</button></td>
      </tr>
    `;
  });

  attachEventListeners();
  updateSummary();
}

// Attach event listeners for quantity changes and remove actions
function attachEventListeners() {
  document.querySelectorAll('.quantity-input').forEach(input => {
    input.addEventListener('change', event => {
      const id = parseInt(event.target.getAttribute('data-id'));
      const quantity = parseInt(event.target.value);
      if (quantity > 0) {
        const product = cart.find(item => item.id === id);
        if (product) {
          product.quantity = quantity;
          saveCart();
          renderCartItems();
        }
      }
    });
  });

  document.querySelectorAll('.remove-btn').forEach(btn => {
    btn.addEventListener('click', event => {
      const id = parseInt(event.target.getAttribute('data-id'));
      cart = cart.filter(item => item.id !== id);
      saveCart();
      renderCartItems();
    });
  });
}

// Update cart summary: subtotal, shipping, tax, total
function updateSummary() {
  const subtotal = cart.reduce((total, item) => total + item.price * item.quantity, 0);
  const shipping = subtotal > 0 ? 50 : 0;  // example flat shipping
  const tax = subtotal * 0.12;  // example 12% tax
  const total = subtotal + shipping + tax;

  document.getElementById('summary-subtotal').textContent = subtotal.toFixed(2);
  document.getElementById('summary-shipping').textContent = shipping.toFixed(2);
  document.getElementById('summary-tax').textContent = tax.toFixed(2);
  document.getElementById('summary-total').textContent = total.toFixed(2);

  const headerTotalEl = document.getElementById('header-total');
  if (headerTotalEl) {
    headerTotalEl.textContent = total.toFixed(2);
  }
}

// Adding products - demo buttons event listener
document.querySelectorAll('.btn-add').forEach(btn => {
  btn.addEventListener('click', () => {
    const id = parseInt(btn.getAttribute('data-id'));
    const name = btn.getAttribute('data-name');
    const price = parseFloat(btn.getAttribute('data-price'));
    const image = btn.getAttribute('data-image');

    const existing = cart.find(item => item.id === id);
    if (existing) {
      existing.quantity++;
    } else {
      cart.push({id, name, price, image, quantity: 1});
    }

    saveCart();
    alert(`${name} added to cart!`);
    renderCartItems();
  });
});

// Initialize cart count and render items on page load
window.onload = () => {
  updateCartCount();
  renderCartItems();
};
