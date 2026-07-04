<?php
include 'db.php';
$page_title = "Shipping & Return Policy | Vaishveda Luxury Ayurvedic";
$page_desc = "Understand our shipping guidelines, domestic delivery timelines, order cancellations, and refunds policy.";
include 'header.php';
?>

  <!-- Page Breadcrumbs -->
  <section class="account-breadcrumbs" style="padding: 30px 0 10px; background-color: var(--color-white); border-bottom: 1px solid var(--color-cream-dark);">
    <div class="container">
      <div style="font-size: 11px; text-transform: uppercase; letter-spacing: 1px; opacity: 0.6;">
        <a href="index.php">Home</a> &nbsp;/&nbsp; <span style="color: var(--color-primary); font-weight: 500;">Shipping & Return Policy</span>
      </div>
    </div>
  </section>

  <!-- Hero Header Section -->
  <section class="policy-hero">
    <div class="container">
      <h1>Shipping & Return Policy</h1>
      <p>We are committed to delivering your VAISHVEDA products safely, quickly, and with complete transparency. Please read our shipping, return, refund, and cancellation policies below.</p>
    </div>
  </section>

  <!-- Main Policy Section -->
  <section class="section-padding" style="background-color: var(--color-cream); min-height: 500px;" id="policyContainer">
    <div class="container">
      <div class="policy-grid">
        
        <!-- Sticky Sidebar Navigation Table of Contents -->
        <aside class="policy-sidebar">
          <ul class="policy-toc-menu">
            <li class="policy-toc-item active"><a href="#shipping" class="policy-toc-link"><ion-icon name="bus-outline"></ion-icon> Shipping Policy</a></li>
            <li class="policy-toc-item"><a href="#returns" class="policy-toc-link"><ion-icon name="refresh-outline"></ion-icon> Returns Policy</a></li>
            <li class="policy-toc-item"><a href="#non-returnable" class="policy-toc-link"><ion-icon name="alert-circle-outline"></ion-icon> Exclusions</a></li>
            <li class="policy-toc-item"><a href="#refunds" class="policy-toc-link"><ion-icon name="card-outline"></ion-icon> Refund Policy</a></li>
            <li class="policy-toc-item"><a href="#cancellation" class="policy-toc-link"><ion-icon name="close-circle-outline"></ion-icon> Cancellations</a></li>
            <li class="policy-toc-item"><a href="#damaged-package" class="policy-toc-link"><ion-icon name="warning-outline"></ion-icon> Damaged Boxes</a></li>
            <li class="policy-toc-item"><a href="#contact" class="policy-toc-link"><ion-icon name="help-buoy-outline"></ion-icon> Support CMS</a></li>
          </ul>
        </aside>

        <!-- Main Cards Panel -->
        <main class="policy-panels">
          
          <!-- Card 1: Shipping Policy -->
          <article class="policy-card policy-section open" id="shipping">
            <div class="policy-card-header">
              <h3><ion-icon name="bus-outline"></ion-icon> Shipping Policy</h3>
              <span class="policy-accordion-indicator"><ion-icon name="chevron-down-outline"></ion-icon></span>
            </div>
            <div class="policy-card-body">
              <span class="badge-free-shipping">Free Shipping over ₹499</span>
              
              <h4>Order Processing</h4>
              <p id="shipProcessing">Loading processing info...</p>
              
              <h4>Shipping Time</h4>
              <table class="policy-table">
                <thead>
                  <tr>
                    <th>Location</th>
                    <th>Estimated Delivery</th>
                  </tr>
                </thead>
                <tbody id="shipTableBody">
                  <!-- Loaded dynamically -->
                </tbody>
              </table>
              <div class="policy-note">
                Delivery times are estimates and may vary depending on courier services, weather conditions, and other unforeseen circumstances.
              </div>

              <h4>Shipping Charges</h4>
              <p id="shipCharges">Loading shipping charges...</p>

              <h4>Order Tracking</h4>
              <p id="shipTracking">Loading tracking details...</p>

              <h4>Delivery Information</h4>
              <p id="shipDeliveryInfo">Loading delivery instructions...</p>
            </div>
          </article>

          <!-- Card 2: Return & Replacement Policy -->
          <article class="policy-card policy-section" id="returns">
            <div class="policy-card-header">
              <h3><ion-icon name="refresh-outline"></ion-icon> Return & Replacement Policy</h3>
              <span class="policy-accordion-indicator"><ion-icon name="chevron-down-outline"></ion-icon></span>
            </div>
            <div class="policy-card-body">
              <h4>Eligible Returns</h4>
              <p id="retEligibility">Loading returns eligibility...</p>

              <h4>Return Request</h4>
              <p id="retRequest">Loading request guidelines...</p>
              <div class="policy-note">
                Please email your return requests to: <strong><a href="#" class="ret-email-link">support@vaishveda.com</a></strong>
              </div>
            </div>
          </article>

          <!-- Card 3: Non-Returnable Products -->
          <article class="policy-card policy-section" id="non-returnable">
            <div class="policy-card-header">
              <h3><ion-icon name="alert-circle-outline"></ion-icon> Non-Returnable Products</h3>
              <span class="policy-accordion-indicator"><ion-icon name="chevron-down-outline"></ion-icon></span>
            </div>
            <div class="policy-card-body">
              <p id="nonReturnableText">Loading non-returnable categories...</p>
            </div>
          </article>

          <!-- Card 4: Refund Policy -->
          <article class="policy-card policy-section" id="refunds">
            <div class="policy-card-header">
              <h3><ion-icon name="card-outline"></ion-icon> Refund Policy</h3>
              <span class="policy-accordion-indicator"><ion-icon name="chevron-down-outline"></ion-icon></span>
            </div>
            <div class="policy-card-body">
              <h4>Refund Process</h4>
              <p id="refProcessing">Loading refund timelines...</p>

              <h4>Payment Method</h4>
              <p id="refMethod">Loading refund methods...</p>
            </div>
          </article>

          <!-- Card 5: Cancellation Policy -->
          <article class="policy-card policy-section" id="cancellation">
            <div class="policy-card-header">
              <h3><ion-icon name="close-circle-outline"></ion-icon> Cancellation Policy</h3>
              <span class="policy-accordion-indicator"><ion-icon name="chevron-down-outline"></ion-icon></span>
            </div>
            <div class="policy-card-body">
              <p id="cancellationText">Loading cancellation policy...</p>
            </div>
          </article>

          <!-- Card 6: Damaged Package Policy -->
          <article class="policy-card policy-section" id="damaged-package">
            <div class="policy-card-header">
              <h3><ion-icon name="warning-outline"></ion-icon> Damaged Package Policy</h3>
              <span class="policy-accordion-indicator"><ion-icon name="chevron-down-outline"></ion-icon></span>
            </div>
            <div class="policy-card-body">
              <p id="damagedPackageText">Loading damaged package guidelines...</p>
            </div>
          </article>

          <!-- Card 7: Contact Support -->
          <article class="policy-card policy-section" id="contact">
            <div class="policy-card-header">
              <h3><ion-icon name="help-buoy-outline"></ion-icon> Contact Support</h3>
              <span class="policy-accordion-indicator"><ion-icon name="chevron-down-outline"></ion-icon></span>
            </div>
            <div class="policy-card-body">
              <p>For any inquiries or issues related to shipping, returns, refunds, or cancellations, please contact us:</p>
              
              <div class="policy-contact-grid">
                <div class="policy-contact-subcard">
                  <ion-icon name="mail-outline"></ion-icon>
                  <h5>Email</h5>
                  <p><a href="#" id="contactEmailVal" class="ret-email-link">vaishveda26@gmail.com</a></p>
                </div>
                <div class="policy-contact-subcard">
                  <ion-icon name="globe-outline"></ion-icon>
                  <h5>Website</h5>
                  <p><a href="index.php" id="contactWebVal" target="_blank">vaishveda.com</a></p>
                </div>
                <div class="policy-contact-subcard">
                  <ion-icon name="logo-whatsapp"></ion-icon>
                  <h5>WhatsApp</h5>
                  <p id="contactPhoneVal">+91 919876543210</p>
                </div>
              </div>

              <div class="policy-cta-buttons">
                <a href="index.php#contact-section" class="btn btn-primary"><ion-icon name="help-buoy-outline"></ion-icon> Contact Support</a>
                <a href="#" id="contactMailBtn" class="btn btn-outline"><ion-icon name="mail-outline"></ion-icon> Email Us</a>
                <a href="#" id="contactWaBtn" target="_blank" class="btn btn-outline" style="border-color:#25D366; color:#25D366;"><ion-icon name="logo-whatsapp"></ion-icon> Chat on WhatsApp</a>
              </div>
            </div>
          </article>

          <!-- Last Updated Date stamp -->
          <div style="text-align: right; font-style: italic; font-size: 12px; color: #777; margin-top: 10px;" id="policyLastUpdated">
            Last Updated: June 26, 2026
          </div>

        </main>
      </div>
    </div>
  </section>

<?php include 'footer.php'; ?>
