<?php
include 'db.php';
$page_title = "Shop All Products | Vaishveda Luxury Ayurvedic";
$page_desc = "Browse the full Vaishveda collection of pure Saffron, Aloe Vera, and Sandalwood haircare and skincare rituals.";
include 'header.php';
?>

  <!-- Page Breadcrumbs & Intro -->
  <section style="padding: 40px 0 20px; background-color: var(--color-white); border-bottom: 1px solid var(--color-cream-dark);">
    <div class="container">
      <div style="font-size: 11px; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 15px; opacity: 0.6;">
        <a href="index.php">Home</a> &nbsp;/&nbsp; <span style="color: var(--color-primary); font-weight: 500;">Shop All</span>
      </div>
      <h1 style="font-size: 2.5rem; color: var(--color-primary); text-transform: uppercase; font-family: var(--font-serif);">The Vaishveda Collection</h1>
    </div>
  </section>

  <!-- Shop Section -->
  <section class="section-padding">
    <div class="container">
      <div class="shop-wrapper">
        
        <!-- Sidebar Filters -->
        <aside class="shop-sidebar" id="shopSidebar">
          <!-- Category Filter -->
          <div class="filter-section">
            <h4 class="filter-title">Category</h4>
            <ul class="filter-list">
              <li>
                <label class="filter-label">
                  <input type="checkbox" name="category" value="Skin" class="filter-checkbox">
                  Skin Care
                </label>
              </li>
              <li>
                <label class="filter-label">
                  <input type="checkbox" name="category" value="Hair" class="filter-checkbox">
                  Hair Care
                </label>
              </li>
              <li>
                <label class="filter-label">
                  <input type="checkbox" name="category" value="Body" class="filter-checkbox">
                  Bath & Body
                </label>
              </li>
              <li>
                <label class="filter-label">
                  <input type="checkbox" name="category" value="Kumkumadi" class="filter-checkbox">
                  Kumkumadi Essentials
                </label>
              </li>
            </ul>
          </div>

          <!-- Price Filter -->
          <div class="filter-section">
            <h4 class="filter-title">Price Range</h4>
            <ul class="filter-list">
              <li>
                <label class="filter-label">
                  <input type="checkbox" name="price" value="under-500" class="filter-checkbox">
                  Under ₹500
                </label>
              </li>
              <li>
                <label class="filter-label">
                  <input type="checkbox" name="price" value="500-1000" class="filter-checkbox">
                  ₹500 - ₹1,000
                </label>
              </li>
              <li>
                <label class="filter-label">
                  <input type="checkbox" name="price" value="above-1000" class="filter-checkbox">
                  Above ₹1,000
                </label>
              </li>
            </ul>
          </div>
        </aside>

        <!-- Product Listing Grid -->
        <main class="shop-content">
          <!-- Toolbar -->
          <div class="shop-toolbar">
            <div class="product-count" id="productCountText">Showing all products</div>
            <div>
              <select class="sort-select" id="sortSelect">
                <option value="featured">Featured Icons</option>
                <option value="price-low">Price: Low to High</option>
                <option value="price-high">Price: High to Low</option>
                <option value="rating">Top Rated</option>
              </select>
            </div>
          </div>

          <!-- Grid -->
          <div class="product-row" id="shopGrid" style="grid-template-columns: repeat(3, 1fr);">
            <!-- Populated dynamically via JS in app.js using PRODUCTS_DB -->
          </div>
        </main>

      </div>
    </div>
  </section>

<?php include 'footer.php'; ?>
