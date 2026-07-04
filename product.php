<?php
include 'db.php';

$product_id = isset($_GET['id']) ? $_GET['id'] : 'kumkumadi';
$product = null;
foreach ($PRODUCTS_DB as $p) {
  if ($p['id'] === $product_id) {
    $product = $p;
    break;
  }
}

if (!$product) {
  // Fallback to first product
  $product = $PRODUCTS_DB[0];
}

$page_title = $product['name'] . " | Vaishveda Luxury Ayurvedic";
$page_desc = $product['description'];

include 'header.php';
?>

  <!-- Page Breadcrumbs -->
  <section style="padding: 30px 0 10px; background-color: var(--color-white); border-bottom: 1px solid var(--color-cream-dark);">
    <div class="container">
      <div style="font-size: 11px; text-transform: uppercase; letter-spacing: 1px; opacity: 0.6;" id="detailBreadcrumbs">
        <a href="index.php">Home</a> &nbsp;/&nbsp; <a href="shop.php">Shop All</a> &nbsp;/&nbsp; <span style="color: var(--color-primary); font-weight: 500;" id="breadcrumbProduct"><?php echo $product['name']; ?></span>
      </div>
    </div>
  </section>

  <!-- Product Details Section -->
  <section class="section-padding">
    <div class="container">
      <div class="product-detail-wrapper">
        
        <!-- Left Side: Image Gallery -->
        <div class="product-gallery">
          <!-- Thumbnails -->
          <div class="gallery-thumbnails" id="galleryThumbs">
            <?php foreach ($product['images'] as $index => $img): ?>
              <button class="thumb-btn <?php echo $index === 0 ? 'active' : ''; ?>" onclick="updateGalleryImage(<?php echo $index; ?>)">
                <img src="<?php echo $img; ?>" alt="Thumbnail">
              </button>
            <?php endforeach; ?>
          </div>
          <!-- Main Image -->
          <div class="gallery-main">
            <button class="gallery-nav-btn prev-btn" onclick="navigateGallery(-1); event.stopPropagation();" aria-label="Previous image">
              <ion-icon name="chevron-back-outline"></ion-icon>
            </button>
            
            <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" id="galleryMainImg">
            
            <button class="gallery-nav-btn next-btn" onclick="navigateGallery(1); event.stopPropagation();" aria-label="Next image">
              <ion-icon name="chevron-forward-outline"></ion-icon>
            </button>
          </div>
        </div>

        <!-- Right Side: Details Info -->
        <div class="details-panel" id="productDetailsPanel">
          <p class="category" id="detailCategory"><?php echo $product['category'] === 'Hair' ? 'Hair Care' : ($product['category'] === 'Skin' ? 'Skin Care' : $product['category'] . ' Essentials'); ?></p>
          <h1 id="detailName"><?php echo $product['name']; ?></h1>
          
          <div class="rating" id="detailRating">
            ★★★★★ <span>(<?php echo $product['reviews'] ?: 'New'; ?> reviews)</span>
          </div>

          <div class="price-box" style="display: flex; align-items: center; gap: 12px; margin-bottom: 25px; border-bottom: 1px solid var(--color-cream-dark); padding-bottom: 20px;">
            <?php 
              $has_discount = isset($product['oldPrice']) && $product['oldPrice'] > $product['price'];
              $discount_percent = $has_discount ? round((($product['oldPrice'] - $product['price']) / $product['oldPrice']) * 100) : 0;
            ?>
            <span class="old-price" id="detailOldPrice" style="text-decoration: line-through; text-decoration-color: #d9534f; color: var(--color-charcoal-light); font-size: 1.2rem; opacity: 0.7; <?php if (!$has_discount) echo 'display: none;'; ?>">₹<?php echo $has_discount ? $product['oldPrice'] : ''; ?></span>
            <span class="price" id="detailPrice" style="font-size: 1.8rem; font-weight: 600; color: var(--color-primary);">₹<?php echo $product['price']; ?></span>
            <span class="discount-badge" id="detailDiscountBadge" style="background-color: #ffebeb; color: #d9534f; font-weight: 600; font-size: 0.9rem; padding: 4px 8px; border-radius: 4px; border: 1px solid #fad2d2; <?php if (!$has_discount) echo 'display: none;'; ?>"><?php echo $discount_percent; ?>% OFF</span>
          </div>

          <h4 class="description-label" style="font-family: var(--font-serif); font-size: 1.1rem; color: var(--color-primary); margin-top: 25px; margin-bottom: 8px; font-weight: 600;">Description</h4>
          <p class="description" id="detailDescription" style="margin-top: 0;">
            <?php echo $product['description']; ?>
          </p>

          <!-- Variant Selector -->
          <div class="variant-selector">
            <h4 class="variant-title">Select Volume</h4>
            <div class="variant-options" id="detailSizes">
              <?php foreach ($product['sizes'] as $index => $size): ?>
                <button class="size-btn <?php echo $index === 0 ? 'active' : ''; ?>" data-size="<?php echo $size; ?>"><?php echo $size; ?></button>
              <?php endforeach; ?>
            </div>
          </div>

          <!-- Purchase Quantity and Buy CTA -->
          <div class="purchase-actions">
            <div class="quantity-selector">
              <button class="qty-btn" id="qtyMinusBtn"><ion-icon name="remove-outline"></ion-icon></button>
              <input type="text" class="qty-input" id="qtyInput" value="1" readonly>
              <button class="qty-btn" id="qtyPlusBtn"><ion-icon name="add-outline"></ion-icon></button>
            </div>
            <button class="btn btn-primary" id="detailAddBagBtn">Add to Bag</button>
          </div>

          <!-- Accordions -->
          <div class="accordion" id="detailsAccordion">
            <!-- Accordion 1: Benefits -->
            <div class="accordion-item active">
              <button class="accordion-header">Product Benefits <span>+</span></button>
              <div class="accordion-content" style="max-height: 200px;">
                <div class="accordion-content-inner" id="accordionBenefits">
                  <?php foreach ($product['benefits'] as $benefit): ?>
                    • <?php echo $benefit; ?><br>
                  <?php endforeach; ?>
                </div>
              </div>
            </div>

            <!-- Accordion 2: How to use -->
            <div class="accordion-item">
              <button class="accordion-header">How To Use <span>+</span></button>
              <div class="accordion-content">
                <div class="accordion-content-inner" id="accordionUsage">
                  <?php echo $product['usage']; ?>
                </div>
              </div>
            </div>

            <!-- Accordion 3: Ingredients -->
            <div class="accordion-item">
              <button class="accordion-header">Pure Ingredients <span>+</span></button>
              <div class="accordion-content">
                <div class="accordion-content-inner" id="accordionIngredients">
                  <?php echo $product['ingredients']; ?>
                </div>
              </div>
            </div>
          </div>

        </div>

      </div>
    </div>
  </section>

  <!-- Customer Reviews & Ratings Section -->
  <section class="reviews-section section-padding" id="reviewsSection" style="background-color: var(--color-cream); border-top: 1px solid var(--color-cream-dark);">
    <div class="container">
      <div class="text-center" style="margin-bottom: 40px;">
        <h2 class="section-title">Customer Reviews</h2>
        <p class="section-subtitle">Read what our wellness community has to say</p>
      </div>

      <!-- Reviews Summary & Rating Card -->
      <div class="reviews-summary-card">
        <!-- Left Column: Average score -->
        <div class="summary-score-box">
          <div class="average-rating-num" id="reviewsAverageRating">4.9</div>
          <div class="stars-outer" style="margin: 10px 0;">
            <div class="stars-inner" id="reviewsAverageStars" style="width: 98%;"></div>
          </div>
          <div class="reviews-count-text" id="reviewsTotalCount">Based on Verified Reviews</div>
          <div class="trust-badge-text">Trusted by thousands of happy customers across India.</div>
        </div>

        <!-- Right Column: Breakdown progress bars -->
        <div class="summary-breakdown-box">
          <div class="rating-bar-row">
            <span class="star-label">5 ★</span>
            <div class="progress-bar-container">
              <div class="progress-bar-fill" id="bar5" style="width: 92%;"></div>
            </div>
            <span class="percentage-label" id="pct5">92%</span>
          </div>
          <div class="rating-bar-row">
            <span class="star-label">4 ★</span>
            <div class="progress-bar-container">
              <div class="progress-bar-fill" id="bar4" style="width: 6%;"></div>
            </div>
            <span class="percentage-label" id="pct4">6%</span>
          </div>
          <div class="rating-bar-row">
            <span class="star-label">3 ★</span>
            <div class="progress-bar-container">
              <div class="progress-bar-fill" id="bar3" style="width: 1%;"></div>
            </div>
            <span class="percentage-label" id="pct3">1%</span>
          </div>
          <div class="rating-bar-row">
            <span class="star-label">2 ★</span>
            <div class="progress-bar-container">
              <div class="progress-bar-fill" id="bar2" style="width: 0.5%;"></div>
            </div>
            <span class="percentage-label" id="pct2">0.5%</span>
          </div>
          <div class="rating-bar-row">
            <span class="star-label">1 ★</span>
            <div class="progress-bar-container">
              <div class="progress-bar-fill" id="bar1" style="width: 0.5%;"></div>
            </div>
            <span class="percentage-label" id="pct1">0.5%</span>
          </div>
        </div>

        <!-- Action Box -->
        <div class="summary-action-box">
          <p>Share your experience with our product!</p>
          <button class="btn btn-primary" id="openReviewFormBtn"><ion-icon name="create-outline"></ion-icon> Write a Review</button>
        </div>
      </div>

      <!-- Controls Block: Filter & Sort -->
      <div class="reviews-controls">
        <div class="filter-chips-container" id="filterChipsContainer">
          <button class="filter-chip active" data-filter="all">All Reviews</button>
          <button class="filter-chip" data-filter="5">5★</button>
          <button class="filter-chip" data-filter="4">4★</button>
          <button class="filter-chip" data-filter="3">3★</button>
          <button class="filter-chip" data-filter="2">2★</button>
          <button class="filter-chip" data-filter="1">1★</button>
          <button class="filter-chip" data-filter="photos">With Photos</button>
          <button class="filter-chip" data-filter="verified">Verified Buyers</button>
        </div>
        <div class="sort-selector-container">
          <label for="reviewSortSelect" style="font-size: 13px; font-weight: 500; color: var(--color-charcoal);">Sort by:</label>
          <select class="sort-select" id="reviewSortSelect">
            <option value="recent">Most Recent</option>
            <option value="highest">Highest Rated</option>
            <option value="lowest">Lowest Rated</option>
            <option value="helpful">Most Helpful</option>
          </select>
        </div>
      </div>

      <!-- Individual Reviews Cards Grid -->
      <div class="reviews-cards-grid" id="reviewsListContainer">
        <!-- Rendered dynamically via JS -->
      </div>
    </div>
  </section>

  <!-- Review Submission Modal Form -->
  <div class="review-modal-overlay" id="reviewFormModal">
    <div class="review-modal-card">
      <div class="modal-card-header">
        <h3>Submit Your Review</h3>
        <button class="modal-close-btn" id="closeReviewFormBtn"><ion-icon name="close-outline"></ion-icon></button>
      </div>
      <form id="customerReviewForm" class="review-form-content">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
          <div class="form-group">
            <label for="reviewName">Full Name *</label>
            <input type="text" id="reviewName" required placeholder="e.g. Priyanha Sen">
          </div>
          <div class="form-group">
            <label for="reviewEmail">Email Address *</label>
            <input type="email" id="reviewEmail" required placeholder="e.g. priya@gmail.com">
          </div>
        </div>

        <div class="form-group">
          <label>Overall Rating *</label>
          <div class="star-rating-selector" id="starSelectorContainer">
            <ion-icon name="star-outline" data-value="1"></ion-icon>
            <ion-icon name="star-outline" data-value="2"></ion-icon>
            <ion-icon name="star-outline" data-value="3"></ion-icon>
            <ion-icon name="star-outline" data-value="4"></ion-icon>
            <ion-icon name="star-outline" data-value="5"></ion-icon>
            <input type="hidden" id="reviewRatingVal" value="0" required>
          </div>
        </div>

        <div class="form-group">
          <label for="reviewTitle">Review Title *</label>
          <input type="text" id="reviewTitle" required placeholder="e.g. Miracle in a bottle! Highly recommend.">
        </div>

        <div class="form-group">
          <label for="reviewMessage">Review Comments *</label>
          <textarea id="reviewMessage" rows="4" required placeholder="Write your honest experience here... What did you like or dislike?"></textarea>
        </div>

        <div class="form-group">
          <label>Upload Product Photo (Optional)</label>
          <div class="file-upload-zone">
            <input type="file" id="reviewPhotoInput" accept="image/*" style="display: none;">
            <div class="upload-zone-prompt" id="uploadZonePrompt">
              <ion-icon name="cloud-upload-outline" style="font-size: 24px; color: var(--color-primary);"></ion-icon>
              <span>Click or drag image here to upload</span>
            </div>
            <div class="upload-preview-container" id="uploadPreviewContainer" style="display: none;">
              <img src="" id="uploadPreviewImg" alt="Upload Preview">
              <button type="button" class="remove-preview-btn" id="removePreviewBtn"><ion-icon name="trash-outline"></ion-icon></button>
            </div>
          </div>
        </div>

        <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 15px;">Submit Review</button>
      </form>
    </div>
  </div>

