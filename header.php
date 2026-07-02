<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo isset($page_title) ? $page_title : "Vaishveda | Luxury Ayurvedic Skincare & Haircare Essentials"; ?></title>
  <meta name="description" content="<?php echo isset($page_desc) ? $page_desc : "Discover Vaishveda: Luxury Ayurvedic formulations rooted in nature, refined by science, and crafted for you. Shop our pure Saffron, Aloe Vera, and Sandalwood rituals."; ?>">
  <meta name="keywords" content="Ayurvedic Skincare, Luxury Beauty, Vaishveda, Organic Haircare, Kumkumadi Oil, Aloe Vera Lotion, Sandalwood">
  <link rel="stylesheet" href="styles.css">
  <!-- Ionicons for luxury outline icons -->
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script type="nomodule" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  <?php if (isset($PRODUCTS_DB)): ?>
  <script>
    const PRODUCTS_DB = <?php echo json_encode($PRODUCTS_DB); ?>;
  </script>
  <?php endif; ?>
</head>
<body>

  <!-- Promotional Top Bar -->
  <div class="promo-bar" id="promoBar">
    <div class="promo-text" id="promoText">Free Shipping on all orders above ₹999</div>
  </div>

  <!-- Main Header -->
  <header class="main-header" id="mainHeader">
    <div class="container">
      <div class="header-top">
        <!-- Burger menu for mobile -->
        <button class="mobile-menu-toggle" id="mobileMenuToggle">
          <ion-icon name="menu-outline"></ion-icon>
        </button>

        <!-- Search box on left for desktop -->
        <div class="header-search-box" id="headerSearchBtn">
          <input type="text" placeholder="Search Vaishveda..." disabled>
          <button><ion-icon name="search-outline"></ion-icon></button>
        </div>

        <!-- Brand Logo & Tagline -->
        <div class="logo-container">
          <a href="index.php" class="logo">
            <img src="assets/logo_cropped.png" alt="Vaishveda Logo">
          </a>
          <div class="logo-tagline">
            <span>Rooted in Nature, Refined by Science.</span>
            <span>Crafted for You.</span>
          </div>
        </div>

        <!-- Actions Menu on Right -->
        <div class="header-actions">
          <!-- User Account Icon with dropdown widget -->
          <div style="position: relative;" id="headerUserWidget">
            <a href="account.php" class="action-icon-btn" id="headerAccountBtn">
              <ion-icon name="person-outline"></ion-icon>
            </a>
            <div class="account-dropdown-menu" id="headerAccountDropdown">
              <a href="account.php" class="account-dropdown-item"><ion-icon name="grid-outline"></ion-icon> Dashboard</a>
              <a href="account.php?tab=orders" class="account-dropdown-item"><ion-icon name="receipt-outline"></ion-icon> My Orders</a>
              <a href="account.php?tab=wishlist" class="account-dropdown-item"><ion-icon name="heart-outline"></ion-icon> Wishlist</a>
              <a href="#" class="account-dropdown-item" id="dropdownLogoutBtn" style="border-top: 1px solid var(--color-cream-dark); color: var(--color-sale);"><ion-icon name="log-out-outline"></ion-icon> Sign Out</a>
            </div>
          </div>
          <button class="action-icon-btn" id="wishlistToggleBtn">
            <ion-icon name="heart-outline"></ion-icon>
            <span class="badge" id="wishlistCount">0</span>
          </button>
          <button class="action-icon-btn" id="cartToggleBtn">
            <ion-icon name="bag-handle-outline"></ion-icon>
            <span class="badge" id="cartCount">0</span>
          </button>
        </div>
      </div>

      <!-- Navigation Links -->
      <nav class="nav-bar" id="navBar">
        <ul class="nav-menu">
          <li class="nav-item"><a href="shop.php" class="nav-link">New Arrivals</a></li>
          <li class="nav-item"><a href="shop.php?category=Bestseller" class="nav-link">Bestsellers</a></li>
          <li class="nav-item">
            <a href="shop.php?category=Skin" class="nav-link">Skin Care</a>
            <div class="nav-dropdown">
              <a href="shop.php?category=Skin" class="dropdown-link">All Skin Care</a>
              <a href="product.php?id=aloelotion" class="dropdown-link">Aloe Vera Lotion</a>
              <a href="product.php?id=kumkumadicream" class="dropdown-link">Sandalwood Face Cream</a>
            </div>
          </li>
          <li class="nav-item">
            <a href="shop.php?category=Hair" class="nav-link">Hair Care</a>
            <div class="nav-dropdown">
              <a href="shop.php?category=Hair" class="dropdown-link">All Hair Care</a>
              <a href="product.php?id=aloeconditioner" class="dropdown-link">Aloe Vera Conditioner</a>
              <a href="product.php?id=shampoo" class="dropdown-link">Anti-Dandruff Shampoo</a>
              <a href="product.php?id=herbalshampoo" class="dropdown-link">Ayurvedic Herbal Shampoo</a>
              <a href="product.php?id=antigreyingshampoo" class="dropdown-link">Anti-Greying Shampoo</a>
            </div>
          </li>
          <li class="nav-item"><a href="shop.php?category=Body" class="nav-link">Bath & Body</a></li>
          <li class="nav-item">
            <a href="shop.php?category=Kumkumadi" class="nav-link">Kumkumadi Essentials</a>
            <div class="nav-dropdown">
              <a href="shop.php?category=Kumkumadi" class="dropdown-link">All Kumkumadi</a>
              <a href="product.php?id=kumkumadi" class="dropdown-link">Facial Oils</a>
              <a href="product.php?id=kumkumadisoap" class="dropdown-link">Luxury Soaps</a>
            </div>
          </li>
          <li class="nav-item"><a href="story.php" class="nav-link">Our Story</a></li>
        </ul>
      </nav>
    </div>
  </header>
