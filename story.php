<?php
include 'db.php';
$page_title = "Our Story | Vaishveda Philosophy & Heritage";
$page_desc = "Discover how Vaishveda bridges traditional Ayurvedic wisdom and modern science to create premium organic skincare and haircare rituals.";
include 'header.php';
?>

  <!-- Page breadcrumbs & intro -->
  <section style="padding: 40px 0 20px; background-color: var(--color-white); border-bottom: 1px solid var(--color-cream-dark);">
    <div class="container">
      <div style="font-size: 11px; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 15px; opacity: 0.6;">
        <a href="index.php">Home</a> &nbsp;/&nbsp; <span style="color: var(--color-primary); font-weight: 500;">Our Story</span>
      </div>
      <h1 style="font-size: 2.5rem; color: var(--color-primary); text-transform: uppercase; font-family: var(--font-serif); text-align: center;">Our Story</h1>
    </div>
  </section>

  <!-- Content Section -->
  <section class="section-padding">
    <div class="container">
      
      <div class="story-intro">
        <div class="flourish-divider">
          <span>❖</span>
        </div>
        <p>Vaishveda was born from a simple observation and a heartfelt purpose. As a postgraduate student in Ayurveda, I gained a deep understanding of both the science of healthy skin and hair and the effects of modern lifestyles. Every day, I saw more people relying on chemical-laden cosmetics, sulfate-based shampoos, synthetic skincare, and artificial beauty products. While these products often promised quick results, they frequently left skin dull, hair dry and frizzy, and natural beauty compromised over time.</p>
      </div>

      <div class="story-grid">
        <!-- Row 1: Wisdom -->
        <div class="story-row">
          <div class="story-col-img">
            <img src="assets/story_about.jpg" alt="Ayurvedic Wisdom">
          </div>
          <div class="story-col-text">
            <h3>Choosing Nature Over Chemicals</h3>
            <p>What touched me the most was seeing people try to hide these concerns with even more makeup and chemical-based products, creating an endless cycle. I believed there had to be a better way.</p>
            <p>Inspired by the timeless wisdom of Ayurveda, I founded Vaishveda with a commitment to bringing nature back into everyday beauty. What began as a dream and a small beginning soon became a mission to create products using carefully selected natural ingredients that nourish, protect, and support healthy skin and hair.</p>
          </div>
        </div>

        <!-- Row 2: Science -->
        <div class="story-row" id="science">
          <div class="story-col-img">
            <img src="assets/hero_skincare.png" alt="Extraction Science">
          </div>
          <div class="story-col-text">
            <h3>Nature Meets Ayurveda & Modern Science</h3>
            <p>From face washes and creams to shampoos, conditioners, hair oils, serums, and face packs, every Vaishveda product is thoughtfully crafted to support healthy skin and hair. Our formulations combine the goodness of traditional Ayurvedic principles with modern scientific understanding to create products that fit naturally into everyday self-care routines.</p>
            <p>Every product reflects our dedication to quality, purity, and gentle care inspired by nature.</p>
          </div>
        </div>

        <!-- Row 3: Ethical -->
        <div class="story-row">
          <div class="story-col-img">
            <img src="assets/products/kumkumadi.jpg" alt="Ethical Harvesting">
          </div>
          <div class="story-col-text">
            <h3>Sharing Ayurvedic Beauty with the World</h3>
            <p>Our journey began as a small business, but our vision extends far beyond borders. We aspire to bring the timeless benefits of authentic Ayurvedic beauty to people around the world, showing that true beauty begins with healthy skin, healthy hair, and ingredients that work in harmony with nature.</p>
            <p>At Vaishveda, we believe skincare and haircare are more than cosmetics—they are daily rituals of self-care that celebrate purity, wellness, and confidence.</p>
            <p>This is only the beginning.</p>
            <p style="font-weight: 500; font-style: italic; color: var(--color-accent-dark);">From Nature. Backed by Ayurveda. Made with Care. Shared with the World.</p>
            <p style="font-size: 1.1rem; font-weight: 600; color: var(--color-primary);">Welcome to Vaishveda. 🌿✨</p>
          </div>
        </div>
      </div>

    </div>
  </section>

<?php include 'footer.php'; ?>
