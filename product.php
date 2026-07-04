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