<?php if ($product['id'] === 'kumkumadisoap'): ?>
  <!-- FAQ Section for Kumkumadi Soap -->
  <section class="section-padding product-faq-section" style="background-color: var(--color-white); border-top: 1px solid var(--color-cream-dark); padding-bottom: 40px;">
    <div class="container">
      <div class="text-center" style="margin-bottom: 45px;">
        <h2 class="section-title" style="font-family: var(--font-serif); font-size: 2.2rem; color: var(--color-primary); margin-bottom: 10px;">Frequently Asked Questions</h2>
        <p class="section-subtitle" style="font-size: 14px; color: var(--color-charcoal-light);">Everything you need to know about Vaishveda Kumkumadi Soap</p>
      </div>
      
      <div class="faq-accordion-container" style="max-width: 800px; margin: 0 auto; display: flex; flex-direction: column; gap: 15px;">
        <!-- Q1 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q1. What is Vaishveda Kumkumadi Soap?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Vaishveda Kumkumadi Soap is a premium Ayurvedic glycerin soap enriched with Kumkumadi Oil, Saffron, Wild Turmeric, Sandalwood, Manjistha, and Licorice. It gently cleanses, nourishes, and enhances the skin's natural glow while leaving it soft and refreshed.
            </div>
          </div>
        </div>

        <!-- Q2 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q2. Which skin type is this soap suitable for?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              This soap is specially formulated for oily skin. It effectively removes excess oil and impurities without stripping the skin's natural moisture.
            </div>
          </div>
        </div>

        <!-- Q3 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q3. Can I use this soap every day?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Yes. It is gentle enough for daily use. For best results, use it twice daily, in the morning and at night.
            </div>
          </div>
        </div>

        <!-- Q4 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q4. What are the benefits of Kumkumadi Soap?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              <ul style="margin: 0; padding-left: 20px; display: flex; flex-direction: column; gap: 8px;">
                <li>Deeply cleanses the skin</li>
                <li>Removes excess oil</li>
                <li>Improves skin radiance</li>
                <li>Nourishes and moisturizes</li>
                <li>Leaves skin soft and refreshed</li>
                <li>Supports a healthy-looking complexion</li>
              </ul>
            </div>
          </div>
        </div>

        <!-- Q5 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q5. Does this soap brighten the skin?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Traditional Ayurvedic ingredients like Kumkumadi Oil, Saffron, Wild Turmeric, and Manjistha help improve the appearance of dull skin and promote a naturally radiant complexion. Individual results may vary.
            </div>
          </div>
        </div>

        <!-- Q6 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q6. Can it help with oily and acne-prone skin?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              The herbal ingredients help remove excess oil and keep pores clean, making it suitable for oily and acne-prone skin. This is a cosmetic product and not intended to treat medical skin conditions.
            </div>
          </div>
        </div>

        <!-- Q7 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q7. Is this soap suitable for both men and women?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Yes. Vaishveda Kumkumadi Soap is suitable for all adults regardless of gender.
            </div>
          </div>
        </div>

        <!-- Q8 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q8. Does it contain harsh chemicals?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              No. The product is:<br>
              ✓ Paraben Free<br>
              ✓ Sulfate Free<br>
              ✓ Cruelty Free
            </div>
          </div>
        </div>

        <!-- Q9 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q9. What are the key ingredients?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              <ul style="margin: 0; padding-left: 20px; display: flex; flex-direction: column; gap: 8px;">
                <li>Glycerin Soap Base</li>
                <li>Kumkumadi Oil</li>
                <li>Saffron Strands</li>
                <li>Wild Turmeric (Amba Haldi)</li>
                <li>Manjistha</li>
                <li>Sandalwood Powder</li>
                <li>Sandalwood Essential Oil</li>
                <li>Licorice Essential Oil</li>
                <li>Turmeric Oil</li>
                <li>Saffron Oil</li>
              </ul>
            </div>
          </div>
        </div>

        <!-- Q10 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q10. Can I use this soap on my face?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Yes. It is suitable for both face and body. If you have sensitive skin, perform a patch test before regular use.
            </div>
          </div>
        </div>

        <!-- Q11 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q11. How do I use the soap?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Wet your skin and the soap, create a rich lather, gently massage in circular motions, rinse thoroughly, and pat dry.
            </div>
          </div>
        </div>

        <!-- Q12 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q12. How should I store the soap?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Store in a cool, dry place away from direct sunlight. Keep the soap dry between uses to extend its life.
            </div>
          </div>
        </div>

        <!-- Q13 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q13. Is the soap cruelty-free?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Yes. Vaishveda Kumkumadi Soap is cruelty-free and is not tested on animals.
            </div>
          </div>
        </div>

        <!-- Q14 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q14. How long does one soap bar last?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              The lifespan depends on usage and storage. When stored properly in a dry soap dish, one bar typically lasts several weeks.
            </div>
          </div>
        </div>

        <!-- Q15 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q15. Why choose Vaishveda Kumkumadi Soap?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Vaishveda Kumkumadi Soap combines traditional Ayurvedic ingredients with modern skincare to provide gentle cleansing, nourishment, hydration, and a naturally radiant appearance. It is ideal for daily skincare and free from parabens and sulfates.
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

