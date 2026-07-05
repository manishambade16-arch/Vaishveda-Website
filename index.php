<?php
include 'db.php';
$page_title = "Vaishveda | Luxury Ayurvedic Skincare & Haircare Essentials";
$page_desc = "Discover Vaishveda: Luxury Ayurvedic formulations rooted in nature, refined by science, and crafted for you. Shop our pure Saffron, Aloe Vera, and Sandalwood rituals.";
include 'header.php';
?>

  <!-- Hero Slideshow Banner -->
  <section class="hero-slider" id="heroSlider">
    <!-- Slide 1: Anti-Dandruff Shampoo -->
    <div class="hero-slide active">
      <img src="assets/hero_tail.jpg" alt="Anti-Dandruff Shampoo Banner" class="hero-bg">
      <div class="hero-content">
        <a href="product.php?id=shampoo" class="btn btn-accent">Shop Now</a>
      </div>
    </div>

    <!-- Slide 2: Kumkumadi Tail -->
    <div class="hero-slide">
      <img src="assets/hero_shampoo.jpg" alt="Kumkumadi Tail Banner" class="hero-bg">
      <div class="hero-content">
        <a href="product.php?id=kumkumadi" class="btn btn-accent">Shop Now</a>
      </div>
    </div>

    <!-- Slide 3: Kumkumadi Soap -->
    <div class="hero-slide">
      <img src="assets/hero_soap.jpg" alt="Kumkumadi Soap Banner" class="hero-bg">
      <div class="hero-content">
        <a href="product.php?id=kumkumadisoap" class="btn btn-accent">Shop Now</a>
      </div>
    </div>

    <!-- Slider Controls -->
    <button class="slider-arrow prev" id="sliderPrevBtn"><ion-icon name="chevron-back-outline"></ion-icon></button>
    <button class="slider-arrow next" id="sliderNextBtn"><ion-icon name="chevron-forward-outline"></ion-icon></button>
    <div class="slider-dots" id="sliderDots"></div>
  </section>

  <!-- Brand Philosophy Section -->
  <section class="philosophy-section section-padding">
    <div class="container">
      <div class="philosophy-content">
        <h2 class="philosophy-title">Vaishveda</h2>
        <div class="flourish-divider">
          <span>❖</span>
        </div>
        <p class="philosophy-quote">"Rooted in nature, refined by science. Crafted for you."</p>
        <p class="philosophy-desc">We bridge ancient Ayurvedic botanical heritage with modern scientific extraction to create clean, luxury skincare and haircare rituals. Every formula is a tribute to pure ingredients sourced ethically from farmers across India.</p>
        <a href="story.php" class="btn btn-outline" style="border-color: var(--color-accent); color: var(--color-accent);">Discover Our Heritage</a>
      </div>
    </div>
  </section>

  <!-- Category Grid -->
  <section class="section-padding">
    <div class="container">
      <div class="text-center">
        <h2 class="section-title">Shop by Category</h2>
        <p class="section-subtitle">Specially curated botanical recipes for your daily rituals</p>
      </div>

      <div class="category-grid">
        <!-- Card 1 -->
        <div class="category-card">
          <img src="assets/products/aloe_lotion1.jpg" alt="Skin Care">
          <div class="category-card-content">
            <h3 class="category-card-title">Skin</h3>
            <a href="shop.php?category=Skin" class="category-card-btn">Explore Oils & Lotions</a>
          </div>
        </div>

        <!-- Card 2 -->
        <div class="category-card">
          <img src="assets/products/aloe_conditioner1.jpg" alt="Hair Care">
          <div class="category-card-content">
            <h3 class="category-card-title">Hair</h3>
            <a href="shop.php?category=Hair" class="category-card-btn">Explore Conditioners</a>
          </div>
        </div>

        <!-- Card 3 -->
        <div class="category-card">
          <img src="assets/products/kumkumadi_soap1.jpg" alt="Body Care">
          <div class="category-card-content">
            <h3 class="category-card-title">Body</h3>
            <a href="shop.php?category=Body" class="category-card-btn">Explore Luxury Soaps</a>
          </div>
        </div>

        <!-- Card 4 -->
        <div class="category-card">
          <img src="assets/products/kumkumadi.jpg" alt="Kumkumadi Essentials">
          <div class="category-card-content">
            <h3 class="category-card-title">Kumkumadi</h3>
            <a href="shop.php?category=Kumkumadi" class="category-card-btn">Explore Essentials</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Bestsellers Section -->
  <section class="section-padding" style="background-color: var(--color-white); border-top: 1px solid var(--color-cream-dark); border-bottom: 1px solid var(--color-cream-dark);">
    <div class="container">
      <div class="text-center">
        <h2 class="section-title">Vaishveda Icons</h2>
        <p class="section-subtitle">Our most loved Ayurvedic formulations</p>
      </div>

      <div class="product-row" id="iconsShelf">
        <?php
        $featured_ids = ["kumkumadi", "aloeconditioner", "aloelotion", "kumkumadicream"];
        foreach ($PRODUCTS_DB as $product) {
          if (in_array($product['id'], $featured_ids)) {
            $badge = "";
            $badgeClass = "";
            if ($product['id'] === 'kumkumadi' || $product['id'] === 'kumkumadicream') {
              $badge = "Bestseller";
            } elseif ($product['id'] === 'aloeconditioner') {
              $badge = "Sale";
              $badgeClass = "sale";
            } elseif ($product['id'] === 'aloelotion') {
              $badge = "New";
              $badgeClass = "sale";
            }
            ?>
            <div class="product-card">
              <?php if ($badge): ?>
                <span class="product-badge <?php echo $badgeClass; ?>"><?php echo $badge; ?></span>
              <?php endif; ?>
              <div class="product-image-container">
                <a href="product.php?id=<?php echo $product['id']; ?>">
                  <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" class="product-image">
                </a>
                <button class="product-quick-add" onclick="quickAddToBag('<?php echo $product['id']; ?>')">Add to Bag</button>
              </div>
              <div class="product-info">
                <p class="product-category"><?php echo $product['category'] === 'Hair' ? 'Hair Care' : ($product['category'] === 'Skin' ? 'Skin Care' : $product['category'] . ' Essentials'); ?></p>
                <h4 class="product-name"><a href="product.php?id=<?php echo $product['id']; ?>"><?php echo $product['name']; ?></a></h4>
                <div class="product-rating">★★★★★ <span>(<?php echo $product['reviews'] ?: 'New'; ?>)</span></div>
                <p class="product-price">
                  <?php if ($product['oldPrice'] > $product['price']): ?>
                    <span class="old-price">₹<?php echo $product['oldPrice']; ?></span>
                  <?php endif; ?>
                  ₹<?php echo $product['price']; ?>
                </p>
              </div>
            </div>
            <?php
          }
        }
        ?>
      </div>
    </div>
  </section>

  <!-- Ingredient Spotlight Section -->
  <section class="section-padding">
    <div class="container">
      <div class="text-center">
        <h2 class="section-title">Ingredient Spotlight</h2>
        <p class="section-subtitle">Pure botanicals sourced ethically at the peak of potency</p>
      </div>

      <div class="spotlight-grid">
        <!-- Saffron -->
        <div class="spotlight-card">
          <img src="assets/saffron_spotlight.jpg" alt="Kashmiri Saffron" class="spotlight-img">
          <div class="spotlight-info">
            <h4 class="spotlight-name">Kashmiri Saffron</h4>
            <p class="spotlight-tag">Kumkumadi</p>
            <p class="spotlight-desc">Harvested at dawn in Pampore, this premium saffron brightens skin complexions, reduces hyperpigmentation, and stimulates cell renewal for a natural glow.</p>
          </div>
        </div>

        <!-- Sandalwood -->
        <div class="spotlight-card">
          <img src="assets/sandalwood_spotlight.jpg" alt="Sandalwood" class="spotlight-img">
          <div class="spotlight-info">
            <h4 class="spotlight-name">Sandalwood</h4>
            <p class="spotlight-tag">Soothing & Cooling</p>
            <p class="spotlight-desc">Revered for its cooling properties, pure Sandalwood calms skin irritation, controls excess oil, and heals blemishes for a soft, even-toned complexion.</p>
          </div>
        </div>

        <!-- Aloe Vera -->
        <div class="spotlight-card">
          <img src="assets/aloe_spotlight.jpg" alt="Organic Aloe Vera" class="spotlight-img">
          <div class="spotlight-info">
            <h4 class="spotlight-name">Organic Aloe Vera</h4>
            <p class="spotlight-tag">Deep Hydration</p>
            <p class="spotlight-desc">Naturally rich in vitamins, minerals, and amino acids, our hand-filleted organic Aloe Vera intensely hydrates the scalp, repairs hair shafts, and conditions for frizz-free, smooth shine.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Premium Contact Us Section -->
  <section class="contact-section section-padding" id="contact-section">
    <div class="container">
      <div class="text-center">
        <h2 class="section-title">Contact Us</h2>
        <p class="section-subtitle">We're here to help. Reach out to us for product inquiries, support, or collaborations.</p>
      </div>

      <div class="contact-grid-cards">
        <!-- Email Card -->
        <a href="mailto:vaishveda26@gmail.com" class="contact-card-item">
          <div class="contact-card-icon">
            <ion-icon name="mail-outline"></ion-icon>
          </div>
          <h3>Email</h3>
          <p>vaishveda26@gmail.com</p>
          <span class="contact-card-action">Send an Email →</span>
        </a>

        <!-- WhatsApp Card -->
        <a href="https://wa.me/message/NUOW33NFTUHNH1" target="_blank" class="contact-card-item" id="whatsappContactLink">
          <div class="contact-card-icon">
            <ion-icon name="logo-whatsapp"></ion-icon>
          </div>
          <h3>WhatsApp</h3>
          <p>Chat with Us</p>
          <span class="contact-card-action">Start Chat →</span>
        </a>

        <!-- Website Card -->
        <a href="https://vaishveda.com" target="_blank" class="contact-card-item">
          <div class="contact-card-icon">
            <ion-icon name="globe-outline"></ion-icon>
          </div>
          <h3>Website</h3>
          <p>https://vaishveda.com</p>
          <span class="contact-card-action">Visit Website →</span>
        </a>

        <!-- Instagram Card -->
        <a href="https://www.instagram.com/vaishveda?igsh=YmVrZmQ1b2FzdXQx" target="_blank" class="contact-card-item">
          <div class="contact-card-icon">
            <ion-icon name="logo-instagram"></ion-icon>
          </div>
          <h3>Instagram</h3>
          <p>@vaishveda</p>
          <span class="contact-card-action">Follow Us →</span>
        </a>
      </div>
    </div>
  </section>

<?php include 'footer.php'; ?>
