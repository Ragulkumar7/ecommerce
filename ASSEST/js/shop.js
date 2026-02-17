document.addEventListener('DOMContentLoaded', function () {
  const cart = {
    items: JSON.parse(localStorage.getItem('cart')) || [],

    save() {
      localStorage.setItem('cart', JSON.stringify(this.items));
      this.updateUI();
    },

    addItem(product) {
      const existing = this.items.find(i => i.id === product.id);
      if (existing) {
        existing.quantity += 1;
      } else {
        this.items.push({ ...product, quantity: 1 });
      }
      this.save();
    },

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

    updateUI() {
      const count = this.items.reduce((s, i) => s + i.quantity, 0);
      const totals = this.calculateTotals();

      // update header cart count
      const headerCartCount = document.getElementById('header-cart-count');
      if (headerCartCount) headerCartCount.textContent = count;

      // update header total
      const headerTotal = document.getElementById('header-total');
      if (headerTotal) headerTotal.textContent = totals.total;
    }
  };

  // Attach add-to-cart button listeners
  document.querySelectorAll('.add-to-cart-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      const product = {
        id: btn.dataset.id,
        name: btn.dataset.name,
        price: parseFloat(btn.dataset.price),
        image: btn.dataset.image
      };
      cart.addItem(product);
      alert(`${product.name} added to cart!`);
    });
  });

  // Initialize UI
  cart.updateUI();
});