<?php endif; ?>

<?php if ($product['id'] === 'kumkumadi'): ?>
  <!-- FAQ Section for Kumkumadi Facial Oil -->
  <section class="section-padding product-faq-section" style="background-color: var(--color-white); border-top: 1px solid var(--color-cream-dark); padding-bottom: 40px;">
    <div class="container">
      <div class="text-center" style="margin-bottom: 45px;">
        <h2 class="section-title" style="font-family: var(--font-serif); font-size: 2.2rem; color: var(--color-primary); margin-bottom: 10px;">Frequently Asked Questions</h2>
        <p class="section-subtitle" style="font-size: 14px; color: var(--color-charcoal-light);">Everything you need to know about Vaishveda Kumkumadi Facial Oil</p>
      </div>
      
      <div class="faq-accordion-container" style="max-width: 800px; margin: 0 auto; display: flex; flex-direction: column; gap: 15px;">
        <!-- Q1 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            1. What is Vaishveda Kumkumadi Tail?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Vaishveda Kumkumadi Tail is a premium Ayurvedic facial oil crafted with traditional herbs and botanical oils including saffron, sandalwood, manjistha, licorice, almond oil, jojoba oil, sesame oil, olive oil, lotus stamen, and wild turmeric. It helps nourish the skin and enhance its natural glow.
            </div>
          </div>
        </div>

        <!-- Q2 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            2. What are the benefits of Kumkumadi Tail?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              <ul style="margin: 0; padding-left: 20px; display: flex; flex-direction: column; gap: 8px;">
                <li>Deeply nourishes skin</li>
                <li>Improves skin radiance</li>
                <li>Helps maintain soft and smooth skin</li>
                <li>Supports an even-looking complexion</li>
                <li>Lightweight daily facial oil</li>
              </ul>
            </div>
          </div>
        </div>

        <!-- Q3 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            3. Which skin types is it suitable for?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Suitable for normal, dry, combination, oily, and mature skin. Perform a patch test if you have sensitive skin.
            </div>
          </div>
        </div>

        <!-- Q4 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            4. Can I use Kumkumadi Tail every day?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Yes. Apply twice daily for the best skincare routine.
            </div>
          </div>
        </div>

        <!-- Q5 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            5. How do I use this facial oil?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Cleanse your face, apply 4–5 drops to the face and neck, and massage gently until absorbed.
            </div>
          </div>
        </div>

        <!-- Q6 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            6. Can I leave it overnight?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Yes. It can be used as an overnight facial oil for deep nourishment.
            </div>
          </div>
        </div>

        <!-- Q7 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            7. Is it suitable for men and women?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Yes. It is suitable for both men and women.
            </div>
          </div>
        </div>

        <!-- Q8 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            8. Does it help brighten the skin?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Traditional Ayurvedic ingredients like saffron, manjistha, sandalwood, and licorice help promote a naturally radiant and healthy-looking complexion. Individual results may vary.
            </div>
          </div>
        </div>

        <!-- Q9 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            9. Is it suitable for oily skin?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Yes. Use only a few drops for lightweight hydration.
            </div>
          </div>
        </div>

        <!-- Q10 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            10. What are the key ingredients?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Almond Oil, Jojoba Oil, Sesame Oil, Olive Oil, Sandalwood Powder, Vetiver Root, Rakta Chandan, Mulethi, Cardamom, Rose Petal, Orange Peel, Dashamool, Nagkesar, Vacha, Lodhra, Wild Turmeric, Lotus Stamen, Saffron Strands, and Manjistha.
            </div>
          </div>
        </div>

        <!-- Q11 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            11. Does it contain parabens or sulfates?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              No.<br>
              ✓ Paraben Free<br>
              ✓ Sulfate Free<br>
              ✓ Cruelty Free
            </div>
          </div>
        </div>

        <!-- Q12 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            12. Can I apply makeup after using it?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Yes. Allow the oil to absorb completely before applying makeup.
            </div>
          </div>
        </div>

        <!-- Q13 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            13. How should I store the product?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Store in a cool, dry place away from direct sunlight and keep the bottle tightly closed.
            </div>
          </div>
        </div>

        <!-- Q14 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            14. Can teenagers use this oil?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Yes. Teenagers can use it as part of their skincare routine. Patch testing is recommended for sensitive skin.
            </div>
          </div>
        </div>

        <!-- Q15 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            15. Why should I choose Vaishveda Kumkumadi Tail?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Vaishveda Kumkumadi Tail combines traditional Ayurvedic herbs with premium botanical oils to provide daily nourishment, hydration, and a naturally radiant appearance. It is free from parabens and sulfates and is cruelty-free.
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
<?php endif; ?>

