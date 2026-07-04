  <!-- Trust Badges Section -->
  <section class="trust-badges-section">
    <div class="container">
      <div class="trust-badges-grid">
        <!-- Badge 1: Free Shipping -->
        <div class="trust-badge-item">
          <div class="trust-badge-icon">
            <ion-icon name="cube-outline"></ion-icon>
          </div>
          <div class="trust-badge-text">
            <h4>Free Shipping</h4>
            <p>On all orders above ₹499</p>
          </div>
        </div>
        
        <!-- Badge 2: COD Not Available -->
        <div class="trust-badge-item">
          <div class="trust-badge-icon">
            <ion-icon name="card-outline"></ion-icon>
          </div>
          <div class="trust-badge-text">
            <h4>COD Not Available</h4>
            <p>Online secure payment only right now</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer Section -->
  <footer class="main-footer">
    <div class="container">
      <div class="footer-grid">
        <!-- Column 1: Brand Info -->
        <div class="footer-about">
          <img src="assets/logo.png" alt="Vaishveda Logo" class="footer-logo" style="filter: brightness(0) invert(1);">
          <p>Luxurious Ayurvedic formulations marrying ancestral botanical wisdom with modern extraction sciences. Pure. Potent. Clinically Refined.</p>
        </div>

        <!-- Column 2: Navigation Links -->
        <div>
          <h4 class="footer-col-title">Our World</h4>
          <ul class="footer-links">
            <li><a href="story.php">Philosophy & Story</a></li>
            <li><a href="shop.php">Shop All Products</a></li>
            <li><a href="admin.php">Admin Panel</a></li>
          </ul>
        </div>

        <!-- Column 3: Customer Care -->
        <div>
          <h4 class="footer-col-title">Customer Care</h4>
          <ul class="footer-links">
            <li><a href="index.php#contact-section">Contact Us</a></li>
            <li><a href="shipping-returns.php">Shipping & Returns</a></li>
            <li><a href="faq.php">FAQs</a></li>
            <li><a href="account.php?mode=login">Log In</a></li>
            <li><a href="account.php?mode=register">Create Account</a></li>
          </ul>
        </div>

        <!-- Column 4: Newsletter -->
        <div class="footer-newsletter">
          <h4 class="footer-col-title">Newsletter</h4>
          <p>Subscribe to receive news of private sales, botanical launches, and Ayurvedic ritual guidance.</p>
          <form class="newsletter-form" id="newsletterForm">
            <input type="email" placeholder="Your Email Address" required>
            <button type="submit">Subscribe</button>
          </form>
        </div>
      </div>

      <!-- Footer Bottom -->
      <div class="footer-bottom">
        <p>&copy; 2026 Vaishveda Private Limited. All rights reserved.</p>
        <div class="footer-bottom-links">
          <a href="index.php">Privacy Policy</a>
          <a href="index.php">Terms of Service</a>
        </div>
      </div>
    </div>
  </footer>

  <!-- ==========================================================================
       OVERLAYS, DRAWERS, AND MODALS
       ========================================================================== */ -->

  <!-- Drawer Overlay Shade -->
  <div class="drawer-overlay" id="drawerOverlay"></div>

  <!-- Shopping Cart Drawer -->
  <div class="cart-drawer" id="cartDrawer">
    <div class="cart-header">
      <h3>Your Bag</h3>
      <button class="close-drawer" id="cartCloseBtn"><ion-icon name="close-outline"></ion-icon></button>
    </div>
    <div class="cart-items-container" id="cartItemsList">
      <!-- Generated dynamically in app.js -->
    </div>
    <div class="cart-footer">
      <div class="cart-summary-line">
        <span>Subtotal</span>
        <span id="cartSubtotal">₹0</span>
      </div>
      <div class="cart-summary-line">
        <span>Shipping</span>
        <span id="cartShipping">Calculated next</span>
      </div>
      <div class="cart-summary-line total">
        <span>Total</span>
        <span id="cartTotal">₹0</span>
      </div>
      <button class="btn btn-primary" id="checkoutBtn">Proceed to Checkout</button>
    </div>
  </div>

  <!-- Search Overlay Overlay -->
  <div class="search-overlay" id="searchOverlay">
    <div class="search-container">
      <button class="search-close" id="searchCloseBtn"><ion-icon name="close-outline"></ion-icon></button>
      <div class="search-input-wrapper">
        <input type="text" id="searchInput" placeholder="Search Saffron, Bhringraj, Rose Water..." autofocus>
        <button><ion-icon name="search-outline"></ion-icon></button>
      </div>
      <div class="search-results" id="searchResultsList">
        <!-- Dynamically rendered results -->
      </div>
    </div>
  </div>

  <!-- Checkout Success Modal -->
  <div class="modal-container" id="checkoutSuccessModal">
    <div class="modal-icon">
      <ion-icon name="checkmark-circle-outline"></ion-icon>
    </div>
    <h3 class="modal-title">Order Placed Successfully!</h3>
    <p class="modal-desc">Thank you for shopping with Vaishveda. Your luxurious Ayurvedic self-care ritual is on its way to you. A confirmation email has been sent to your address.</p>
    <button class="btn btn-primary" id="modalCloseBtn">Continue Shopping</button>
  </div>

  <!-- Checkout Form Modal -->
  <div class="modal-container checkout-modal" id="checkoutFormModal">
    <button class="modal-close-btn" id="checkoutFormCloseBtn"><ion-icon name="close-outline"></ion-icon></button>
    <h3 class="modal-title" style="margin-bottom: 20px; font-size: 1.6rem;">Shipping & Contact</h3>
    
    <!-- Checkout Page Notice -->
    <div class="checkout-notice-alert">
      <ion-icon name="alert-circle-outline"></ion-icon>
      <div>
        <strong>Checkout Page Notice</strong>
        <span>Cash on Delivery is temporarily unavailable. Please select a G-Pay option to complete your order.</span>
      </div>
    </div>

    <form id="checkoutDetailsForm" class="checkout-form">
      <div class="form-group">
        <label for="checkoutName">Full Name *</label>
        <input type="text" id="checkoutName" required placeholder="e.g. Aditi Sharma">
      </div>
      <div class="form-group-row">
        <div class="form-group">
          <label for="checkoutEmail">Email Address *</label>
          <input type="email" id="checkoutEmail" required placeholder="e.g. aditi@gmail.com">
        </div>
        <div class="form-group">
          <label for="checkoutPhone">Phone Number *</label>
          <input type="tel" id="checkoutPhone" required placeholder="e.g. 9876543210" pattern="[0-9]{10}">
        </div>
      </div>
      <div class="form-group">
        <label for="checkoutAddress">Street Address *</label>
        <input type="text" id="checkoutAddress" required placeholder="e.g. 12, Park Street, Flat 3B">
      </div>
      <div class="form-group-row">
        <div class="form-group">
          <label for="checkoutCity">City *</label>
          <input type="text" id="checkoutCity" required placeholder="e.g. Mumbai">
        </div>
        <div class="form-group">
          <label for="checkoutState">State *</label>
          <input type="text" id="checkoutState" required placeholder="e.g. Maharashtra">
        </div>
        <div class="form-group">
          <label for="checkoutPincode">Pin Code *</label>
          <input type="text" id="checkoutPincode" required placeholder="e.g. 400001" pattern="[0-9]{6}">
        </div>
      </div>

      <!-- Payment Method Selection -->
      <div class="payment-method-section">
        <label class="form-section-title">Payment Method</label>
        
        <div class="payment-methods-grid">
          <label class="payment-method-card disabled" for="payCod">
            <input type="radio" id="payCod" name="paymentMethod" value="COD" disabled>
            <div class="payment-method-content">
              <ion-icon name="cash-outline"></ion-icon>
              <span>Cash on Delivery</span>
            </div>
          </label>
          
          <label class="payment-method-card active" for="payGpay">
            <input type="radio" id="payGpay" name="paymentMethod" value="GPAY" checked>
            <div class="payment-method-content">
              <ion-icon name="logo-google" style="transform: scale(0.9);"></ion-icon>
              <span>Google Pay</span>
            </div>
          </label>

          <label class="payment-method-card" for="payPaypal">
            <input type="radio" id="payPaypal" name="paymentMethod" value="PAYPAL">
            <div class="payment-method-content">
              <ion-icon name="logo-paypal"></ion-icon>
              <span>PayPal</span>
            </div>
          </label>
        </div>

        <!-- Payment Details Content Areas -->
        <div class="payment-details-wrapper">
          <!-- COD details -->
          <div class="payment-details-box" id="detailsCod" style="display: none;">
            <p class="payment-desc" style="margin: 0;">Pay with cash upon delivery. Safe and reliable.</p>
          </div>

          <!-- Google Pay details -->
          <div class="payment-details-box active" id="detailsGpay" style="display: block;">
            <p class="payment-desc">Scan the QR code with Google Pay or any UPI app to pay.</p>
            <div class="qr-code-container">
              <img src="assets/gpay_qr.jpg" alt="Google Pay QR Code" class="gpay-qr-img">
              <p class="upi-id-text">UPI ID: <strong>vaishnavi166@federal</strong></p>
            </div>
            <div class="form-group" style="margin-top: 15px; margin-bottom: 0;">
              <label for="gpayTransactionId">UPI Transaction ID (12 digits) *</label>
              <input type="text" id="gpayTransactionId" placeholder="e.g. 123456789012" pattern="[0-9]{12}" required>
            </div>
          </div>

          <!-- PayPal details -->
          <div class="payment-details-box" id="detailsPaypal" style="display: none;">
            <p class="payment-desc">Complete your payment securely via PayPal email validation.</p>
            <div class="form-group" style="margin-bottom: 0;">
              <label for="paypalEmail">PayPal Email Address *</label>
              <input type="email" id="paypalEmail" placeholder="e.g. paypal@example.com">
            </div>
          </div>
        </div>
      </div>

      <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 15px;">Place Order</button>
    </form>
  </div>

  <script src="app.js?v=<?php echo filemtime('app.js'); ?>"></script>
</body>
</html>
