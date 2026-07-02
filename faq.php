<?php
include 'db.php';
$page_title = "Frequently Asked Questions | Vaishveda Customer Support";
$page_desc = "Get answers to common queries regarding our Ayurvedic skin care, organic hair care formulations, shipping, and returns.";
include 'header.php';
?>

  <!-- Page Breadcrumbs -->
  <section class="account-breadcrumbs" style="padding: 30px 0 10px; background-color: var(--color-white); border-bottom: 1px solid var(--color-cream-dark);">
    <div class="container">
      <div style="font-size: 11px; text-transform: uppercase; letter-spacing: 1px; opacity: 0.6;">
        <a href="index.php">Home</a> &nbsp;/&nbsp; <span style="color: var(--color-primary); font-weight: 500;">Frequently Asked Questions</span>
      </div>
    </div>
  </section>

  <!-- FAQ Hero Section with Search -->
  <section class="faq-hero">
    <div class="container">
      <h1>Frequently Asked Questions</h1>
      <p>Have questions? We have answers. Search or browse our categories below.</p>
      
      <div class="faq-search-wrapper">
        <input type="text" class="faq-search-input" id="faqSearchInput" placeholder="Search FAQs...">
        <ion-icon name="search-outline" class="faq-search-icon"></ion-icon>
      </div>
      
      <div>
        <span class="faq-count-badge" id="faqCountDisplay">Showing FAQs</span>
      </div>
    </div>
  </section>

  <!-- FAQ Main Layout Grid -->
  <section class="section-padding" style="background-color: var(--color-cream); min-height: 500px;">
    <div class="container">
      <div class="faq-layout-grid">
        
        <!-- Sticky Sidebar Navigation -->
        <aside class="faq-sidebar">
          <ul class="faq-sidebar-menu" id="faqSidebarNav">
            <!-- Dynamic Category List will render here -->
          </ul>
        </aside>
        
        <!-- Accordion Cards Panel -->
        <main class="faq-accordion-panel" id="faqAccordionContainer">
          <!-- Dynamic Accordion Cards will render here -->
        </main>
        
      </div>
    </div>
  </section>

  <!-- Bottom CTA: "Still have questions?" -->
  <section class="faq-cta-section">
    <div class="container">
      <div class="faq-cta-box">
        <h3>Still have questions?</h3>
        <p>If you cannot find the answer to your query in our FAQs, please reach out to our dedicated support team.</p>
        <div class="faq-cta-buttons">
          <a href="index.php#contact-section" class="btn btn-primary"><ion-icon name="help-buoy-outline"></ion-icon> Contact Us</a>
          <a href="https://wa.me/message/NUOW33NFTUHNH1" target="_blank" class="btn btn-outline" style="border-color: #25D366; color: #25D366;"><ion-icon name="logo-whatsapp"></ion-icon> WhatsApp Support</a>
          <a href="mailto:vaishveda26@gmail.com" class="btn btn-outline"><ion-icon name="mail-outline"></ion-icon> Email Support</a>
        </div>
      </div>
    </div>
  </section>

<?php include 'footer.php'; ?>