<?php if ($product['id'] === 'aloeconditioner'): ?>
  <!-- FAQ Section for Aloe Vera Hair Conditioner -->
  <section class="section-padding product-faq-section" style="background-color: var(--color-white); border-top: 1px solid var(--color-cream-dark); padding-bottom: 40px;">
    <div class="container">
      <div class="text-center" style="margin-bottom: 45px;">
        <h2 class="section-title" style="font-family: var(--font-serif); font-size: 2.2rem; color: var(--color-primary); margin-bottom: 10px;">Frequently Asked Questions</h2>
        <p class="section-subtitle" style="font-size: 14px; color: var(--color-charcoal-light);">Everything you need to know about Vaishveda Aloe Vera Hair Conditioner</p>
      </div>
      
      <div class="faq-accordion-container" style="max-width: 800px; margin: 0 auto; display: flex; flex-direction: column; gap: 15px;">
        <!-- Q1 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q1. What is Vaishveda Aloe Vera Hair Conditioner?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Vaishveda Aloe Vera Hair Conditioner is a premium herbal conditioner enriched with Aloe Vera, nourishing botanical oils, natural butters, and hydrolyzed wheat protein. It deeply conditions hair while improving softness, shine, and manageability.
            </div>
          </div>
        </div>

        <!-- Q2 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q2. What are the main benefits?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              <ul style="margin: 0; padding-left: 20px; display: flex; flex-direction: column; gap: 8px;">
                <li>Deeply moisturizes dry hair</li>
                <li>Reduces frizz</li>
                <li>Improves softness</li>
                <li>Adds natural shine</li>
                <li>Strengthens hair fibers</li>
                <li>Improves manageability</li>
              </ul>
            </div>
          </div>
        </div>

        <!-- Q3 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q3. Which hair types is it suitable for?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Suitable for normal, dry, frizzy, curly, wavy, color-treated, and chemically treated hair.
            </div>
          </div>
        </div>

        <!-- Q4 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q4. Can I use it every day?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Yes. It is gentle enough for regular use after shampooing.
            </div>
          </div>
        </div>

        <!-- Q5 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q5. How do I use this conditioner?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              After shampooing, apply evenly from mid-length to hair ends. Leave for 2–3 minutes and rinse thoroughly.
            </div>
          </div>
        </div>

        <!-- Q6 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q6. Should I apply it on the scalp?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              For best results, apply mainly to the mid-lengths and ends of the hair.
            </div>
          </div>
        </div>

        <!-- Q7 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q7. Does it reduce frizz?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Yes. Its moisturizing ingredients help smooth the hair and reduce frizz.
            </div>
          </div>
        </div>

        <!-- Q8 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q8. Will it make my hair soft?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Yes. Aloe Vera, Shea Butter, Cocoa Butter, Mango Butter, Almond Oil, Coconut Oil, and Olive Oil help leave hair soft and silky.
            </div>
          </div>
        </div>

        <!-- Q9 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q9. Does it strengthen hair?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Hydrolyzed Wheat Protein helps support stronger, healthier-looking hair while reducing dryness.
            </div>
          </div>
        </div>

        <!-- Q10 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q10. Can men and women both use it?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Yes. It is suitable for both men and women.
            </div>
          </div>
        </div>

        <!-- Q11 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q11. Is it safe for colored or chemically treated hair?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Yes. It helps nourish and moisturize treated hair.
            </div>
          </div>
        </div>

        <!-- Q12 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q12. What are the key ingredients?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Aloe Vera Leaf Juice, Glycerin, Coconut Oil, Olive Oil, Sweet Almond Oil, Shea Butter, Mango Butter, Cocoa Butter, Hydrolyzed Wheat Protein, Cedarwood Oil, Lavender Oil, Peppermint Oil, and Tea Tree Oil.
            </div>
          </div>
        </div>

        <!-- Q13 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q13. Is it cruelty-free?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Yes. Vaishveda Aloe Vera Hair Conditioner is cruelty-free.
            </div>
          </div>
        </div>

        <!-- Q14 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q14. Is it made with natural ingredients?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Yes. It contains Aloe Vera, botanical oils, natural butters, and essential oils.
            </div>
          </div>
        </div>

        <!-- Q15 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q15. Will it make my hair greasy?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              No. When used as directed and rinsed properly, it leaves hair soft without feeling heavy.
            </div>
          </div>
        </div>

        <!-- Q16 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q16. Can teenagers use it?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Yes. It is suitable for teenagers and adults.
            </div>
          </div>
        </div>

        <!-- Q17 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q17. Does it improve hair shine?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Yes. Regular use helps enhance your hair's natural shine.
            </div>
          </div>
        </div>

        <!-- Q18 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q18. How often should I use it?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Use after every shampoo or 2–3 times per week depending on your hair care routine.
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
<?php endif; ?>

<?php if ($product['id'] === 'shampoo'): ?>
  <!-- FAQ Section for Anti-Dandruff Shampoo -->
  <section class="section-padding product-faq-section" style="background-color: var(--color-white); border-top: 1px solid var(--color-cream-dark); padding-bottom: 40px;">
    <div class="container">
      <div class="text-center" style="margin-bottom: 45px;">
        <h2 class="section-title" style="font-family: var(--font-serif); font-size: 2.2rem; color: var(--color-primary); margin-bottom: 10px;">Frequently Asked Questions</h2>
        <p class="section-subtitle" style="font-size: 14px; color: var(--color-charcoal-light);">Everything you need to know about Vaishveda Ayurvedic Anti-Dandruff Shampoo</p>
      </div>
      
      <div class="faq-accordion-container" style="max-width: 800px; margin: 0 auto; display: flex; flex-direction: column; gap: 15px;">
        <!-- Q1 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q1. What is Vaishveda Ayurvedic Anti-Dandruff Shampoo?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Vaishveda Ayurvedic Anti-Dandruff Shampoo is a premium herbal shampoo enriched with Neem Extract, Tulsi Extract, Aloe Vera Gel, Lavender Oil, and Tea Tree Oil. It gently cleanses the scalp while helping maintain a healthy, refreshed scalp and soft, manageable hair.
            </div>
          </div>
        </div>

        <!-- Q2 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q2. What are the benefits of this shampoo?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              <ul style="margin: 0; padding-left: 20px; display: flex; flex-direction: column; gap: 8px;">
                <li>Gently cleanses the scalp</li>
                <li>Helps reduce visible dandruff flakes</li>
                <li>Refreshes and soothes the scalp</li>
                <li>Nourishes hair from root to tip</li>
                <li>Helps reduce dryness and itchiness</li>
                <li>Leaves hair soft and manageable</li>
              </ul>
            </div>
          </div>
        </div>

        <!-- Q3 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q3. Which hair types is it suitable for?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Suitable for oily, dry, normal, combination, curly, straight, and wavy hair.
            </div>
          </div>
        </div>

        <!-- Q4 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q4. Can I use this shampoo every day?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Yes. It is gentle enough for regular use. Depending on your hair type, use it daily or 2–3 times per week.
            </div>
          </div>
        </div>

        <!-- Q5 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q5. How do I use this shampoo?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Wet your hair thoroughly, apply shampoo, massage gently into the scalp and hair, rinse thoroughly, and repeat if required.
            </div>
          </div>
        </div>

        <!-- Q6 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q6. What are the key herbal ingredients?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Neem Extract, Tulsi Extract, Aloe Vera Gel, Lavender Oil, Tea Tree Oil, and Liquid Castile Soap.
            </div>
          </div>
        </div>

        <!-- Q7 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q7. Does it help reduce dandruff?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Neem and Tea Tree Oil are traditionally used to help maintain a clean scalp and reduce visible dandruff with regular use. Individual results may vary.
            </div>
          </div>
        </div>

        <!-- Q8 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q8. Does it help soothe an itchy scalp?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Aloe Vera and Tulsi help keep the scalp hydrated and comfortable while supporting overall scalp health.
            </div>
          </div>
        </div>

        <!-- Q9 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q9. Is it suitable for men and women?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Yes. It is suitable for both men and women.
            </div>
          </div>
        </div>

        <!-- Q10 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q10. Is it suitable for color-treated hair?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Yes. The gentle herbal formula is suitable for most hair types, including color-treated and chemically treated hair.
            </div>
          </div>
        </div>

        <!-- Q11 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q11. Does it contain sulfates, parabens, or silicones?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              No.<br>
              ✓ Sulphate Free<br>
              ✓ Paraben Free<br>
              ✓ Silicone Free
            </div>
          </div>
        </div>

        <!-- Q12 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q12. Is it vegan?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Yes. The product is 100% Vegan.
            </div>
          </div>
        </div>

        <!-- Q13 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q13. Is it cruelty-free?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Yes. Vaishveda Ayurvedic Anti-Dandruff Shampoo is cruelty-free.
            </div>
          </div>
        </div>

        <!-- Q14 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q14. Can teenagers use it?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Yes. It is suitable for teenagers and adults. Avoid contact with the eyes.
            </div>
          </div>
        </div>

        <!-- Q15 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q15. Will it dry out my hair?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              No. Aloe Vera and herbal extracts help maintain moisture while cleansing.
            </div>
          </div>
        </div>

        <!-- Q16 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q16. Can I use it with conditioner?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Yes. For best results, follow with Vaishveda Hair Conditioner.
            </div>
          </div>
        </div>

        <!-- Q17 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q17. How often should I use it?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Use 2–4 times per week or as needed, depending on your scalp and hair care routine.
            </div>
          </div>
        </div>

        <!-- Q18 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q18. How should I store it?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Store in a cool, dry place away from direct sunlight. Keep the bottle tightly closed after use.
            </div>
          </div>
        </div>

        <!-- Q19 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q19. Why should I choose Vaishveda Ayurvedic Anti-Dandruff Shampoo?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Vaishveda combines traditional Ayurvedic herbs with a gentle cleansing formula that is Sulphate-Free, Paraben-Free, Silicone-Free, Vegan, Cruelty-Free, and suitable for regular use.
            </div>
          </div>
        </div>

        <!-- Q20 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q20. What makes this shampoo unique?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              It blends Neem, Tulsi, Aloe Vera, Lavender Oil, and Tea Tree Oil in a premium Ayurvedic formula designed to cleanse, nourish, and refresh the scalp while supporting healthy-looking hair.
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
<?php endif; ?>

<?php if ($product['id'] === 'herbalshampoo'): ?>
  <!-- FAQ Section for Ayurvedic Herbal Shampoo -->
  <section class="section-padding product-faq-section" style="background-color: var(--color-white); border-top: 1px solid var(--color-cream-dark); padding-bottom: 40px;">
    <div class="container">
      <div class="text-center" style="margin-bottom: 45px;">
        <h2 class="section-title" style="font-family: var(--font-serif); font-size: 2.2rem; color: var(--color-primary); margin-bottom: 10px;">Frequently Asked Questions</h2>
        <p class="section-subtitle" style="font-size: 14px; color: var(--color-charcoal-light);">Everything you need to know about Vaishveda Ayurvedic Herbal Shampoo</p>
      </div>
      
      <div class="faq-accordion-container" style="max-width: 800px; margin: 0 auto; display: flex; flex-direction: column; gap: 15px;">
        <!-- Q1 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q1. What is Vaishveda Ayurvedic Herbal Shampoo?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Vaishveda Ayurvedic Herbal Shampoo is a premium daily scalp care shampoo enriched with traditional Ayurvedic ingredients including Amla, Neem, Shikakai, Reetha, Aloe Vera, Black Sesame Seeds, and Rose Water. It gently cleanses the scalp while nourishing hair and promoting healthy-looking hair.
            </div>
          </div>
        </div>

        <!-- Q2 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q2. What are the benefits of this shampoo?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              <ul style="margin: 0; padding-left: 20px; display: flex; flex-direction: column; gap: 8px;">
                <li>Gently cleanses the scalp</li>
                <li>Removes dirt and excess oil</li>
                <li>Helps maintain a healthy scalp</li>
                <li>Leaves hair soft and manageable</li>
                <li>Nourishes hair with Ayurvedic herbs</li>
                <li>Suitable for regular use</li>
              </ul>
            </div>
          </div>
        </div>

        <!-- Q3 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q3. Which hair types is it suitable for?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Suitable for oily, dry, normal, combination, curly, straight, and wavy hair.
            </div>
          </div>
        </div>

        <!-- Q4 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q4. Can I use this shampoo every day?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Yes. It is formulated for daily scalp care and is gentle enough for regular use.
            </div>
          </div>
        </div>

        <!-- Q5 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q5. How do I use Vaishveda Herbal Shampoo?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Wet your hair thoroughly, apply shampoo to the scalp, massage gently, leave it on for about 2 minutes, rinse thoroughly, and repeat if required.
            </div>
          </div>
        </div>

        <!-- Q6 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q6. What are the key ingredients?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Amla, Neem, Shikakai, Reetha, Aloe Vera, Black Sesame Seeds, Rose Water, and other carefully selected ingredients inspired by Ayurvedic traditions.
            </div>
          </div>
        </div>

        <!-- Q7 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q7. Is this shampoo suitable for oily scalp?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Yes. It helps remove excess oil while maintaining the scalp's natural balance.
            </div>
          </div>
        </div>

        <!-- Q8 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q8. Does it help with dandruff?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Traditional Ayurvedic ingredients such as Neem and Reetha help keep the scalp clean and refreshed, supporting a healthy scalp with regular use. Individual results may vary.
            </div>
          </div>
        </div>

        <!-- Q9 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q9. Can it be used for itchy scalp?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Aloe Vera and Neem are traditionally used to soothe and refresh the scalp.
            </div>
          </div>
        </div>

        <!-- Q10 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q10. Does it help reduce hair fall?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              A healthy scalp supports healthy-looking hair. This shampoo gently cleanses and nourishes the scalp as part of a regular hair care routine. It is not intended to treat medical causes of hair loss.
            </div>
          </div>
        </div>

        <!-- Q11 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q11. Is it suitable for men and women?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Yes. It is suitable for both men and women.
            </div>
          </div>
        </div>

        <!-- Q12 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q12. Is it suitable for teenagers?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Yes. It is suitable for teenagers and adults.
            </div>
          </div>
        </div>

        <!-- Q13 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q13. Is it suitable for color-treated hair?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Yes. The gentle cleansing formula is suitable for most hair types, including color-treated hair.
            </div>
          </div>
        </div>

        <!-- Q14 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q14. Is it paraben-free?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Yes. According to the product label, it is Paraben-Free.
            </div>
          </div>
        </div>

        <!-- Q15 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q15. Is it silicone-free?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Yes. The shampoo is Silicone-Free.
            </div>
          </div>
        </div>

        <!-- Q16 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q16. Is it cruelty-free?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Yes. Vaishveda Ayurvedic Herbal Shampoo is Cruelty-Free.
            </div>
          </div>
        </div>

        <!-- Q17 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q17. How often should I use it?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Use daily or as needed based on your hair type and lifestyle.
            </div>
          </div>
        </div>

        <!-- Q18 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q18. How should I store it?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Store in a cool, dry place away from direct sunlight and keep the bottle tightly closed after use.
            </div>
          </div>
        </div>

        <!-- Q19 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q19. Can I use a conditioner after shampooing?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Yes. For best results, follow with a suitable Vaishveda Hair Conditioner to enhance softness and manageability.
            </div>
          </div>
        </div>

        <!-- Q20 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q20. Why should I choose Vaishveda Ayurvedic Herbal Shampoo?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Vaishveda Ayurvedic Herbal Shampoo combines time-tested Ayurvedic herbs with a gentle daily cleansing formula. It is cruelty-free, paraben-free, silicone-free, and crafted to support a clean, refreshed scalp and healthy-looking hair.
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
<?php endif; ?>

<?php if ($product['id'] === 'antigreyingshampoo'): ?>
  <!-- FAQ Section for Anti-Greying Hair Shampoo -->
  <section class="section-padding product-faq-section" style="background-color: var(--color-white); border-top: 1px solid var(--color-cream-dark); padding-bottom: 40px;">
    <div class="container">
      <div class="text-center" style="margin-bottom: 45px;">
        <h2 class="section-title" style="font-family: var(--font-serif); font-size: 2.2rem; color: var(--color-primary); margin-bottom: 10px;">Frequently Asked Questions</h2>
        <p class="section-subtitle" style="font-size: 14px; color: var(--color-charcoal-light);">Everything you need to know about Vaishveda Anti-Greying Hair Shampoo</p>
      </div>
      
      <div class="faq-accordion-container" style="max-width: 800px; margin: 0 auto; display: flex; flex-direction: column; gap: 15px;">
        <!-- Q1 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q1. What is Vaishveda Anti-Greying Hair Shampoo?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Vaishveda Anti-Greying Hair Shampoo is a premium Ayurvedic shampoo enriched with Bhringraj, Amla, Brahmi, Ritha, Neem, Curry Leaves, Indigo, Henna, Black Sesame Oil, Coconut Oil, and Glycerine. It gently cleanses while nourishing the scalp and helping maintain healthy-looking hair.
            </div>
          </div>
        </div>

        <!-- Q2 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q2. What are the benefits of this shampoo?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              <ul style="margin: 0; padding-left: 20px; display: flex; flex-direction: column; gap: 8px;">
                <li>Gently cleanses the scalp</li>
                <li>Nourishes hair from root to tip</li>
                <li>Hydrates and moisturizes</li>
                <li>Improves softness and shine</li>
                <li>Helps reduce dryness and frizz</li>
                <li>Supports stronger, healthier-looking hair</li>
              </ul>
            </div>
          </div>
        </div>

        <!-- Q3 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q3. Which hair types is it suitable for?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Suitable for dry, normal, oily, curly, straight, wavy, color-treated, and chemically treated hair.
            </div>
          </div>
        </div>

        <!-- Q4 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q4. Can I use this shampoo every day?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Yes. It is gentle enough for regular use. Depending on your hair type, you may use it daily or 2–3 times per week.
            </div>
          </div>
        </div>

        <!-- Q5 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q5. How do I use Vaishveda Anti-Greying Hair Shampoo?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Wet your hair thoroughly, apply the shampoo, massage gently into a rich lather, rinse thoroughly, and repeat if necessary. Follow with a conditioner for best results.
            </div>
          </div>
        </div>

        <!-- Q6 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q6. What are the key herbal ingredients?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Bhringraj, Amla, Brahmi, Ritha, Neem, Curry Leaves, Indigo, Henna, Black Sesame Oil, Coconut Oil, and Glycerine.
            </div>
          </div>
        </div>

        <!-- Q7 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q7. Does this shampoo help with premature greying?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Traditional Ayurvedic ingredients such as Bhringraj, Amla, Curry Leaves, Black Sesame Oil, Indigo, and Henna have long been used in hair care routines to help maintain healthy-looking, naturally vibrant hair. Individual results may vary.
            </div>
          </div>
        </div>

        <!-- Q8 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q8. Does it help strengthen hair?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Yes. The nourishing herbal ingredients help support stronger, healthier-looking hair as part of a regular hair care routine.
            </div>
          </div>
        </div>

        <!-- Q9 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q9. Does it help reduce hair fall?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Healthy scalp care supports healthy-looking hair. This shampoo gently cleanses and nourishes the scalp as part of a regular hair care routine. It is not intended to treat medical causes of hair loss.
            </div>
          </div>
        </div>

        <!-- Q10 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q10. Is it suitable for men and women?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Yes. It is suitable for both men and women.
            </div>
          </div>
        </div>

        <!-- Q11 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q11. Can teenagers use this shampoo?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Yes. It is suitable for teenagers and adults.
            </div>
          </div>
        </div>

        <!-- Q12 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q12. Is it suitable for color-treated hair?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Yes. Its gentle formula is suitable for most hair types, including color-treated hair.
            </div>
          </div>
        </div>

        <!-- Q13 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q13. Is it Paraben-Free?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Yes. According to the product label, it is Paraben-Free.
            </div>
          </div>
        </div>

        <!-- Q14 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q14. Is it Silicone-Free?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Yes. According to the product label, it is Silicone-Free.
            </div>
          </div>
        </div>

        <!-- Q15 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q15. Is it Cruelty-Free?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Yes. Vaishveda Anti-Greying Hair Shampoo is Cruelty-Free.
            </div>
          </div>
        </div>

        <!-- Q16 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q16. Is it made with natural ingredients?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Yes. It contains a blend of Ayurvedic herbs, botanical oils, and naturally inspired ingredients.
            </div>
          </div>
        </div>

        <!-- Q17 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q17. How often should I use it?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Use 2–4 times per week or according to your hair care routine.
            </div>
          </div>
        </div>

        <!-- Q18 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q18. How should I store the shampoo?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Store in a cool, dry place away from direct sunlight and keep the bottle tightly closed after use.
            </div>
          </div>
        </div>

        <!-- Q19 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q19. Can I use a conditioner after shampooing?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Yes. For best results, follow with a Vaishveda Hair Conditioner to improve softness and manageability.
            </div>
          </div>
        </div>

        <!-- Q20 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q20. Why should I choose Vaishveda Anti-Greying Hair Shampoo?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Vaishveda Anti-Greying Hair Shampoo combines time-tested Ayurvedic herbs with nourishing oils in a premium formula that gently cleanses, hydrates, and supports healthy-looking hair. It is made with natural ingredients and is Paraben-Free, Silicone-Free, and Cruelty-Free.
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
<?php endif; ?>

<?php if ($product['id'] === 'aloelotion'): ?>
  <!-- FAQ Section for Aloe Vera Body Lotion -->
  <section class="section-padding product-faq-section" style="background-color: var(--color-white); border-top: 1px solid var(--color-cream-dark); padding-bottom: 40px;">
    <div class="container">
      <div class="text-center" style="margin-bottom: 45px;">
        <h2 class="section-title" style="font-family: var(--font-serif); font-size: 2.2rem; color: var(--color-primary); margin-bottom: 10px;">Frequently Asked Questions</h2>
        <p class="section-subtitle" style="font-size: 14px; color: var(--color-charcoal-light);">Everything you need to know about Vaishveda Aloe Vera Body Lotion</p>
      </div>
      
      <div class="faq-accordion-container" style="max-width: 800px; margin: 0 auto; display: flex; flex-direction: column; gap: 15px;">
        <!-- Q1 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q1. What is Vaishveda Aloe Vera Body Lotion?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Vaishveda Aloe Vera Body Lotion is a premium herbal moisturizer enriched with Aloe Vera Gel, Vitamin E, Shea Butter, Virgin Coconut Oil, Olive Oil, and botanical oils. It provides deep hydration while helping maintain soft, smooth, and healthy-looking skin.
            </div>
          </div>
        </div>

        <!-- Q2 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q2. What are the benefits of this body lotion?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              <ul style="margin: 0; padding-left: 20px; display: flex; flex-direction: column; gap: 8px;">
                <li>Deeply moisturizes dry skin</li>
                <li>Soothes and comforts the skin</li>
                <li>Improves skin softness</li>
                <li>Supports skin elasticity</li>
                <li>Leaves skin smooth and nourished</li>
                <li>Lightweight, non-greasy formula</li>
              </ul>
            </div>
          </div>
        </div>

        <!-- Q3 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q3. Which skin types is it suitable for?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Suitable for dry, normal, combination, and mature skin. Those with sensitive skin should perform a patch test before regular use.
            </div>
          </div>
        </div>

        <!-- Q4 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q4. Can I use this lotion every day?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Yes. It is formulated for daily use and can be applied morning and evening for long-lasting hydration.
            </div>
          </div>
        </div>

        <!-- Q5 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q5. How do I use Vaishveda Aloe Vera Body Lotion?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Apply generously to clean, dry skin. Massage gently until fully absorbed. Use daily for the best results.
            </div>
          </div>
        </div>

        <!-- Q6 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q6. Is the lotion greasy?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              No. It has a lightweight, non-greasy formula that absorbs quickly into the skin.
            </div>
          </div>
        </div>

        <!-- Q7 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q7. Can I use it on my face?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              This lotion is primarily formulated for the body. If using it on the face, perform a patch test first or use a moisturizer specifically designed for facial skin.
            </div>
          </div>
        </div>

        <!-- Q8 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q8. What are the key ingredients?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Aloe Vera Gel, Vitamin E Oil, Virgin Coconut Oil, Olive Oil, Shea Butter, Glycerin, Rose Oil, Rosemary Oil, and Orange Oil.
            </div>
          </div>
        </div>

        <!-- Q9 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q9. Does Aloe Vera help soothe the skin?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Aloe Vera is traditionally used to hydrate and soothe the skin, leaving it feeling refreshed and comfortable.
            </div>
          </div>
        </div>

        <!-- Q10 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q10. Does this lotion help with dry skin?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Yes. Its moisturizing ingredients help replenish moisture and keep dry skin feeling soft and smooth with regular use.
            </div>
          </div>
        </div>

        <!-- Q11 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q11. Is it suitable for men and women?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Yes. Vaishveda Aloe Vera Body Lotion is suitable for both men and women.
            </div>
          </div>
        </div>

        <!-- Q12 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q12. Can teenagers use this lotion?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Yes. It is suitable for teenagers and adults.
            </div>
          </div>
        </div>

        <!-- Q13 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q13. Is it suitable for all seasons?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Yes. It provides year-round hydration and helps maintain soft, healthy-looking skin.
            </div>
          </div>
        </div>

        <!-- Q14 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q14. Does it improve skin elasticity?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Its nourishing ingredients help keep skin moisturized and supple, supporting healthy-looking skin over time.
            </div>
          </div>
        </div>

        <!-- Q15 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q15. Does it leave a sticky residue?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              No. The lotion absorbs quickly and leaves the skin feeling soft without a sticky or oily residue.
            </div>
          </div>
        </div>

        <!-- Q16 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q16. Is it cruelty-free?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Yes. Vaishveda Aloe Vera Body Lotion is Cruelty-Free.
            </div>
          </div>
        </div>

        <!-- Q17 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q17. Is it paraben-free?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Yes. According to the product label, it is Paraben-Free.
            </div>
          </div>
        </div>

        <!-- Q18 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q18. Does it contain organic ingredients?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Yes. The formula contains Aloe Vera and other botanical ingredients as highlighted on the product label.
            </div>
          </div>
        </div>

        <!-- Q19 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q19. How should I store the lotion?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Store in a cool, dry place away from direct sunlight and keep the container tightly closed after use.
            </div>
          </div>
        </div>

        <!-- Q20 -->
        <div class="faq-item" style="border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); overflow: hidden; background-color: var(--color-white);">
          <button class="faq-header" style="width: 100%; padding: 18px 25px; display: flex; justify-content: space-between; align-items: center; background: none; border: none; font-family: var(--font-serif); font-size: 1.1rem; font-weight: 600; color: var(--color-primary); text-align: left; cursor: pointer; transition: background-color 0.2s;">
            Q20. Why should I choose Vaishveda Aloe Vera Body Lotion?
            <ion-icon name="add-outline" style="font-size: 1.3rem; color: var(--color-accent); flex-shrink: 0; transition: transform 0.3s;"></ion-icon>
          </button>
          <div class="faq-body" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; background-color: var(--color-cream-light);">
            <div style="padding: 20px 25px; font-size: 14.5px; line-height: 1.6; color: var(--color-charcoal-light);">
              Vaishveda Aloe Vera Body Lotion combines Aloe Vera, Vitamin E, Shea Butter, Coconut Oil, Olive Oil, and botanical extracts to deliver deep hydration, natural softness, and a healthy glow. It features a lightweight, non-greasy formula and is made with organic ingredients while being Paraben-Free and Cruelty-Free.
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
<?php endif; ?>

<?php if ($product['id'] === 'kumkumadisoap' || $product['id'] === 'kumkumadi' || $product['id'] === 'aloeconditioner' || $product['id'] === 'shampoo' || $product['id'] === 'herbalshampoo' || $product['id'] === 'antigreyingshampoo' || $product['id'] === 'aloelotion'): ?>
  <!-- Common FAQ Accordion Toggle JavaScript -->
  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const headers = document.querySelectorAll(".faq-header");
      headers.forEach(header => {
        header.addEventListener("click", () => {
          const item = header.parentElement;
          const body = item.querySelector(".faq-body");
          const icon = header.querySelector("ion-icon");
          
          // Toggle active class
          const isOpen = item.classList.contains("active");
          
          // Close other active accordion items
          document.querySelectorAll(".faq-item").forEach(otherItem => {
            if (otherItem !== item) {
              otherItem.classList.remove("active");
              otherItem.querySelector(".faq-body").style.maxHeight = "0px";
              const otherIcon = otherItem.querySelector(".faq-header ion-icon");
              if (otherIcon) {
                otherIcon.setAttribute("name", "add-outline");
                otherIcon.style.transform = "rotate(0deg)";
              }
            }
          });
          
          if (isOpen) {
            item.classList.remove("active");
            body.style.maxHeight = "0px";
            if (icon) {
              icon.setAttribute("name", "add-outline");
              icon.style.transform = "rotate(0deg)";
            }
          } else {
            item.classList.add("active");
            body.style.maxHeight = body.scrollHeight + "px";
            if (icon) {
              icon.setAttribute("name", "remove-outline");
              icon.style.transform = "rotate(180deg)";
            }
          }
        });
      });
    });
  </script>
<?php endif; ?>

  <!-- Related Products Section -->
  <section class="section-padding" style="background-color: var(--color-white); border-top: 1px solid var(--color-cream-dark);">
    <div class="container">
      <div class="text-center">
        <h2 class="section-title">Related Rituals</h2>
        <p class="section-subtitle">Complement your beauty regime with these icons</p>
      </div>

      <div class="product-row" id="relatedProductsGrid">
        <!-- Generated Dynamically via JS in app.js -->
      </div>
    </div>
  </section>

  <!-- Lightbox Fullscreen Modal -->
  <div id="galleryLightbox" class="lightbox-modal" onclick="closeLightbox()">
    <button class="lightbox-close" onclick="closeLightbox()">&times;</button>
    <button class="lightbox-nav prev" onclick="navigateLightbox(-1); event.stopPropagation();" aria-label="Previous image"><ion-icon name="chevron-back-outline"></ion-icon></button>
    <div class="lightbox-content" onclick="event.stopPropagation()">
      <img id="lightboxImg" src="" alt="Enlarged product view">
    </div>
    <button class="lightbox-nav next" onclick="navigateLightbox(1); event.stopPropagation();" aria-label="Next image"><ion-icon name="chevron-forward-outline"></ion-icon></button>
  </div>

  <script>
  // Product image catalog populated from PHP database
  const productCatalogImages = <?php echo json_encode($product['images']); ?>;
  let currentGalleryIdx = 0;

  function updateGalleryImage(index) {
    currentGalleryIdx = index;
    const mainImg = document.getElementById('galleryMainImg');
    if (mainImg) {
      mainImg.src = productCatalogImages[index];
    }
    
    // Update active class on thumbnails
    const thumbnails = document.querySelectorAll('.gallery-thumbnails .thumb-btn');
    thumbnails.forEach((thumb, idx) => {
      if (idx === index) {
        thumb.classList.add('active');
        // Scroll thumbnail into view if needed
        thumb.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
      } else {
        thumb.classList.remove('active');
      }
    });
  }

  function navigateGallery(direction) {
    let nextIdx = currentGalleryIdx + direction;
    if (nextIdx >= productCatalogImages.length) {
      nextIdx = 0;
    } else if (nextIdx < 0) {
      nextIdx = productCatalogImages.length - 1;
    }
    updateGalleryImage(nextIdx);
  }

  // Fullscreen Lightbox logic
  function openLightbox() {
    const lightbox = document.getElementById('galleryLightbox');
    const lightboxImg = document.getElementById('lightboxImg');
    if (lightbox && lightboxImg) {
      lightboxImg.src = productCatalogImages[currentGalleryIdx];
      lightbox.classList.add('active');
      document.body.style.overflow = 'hidden'; // Lock background scrolling
    }
  }

  function closeLightbox() {
    const lightbox = document.getElementById('galleryLightbox');
    if (lightbox) {
      lightbox.classList.remove('active');
      document.body.style.overflow = ''; // Unlock background scrolling
    }
  }

  function navigateLightbox(direction) {
    let nextIdx = currentGalleryIdx + direction;
    if (nextIdx >= productCatalogImages.length) {
      nextIdx = 0;
    } else if (nextIdx < 0) {
      nextIdx = productCatalogImages.length - 1;
    }
    
    // Sync main gallery & update lightbox image
    updateGalleryImage(nextIdx);
    const lightboxImg = document.getElementById('lightboxImg');
    if (lightboxImg) {
      lightboxImg.src = productCatalogImages[nextIdx];
    }
  }

  document.addEventListener('DOMContentLoaded', () => {
    // Bind click event to main gallery image for zooming
    const mainImg = document.getElementById('galleryMainImg');
    if (mainImg) {
      mainImg.addEventListener('click', openLightbox);
    }
    
    // Keyboard accessibility support
    document.addEventListener('keydown', (e) => {
      const lightbox = document.getElementById('galleryLightbox');
      if (lightbox && lightbox.classList.contains('active')) {
        if (e.key === 'ArrowRight') {
          navigateLightbox(1);
        } else if (e.key === 'ArrowLeft') {
          navigateLightbox(-1);
        } else if (e.key === 'Escape') {
          closeLightbox();
        }
      }
    });
  });
  </script>

<?php include 'footer.php'; ?>
