/* ==========================================================================
   VAISHVEDA BRAND E-COMMERCE ENGINE (Vanilla JS)
   ========================================================================== */

// 1. PRODUCTS MOCK DATABASE
if (typeof PRODUCTS_DB === 'undefined') {
  window.PRODUCTS_DB = [
  {
    id: "kumkumadi",
    name: "Kumkumadi Facial Oil",
    category: "Kumkumadi",
    price: 599,
    oldPrice: 799,
    rating: 5,
    reviews: 148,
    image: "assets/hero_slide2.jpg",
    images: [
      "assets/hero_slide2.jpg",
      "assets/hero_slide1.jpg",
      "assets/kumkumadi_ingredients.jpg",
      "assets/kumkumadi_crueltyfree.jpg"
    ],
    description: "An iconic Ayurvedic formulation crafted with pure Kashmiri Saffron, Red Sandalwood, and natural extracts. It nourishes skin, reduces blemishes, improves skin tone, and restores youthful radiance.",
    benefits: [
      "Visibly brightens the skin tone and adds a golden glow.",
      "Fades dark spots, acne scars, and pigmentation.",
      "Hydrates deeply and prevents signs of premature aging.",
      "100% natural formula free of parabens and synthetic fragrances."
    ],
    usage: "Apply 3-4 drops on clean, damp face and neck. Gently massage upwards in circular motions until absorbed. Use daily at night as the last step in your skincare ritual for best results.",
    ingredients: "Pure Kashmiri Saffron (Kumkuma), Red Sandalwood (Rakta Chandana), Lotus extract (Kamala), Vetiver, Licorice, and Sesame Oil.",
    sizes: ["30ml", "50ml"],
    sizePrices: {
      "30ml": 599,
      "50ml": 899
    }
  },
  {
    id: "aloeconditioner",
    name: "Aloe Vera Hair Conditioner",
    category: "Hair",
    price: 149,
    oldPrice: 199,
    rating: 4.9,
    reviews: 120,
    image: "assets/products/aloe_conditioner1.jpg",
    images: [
      "assets/products/aloe_conditioner1.jpg",
      "assets/products/aloe_conditioner2.jpg"
    ],
    description: "A rich, ultra-nourishing botanical hair conditioner formulated with organic Aloe Vera Gel, Coconut Oil, Almond Oil, and Wheat Protein. It penetrates deep into the hair shafts to lock in moisture, repair split ends, and deliver smoothness and a high-gloss natural shine.",
    benefits: [
      "Intensely conditions, smooths frizz, and improves hair manageability.",
      "Repairs split ends and strengthens hair shafts with hydrolyzed wheat protein.",
      "Rich botanical oils (Coconut, Olive & Almond) lock in deep moisture.",
      "Calming organic Aloe Vera extract provides scalp hydration and reduces irritation."
    ],
    usage: "After shampooing, apply a generous amount to damp hair, focusing on the mid-lengths to the ends. Leave it on for 2-3 minutes. Rinse thoroughly with lukewarm water. Suitable for all hair types.",
    ingredients: "Organic Aloe Vera Juice, Coconut Oil, Olive Oil, Sweet Almond Oil, Shea Butter, Mango Butter, Cocoa Butter, Hydrolyzed Wheat Protein, Peppermint Oil, Lavender Oil, Tea Tree Oil, Cedarwood Oil.",
    sizes: ["150ml", "250ml", "500ml"],
    sizePrices: {
      "150ml": 149,
      "250ml": 299,
      "500ml": 499
    }
  },
  {
    id: "aloelotion",
    name: "Aloe Vera Body Lotion",
    category: "Skin",
    price: 149,
    oldPrice: 199,
    rating: 4.9,
    reviews: 85,
    image: "assets/products/aloe_lotion1.jpg",
    images: [
      "assets/products/aloe_lotion1.jpg",
      "assets/products/aloe_lotion2.jpg",
      "assets/products/aloe_lotion3.jpg"
    ],
    description: "A light, daily hydrating body lotion infused with organic Aloe Vera, Shea Butter, Sweet Almond Oil, and Vitamin E. It absorbs instantly without feeling greasy, soothing irritated skin and leaving it smooth and glowing.",
    benefits: [
      "Provides deep, long-lasting 24-hour skin hydration.",
      "Soothes dry skin, calms irritation, and reduces redness.",
      "Improves skin elasticity and restores natural texture.",
      "Non-greasy, fast-absorbing botanical formula."
    ],
    usage: "Massage all over body daily after bathing or whenever skin feels dry. Focus on dry areas like elbows, knees, and hands.",
    ingredients: "Organic Aloe Vera Gel, Shea Butter, Cocoa Butter, Sweet Almond Oil, Coconut Oil, Vitamin E, Lavender Oil, Rosemary Extract.",
    sizes: ["150ml", "250ml", "500ml"],
    sizePrices: {
      "150ml": 149,
      "250ml": 299,
      "500ml": 499
    }
  },
  {
    id: "kumkumadisoap",
    name: "Kumkumadi Soap",
    category: "Kumkumadi",
    price: 175,
    oldPrice: 250,
    rating: 4.9,
    reviews: 34,
    image: "assets/products/kumkumadi_soap1.jpg",
    images: [
      "assets/products/kumkumadi_soap1.jpg",
      "assets/products/kumkumadi_soap2.jpg",
      "assets/products/kumkumadi_soap3.jpg"
    ],
    description: "A divine, hand-crafted cleansing bar enriched with pure Kumkumadi Oil, Sandalwood Essential Oil, and Amba Haldi. It gently cleanses while maintaining the skin's natural moisture balance, revealing a radiant, brightened complexion.",
    benefits: [
      "Formulated with pure Kumkumadi Tailam to naturally brighten and illuminate skin tone.",
      "Gently exfoliates dead skin cells with wild turmeric strands and sandalwood powder.",
      "Rich glycerin base provides intense hydration, preventing dryness post-bath.",
      "Manjistha and Turmeric extract reduce pigmentation, blemishes, and dark spots."
    ],
    usage: "Lather the soap between wet palms or rub directly over wet body. Massage gently in circular motions for a few seconds to let the essential botanical oils absorb. Rinse thoroughly with water. Store in a dry soap dish.",
    ingredients: "Glycerin Soap Base, Saffron Strands, Amba Haldi Powder (Wild Turmeric), Manjistha Powder, Chandan Powder (Sandalwood Powder), Sandalwood Essential Oil, Liquorice Essential Oil, Manjistha Oil, Turmeric Oil, Saffron Oil, Kumkumadi Oil.",
    sizes: ["100g"],
    sizePrices: {
      "100g": 175
    }
  },
  {
    id: "kumkumadicream",
    name: "Sandalwood Face Cream",
    category: "Skin",
    price: 149,
    oldPrice: 199,
    rating: 4.9,
    reviews: 45,
    image: "assets/products/kumkumadi_cream3.jpg",
    images: [
      "assets/products/kumkumadi_cream3.jpg",
      "assets/products/kumkumadi_cream1.jpg",
      "assets/products/kumkumadi_cream2.jpg"
    ],
    description: "An absolute Ayurvedic masterpiece. This Sandalwood & Saffron Face Cream merges the cooling properties of pure Sandalwood with the brightening power of Kashmiri Saffron. It deeply hydrates, reduces pigmentation, controls sebum, and restores a natural, youthful radiance.",
    benefits: [
      "Reduces dark spots, pigmentation, and uneven skin tone.",
      "Deeply hydrates and restores skin elasticity with rich botanical oils.",
      "Cooling Sandalwood extract calms skin irritation and controls excess oil.",
      "Rich in antioxidants to combat signs of aging and environmental stress."
    ],
    usage: "Take a small pea-sized amount of the cream on your fingertips. Dot it all over clean face and neck. Massage gently in upward circular motions until fully absorbed. Use daily in the morning and night for ultimate radiance.",
    ingredients: "Pure Sandalwood Extract, Kashmiri Saffron (Kumkuma), Coconut Oil, Almond Oil, Olive Oil, Shea Butter, Lavender Oil, Rosemary Oil, Vitamin E.",
    sizes: ["50g", "100g"],
    sizePrices: {
      "50g": 149,
      "100g": 299
    }
  },
  {
    id: "shampoo",
    name: "Ayurvedic Anti-Dandruff Shampoo",
    category: "Hair",
    price: 199,
    oldPrice: 249,
    rating: 0,
    reviews: 0,
    image: "assets/products/anti_dandruff_shampoo1.jpg",
    images: [
      "assets/products/anti_dandruff_shampoo1.jpg",
      "assets/products/anti_dandruff_shampoo2.jpg"
    ],
    description: "A clinical-strength, botanical Ayurvedic Anti-Dandruff Shampoo designed to purify the scalp, eliminate flakes, and soothe irritation. Enriched with Neem, Tulsi, and Tea Tree Oil, it targets the root cause of dandruff while nourishing hair strands from root to tip.",
    benefits: [
      "Effectively reduces dandruff flakes and prevents future recurrence.",
      "Soothes dry, itchy, or irritated scalp with calming Aloe Vera and Lavender.",
      "Neem and Tulsi extracts act as natural purifying agents to deep-clean follicles.",
      "Tea Tree Oil controls excess sebum production without drying out strands."
    ],
    usage: "Wet hair thoroughly. Massage a small amount of shampoo into your scalp and hair. Leave it on for 2 minutes to let the botanical extracts absorb. Rinse thoroughly with lukewarm water. Follow with Vaishveda Hair Conditioner for best results.",
    ingredients: "Neem Extract, Tulsi Extract, Organic Aloe Vera Gel, Lavender Essential Oil, Tea Tree Essential Oil, Coconut Cleansing Base, Water.",
    sizes: ["150ml", "250ml", "500ml"],
    sizePrices: {
      "150ml": 199,
      "250ml": 299,
      "500ml": 699
    }
  },
  {
    id: "herbalshampoo",
    name: "Ayurvedic Herbal Shampoo",
    category: "Hair",
    price: 199,
    oldPrice: 249,
    rating: 0,
    reviews: 0,
    image: "assets/products/herbal_shampoo1.jpg",
    images: [
      "assets/products/herbal_shampoo1.jpg",
      "assets/products/herbal_shampoo2.jpg",
      "assets/products/herbal_shampoo3.jpg",
      "assets/products/herbal_shampoo4.jpg"
    ],
    description: "A botanical Ayurvedic Herbal Shampoo enriched with Amla, Neem, Shikakai, Reetha, Aloe Vera, and Black Sesame Seeds. It gently cleanses the scalp, nourishes the roots, reduces hair fall, and restores a natural, healthy shine.",
    benefits: [
      "Gently cleanses the scalp and removes impurities without stripping natural oils.",
      "Strengthens hair roots and helps reduce hair fall and premature greying.",
      "Promotes hair growth, soft texture, and a naturally shiny appearance.",
      "Aloe Vera hydrates the scalp, reducing dryness and irritation."
    ],
    usage: "Wet hair thoroughly. Apply a generous amount of shampoo and gently massage into the scalp and hair to create a rich lather. Leave it on for 1-2 minutes. Rinse thoroughly with water. Suitable for daily use and all hair types.",
    ingredients: "Amla (Emblica Officinalis), Neem (Azadirachta Indica), Shikakai (Acacia Concinna), Reetha (Sapindus Mukorossi), Organic Aloe Vera, Black Sesame Seeds (Sesamum Indicum), Coconut Cleansing Base, Purified Water.",
    sizes: ["150ml", "250ml", "500ml"],
    sizePrices: {
      "150ml": 199,
      "250ml": 349,
      "500ml": 599
    }
  },
  {
    id: "antigreyingshampoo",
    name: "Ayurvedic Anti-Greying Hair Shampoo",
    category: "Hair",
    price: 199,
    oldPrice: 249,
    rating: 0,
    reviews: 0,
    image: "assets/products/antigreying_shampoo1.jpg?v=2",
    images: [
      "assets/products/antigreying_shampoo1.jpg?v=2",
      "assets/products/antigreying_shampoo2.jpg?v=2",
      "assets/products/antigreying_shampoo3.jpg?v=2"
    ],
    description: "A rejuvenating Ayurvedic Anti-Greying Hair Shampoo designed to prevent premature greying, deeply nourish follicles, and promote dark, lustrous hair growth. Formulated with Bhringraj, Amla, Shikakai, and Black Sesame Oil, it restores natural pigmentation and adds a rich, healthy shine.",
    benefits: [
      "Helps reduce and prevent premature greying of hair.",
      "Deeply nourishes scalp and strengthens hair roots to reduce hair fall.",
      "Locks in moisture and conditions hair for a soft, smooth texture.",
      "Maintains natural hair color and adds a rich, healthy shine."
    ],
    usage: "Wet hair thoroughly. Apply shampoo and massage gently into the scalp and hair roots. Leave on for 2-3 minutes to allow the herbal extracts to absorb. Rinse thoroughly with water. Use regularly for best results.",
    ingredients: "Bhringraj, Amla, Ritha, Glycerine, Black Sesame Oil, Coconut Oil, Neem, Curry Leaves, Indigo, Heena.",
    sizes: ["150ml", "250ml", "500ml"],
    sizePrices: {
      "150ml": 199,
      "250ml": 399,
      "500ml": 599
    }
  }
];
}

// 2. STATE MANAGEMENT (LocalStorage-backed)
let cart = JSON.parse(localStorage.getItem("vaishveda_cart")) || [];
let wishlist = JSON.parse(localStorage.getItem("vaishveda_wishlist")) || [];

// 3. GLOBAL APPLICATION CONTROLLERS
document.addEventListener("DOMContentLoaded", () => {
  initTheme();
  initPromoBar();
  initStickyHeader();
  initDrawersAndModals();
  initSearchSystem();
  initWishlistSystem();
  updateCartBadge();
  updateHeaderUserWidget();

  // Dynamic Page Routing Handlers
  if (document.getElementById("heroSlider")) {
    initHeroSlider();
  }
  if (document.getElementById("iconsShelf")) {
    initHomePageRatings();
  }
  if (document.getElementById("shopGrid")) {
    initShopPage();
  }
  if (document.getElementById("productDetailsPanel")) {
    initProductDetailPage();
  }
  if (document.getElementById("authPortalSection") || document.getElementById("customerDashboardSection")) {
    initAccountPage();
  }
  if (document.getElementById("faqAccordionContainer")) {
    initFaqPage();
  }
  if (document.getElementById("policyContainer")) {
    initPolicyPage();
  }
  
  // Initialize contact section reveal animation
  initScrollReveal();
});

/* ==========================================================================
   GLOBAL COMPONENT INITIALIZERS
   ========================================================================== */

// Announcement Banner Rotations
function initPromoBar() {
  const promoText = document.getElementById("promoText");
  if (!promoText) return;

  const messages = [
    "Free Shipping on all orders above ₹499",
    "Use Code: VAISHVEDA10 for 10% off your first purchase"
  ];
  let index = 0;

  setInterval(() => {
    index = (index + 1) % messages.length;
    promoText.style.opacity = 0;
    setTimeout(() => {
      promoText.textContent = messages[index];
      promoText.style.opacity = 1;
    }, 400);
  }, 5000);
}

// Sticky Header effect
function initStickyHeader() {
  const header = document.getElementById("mainHeader");
  if (!header) return;

  const headerHeight = header.offsetHeight;

  window.addEventListener("scroll", () => {
    if (window.scrollY > 150) {
      header.classList.add("sticky");
      document.body.style.paddingTop = headerHeight + "px";
    } else {
      header.classList.remove("sticky");
      document.body.style.paddingTop = "0px";
    }
  });
}

// Drawer Overlay, Cart Toggle, Hamburger mobile menus
function initDrawersAndModals() {
  const overlay = document.getElementById("drawerOverlay");
  const cartDrawer = document.getElementById("cartDrawer");
  const cartToggle = document.getElementById("cartToggleBtn");
  const cartClose = document.getElementById("cartCloseBtn");
  const mobileToggle = document.getElementById("mobileMenuToggle");
  const navBar = document.getElementById("navBar");

  // Cart drawer toggles
  if (cartToggle && cartDrawer && overlay) {
    cartToggle.addEventListener("click", () => {
      renderCartItems();
      cartDrawer.classList.add("active");
      overlay.classList.add("active");
    });
  }

  const closeCart = () => {
    cartDrawer.classList.remove("active");
    if (!document.getElementById("searchOverlay").classList.contains("active")) {
      overlay.classList.remove("active");
    }
  };

  const checkoutFormModal = document.getElementById("checkoutFormModal");
  const checkoutFormCloseBtn = document.getElementById("checkoutFormCloseBtn");
  const checkoutDetailsForm = document.getElementById("checkoutDetailsForm");

  if (cartClose) cartClose.addEventListener("click", closeCart);
  if (overlay) overlay.addEventListener("click", () => {
    closeCart();
    closeSearch();
    if (checkoutFormModal) checkoutFormModal.classList.remove("active");
  });

  if (checkoutFormCloseBtn && checkoutFormModal) {
    checkoutFormCloseBtn.addEventListener("click", () => {
      checkoutFormModal.classList.remove("active");
      overlay.classList.remove("active");
    });
  }

  // Mobile navigation drawer toggle
  if (mobileToggle && navBar) {
    mobileToggle.addEventListener("click", () => {
      navBar.classList.toggle("active");
      mobileToggle.classList.toggle("active");
    });
  }

  const updateGpayQrCode = () => {
    const target = document.getElementById("detailsGpay");
    if (!target) return;
    const qrImg = target.querySelector(".gpay-qr-img");
    if (qrImg) {
      const total = cart.reduce((t, item) => t + (item.price * item.quantity), 0);
      const upiUri = `upi://pay?pa=vaishnavi166@federal&pn=VAISHNAVI%20CHANDRASHEKHAR%20MOHITKAR&am=${total}&cu=INR&tn=Order%20Payment`;
      qrImg.src = `https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=${encodeURIComponent(upiUri)}`;
      
      let amtText = target.querySelector(".upi-amount-text");
      if (!amtText) {
        amtText = document.createElement("p");
        amtText.className = "upi-amount-text";
        amtText.style.cssText = "margin-top: 8px; font-weight: 600; color: var(--color-primary); font-size: 14px; text-align: center;";
        const upiIdText = target.querySelector(".upi-id-text");
        if (upiIdText) {
          upiIdText.after(amtText);
        } else {
          target.querySelector(".qr-code-container").appendChild(amtText);
        }
      }
      amtText.innerHTML = `Amount to Pay: <strong>₹${total.toLocaleString("en-IN")}</strong>`;
    }
  };

  // Checkout Form Trigger
  const checkoutBtn = document.getElementById("checkoutBtn");
  const successModal = document.getElementById("checkoutSuccessModal");
  const modalClose = document.getElementById("modalCloseBtn");

  if (checkoutBtn && checkoutFormModal) {
    checkoutBtn.addEventListener("click", () => {
      if (cart.length === 0) {
        alert("Your bag is currently empty.");
        return;
      }
      cartDrawer.classList.remove("active");
      checkoutFormModal.classList.add("active");
      overlay.classList.add("active");
      updateGpayQrCode();
      if (typeof autofillCheckoutDetails === "function") {
        autofillCheckoutDetails();
      }
    });
  }

  // Handle Payment Method tab switching in Checkout Form
  const initPaymentMethodTabs = () => {
    const cards = document.querySelectorAll(".payment-method-card");
    const boxes = document.querySelectorAll(".payment-details-box");
    const gpayInput = document.getElementById("gpayTransactionId");
    const paypalInput = document.getElementById("paypalEmail");

    cards.forEach(card => {
      card.addEventListener("click", () => {
        // Toggle active card class
        cards.forEach(c => c.classList.remove("active"));
        card.classList.add("active");

        // Toggle active details box and input requirement
        const radio = card.querySelector('input[type="radio"]');
        if (radio) {
          radio.checked = true;
          const val = radio.value;

          boxes.forEach(box => {
            box.style.display = "none";
            box.classList.remove("active");
          });

          if (val === "COD") {
            const target = document.getElementById("detailsCod");
            if (target) {
              target.style.display = "block";
              target.classList.add("active");
            }
            if (gpayInput) { gpayInput.required = false; gpayInput.value = ""; }
            if (paypalInput) { paypalInput.required = false; paypalInput.value = ""; }
          } else if (val === "GPAY") {
            const target = document.getElementById("detailsGpay");
            if (target) {
              target.style.display = "block";
              target.classList.add("active");
            }
            if (gpayInput) gpayInput.required = true;
            if (paypalInput) { paypalInput.required = false; paypalInput.value = ""; }
            updateGpayQrCode();
          } else if (val === "PAYPAL") {
            const target = document.getElementById("detailsPaypal");
            if (target) {
              target.style.display = "block";
              target.classList.add("active");
            }
            if (gpayInput) { gpayInput.required = false; gpayInput.value = ""; }
            if (paypalInput) paypalInput.required = true;
          }
        }
      });
    });
  };

  initPaymentMethodTabs();

  // Checkout Form Submission (Placing Order)
  if (checkoutDetailsForm && checkoutFormModal && successModal) {
    checkoutDetailsForm.addEventListener("submit", (e) => {
      e.preventDefault();

      // Generate Order ID
      const orderId = `#VV-${Math.floor(10000 + Math.random() * 90000)}`;
      
      // Get Date
      const date = new Date().toLocaleString("en-IN", { hour12: false }).replace(/\//g, "-");

      // Extract Payment Method and Details
      const payMethodRadio = document.querySelector('input[name="paymentMethod"]:checked');
      const payMethod = payMethodRadio ? payMethodRadio.value : "COD";
      let paymentMethodName = "Cash on Delivery";
      let paymentDetails = "";
      let orderStatus = "Pending";

      if (payMethod === "GPAY") {
        paymentMethodName = "Google Pay (UPI)";
        paymentDetails = `TXN Ref: ${document.getElementById("gpayTransactionId").value}`;
        orderStatus = "Paid";
      } else if (payMethod === "PAYPAL") {
        paymentMethodName = "PayPal";
        paymentDetails = `Account: ${document.getElementById("paypalEmail").value}`;
        orderStatus = "Paid";
      }

      const subtotal = cart.reduce((total, item) => total + (item.price * item.quantity), 0);
      const shipping = subtotal < 499 ? 99 : 0;
      const total = subtotal + shipping;

      // Build Order Object
      const newOrder = {
        id: orderId,
        date: date,
        customer: {
          name: document.getElementById("checkoutName").value,
          email: document.getElementById("checkoutEmail").value,
          phone: document.getElementById("checkoutPhone").value,
          address: `${document.getElementById("checkoutAddress").value}, ${document.getElementById("checkoutCity").value}, ${document.getElementById("checkoutState").value} - ${document.getElementById("checkoutPincode").value}`
        },
        items: cart.map(item => ({
          id: item.id,
          name: item.name,
          image: item.image,
          size: item.size,
          price: item.price,
          quantity: item.quantity
        })),
        subtotal: subtotal,
        shipping: shipping,
        total: total,
        paymentMethod: paymentMethodName,
        paymentDetails: paymentDetails,
        status: orderStatus
      };

      // If user is logged in, link order to account and award loyalty points
      const activeUser = JSON.parse(sessionStorage.getItem("vaishveda_active_user")) || JSON.parse(localStorage.getItem("vaishveda_active_user")) || null;
      if (activeUser) {
        newOrder.userEmail = activeUser.email;
        let usersList = JSON.parse(localStorage.getItem("vaishveda_users")) || [];
        const uIdx = usersList.findIndex(u => u.email === activeUser.email);
        if (uIdx !== -1) {
          const pointsEarned = Math.floor(newOrder.total / 100) * 10;
          if (pointsEarned > 0) {
            usersList[uIdx].rewardPoints = (usersList[uIdx].rewardPoints || 0) + pointsEarned;
            if (!usersList[uIdx].walletTransactions) usersList[uIdx].walletTransactions = [];
            usersList[uIdx].walletTransactions.unshift({
              date: new Date().toLocaleDateString("en-IN"),
              type: `Earned on Order ${orderId}`,
              points: pointsEarned,
              balance: usersList[uIdx].rewardPoints
            });
            if (!usersList[uIdx].notifications) usersList[uIdx].notifications = [];
            usersList[uIdx].notifications.unshift({
              id: Date.now(),
              title: `Order ${orderId} Placed!`,
              message: `Your order has been logged. You earned ${pointsEarned} reward points!`,
              date: new Date().toLocaleDateString("en-IN"),
              read: false
            });
            
            // Sync activeUser
            activeUser.rewardPoints = usersList[uIdx].rewardPoints;
            activeUser.walletTransactions = usersList[uIdx].walletTransactions;
            activeUser.notifications = usersList[uIdx].notifications;
            const isLocal = !!localStorage.getItem("vaishveda_active_user");
            if (isLocal) {
              localStorage.setItem("vaishveda_active_user", JSON.stringify(activeUser));
            } else {
              sessionStorage.setItem("vaishveda_active_user", JSON.stringify(activeUser));
            }
            localStorage.setItem("vaishveda_users", JSON.stringify(usersList));
          }
        }
      }

      // Save to server-side MySQL database
      fetch("order_api.php?action=create", {
        method: "POST",
        headers: {
          "Content-Type": "application/json"
        },
        body: JSON.stringify(newOrder)
      })
      .then(res => res.json())
      .then(result => {
        if (!result.success) {
          console.error("Database save failed: ", result.message);
        }
      })
      .catch(err => {
        console.error("API error, saving to local storage fallback:", err);
      });

      // Keep backup in localStorage for offline/client fallback
      let orders = JSON.parse(localStorage.getItem("vaishveda_orders")) || [];
      orders.unshift(newOrder);
      localStorage.setItem("vaishveda_orders", JSON.stringify(orders));

      // Reset cart and form
      cart = [];
      saveCart();
      updateCartBadge();
      checkoutDetailsForm.reset();
      checkoutFormModal.classList.remove("active");

      // Reset payment tabs to GPAY default after submission
      const gpayCard = document.querySelector('.payment-method-card[for="payGpay"]');
      if (gpayCard) gpayCard.click();

      // Show success modal
      setTimeout(() => {
        const modalDesc = successModal.querySelector(".modal-desc");
        if (modalDesc) {
          modalDesc.innerHTML = `Thank you for shopping with Vaishveda. Your luxurious Ayurvedic self-care ritual is on its way to you.<br><br><strong>Order ID: ${orderId}</strong><br><strong>Payment Mode:</strong> ${paymentMethodName} ${paymentDetails ? '(' + paymentDetails + ')' : ''}<br><br>Keep this order ID for tracking your shipment.`;
        }
        successModal.classList.add("active");
        overlay.classList.add("active");
      }, 400);
    });
  }

  if (modalClose && successModal) {
    modalClose.addEventListener("click", () => {
      successModal.classList.remove("active");
      overlay.classList.remove("active");
      window.location.href = "shop.php";
    });
  }
}

// Search Modal functionality
function initSearchSystem() {
  const searchBtn = document.getElementById("headerSearchBtn");
  const searchOverlay = document.getElementById("searchOverlay");
  const searchClose = document.getElementById("searchCloseBtn");
  const searchInput = document.getElementById("searchInput");
  const resultsContainer = document.getElementById("searchResultsList");
  const overlay = document.getElementById("drawerOverlay");

  const openSearch = () => {
    searchOverlay.classList.add("active");
    overlay.classList.add("active");
    setTimeout(() => searchInput.focus(), 300);
  };

  window.closeSearch = () => {
    searchOverlay.classList.remove("active");
    if (!document.getElementById("cartDrawer").classList.contains("active")) {
      overlay.classList.remove("active");
    }
    searchInput.value = "";
    resultsContainer.innerHTML = "";
  };

  if (searchBtn) searchBtn.addEventListener("click", openSearch);
  if (searchClose) searchClose.addEventListener("click", window.closeSearch);

  // Search input filtration logic
  if (searchInput && resultsContainer) {
    searchInput.addEventListener("input", (e) => {
      const query = e.target.value.toLowerCase().trim();
      resultsContainer.innerHTML = "";

      if (query.length < 2) return;

      const filtered = PRODUCTS_DB.filter(p => 
        p.name.toLowerCase().includes(query) || 
        p.category.toLowerCase().includes(query) ||
        p.ingredients.toLowerCase().includes(query)
      );

      if (filtered.length === 0) {
        resultsContainer.innerHTML = `<div style="text-align:center; padding:20px; color:#888;">No products found for "${query}"</div>`;
        return;
      }

      filtered.forEach(p => {
        const item = document.createElement("div");
        item.className = "search-result-item";
        item.innerHTML = `
          <img src="${p.image}" alt="${p.name}" class="search-result-img">
          <div>
            <h5 class="search-result-name"><a href="product.php?id=${p.id}">${p.name}</a></h5>
            <small style="color:var(--color-accent-dark); text-transform:uppercase; font-size:9px;">${p.category}</small>
          </div>
          <div class="search-result-price">₹${p.price}</div>
        `;
        resultsContainer.appendChild(item);
      });
    });
  }
}

// Wishlist overlay toggle
function initWishlistSystem() {
  const wishlistBtn = document.getElementById("wishlistToggleBtn");
  const wishlistCount = document.getElementById("wishlistCount");

  const updateWishlistUI = () => {
    if (wishlistCount) wishlistCount.textContent = wishlist.length;
  };

  if (wishlistBtn) {
    wishlistBtn.addEventListener("click", () => {
      if (wishlist.length === 0) {
        alert("Your wishlist is currently empty. Visit the shop to add items!");
      } else {
        let listStr = "Your Wishlist Items:\n\n";
        wishlist.forEach(id => {
          const p = PRODUCTS_DB.find(item => item.id === id);
          if (p) listStr += `• ${p.name} (₹${p.price})\n`;
        });
        alert(listStr);
      }
    });
  }

  updateWishlistUI();
  window.toggleWishlist = (prodId) => {
    const idx = wishlist.indexOf(prodId);
    if (idx > -1) {
      wishlist.splice(idx, 1);
    } else {
      wishlist.push(prodId);
    }
    localStorage.setItem("vaishveda_wishlist", JSON.stringify(wishlist));
    updateWishlistUI();
  };
}

/* ==========================================================================
   CART SYSTEM OPERATIONS
   ========================================================================== */

function saveCart() {
  localStorage.setItem("vaishveda_cart", JSON.stringify(cart));
}

function updateCartBadge() {
  const cartCount = document.getElementById("cartCount");
  if (!cartCount) return;

  const totalQty = cart.reduce((total, item) => total + item.quantity, 0);
  cartCount.textContent = totalQty;
}

function quickAddToBag(prodId) {
  const product = PRODUCTS_DB.find(p => p.id === prodId);
  if (!product) return;

  // Add default size (first in array)
  const size = product.sizes[0];
  const price = product.sizePrices[size];

  addToCart(prodId, size, price, 1);
}

function addToCart(prodId, size, price, qty) {
  const product = PRODUCTS_DB.find(p => p.id === prodId);
  if (!product) return;

  const existingItem = cart.find(item => item.id === prodId && item.size === size);

  if (existingItem) {
    existingItem.quantity += qty;
  } else {
    cart.push({
      id: prodId,
      name: product.name,
      image: product.image,
      size: size,
      price: price,
      quantity: qty
    });
  }

  saveCart();
  updateCartBadge();
  renderCartItems();

  // Slide open the cart drawer
  document.getElementById("cartDrawer").classList.add("active");
  document.getElementById("drawerOverlay").classList.add("active");
}

function updateCartQty(prodId, size, newQty) {
  if (newQty < 1) {
    removeCartItem(prodId, size);
    return;
  }
  const item = cart.find(i => i.id === prodId && i.size === size);
  if (item) {
    item.quantity = newQty;
    saveCart();
    updateCartBadge();
    renderCartItems();
  }
}

function removeCartItem(prodId, size) {
  cart = cart.filter(item => !(item.id === prodId && item.size === size));
  saveCart();
  updateCartBadge();
  renderCartItems();
}

function renderCartItems() {
  const container = document.getElementById("cartItemsList");
  const subtotalText = document.getElementById("cartSubtotal");
  const totalText = document.getElementById("cartTotal");
  if (!container) return;

  container.innerHTML = "";

  if (cart.length === 0) {
    container.innerHTML = `
      <div class="cart-empty-message">
        <ion-icon name="basket-outline" style="font-size:3.5rem; color:var(--color-cream-dark); margin-bottom:15px; display:block;"></ion-icon>
        <p>Your shopping bag is empty.</p>
        <a href="shop.php" class="btn btn-outline" style="margin-top:20px; font-size:10px; padding:10px 20px;">Shop Our Rituals</a>
      </div>
    `;
    if (subtotalText) subtotalText.textContent = "₹0";
    if (totalText) totalText.textContent = "₹0";
    return;
  }

  let subtotal = 0;

  cart.forEach(item => {
    const itemTotal = item.price * item.quantity;
    subtotal += itemTotal;

    const card = document.createElement("div");
    card.className = "cart-item";
    card.innerHTML = `
      <img src="${item.image}" alt="${item.name}" class="cart-item-img">
      <div class="cart-item-info">
        <h5 class="cart-item-name">${item.name}</h5>
        <div class="cart-item-meta">Size: ${item.size}</div>
        <div class="cart-item-price">₹${item.price}</div>
        <div class="cart-item-actions">
          <div class="cart-item-qty">
            <button class="cart-item-qty-btn" onclick="updateCartQty('${item.id}', '${item.size}', ${item.quantity - 1})">-</button>
            <span class="cart-item-qty-val">${item.quantity}</span>
            <button class="cart-item-qty-btn" onclick="updateCartQty('${item.id}', '${item.size}', ${item.quantity + 1})">+</button>
          </div>
          <button class="remove-cart-item" onclick="removeCartItem('${item.id}', '${item.size}')">Remove</button>
        </div>
      </div>
    `;
    container.appendChild(card);
  });

  const shippingText = document.getElementById("cartShipping");
  let shipping = 0;
  if (subtotal > 0) {
    shipping = subtotal < 499 ? 99 : 0;
  }
  const total = subtotal + shipping;

  if (subtotalText) subtotalText.textContent = `₹${subtotal.toLocaleString("en-IN")}`;
  if (shippingText) {
    if (subtotal === 0) {
      shippingText.textContent = "₹0";
    } else {
      shippingText.textContent = shipping === 0 ? "FREE" : `₹${shipping}`;
    }
  }
  if (totalText) totalText.textContent = `₹${total.toLocaleString("en-IN")}`;
}

/* ==========================================================================
   HOMEPAGE SPECIFIC: HERO SLIDESHOW
   ========================================================================== */

function initHeroSlider() {
  const slides = document.querySelectorAll(".hero-slide");
  const prevBtn = document.getElementById("sliderPrevBtn");
  const nextBtn = document.getElementById("sliderNextBtn");
  const dotsContainer = document.getElementById("sliderDots");
  
  if (slides.length === 0) return;
  
  let currentSlide = 0;

  // Create dot controls
  slides.forEach((_, idx) => {
    const dot = document.createElement("button");
    dot.className = `slider-dot ${idx === 0 ? 'active' : ''}`;
    dot.addEventListener("click", () => goToSlide(idx));
    dotsContainer.appendChild(dot);
  });

  const dots = document.querySelectorAll(".slider-dot");

  const goToSlide = (idx) => {
    slides[currentSlide].classList.remove("active");
    dots[currentSlide].classList.remove("active");
    currentSlide = (idx + slides.length) % slides.length;
    slides[currentSlide].classList.add("active");
    dots[currentSlide].classList.add("active");
  };

  if (prevBtn) prevBtn.addEventListener("click", () => goToSlide(currentSlide - 1));
  if (nextBtn) nextBtn.addEventListener("click", () => goToSlide(currentSlide + 1));

  // Autoplay Hero banner
  setInterval(() => {
    goToSlide(currentSlide + 1);
  }, 6000);
}

/* ==========================================================================
   CATALOG PAGE SPECIFIC: shop.php
   ========================================================================== */

function initShopPage() {
  const grid = document.getElementById("shopGrid");
  const checkboxes = document.querySelectorAll(".filter-checkbox");
  const sortSelect = document.getElementById("sortSelect");
  const countText = document.getElementById("productCountText");

  if (!grid) return;

  // Parse filters from URL Query parameters (e.g. ?category=Face)
  const urlParams = new URLSearchParams(window.location.search);
  const catParam = urlParams.get("category");
  if (catParam) {
    checkboxes.forEach(box => {
      if (box.name === "category" && box.value === catParam) {
        box.checked = true;
      }
    });
  }

  const renderProducts = (products) => {
    grid.innerHTML = "";
    if (products.length === 0) {
      grid.innerHTML = `<div style="grid-column: span 3; text-align:center; padding:50px 0; color:#888;">No rituals match selected filters.</div>`;
      if (countText) countText.textContent = "Showing 0 products";
      return;
    }

    if (countText) countText.textContent = `Showing ${products.length} product${products.length > 1 ? 's' : ''}`;

    products.forEach(p => {
      const card = document.createElement("div");
      card.className = "product-card";
      
      const badgeHtml = p.oldPrice ? `<span class="product-badge sale">Sale</span>` : ``;
      const priceHtml = p.oldPrice 
        ? `<span class="old-price">₹${p.oldPrice.toLocaleString("en-IN")}</span> ₹${p.price.toLocaleString("en-IN")}`
        : `₹${p.price.toLocaleString("en-IN")}`;

      card.innerHTML = `
        ${badgeHtml}
        <div class="product-image-container">
          <a href="product.php?id=${p.id}">
            <img src="${p.image}" alt="${p.name}" class="product-image">
          </a>
          <button class="product-quick-add" onclick="quickAddToBag('${p.id}')">Add to Bag</button>
        </div>
        <div class="product-info">
          <p class="product-category">${p.category === "Kumkumadi" ? "Kumkumadi Essentials" : p.category + " Care"}</p>
          <h4 class="product-name"><a href="product.php?id=${p.id}">${p.name}</a></h4>
          <div class="product-rating">${getProductRatingStats(p.id).starsHtml} <span>(${getProductRatingStats(p.id).count})</span></div>
          <p class="product-price">${priceHtml}</p>
        </div>
      `;
      grid.appendChild(card);
    });
  };

  const filterAndSortProducts = () => {
    let filtered = [...PRODUCTS_DB];

    // 1. Category filter
    const activeCats = Array.from(document.querySelectorAll("input[name='category']:checked")).map(b => b.value);
    if (activeCats.length > 0) {
      filtered = filtered.filter(p => {
        const resolvedCats = [p.category];
        // Kumkumadi Soap belongs to both Kumkumadi Essentials and Bath & Body
        if (p.category === "Kumkumadi") {
          if (p.id === "kumkumadisoap") {
            resolvedCats.push("Body");
          }
        }
        return activeCats.some(cat => resolvedCats.includes(cat));
      });
    }

    // 2. Price filter
    const activePrices = Array.from(document.querySelectorAll("input[name='price']:checked")).map(b => b.value);
    if (activePrices.length > 0) {
      filtered = filtered.filter(p => {
        let match = false;
        activePrices.forEach(range => {
          if (range === "under-500" && p.price < 500) match = true;
          if (range === "500-1000" && p.price >= 500 && p.price <= 1000) match = true;
          if (range === "above-1000" && p.price > 1000) match = true;
        });
        return match;
      });
    }

    // 3. Sorting
    const sortVal = sortSelect.value;
    if (sortVal === "price-low") {
      filtered.sort((a, b) => a.price - b.price);
    } else if (sortVal === "price-high") {
      filtered.sort((a, b) => b.price - a.price);
    } else if (sortVal === "rating") {
      filtered.sort((a, b) => getProductRatingStats(b.id).rating - getProductRatingStats(a.id).rating);
    }

    renderProducts(filtered);
  };

  checkboxes.forEach(box => box.addEventListener("change", filterAndSortProducts));
  if (sortSelect) sortSelect.addEventListener("change", filterAndSortProducts);

  // Initial load
  filterAndSortProducts();
}

/* ==========================================================================
   PRODUCT DETAIL PAGE SPECIFIC: product.php
   ========================================================================== */

function initProductDetailPage() {
  const urlParams = new URLSearchParams(window.location.search);
  const prodId = urlParams.get("id") || "kumkumadi"; // Default to Kumkumadi Oil

  const product = PRODUCTS_DB.find(p => p.id === prodId);
  if (!product) {
    window.location.href = "shop.php";
    return;
  }

  // Bind values to UI Elements
  document.title = `${product.name} | Vaishveda`;
  const nameEl = document.getElementById("detailName");
  const categoryEl = document.getElementById("detailCategory");
  const priceEl = document.getElementById("detailPrice");
  const descEl = document.getElementById("detailDescription");
  const breadcrumbName = document.getElementById("breadcrumbProduct");
  const mainImage = document.getElementById("galleryMainImg");
  const thumbContainer = document.getElementById("galleryThumbs");

  if (nameEl) nameEl.textContent = product.name;
  if (categoryEl) categoryEl.textContent = product.category === "Kumkumadi" ? "Kumkumadi Essentials" : `${product.category} Care`;
  if (priceEl) priceEl.textContent = `₹${product.price.toLocaleString("en-IN")}`;
  if (descEl) descEl.textContent = product.description;
  if (breadcrumbName) breadcrumbName.textContent = product.name;
  if (mainImage) mainImage.src = product.image;

  // Render Thumbnails
  if (thumbContainer) {
    thumbContainer.innerHTML = "";
    // Use product-specific images array if defined, otherwise fall back to default
    const images = product.images || [product.image];
    images.forEach((imgSrc, idx) => {
      const thumb = document.createElement("div");
      thumb.className = `thumb-item ${idx === 0 ? 'active' : ''}`;
      thumb.innerHTML = `<img src="${imgSrc}" alt="Thumbnail ${idx}">`;
      thumb.addEventListener("click", () => {
        document.querySelectorAll(".thumb-item").forEach(t => t.classList.remove("active"));
        thumb.classList.add("active");
        mainImage.src = imgSrc;
      });
      thumbContainer.appendChild(thumb);
    });
  }

  // Populate Sizes options
  const sizesContainer = document.getElementById("detailSizes");
  let selectedSize = product.sizes[0];
  let selectedPrice = product.sizePrices[selectedSize];

  if (sizesContainer) {
    sizesContainer.innerHTML = "";
    product.sizes.forEach((size, idx) => {
      const btn = document.createElement("button");
      btn.className = `size-btn ${idx === 0 ? 'active' : ''}`;
      btn.textContent = size;
      btn.addEventListener("click", () => {
        document.querySelectorAll(".size-btn").forEach(b => b.classList.remove("active"));
        btn.classList.add("active");
        selectedSize = size;
        selectedPrice = product.sizePrices[size];
        priceEl.textContent = `₹${selectedPrice.toLocaleString("en-IN")}`;
      });
      sizesContainer.appendChild(btn);
    });
  }

  // Quantity controllers
  const qtyInput = document.getElementById("qtyInput");
  const minusBtn = document.getElementById("qtyMinusBtn");
  const plusBtn = document.getElementById("qtyPlusBtn");

  if (qtyInput && minusBtn && plusBtn) {
    minusBtn.addEventListener("click", () => {
      let qty = parseInt(qtyInput.value);
      if (qty > 1) qtyInput.value = qty - 1;
    });

    plusBtn.addEventListener("click", () => {
      let qty = parseInt(qtyInput.value);
      qtyInput.value = qty + 1;
    });
  }

  // Add to Bag trigger
  const addBagBtn = document.getElementById("detailAddBagBtn");
  if (addBagBtn) {
    addBagBtn.addEventListener("click", () => {
      const qty = parseInt(qtyInput.value);
      addToCart(product.id, selectedSize, selectedPrice, qty);
    });
  }

  // Populate Accordion content dynamically
  const benefitsEl = document.getElementById("accordionBenefits");
  const usageEl = document.getElementById("accordionUsage");
  const ingredientsEl = document.getElementById("accordionIngredients");

  if (benefitsEl) {
    benefitsEl.innerHTML = product.benefits.map(b => `• ${b}`).join("<br>");
  }
  if (usageEl) usageEl.textContent = product.usage;
  if (ingredientsEl) ingredientsEl.textContent = product.ingredients;

  // Accordion Expand/Collapse logic
  const accordionHeaders = document.querySelectorAll(".accordion-header");
  accordionHeaders.forEach(header => {
    header.addEventListener("click", () => {
      const item = header.parentElement;
      const content = header.nextElementSibling;
      const isActive = item.classList.contains("active");

      // Close all other accordion items
      document.querySelectorAll(".accordion-item").forEach(acc => {
        acc.classList.remove("active");
        acc.querySelector(".accordion-content").style.maxHeight = null;
      });

      if (!isActive) {
        item.classList.add("active");
        content.style.maxHeight = content.scrollHeight + "px";
      }
    });
  });

  // Render Related Products
  const relatedGrid = document.getElementById("relatedProductsGrid");
  if (relatedGrid) {
    const related = PRODUCTS_DB.filter(p => p.id !== product.id).slice(0, 4);
    relatedGrid.innerHTML = "";
    related.forEach(p => {
      const card = document.createElement("div");
      card.className = "product-card";
      card.innerHTML = `
        <div class="product-image-container">
          <a href="product.php?id=${p.id}">
            <img src="${p.image}" alt="${p.name}" class="product-image">
          </a>
          <button class="product-quick-add" onclick="quickAddToBag('${p.id}')">Add to Bag</button>
        </div>
        <div class="product-info">
          <p class="product-category">${p.category === "Kumkumadi" ? "Kumkumadi Essentials" : p.category + " Care"}</p>
          <h4 class="product-name"><a href="product.php?id=${p.id}">${p.name}</a></h4>
          <div class="product-rating">${getProductRatingStats(p.id).starsHtml} <span>(${getProductRatingStats(p.id).count})</span></div>
          <p class="product-price">₹${p.price}</p>
        </div>
      `;
      relatedGrid.appendChild(card);
    });
  }

  // Initialize Customer Reviews & Ratings section
  initProductReviews(product.id);
}

/* ==========================================================================
   THEME, USER ACCOUNT & AUTHENTICATION ENGINE
   ========================================================================== */

// 1. DEFAULT REGISTERED USERS SEED DATA
const DEFAULT_USERS = [
  {
    name: "Jane Doe",
    email: "user@example.com",
    phone: "9876543210",
    password: "Password123!",
    joinedDate: "2026-06-20",
    status: "Active",
    rewardPoints: 350,
    walletTransactions: [
      { date: "2026-06-20", type: "Signup Bonus", points: 100, balance: 100 },
      { date: "2026-06-21", type: "Order #VV-12847", points: 250, balance: 350 }
    ],
    addresses: [
      { name: "Jane Doe", phone: "9876543210", house: "A-12, Green Apartments", street: "Sector 62", city: "Noida", state: "Uttar Pradesh", pincode: "201301", country: "India", isDefault: true }
    ],
    cards: [
      { holder: "Jane Doe", number: "•••• •••• •••• 4321", expiry: "12/28" }
    ],
    notifications: [
      { id: 1, title: "Welcome to Vaishveda!", message: "Thank you for joining our luxury Ayurvedic circle. Enjoy 100 welcome reward points!", date: "2026-06-20", read: false }
    ],
    wishlist: ["kumkumadi", "aloelotion"],
    cart: []
  }
];

// Initialize users database in localStorage if empty
if (!localStorage.getItem("vaishveda_users")) {
  localStorage.setItem("vaishveda_users", JSON.stringify(DEFAULT_USERS));
}

// Initialize reviews database in localStorage if empty
const DEFAULT_REVIEWS = [];

// Clear old reviews with dummy IDs if present to start fresh
const storedReviews = JSON.parse(localStorage.getItem("vaishveda_reviews_db"));
if (storedReviews && storedReviews.some(r => r.id.startsWith("rev_") && !r.id.startsWith("rev_custom_"))) {
  localStorage.removeItem("vaishveda_reviews_db");
}

if (!localStorage.getItem("vaishveda_reviews_db")) {
  localStorage.setItem("vaishveda_reviews_db", JSON.stringify(DEFAULT_REVIEWS));
}

// Product Review Baselines (all set to 0 to remove dummy reviews)
const PRODUCT_REVIEW_BASELINES = {
  kumkumadi: {
    baseTotal: 0,
    baseAverage: 0.0,
    baseCounts: { 5: 0, 4: 0, 3: 0, 2: 0, 1: 0 }
  },
  aloeconditioner: {
    baseTotal: 0,
    baseAverage: 0.0,
    baseCounts: { 5: 0, 4: 0, 3: 0, 2: 0, 1: 0 }
  },
  aloelotion: {
    baseTotal: 0,
    baseAverage: 0.0,
    baseCounts: { 5: 0, 4: 0, 3: 0, 2: 0, 1: 0 }
  },
  kumkumadisoap: {
    baseTotal: 0,
    baseAverage: 0.0,
    baseCounts: { 5: 0, 4: 0, 3: 0, 2: 0, 1: 0 }
  },
  kumkumadicream: {
    baseTotal: 0,
    baseAverage: 0.0,
    baseCounts: { 5: 0, 4: 0, 3: 0, 2: 0, 1: 0 }
  },
  shampoo: {
    baseTotal: 0,
    baseAverage: 0.0,
    baseCounts: { 5: 0, 4: 0, 3: 0, 2: 0, 1: 0 }
  },
  herbalshampoo: {
    baseTotal: 0,
    baseAverage: 0.0,
    baseCounts: { 5: 0, 4: 0, 3: 0, 2: 0, 1: 0 }
  },
  antigreyingshampoo: {
    baseTotal: 0,
    baseAverage: 0.0,
    baseCounts: { 5: 0, 4: 0, 3: 0, 2: 0, 1: 0 }
  }
};

// Get dynamically calculated rating stats for product cards
function getProductRatingStats(productId) {
  const baseline = PRODUCT_REVIEW_BASELINES[productId] || {
    baseTotal: 0,
    baseAverage: 0.0,
    baseCounts: { 5: 0, 4: 0, 3: 0, 2: 0, 1: 0 }
  };
  
  const allDbReviews = JSON.parse(localStorage.getItem("vaishveda_reviews_db")) || [];
  const productReviews = allDbReviews.filter(r => r.productId === productId);
  
  const counts = { ...baseline.baseCounts };
  productReviews.forEach(r => {
    const rate = Math.round(r.rating);
    if (counts[rate] !== undefined) {
      counts[rate]++;
    }
  });
  
  const total = baseline.baseTotal + productReviews.length;
  if (total === 0) {
    return { rating: 0, count: 0, starsHtml: "☆☆☆☆☆" };
  }
  
  const totalSum = (counts[5]*5) + (counts[4]*4) + (counts[3]*3) + (counts[2]*2) + (counts[1]*1);
  const avg = totalSum / total;
  const rounded = Math.round(avg);
  
  let starsHtml = "";
  for (let i = 1; i <= 5; i++) {
    starsHtml += i <= rounded ? "★" : "☆";
  }
  
  return { rating: avg, count: total, starsHtml: starsHtml };
}

// Update homepage bestseller rating cards dynamically
function initHomePageRatings() {
  const shelf = document.getElementById("iconsShelf");
  if (!shelf) return;
  
  const cards = shelf.querySelectorAll(".product-card");
  cards.forEach(card => {
    const link = card.querySelector("a[href*='id=']");
    if (!link) return;
    const urlParams = new URLSearchParams(link.href.split("?")[1]);
    const prodId = urlParams.get("id");
    if (!prodId) return;
    
    const stats = getProductRatingStats(prodId);
    const ratingEl = card.querySelector(".product-rating");
    if (ratingEl) {
      ratingEl.innerHTML = `${stats.starsHtml} <span>(${stats.count})</span>`;
    }
  });
}

let currentProductReviewsFilter = "all";
let currentProductReviewsSort = "recent";
let reviewPhotoBase64 = null;

function renderReviews(productId) {
  const baseline = PRODUCT_REVIEW_BASELINES[productId] || {
    baseTotal: 10,
    baseAverage: 5.0,
    baseCounts: { 5: 10, 4: 0, 3: 0, 2: 0, 1: 0 }
  };

  fetch(`api.php?action=get_reviews&product_id=${encodeURIComponent(productId)}`)
    .then(res => res.json())
    .then(dbReviews => {
      if (!dbReviews || dbReviews.length === 0) {
        const allDbReviews = JSON.parse(localStorage.getItem("vaishveda_reviews_db")) || [];
        dbReviews = allDbReviews.filter(r => r.productId === productId);
      }
      displayProductReviews(dbReviews);
    })
    .catch(err => {
      console.error("Failed to load reviews from DB, fallback:", err);
      const allDbReviews = JSON.parse(localStorage.getItem("vaishveda_reviews_db")) || [];
      const dbReviews = allDbReviews.filter(r => r.productId === productId);
      displayProductReviews(dbReviews);
    });

  function displayProductReviews(productReviews) {
    // Compute rating totals
    const counts = { ...baseline.baseCounts };
    productReviews.forEach(r => {
      const rate = Math.round(r.rating);
      if (counts[rate] !== undefined) {
        counts[rate]++;
      }
    });

    const totalReviews = baseline.baseTotal + productReviews.length;
    const totalSum = (counts[5]*5) + (counts[4]*4) + (counts[3]*3) + (counts[2]*2) + (counts[1]*1);
    const averageRating = totalReviews > 0 ? (totalSum / totalReviews) : 0.0;
    const formattedAvg = averageRating.toFixed(1);

    // Update Summary UI elements
    const avgRatingNumEl = document.getElementById("reviewsAverageRating");
    const avgStarsEl = document.getElementById("reviewsAverageStars");
    const totalCountEl = document.getElementById("reviewsTotalCount");

    if (avgRatingNumEl) avgRatingNumEl.textContent = formattedAvg;
    if (avgStarsEl) {
      const starPct = (averageRating / 5) * 100;
      avgStarsEl.style.width = `${starPct}%`;
    }
    if (totalCountEl) {
      totalCountEl.textContent = `Based on ${totalReviews.toLocaleString("en-IN")} Verified Reviews`;
    }

    // Update detailRating in top header of product page
    const mainRatingEl = document.getElementById("detailRating");
    if (mainRatingEl) {
      let starsHtml = "";
      const roundedStars = Math.round(averageRating);
      for (let i = 1; i <= 5; i++) {
        starsHtml += i <= roundedStars ? "★" : "☆";
      }
      mainRatingEl.innerHTML = `${starsHtml} <span>(${totalReviews.toLocaleString("en-IN")} reviews)</span>`;
    }

    // Update breakdown bars
    for (let i = 1; i <= 5; i++) {
      const barEl = document.getElementById(`bar${i}`);
      const pctEl = document.getElementById(`pct${i}`);
      if (barEl && pctEl) {
        const pctVal = totalReviews > 0 ? ((counts[i] / totalReviews) * 100) : 0;
        const formattedPct = pctVal >= 1 ? `${Math.round(pctVal)}%` : `${pctVal.toFixed(1)}%`;
        barEl.style.width = `${pctVal}%`;
        pctEl.textContent = formattedPct;
      }
    }

    // Sort and filter the list of reviews shown in the cards list
    let displayReviews = [...productReviews];

    // Apply Filter
    if (currentProductReviewsFilter !== "all") {
      if (currentProductReviewsFilter === "photos") {
        displayReviews = displayReviews.filter(r => r.image !== null && r.image !== undefined && r.image !== "");
      } else if (currentProductReviewsFilter === "verified") {
        displayReviews = displayReviews.filter(r => r.verified === true);
      } else {
        const targetRating = parseInt(currentProductReviewsFilter);
        displayReviews = displayReviews.filter(r => r.rating === targetRating);
      }
    }

    // Apply Sorting
    if (currentProductReviewsSort === "recent") {
      displayReviews.sort((a, b) => new Date(b.date) - new Date(a.date));
    } else if (currentProductReviewsSort === "highest") {
      displayReviews.sort((a, b) => b.rating - a.rating);
    } else if (currentProductReviewsSort === "lowest") {
      displayReviews.sort((a, b) => a.rating - b.rating);
    } else if (currentProductReviewsSort === "helpful") {
      displayReviews.sort((a, b) => b.helpful - a.helpful);
    }

    // Render Cards
    const container = document.getElementById("reviewsCardsList");
    if (!container) return;
    container.innerHTML = "";

    if (displayReviews.length === 0) {
      container.innerHTML = `<div style="text-align:center; padding:30px; color:#888;">No reviews matching filter criteria.</div>`;
      return;
    }

    displayReviews.forEach(r => {
      const card = document.createElement("div");
      card.className = "review-card";
      
      let starsHtml = "";
      for (let i = 1; i <= 5; i++) {
        starsHtml += i <= r.rating ? "★" : "☆";
      }

      let imageHtml = "";
      if (r.image) {
        imageHtml = `<div class="review-image-preview"><img src="${r.image}" onclick="openImageLightbox('${r.image}')" alt="Review Photo"></div>`;
      }

      const isActiveLiked = localStorage.getItem(`vaishveda_liked_${r.id}`) ? "active" : "";

      card.innerHTML = `
        <div class="review-card-header">
          <div class="review-user-info">
            <span class="user-avatar-placeholder">${r.userName.charAt(0).toUpperCase()}</span>
            <div>
              <h5>${r.userName}</h5>
              ${r.verified ? '<span class="verified-buyer"><ion-icon name="checkmark-circle"></ion-icon> Verified Buyer</span>' : ''}
            </div>
          </div>
          <div class="review-meta">
            <div class="review-stars">${starsHtml}</div>
            <div class="review-date">${r.date}</div>
          </div>
        </div>
        <div class="review-product-purchased">Product Purchased: ${r.productName || 'Product'}</div>
        <div class="review-card-body">
          <h4>${r.title}</h4>
          <p>${r.comment}</p>
          ${imageHtml}
        </div>
        <div class="review-card-footer">
          <span class="was-helpful-text">Was this review helpful?</span>
          <button class="helpful-btn ${isActiveLiked}" onclick="likeReview('${r.id}', '${productId}')">
            <ion-icon name="thumbs-up-outline"></ion-icon> Helpful <span>(${r.helpful})</span>
          </button>
        </div>
      `;
      container.appendChild(card);
    });
  }
}

window.likeReview = function(reviewId, productId) {
  const likedKey = `vaishveda_liked_${reviewId}`;
  if (localStorage.getItem(likedKey)) {
    localStorage.removeItem(likedKey);
  } else {
    localStorage.setItem(likedKey, "true");
    if (!isNaN(reviewId)) {
      fetch("api.php?action=like_review", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ review_id: parseInt(reviewId) })
      })
      .then(res => res.json())
      .catch(err => console.error("Error liking review in DB:", err));
    }
  }

  // Update backup in local storage
  const reviews = JSON.parse(localStorage.getItem("vaishveda_reviews_db")) || [];
  const review = reviews.find(r => r.id == reviewId);
  if (review) {
    review.helpful = localStorage.getItem(likedKey) ? review.helpful + 1 : Math.max(0, review.helpful - 1);
    localStorage.setItem("vaishveda_reviews_db", JSON.stringify(reviews));
  }
  renderReviews(productId);
};

window.openImageLightbox = function(src) {
  window.open(src, "_blank");
};

function initProductReviews(productId) {
  // Bind controls
  const filterChips = document.querySelectorAll(".filter-chip");
  filterChips.forEach(chip => {
    chip.addEventListener("click", () => {
      filterChips.forEach(c => c.classList.remove("active"));
      chip.classList.add("active");
      currentProductReviewsFilter = chip.getAttribute("data-filter");
      renderReviews(productId);
    });
  });

  const sortSelect = document.getElementById("reviewSortSelect");
  if (sortSelect) {
    sortSelect.value = currentProductReviewsSort;
    sortSelect.addEventListener("change", (e) => {
      currentProductReviewsSort = e.target.value;
      renderReviews(productId);
    });
  }

  // Modal Setup
  const openFormBtn = document.getElementById("openReviewFormBtn");
  const closeFormBtn = document.getElementById("closeReviewFormBtn");
  const modalOverlay = document.getElementById("reviewFormModal");

  if (openFormBtn && modalOverlay) {
    openFormBtn.addEventListener("click", () => {
      modalOverlay.classList.add("active");
    });
  }

  if (closeFormBtn && modalOverlay) {
    closeFormBtn.addEventListener("click", () => {
      modalOverlay.classList.remove("active");
    });
  }

  // Star Rating Selector Logic
  const starIcons = document.querySelectorAll("#starSelectorContainer ion-icon");
  const ratingInput = document.getElementById("reviewRatingVal");
  if (starIcons && ratingInput) {
    starIcons.forEach(star => {
      star.addEventListener("click", () => {
        const val = parseInt(star.getAttribute("data-value"));
        ratingInput.value = val;
        starIcons.forEach(s => {
          const sVal = parseInt(s.getAttribute("data-value"));
          if (sVal <= val) {
            s.setAttribute("name", "star");
            s.classList.add("selected");
          } else {
            s.setAttribute("name", "star-outline");
            s.classList.remove("selected");
          }
        });
      });
    });
  }

  // Photo upload logic
  const fileInput = document.getElementById("reviewPhotoInput");
  const uploadPrompt = document.getElementById("uploadZonePrompt");
  const previewContainer = document.getElementById("uploadPreviewContainer");
  const previewImg = document.getElementById("uploadPreviewImg");
  const removeBtn = document.getElementById("removePreviewBtn");

  const uploadZone = document.querySelector(".file-upload-zone");
  if (uploadZone && fileInput) {
    uploadZone.addEventListener("click", () => {
      fileInput.click();
    });
  }

  if (fileInput) {
    fileInput.addEventListener("change", (e) => {
      const file = e.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function(evt) {
          reviewPhotoBase64 = evt.target.result;
          if (previewImg) previewImg.src = reviewPhotoBase64;
          if (uploadPrompt) uploadPrompt.style.display = "none";
          if (previewContainer) previewContainer.style.display = "block";
        };
        reader.readAsDataURL(file);
      }
    });
  }

  if (removeBtn) {
    removeBtn.addEventListener("click", (e) => {
      e.stopPropagation();
      if (fileInput) fileInput.value = "";
      reviewPhotoBase64 = null;
      if (uploadPrompt) uploadPrompt.style.display = "flex";
      if (previewContainer) previewContainer.style.display = "none";
    });
  }

  // Form submit handler
  const form = document.getElementById("customerReviewForm");
  if (form) {
    form.addEventListener("submit", (e) => {
      e.preventDefault();
      const name = document.getElementById("reviewName").value;
      const email = document.getElementById("reviewEmail").value;
      const rating = parseInt(document.getElementById("reviewRatingVal").value);
      const title = document.getElementById("reviewTitle").value;
      const comment = document.getElementById("reviewMessage").value;

      if (rating === 0) {
        alert("Please select a star rating by clicking on the stars.");
        return;
      }

      const product = PRODUCTS_DB.find(p => p.id === productId);

      // Save to server-side MySQL database
      const reviewPayload = {
        productId: productId,
        userName: name,
        rating: rating,
        title: title,
        comment: comment,
        date: new Date().toISOString().split("T")[0],
        verified: true
      };

      fetch("api.php?action=create_review", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(reviewPayload)
      })
      .then(res => res.json())
      .then(result => {
        if (result.success) {
          renderReviews(productId);
        } else {
          console.error("Failed to save review in DB:", result.message);
        }
      })
      .catch(err => {
        console.error("API error saving review:", err);
      });

      const newReview = {
        id: `rev_custom_${Date.now()}`,
        productId: productId,
        name: name,
        rating: rating,
        date: new Date().toISOString().split("T")[0],
        productName: product ? product.name : "Product",
        title: title,
        comment: comment,
        helpful: 0,
        image: reviewPhotoBase64,
        verified: true
      };

      const reviews = JSON.parse(localStorage.getItem("vaishveda_reviews_db")) || [];
      reviews.push(newReview);
      localStorage.setItem("vaishveda_reviews_db", JSON.stringify(reviews));

      // Reset
      form.reset();
      reviewPhotoBase64 = null;
      document.getElementById("reviewRatingVal").value = "0";
      if (starIcons) {
        starIcons.forEach(s => {
          s.setAttribute("name", "star-outline");
          s.classList.remove("selected");
        });
      }
      if (uploadPrompt) uploadPrompt.style.display = "flex";
      if (previewContainer) previewContainer.style.display = "none";
      if (modalOverlay) modalOverlay.classList.remove("active");

      alert("Thank you! Your review has been submitted successfully and is now active.");

      renderReviews(productId);
    });
  }

  renderReviews(productId);
}

// 2. THEME CONTROLLER
function initTheme() {
  const currentTheme = localStorage.getItem("vaishveda_theme");
  if (currentTheme === "dark") {
    document.body.classList.add("dark-theme");
  }
}

// 3. HEADER USER STATE WIDGET
function updateHeaderUserWidget() {
  const activeUser = JSON.parse(sessionStorage.getItem("vaishveda_active_user")) || JSON.parse(localStorage.getItem("vaishveda_active_user")) || null;
  const widget = document.getElementById("headerUserWidget");
  if (!widget) return;

  let accountBtn = document.getElementById("headerAccountBtn");
  const dropdown = document.getElementById("headerAccountDropdown");

  if (!accountBtn || !dropdown) return;

  // Clone accountBtn to clear any active event listeners from previous states
  const newAccountBtn = accountBtn.cloneNode(true);
  accountBtn.parentNode.replaceChild(newAccountBtn, accountBtn);
  accountBtn = newAccountBtn;

  if (activeUser) {
    // Show user initials badge
    const initials = activeUser.name ? activeUser.name.split(" ").map(n => n[0]).join("").toUpperCase().slice(0, 2) : "U";
    accountBtn.innerHTML = `<span class="user-initials-btn">${initials}</span>`;
    
    // Set logged-in dropdown items
    dropdown.innerHTML = `
      <a href="account.php" class="account-dropdown-item"><ion-icon name="grid-outline"></ion-icon> Dashboard</a>
      <a href="account.php?tab=orders" class="account-dropdown-item"><ion-icon name="receipt-outline"></ion-icon> My Orders</a>
      <a href="account.php?tab=wishlist" class="account-dropdown-item"><ion-icon name="heart-outline"></ion-icon> Wishlist</a>
      <a href="#" class="account-dropdown-item" id="dropdownLogoutBtn" style="border-top: 1px solid var(--color-cream-dark); color: var(--color-sale);"><ion-icon name="log-out-outline"></ion-icon> Sign Out</a>
    `;

    // Setup dropdown toggle
    accountBtn.addEventListener("click", (e) => {
      e.preventDefault();
      dropdown.classList.toggle("active");
    });

    const newDropdownLogout = document.getElementById("dropdownLogoutBtn");
    if (newDropdownLogout) {
      newDropdownLogout.addEventListener("click", (e) => {
        e.preventDefault();
        logoutUser();
      });
    }
  } else {
    // Reset to default person outline icon
    accountBtn.innerHTML = `<ion-icon name="person-outline" class="action-icon-btn"></ion-icon>`;
    
    // Set logged-out dropdown items
    dropdown.innerHTML = `
      <a href="account.php?mode=login" class="account-dropdown-item" id="headerDropdownLoginBtn"><ion-icon name="log-in-outline"></ion-icon> Sign In</a>
      <a href="account.php?mode=register" class="account-dropdown-item" id="headerDropdownRegisterBtn"><ion-icon name="person-add-outline"></ion-icon> Create Account</a>
    `;

    // Setup dropdown toggle
    accountBtn.addEventListener("click", (e) => {
      e.preventDefault();
      dropdown.classList.toggle("active");
    });

    // If already on the account page, allow switching tabs directly without reloading
    if (window.location.pathname.toLowerCase().includes("account.php")) {
      const loginLink = document.getElementById("headerDropdownLoginBtn");
      const registerLink = document.getElementById("headerDropdownRegisterBtn");
      
      if (loginLink) {
        loginLink.addEventListener("click", (e) => {
          e.preventDefault();
          const tabBtnLogin = document.getElementById("tabBtnLogin");
          if (tabBtnLogin) tabBtnLogin.click();
          dropdown.classList.remove("active");
        });
      }
      if (registerLink) {
        registerLink.addEventListener("click", (e) => {
          e.preventDefault();
          const tabBtnRegister = document.getElementById("tabBtnRegister");
          if (tabBtnRegister) tabBtnRegister.click();
          dropdown.classList.remove("active");
        });
      }
    }
  }

  // Close dropdown on clicking outside
  document.addEventListener("click", (e) => {
    if (widget && !widget.contains(e.target)) {
      dropdown.classList.remove("active");
    }
  });
}

// 4. USER LOGOUT
function logoutUser() {
  sessionStorage.removeItem("vaishveda_active_user");
  localStorage.removeItem("vaishveda_active_user");
  
  const loader = document.getElementById("globalLoaderOverlay");
  if (loader) {
    document.getElementById("globalLoaderText").textContent = "Ending session...";
    loader.classList.add("active");
    setTimeout(() => {
      window.location.href = "account.php";
    }, 1000);
  } else {
    window.location.href = "account.php";
  }
}

// 5. AUTOFILL CHECKOUT SHIPPING DETAILS
function autofillCheckoutDetails() {
  const activeUser = JSON.parse(sessionStorage.getItem("vaishveda_active_user")) || JSON.parse(localStorage.getItem("vaishveda_active_user")) || null;
  if (!activeUser) return;

  const nameInput = document.getElementById("checkoutName");
  const emailInput = document.getElementById("checkoutEmail");
  const phoneInput = document.getElementById("checkoutPhone");
  const addressInput = document.getElementById("checkoutAddress");
  const cityInput = document.getElementById("checkoutCity");
  const stateInput = document.getElementById("checkoutState");
  const pincodeInput = document.getElementById("checkoutPincode");

  if (nameInput) nameInput.value = activeUser.name || "";
  if (emailInput) emailInput.value = activeUser.email || "";
  if (phoneInput) phoneInput.value = activeUser.phone || "";

  if (activeUser.addresses && activeUser.addresses.length > 0) {
    const defAddr = activeUser.addresses.find(a => a.isDefault) || activeUser.addresses[0];
    if (defAddr) {
      if (addressInput) addressInput.value = `${defAddr.house}, ${defAddr.street}`;
      if (cityInput) cityInput.value = defAddr.city || "";
      if (stateInput) stateInput.value = defAddr.state || "";
      if (pincodeInput) pincodeInput.value = defAddr.pincode || "";
    }
  }
}

// 6. INITIALIZE CUSTOMER DASHBOARD & AUTH INTERFACE
function initAccountPage() {
  const activeUser = JSON.parse(sessionStorage.getItem("vaishveda_active_user")) || JSON.parse(localStorage.getItem("vaishveda_active_user")) || null;
  
  const authPortal = document.getElementById("authPortalSection");
  const customerDashboard = document.getElementById("customerDashboardSection");
  
  if (activeUser) {
    if (authPortal) authPortal.style.display = "none";
    if (customerDashboard) customerDashboard.style.display = "grid";
    document.body.classList.remove("auth-portal-active");
    
    setupDashboardPortal(activeUser);
  } else {
    if (authPortal) authPortal.style.display = "block";
    if (customerDashboard) customerDashboard.style.display = "none";
    document.body.classList.add("auth-portal-active");
    
    setupAuthPortal();
  }
}

// 7. SETUP AUTHENTICATION CARD PANELS
function setupAuthPortal() {
  // Tab Swappers
  const tabBtnLogin = document.getElementById("tabBtnLogin");
  const tabBtnRegister = document.getElementById("tabBtnRegister");
  const panelLogin = document.getElementById("panelLogin");
  const panelRegister = document.getElementById("panelRegister");
  const panelForgot = document.getElementById("panelForgot");
  
  if (tabBtnLogin && tabBtnRegister) {
    tabBtnLogin.addEventListener("click", () => {
      tabBtnLogin.classList.add("active");
      tabBtnRegister.classList.remove("active");
      panelLogin.classList.add("active");
      panelRegister.classList.remove("active");
      panelForgot.classList.remove("active");
    });
    
    tabBtnRegister.addEventListener("click", () => {
      tabBtnRegister.classList.add("active");
      tabBtnLogin.classList.remove("active");
      panelRegister.classList.add("active");
      panelLogin.classList.remove("active");
      panelForgot.classList.remove("active");
    });

    // Check if query param is set to toggle appropriate tab on load
    const urlParams = new URLSearchParams(window.location.search);
    const mode = urlParams.get("mode") ? urlParams.get("mode").toLowerCase() : null;
    if (mode === "register") {
      tabBtnRegister.click();
    } else if (mode === "login") {
      tabBtnLogin.click();
    }
  }
  
  // Forgot Password Links
  const forgotLink = document.getElementById("forgotPasswordLink");
  const backToLogin = document.getElementById("forgotBackToLogin");
  if (forgotLink) {
    forgotLink.addEventListener("click", (e) => {
      e.preventDefault();
      panelLogin.classList.remove("active");
      panelForgot.classList.add("active");
    });
  }
  if (backToLogin) {
    backToLogin.addEventListener("click", (e) => {
      e.preventDefault();
      panelForgot.classList.remove("active");
      panelLogin.classList.add("active");
    });
  }
  
  // Login fields radio toggles (Email vs Phone)
  const loginTypes = document.querySelectorAll('input[name="loginType"]');
  const fieldEmail = document.getElementById("loginFieldEmail");
  const fieldMobile = document.getElementById("loginFieldMobile");
  
  loginTypes.forEach(t => {
    t.addEventListener("change", () => {
      if (t.value === "PASSWORD") {
        if (fieldEmail) fieldEmail.style.display = "block";
        if (fieldMobile) fieldMobile.style.display = "none";
      } else {
        if (fieldEmail) fieldEmail.style.display = "none";
        if (fieldMobile) fieldMobile.style.display = "block";
      }
    });
  });
  
  // Password Real-time strength meter validation rules
  const regPass = document.getElementById("registerPassword");
  const reqLen = document.getElementById("reqLen");
  const reqUpper = document.getElementById("reqUpper");
  const reqLower = document.getElementById("reqLower");
  const reqNum = document.getElementById("reqNum");
  const reqSpec = document.getElementById("reqSpec");
  const pwRequirements = document.getElementById("pwRequirements");
  
  if (regPass) {
    regPass.addEventListener("input", () => {
      const val = regPass.value;
      const lenVal = val.length >= 8;
      const upperVal = /[A-Z]/.test(val);
      const lowerVal = /[a-z]/.test(val);
      const numVal = /[0-9]/.test(val);
      const specVal = /[!@#$%^&*(),.?":{}|<>]/.test(val);
      
      toggleMetRule(reqLen, lenVal);
      toggleMetRule(reqUpper, upperVal);
      toggleMetRule(reqLower, lowerVal);
      toggleMetRule(reqNum, numVal);
      toggleMetRule(reqSpec, specVal);
      
      if (pwRequirements) {
        if (lenVal && upperVal && lowerVal && numVal && specVal) {
          pwRequirements.className = "password-requirements valid";
        } else {
          pwRequirements.className = "password-requirements invalid";
        }
      }
    });
  }
  
  // Submit Log In Form
  const loginForm = document.getElementById("loginForm");
  if (loginForm) {
    loginForm.addEventListener("submit", (e) => {
      e.preventDefault();
      
      const type = document.querySelector('input[name="loginType"]:checked').value;
      const remember = document.getElementById("loginRememberMe").checked;
      
      const captcha = document.getElementById("loginCaptcha");
      if (captcha && !captcha.checked) {
        alert("Please verify the CAPTCHA checkbox.");
        return;
      }
      
      if (type === "PASSWORD") {
        const email = document.getElementById("loginEmail").value.trim();
        const pass = document.getElementById("loginPassword").value;
        
        fetch("api.php?action=login_user", {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify({ email: email, password: pass })
        })
        .then(res => res.json())
        .then(res => {
          if (res.success) {
            const user = res.user;
            if (remember) {
              localStorage.setItem("vaishveda_active_user", JSON.stringify(user));
            } else {
              sessionStorage.setItem("vaishveda_active_user", JSON.stringify(user));
            }
            alert(`Welcome back, ${user.name}!`);
            location.reload();
          } else {
            alert(res.message);
          }
        })
        .catch(err => {
          console.error("Login API error:", err);
          // Fallback to local storage
          const usersList = JSON.parse(localStorage.getItem("vaishveda_users")) || [];
          const user = usersList.find(u => u.email === email && u.password === pass);
          if (user) {
            if (remember) {
              localStorage.setItem("vaishveda_active_user", JSON.stringify(user));
            } else {
              sessionStorage.setItem("vaishveda_active_user", JSON.stringify(user));
            }
            alert(`Welcome back, ${user.name}!`);
            location.reload();
          } else {
            alert("Invalid Email or Password.");
          }
        });
      } else {
        // Mobile OTP Login
        const phone = document.getElementById("loginMobile").value.trim();
        if (phone.length !== 10 || isNaN(phone)) {
          alert("Please enter a valid 10-digit mobile number.");
          return;
        }
        
        sendOtp("MOBILE_LOGIN", { phone, rememberMe: remember });
      }
    });
  }
  
  // Submit Register Form
  const registerForm = document.getElementById("registerForm");
  if (registerForm) {
    registerForm.addEventListener("submit", (e) => {
      e.preventDefault();
      
      const name = document.getElementById("registerName").value.trim();
      const email = document.getElementById("registerEmail").value.trim();
      const phone = document.getElementById("registerMobile").value.trim();
      const pass = document.getElementById("registerPassword").value;
      const confPass = document.getElementById("registerConfirmPassword").value;
      const referral = document.getElementById("registerReferral").value.trim();
      
      const captcha = document.getElementById("registerCaptcha");
      if (captcha && !captcha.checked) {
        alert("Please verify the CAPTCHA checkbox.");
        return;
      }
      
      if (pass !== confPass) {
        alert("Passwords do not match.");
        return;
      }
      
      const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*(),.?":{}|<>]).{8,}$/;
      if (!regex.test(pass)) {
        alert("Password does not meet requirements.");
        return;
      }
      
      // Check duplicate
      let usersList = JSON.parse(localStorage.getItem("vaishveda_users")) || [];
      if (usersList.some(u => u.email === email)) {
        alert("An account with this email address already exists.");
        return;
      }
      if (usersList.some(u => u.phone === phone)) {
        alert("An account with this mobile number already exists.");
        return;
      }
      
      sendOtp("SIGNUP", { name, email, phone, password: pass, referral });
    });
  }
  
  // Submit Forgot Password Form
  const forgotForm = document.getElementById("forgotForm");
  if (forgotForm) {
    forgotForm.addEventListener("submit", (e) => {
      e.preventDefault();
      const contact = document.getElementById("forgotContact").value.trim();
      
      let usersList = JSON.parse(localStorage.getItem("vaishveda_users")) || [];
      const user = usersList.find(u => u.email === contact || u.phone === contact);
      
      if (!user) {
        alert("No registered account found with that email address or mobile number.");
        return;
      }
      
      sendOtp("FORGOT_PASSWORD", { contact });
    });
  }
}

function toggleMetRule(el, isMet) {
  if (!el) return;
  if (isMet) {
    el.classList.add("met");
    const icon = el.querySelector("ion-icon");
    if (icon) icon.setAttribute("name", "checkmark-circle-outline");
  } else {
    el.classList.remove("met");
    const icon = el.querySelector("ion-icon");
    if (icon) icon.setAttribute("name", "close-circle-outline");
  }
}

// 8. SETUP LOGGED-IN CUSTOMER DASHBOARD
function setupDashboardPortal(user) {
  // Setup sidebar navigation switching
  const dbTabs = document.querySelectorAll(".db-nav-item");
  dbTabs.forEach(tab => {
    tab.addEventListener("click", () => {
      const tabName = tab.getAttribute("data-tab");
      if (!tabName) return; // Ignore logout button
      
      dbTabs.forEach(t => t.classList.remove("active"));
      tab.classList.add("active");
      
      const panels = document.querySelectorAll(".dashboard-panel-view");
      panels.forEach(p => p.classList.remove("active"));
      
      let panelId = "tabPanelProfile";
      if (tabName === "profile") panelId = "tabPanelProfile";
      else if (tabName === "orders") panelId = "tabPanelOrders";
      else if (tabName === "wishlist") panelId = "tabPanelWishlist";
      else if (tabName === "addresses") panelId = "tabPanelAddresses";
      else if (tabName === "payments") panelId = "tabPanelPayments";
      else if (tabName === "wallet") panelId = "tabPanelWallet";
      else if (tabName === "coupons") panelId = "tabPanelCoupons";
      else if (tabName === "notifications") panelId = "tabPanelNotifications";
      else if (tabName === "settings") panelId = "tabPanelSettings";
      
      const panel = document.getElementById(panelId);
      if (panel) panel.classList.add("active");
    });
  });

  // Handle Logout button in dashboard sidebar
  const logoutBtn = document.getElementById("dashboardLogoutBtn");
  if (logoutBtn) {
    logoutBtn.addEventListener("click", (e) => {
      e.preventDefault();
      logoutUser();
    });
  }
  
  // Theme Switching toggle setup inside dashboard settings
  const themeSwitch = document.getElementById("themeSwitchBtn");
  if (themeSwitch) {
    themeSwitch.checked = document.body.classList.contains("dark-theme");
    themeSwitch.addEventListener("change", () => {
      if (themeSwitch.checked) {
        document.body.classList.add("dark-theme");
        localStorage.setItem("vaishveda_theme", "dark");
      } else {
        document.body.classList.remove("dark-theme");
        localStorage.setItem("vaishveda_theme", "light");
      }
    });
  }

  // Pre-fill profile settings inputs
  const pName = document.getElementById("profileName");
  const pEmail = document.getElementById("profileEmail");
  const pPhone = document.getElementById("profileMobile");
  const pJoined = document.getElementById("profileJoined");
  
  if (pName) pName.value = user.name || "";
  if (pEmail) pEmail.value = user.email || "";
  if (pPhone) pPhone.value = user.phone || "";
  if (pJoined) pJoined.value = user.joinedDate || "";
  
  // Avatar preview
  const avatarImg = document.getElementById("profileAvatarImg");
  if (avatarImg && user.avatar) {
    avatarImg.src = user.avatar;
  }
  
  // Avatar upload handler
  const avatarInput = document.getElementById("avatarUploadInput");
  if (avatarInput && avatarImg) {
    avatarInput.addEventListener("change", (e) => {
      const file = e.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = (event) => {
          const base64 = event.target.result;
          avatarImg.src = base64;
          
          let activeUser = JSON.parse(sessionStorage.getItem("vaishveda_active_user")) || JSON.parse(localStorage.getItem("vaishveda_active_user")) || null;
          if (activeUser) {
            activeUser.avatar = base64;
            const isLocal = !!localStorage.getItem("vaishveda_active_user");
            if (isLocal) {
              localStorage.setItem("vaishveda_active_user", JSON.stringify(activeUser));
            } else {
              sessionStorage.setItem("vaishveda_active_user", JSON.stringify(activeUser));
            }
            
            let usersList = JSON.parse(localStorage.getItem("vaishveda_users")) || [];
            const uIdx = usersList.findIndex(u => u.email === activeUser.email);
            if (uIdx !== -1) {
              usersList[uIdx].avatar = base64;
              localStorage.setItem("vaishveda_users", JSON.stringify(usersList));
            }
          }
        };
        reader.readAsDataURL(file);
      }
    });
  }
  
  // Edit Profile Form Submission
  const profileForm = document.getElementById("profileForm");
  if (profileForm) {
    profileForm.addEventListener("submit", (e) => {
      e.preventDefault();
      
      const newName = pName.value.trim();
      const newEmail = pEmail.value.trim();
      const newPhone = pPhone.value.trim();
      
      let activeUser = JSON.parse(sessionStorage.getItem("vaishveda_active_user")) || JSON.parse(localStorage.getItem("vaishveda_active_user")) || null;
      if (!activeUser) return;
      
      if (newEmail !== activeUser.email) {
        sendOtp("EMAIL_CHANGE", { newEmail });
        return;
      }
      
      if (newPhone !== activeUser.phone) {
        sendOtp("PHONE_CHANGE", { newPhone });
        return;
      }
      
      activeUser.name = newName;
      saveProfileData(activeUser);
      alert("Name updated successfully!");
    });
  }
  
  // Update Password Form Submission
  const changePasswordForm = document.getElementById("changePasswordForm");
  if (changePasswordForm) {
    changePasswordForm.addEventListener("submit", (e) => {
      e.preventDefault();
      
      let activeUser = JSON.parse(sessionStorage.getItem("vaishveda_active_user")) || JSON.parse(localStorage.getItem("vaishveda_active_user")) || null;
      if (!activeUser) return;
      
      const oldPass = document.getElementById("profileOldPassword").value;
      const newPass = document.getElementById("profileNewPassword").value;
      const confPass = document.getElementById("profileConfirmNewPassword").value;
      
      if (oldPass !== activeUser.password) {
        alert("Incorrect current password.");
        return;
      }
      
      if (newPass !== confPass) {
        alert("New passwords do not match.");
        return;
      }
      
      const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*(),.?":{}|<>]).{8,}$/;
      if (!regex.test(newPass)) {
        alert("Password does not meet complexity requirements.");
        return;
      }
      
      activeUser.password = newPass;
      saveProfileData(activeUser);
      alert("Password updated successfully!");
      changePasswordForm.reset();
    });
  }
  
  // Address Modals logic
  const addressFormClose = document.getElementById("addressFormCloseBtn");
  const addressModal = document.getElementById("addressFormModal");
  const overlay = document.getElementById("drawerOverlay");
  
  if (addressFormClose && addressModal && overlay) {
    addressFormClose.addEventListener("click", () => {
      addressModal.classList.remove("active");
      overlay.classList.remove("active");
    });
  }
  
  const addAddressBtn = document.getElementById("addAddressBtn");
  if (addAddressBtn && addressModal && overlay) {
    addAddressBtn.addEventListener("click", () => {
      document.getElementById("addressFormTitle").textContent = "Add New Address";
      document.getElementById("addressFormIndex").value = "";
      document.getElementById("addressDetailsForm").reset();
      addressModal.classList.add("active");
      overlay.classList.add("active");
    });
  }
  
  const addressDetailsForm = document.getElementById("addressDetailsForm");
  if (addressDetailsForm && addressModal && overlay) {
    addressDetailsForm.addEventListener("submit", (e) => {
      e.preventDefault();
      
      let activeUser = JSON.parse(sessionStorage.getItem("vaishveda_active_user")) || JSON.parse(localStorage.getItem("vaishveda_active_user")) || null;
      if (!activeUser) return;
      
      const idxVal = document.getElementById("addressFormIndex").value;
      const newAddr = {
        name: document.getElementById("addrName").value,
        phone: document.getElementById("addrPhone").value,
        house: document.getElementById("addrHouse").value,
        street: document.getElementById("addrStreet").value,
        city: document.getElementById("addrCity").value,
        state: document.getElementById("addrState").value,
        pincode: document.getElementById("addrPincode").value,
        country: document.getElementById("addrCountry").value,
        isDefault: false
      };
      
      if (!activeUser.addresses) activeUser.addresses = [];
      
      if (idxVal === "") {
        if (activeUser.addresses.length === 0) newAddr.isDefault = true;
        activeUser.addresses.push(newAddr);
      } else {
        const idx = parseInt(idxVal);
        newAddr.isDefault = activeUser.addresses[idx].isDefault;
        activeUser.addresses[idx] = newAddr;
      }
      
      saveAddressesList(activeUser);
      addressModal.classList.remove("active");
      overlay.classList.remove("active");
      addressDetailsForm.reset();
    });
  }
  
  // Card Modals logic
  const cardFormClose = document.getElementById("cardFormCloseBtn");
  const cardModal = document.getElementById("cardFormModal");
  if (cardFormClose && cardModal && overlay) {
    cardFormClose.addEventListener("click", () => {
      cardModal.classList.remove("active");
      overlay.classList.remove("active");
    });
  }
  
  const addCardBtn = document.getElementById("addCardBtn");
  if (addCardBtn && cardModal && overlay) {
    addCardBtn.addEventListener("click", () => {
      document.getElementById("cardDetailsForm").reset();
      cardModal.classList.add("active");
      overlay.classList.add("active");
    });
  }
  
  const cardDetailsForm = document.getElementById("cardDetailsForm");
  if (cardDetailsForm && cardModal && overlay) {
    cardDetailsForm.addEventListener("submit", (e) => {
      e.preventDefault();
      
      let activeUser = JSON.parse(sessionStorage.getItem("vaishveda_active_user")) || JSON.parse(localStorage.getItem("vaishveda_active_user")) || null;
      if (!activeUser) return;
      
      const num = document.getElementById("cardNumber").value;
      const masked = `•••• •••• •••• ${num.slice(-4)}`;
      
      const newCard = {
        holder: document.getElementById("cardHolder").value,
        number: masked,
        expiry: document.getElementById("cardExpiry").value
      };
      
      if (!activeUser.cards) activeUser.cards = [];
      activeUser.cards.push(newCard);
      
      saveCardsList(activeUser);
      cardModal.classList.remove("active");
      overlay.classList.remove("active");
      cardDetailsForm.reset();
    });
  }
  
  // Mark All Notifications read
  const markAllBtn = document.getElementById("markAllReadBtn");
  if (markAllBtn) {
    markAllBtn.addEventListener("click", () => {
      let activeUser = JSON.parse(sessionStorage.getItem("vaishveda_active_user")) || JSON.parse(localStorage.getItem("vaishveda_active_user")) || null;
      if (!activeUser) return;
      
      if (activeUser.notifications) {
        activeUser.notifications.forEach(n => n.read = true);
        saveNotificationState(activeUser);
      }
    });
  }
  
  // Deactivate Account
  const deactivateBtn = document.getElementById("deactivateAccountBtn");
  if (deactivateBtn) {
    deactivateBtn.addEventListener("click", () => {
      if (confirm("Are you sure you want to permanently delete your account? All reward points will be lost.")) {
        let activeUser = JSON.parse(sessionStorage.getItem("vaishveda_active_user")) || JSON.parse(localStorage.getItem("vaishveda_active_user")) || null;
        if (!activeUser) return;
        
        let usersList = JSON.parse(localStorage.getItem("vaishveda_users")) || [];
        usersList = usersList.filter(u => u.email !== activeUser.email);
        localStorage.setItem("vaishveda_users", JSON.stringify(usersList));
        
        sessionStorage.removeItem("vaishveda_active_user");
        localStorage.removeItem("vaishveda_active_user");
        alert("Account deleted.");
        location.reload();
      }
    });
  }
  
  // Populate dashboard panels
  renderOrderHistory(user);
  renderWishlistTab(user);
  renderAddressesTab(user);
  renderPaymentsTab(user);
  renderWalletTab(user);
  renderCouponsTab(user);
  renderNotificationsTab(user);
  
  // Deep-linked tabs check
  const urlParams = new URLSearchParams(window.location.search);
  const activeTabParam = urlParams.get("tab");
  if (activeTabParam) {
    const targetTab = document.querySelector(`.db-nav-item[data-tab="${activeTabParam}"]`);
    if (targetTab) targetTab.click();
  }
}

function saveUserData(user) {
  const isLocal = !!localStorage.getItem("vaishveda_active_user");
  if (isLocal) {
    localStorage.setItem("vaishveda_active_user", JSON.stringify(user));
  } else {
    sessionStorage.setItem("vaishveda_active_user", JSON.stringify(user));
  }

  fetch("api.php?action=sync_user", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify(user)
  })
  .then(res => res.json())
  .then(res => {
    if (!res.success) console.error("Database sync failed:", res.message);
  })
  .catch(err => console.error("API error syncing user profile:", err));

  let usersList = JSON.parse(localStorage.getItem("vaishveda_users")) || [];
  const uIdx = usersList.findIndex(u => u.email === user.email);
  if (uIdx !== -1) {
    usersList[uIdx] = user;
    localStorage.setItem("vaishveda_users", JSON.stringify(usersList));
  }
}

function saveProfileData(user) {
  saveUserData(user);
}

function saveAddressesList(user) {
  saveUserData(user);
  renderAddressesTab(user);
}

function saveCardsList(user) {
  saveUserData(user);
  renderPaymentsTab(user);
}

function saveNotificationState(user) {
  saveUserData(user);
  renderNotificationsTab(user);
}

// 9. RENDER DASHBOARD TABS CONTENT
function renderOrderHistory(user) {
  const container = document.getElementById("dashboardOrdersList");
  if (!container) return;
  
  // Show loading indicator
  container.innerHTML = `<div style="text-align:center; padding:40px; color:#888;"><ion-icon name="sync-outline" class="spin-icon" style="font-size:2rem; margin-bottom:10px;"></ion-icon><p>Loading your orders...</p></div>`;
  
  fetch(`order_api.php?action=list&email=${encodeURIComponent(user.email)}`)
    .then(response => response.json())
    .then(orders => {
      if (!orders || orders.length === 0) {
        // Fallback to local storage if API is empty
        const localOrders = JSON.parse(localStorage.getItem("vaishveda_orders")) || [];
        orders = localOrders.filter(o => o.userEmail === user.email || o.customer.email === user.email);
      }
      displayOrders(orders);
    })
    .catch(err => {
      console.error("Error fetching orders from DB:", err);
      // Fallback
      const localOrders = JSON.parse(localStorage.getItem("vaishveda_orders")) || [];
      const orders = localOrders.filter(o => o.userEmail === user.email || o.customer.email === user.email);
      displayOrders(orders);
    });

  function displayOrders(userOrders) {
    if (userOrders.length === 0) {
      container.innerHTML = `
        <div style="text-align:center; padding:40px; color:#888;">
          <ion-icon name="receipt-outline" style="font-size:3rem; opacity:0.5; margin-bottom:10px;"></ion-icon>
          <p>No orders placed yet. Start your self-care journey today!</p>
          <a href="shop.php" class="btn btn-outline" style="margin-top:15px; display:inline-block; font-size:11px;">Shop Collections</a>
        </div>`;
      return;
    }
    
    container.innerHTML = "";
    userOrders.forEach(order => {
      const card = document.createElement("div");
      card.style.cssText = "background-color: var(--color-white); border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); padding:20px; margin-bottom:20px; box-shadow: 0 4px 10px rgba(0,0,0,0.02);";
      
      const itemsHtml = order.items.map(item => `
        <tr>
          <td style="padding: 8px 0; font-size:12.5px; color:var(--color-charcoal);">${item.name} (${item.size})</td>
          <td style="padding: 8px 0; font-size:12.5px; text-align:center; color:var(--color-charcoal);">${item.quantity}</td>
          <td style="padding: 8px 0; font-size:12.5px; text-align:right; color:var(--color-charcoal);">₹${(item.price * item.quantity).toLocaleString("en-IN")}</td>
        </tr>
      `).join("");
      
      card.innerHTML = `
        <div style="display:flex; justify-content:space-between; align-items:center; border-bottom: 1px solid var(--color-cream-dark); padding-bottom:12px; margin-bottom:12px;">
          <div>
            <span style="font-size: 13.5px; font-weight:700; color:var(--color-primary);">${order.id}</span>
            <span style="font-size: 11px; color:#777; margin-left: 15px;">Placed: ${order.createdAt ? order.createdAt.split(' ')[0] : order.date}</span>
          </div>
          <span class="status-badge ${order.status.toLowerCase()}">${order.status}</span>
        </div>
        <table style="width:100%; border-collapse:collapse; margin-bottom:12px;">
          <thead>
            <tr style="border-bottom:1px dashed var(--color-cream-dark); color:#666; font-size:11px; text-transform:uppercase;">
              <th style="text-align:left; padding-bottom:5px;">Product</th>
              <th style="text-align:center; padding-bottom:5px; width:60px;">Qty</th>
              <th style="text-align:right; padding-bottom:5px; width:100px;">Total</th>
            </tr>
          </thead>
          <tbody>
            ${itemsHtml}
          </tbody>
          <tfoot>
            <tr style="border-top:1px solid var(--color-cream-dark); font-weight:700;">
              <td colspan="2" style="padding-top:10px; font-size:13px; text-align:right; color:var(--color-charcoal);">Total Paid:</td>
              <td style="padding-top:10px; font-size:14px; text-align:right; color:var(--color-primary);">₹${order.total.toLocaleString("en-IN")}</td>
            </tr>
          </tfoot>
        </table>
        <div style="display:flex; justify-content:space-between; align-items:center; font-size:11px; color:#555;">
          <span style="color:var(--color-charcoal);"><strong>Payment:</strong> ${order.paymentMethod || 'Cash on Delivery'}</span>
          <div style="display:flex; gap:10px;">
            <button class="btn btn-outline" style="font-size:9px; padding:6px 12px;" onclick="reorderItems(${JSON.stringify(order.items).replace(/"/g, '&quot;')})">Re-Order</button>
            <button class="btn btn-outline" style="font-size:9px; padding:6px 12px;" onclick="viewInvoiceAlert('${order.id}')">View Details</button>
          </div>
        </div>
      `;
      container.appendChild(card);
    });
  }
}

window.reorderItems = function(items) {
  cart = items.map(i => ({
    id: i.id,
    name: i.name,
    image: i.image,
    size: i.size,
    price: i.price,
    quantity: i.quantity
  }));
  saveCart();
  updateCartBadge();
  alert("Items have been added to your Bag. Opening drawer...");
  
  const drawer = document.getElementById("cartDrawer");
  const overlay = document.getElementById("drawerOverlay");
  if (drawer && overlay) {
    renderCartItems();
    drawer.classList.add("active");
    overlay.classList.add("active");
  }
};

window.viewInvoiceAlert = function(orderId) {
  const orders = JSON.parse(localStorage.getItem("vaishveda_orders")) || [];
  const order = orders.find(o => o.id === orderId);
  if (!order) return;
  
  let info = `INVOICE details for ${order.id}\n`;
  info += `------------------------------------\n`;
  info += `Date: ${order.date}\n`;
  info += `Status: ${order.status}\n`;
  info += `Payment Method: ${order.paymentMethod}\n`;
  info += `Shipping: ${order.customer.address}\n\n`;
  info += `Items:\n`;
  order.items.forEach(i => {
    info += `- ${i.name} (${i.size}) x ${i.quantity} @ ₹${i.price}\n`;
  });
  info += `\nTotal Bill Amount: ₹${order.total}\n`;
  
  alert(info);
};

function renderWishlistTab(user) {
  const grid = document.getElementById("dashboardWishlistGrid");
  if (!grid) return;
  
  const userWishlist = user.wishlist || [];
  grid.innerHTML = "";
  
  if (userWishlist.length === 0) {
    grid.innerHTML = `
      <div style="grid-column: 1/-1; text-align:center; padding:40px; color:#888;">
        <ion-icon name="heart-outline" style="font-size:3rem; opacity:0.5; margin-bottom:10px;"></ion-icon>
        <p>Your wishlist is currently empty.</p>
        <a href="shop.php" class="btn btn-outline" style="margin-top:15px; display:inline-block; font-size:11px;">Explore Collections</a>
      </div>`;
    return;
  }
  
  userWishlist.forEach(prodId => {
    const p = PRODUCTS_DB.find(item => item.id === prodId);
    if (!p) return;
    
    const card = document.createElement("div");
    card.className = "product-card";
    card.innerHTML = `
      <div class="product-image-container">
        <a href="product.php?id=${p.id}">
          <img src="${p.image}" alt="${p.name}" class="product-image">
        </a>
        <button class="product-quick-add" onclick="quickAddToBag('${p.id}')">Add to Bag</button>
      </div>
      <div class="product-info">
        <p class="product-category">${p.category === "Kumkumadi" ? "Kumkumadi Essentials" : p.category + " Care"}</p>
        <h4 class="product-name"><a href="product.php?id=${p.id}">${p.name}</a></h4>
        <p class="product-price">₹${p.price}</p>
        <button class="btn btn-outline" style="font-size:9.5px; padding:6px 12px; width:100%; margin-top:10px;" onclick="removeWishlistItem('${p.id}')">Remove Item</button>
      </div>
    `;
    grid.appendChild(card);
  });
}

window.removeWishlistItem = function(id) {
  let activeUser = JSON.parse(sessionStorage.getItem("vaishveda_active_user")) || JSON.parse(localStorage.getItem("vaishveda_active_user")) || null;
  if (!activeUser) return;
  
  activeUser.wishlist = (activeUser.wishlist || []).filter(w => w !== id);
  const isLocal = !!localStorage.getItem("vaishveda_active_user");
  if (isLocal) {
    localStorage.setItem("vaishveda_active_user", JSON.stringify(activeUser));
  } else {
    sessionStorage.setItem("vaishveda_active_user", JSON.stringify(activeUser));
  }
  
  let usersList = JSON.parse(localStorage.getItem("vaishveda_users")) || [];
  const uIdx = usersList.findIndex(u => u.email === activeUser.email);
  if (uIdx !== -1) {
    usersList[uIdx].wishlist = activeUser.wishlist;
    localStorage.setItem("vaishveda_users", JSON.stringify(usersList));
  }
  
  wishlist = activeUser.wishlist;
  localStorage.setItem("vaishveda_wishlist", JSON.stringify(wishlist));
  
  const wBadge = document.getElementById("wishlistCount");
  if (wBadge) wBadge.textContent = wishlist.length;
  
  renderWishlistTab(activeUser);
};

function renderAddressesTab(user) {
  const grid = document.getElementById("dashboardAddressesGrid");
  if (!grid) return;
  
  const addresses = user.addresses || [];
  grid.innerHTML = "";
  
  if (addresses.length === 0) {
    grid.innerHTML = `<div style="grid-column:1/-1; text-align:center; padding:30px; color:#888;">No saved addresses. Click Add Address to create one.</div>`;
    return;
  }
  
  addresses.forEach((addr, idx) => {
    const card = document.createElement("div");
    card.style.cssText = `border: 1px solid ${addr.isDefault ? 'var(--color-primary)' : 'var(--color-cream-dark)'}; border-radius: var(--border-radius); padding: 18px; position:relative; background-color: var(--color-white);`;
    
    card.innerHTML = `
      ${addr.isDefault ? '<span class="status-badge shipped" style="position:absolute; top:12px; right:12px; font-size:9px;">DEFAULT</span>' : ''}
      <h5 style="font-weight:700; margin-bottom:5px; font-size:13.5px; color:var(--color-charcoal);">${addr.name}</h5>
      <p style="font-size:12px; line-height:1.4; color:var(--color-charcoal); margin-bottom:8px;">
        ${addr.house}, ${addr.street}<br>
        ${addr.city}, ${addr.state} - ${addr.pincode}<br>
        ${addr.country}
      </p>
      <div style="font-size:11px; color:#777; margin-bottom:12px;"><strong>Phone:</strong> ${addr.phone}</div>
      <div style="display:flex; gap:10px; font-size:10.5px;">
        <button class="btn btn-outline" style="padding:4px 10px; font-size:9.5px;" onclick="openAddressEditForm(${idx})">Edit</button>
        <button class="btn btn-outline" style="padding:4px 10px; font-size:9.5px; border-color:var(--color-sale); color:var(--color-sale);" onclick="deleteAddress(${idx})">Delete</button>
        ${!addr.isDefault ? `<button class="btn btn-outline" style="padding:4px 10px; font-size:9.5px;" onclick="setDefaultAddress(${idx})">Set Default</button>` : ''}
      </div>
    `;
    grid.appendChild(card);
  });
}

window.openAddressEditForm = function(idx) {
  let activeUser = JSON.parse(sessionStorage.getItem("vaishveda_active_user")) || JSON.parse(localStorage.getItem("vaishveda_active_user")) || null;
  const addr = activeUser.addresses[idx];
  if (!addr) return;
  
  document.getElementById("addressFormTitle").textContent = "Edit Address";
  document.getElementById("addressFormIndex").value = idx;
  document.getElementById("addrName").value = addr.name;
  document.getElementById("addrPhone").value = addr.phone;
  document.getElementById("addrHouse").value = addr.house;
  document.getElementById("addrStreet").value = addr.street;
  document.getElementById("addrCity").value = addr.city;
  document.getElementById("addrState").value = addr.state;
  document.getElementById("addrPincode").value = addr.pincode;
  document.getElementById("addrCountry").value = addr.country || "India";
  
  document.getElementById("addressFormModal").classList.add("active");
  document.getElementById("drawerOverlay").classList.add("active");
};

window.deleteAddress = function(idx) {
  if (confirm("Delete this address?")) {
    let activeUser = JSON.parse(sessionStorage.getItem("vaishveda_active_user")) || JSON.parse(localStorage.getItem("vaishveda_active_user")) || null;
    const isDefault = activeUser.addresses[idx].isDefault;
    activeUser.addresses.splice(idx, 1);
    
    if (isDefault && activeUser.addresses.length > 0) {
      activeUser.addresses[0].isDefault = true;
    }
    
    saveAddressesList(activeUser);
  }
};

window.setDefaultAddress = function(idx) {
  let activeUser = JSON.parse(sessionStorage.getItem("vaishveda_active_user")) || JSON.parse(localStorage.getItem("vaishveda_active_user")) || null;
  activeUser.addresses.forEach((a, i) => a.isDefault = (i === idx));
  saveAddressesList(activeUser);
};

function renderPaymentsTab(user) {
  const grid = document.getElementById("dashboardCardsGrid");
  if (!grid) return;
  
  const cards = user.cards || [];
  grid.innerHTML = "";
  
  if (cards.length === 0) {
    grid.innerHTML = `<div style="grid-column:1/-1; text-align:center; padding:30px; color:#888;">No cards saved. Click Add Card to save one.</div>`;
    return;
  }
  
  cards.forEach((card, idx) => {
    const item = document.createElement("div");
    item.style.cssText = `border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); padding: 18px; background-color: var(--color-cream); display:flex; justify-content:space-between; align-items:center;`;
    
    item.innerHTML = `
      <div>
        <div style="font-weight:700; font-size:13.5px; display:flex; align-items:center; gap:8px; color:var(--color-charcoal);">
          <ion-icon name="card-outline" style="color:var(--color-accent); font-size:1.35rem;"></ion-icon>
          ${card.number}
        </div>
        <div style="font-size:11.5px; color:#666; margin-top:5px;">Holder: ${card.holder} | Expires: ${card.expiry}</div>
      </div>
      <button class="btn btn-outline" style="padding:4px 10px; font-size:9.5px; border-color:var(--color-sale); color:var(--color-sale);" onclick="deleteCard(${idx})">Remove</button>
    `;
    grid.appendChild(item);
  });
}

window.deleteCard = function(idx) {
  if (confirm("Remove this card?")) {
    let activeUser = JSON.parse(sessionStorage.getItem("vaishveda_active_user")) || JSON.parse(localStorage.getItem("vaishveda_active_user")) || null;
    activeUser.cards.splice(idx, 1);
    saveCardsList(activeUser);
  }
};

function renderWalletTab(user) {
  const pointsVal = document.getElementById("walletPointsVal");
  const cashVal = document.getElementById("walletCashVal");
  const levelText = document.getElementById("loyaltyLevelText");
  const targetText = document.getElementById("loyaltyPointsTarget");
  const barFill = document.getElementById("loyaltyBarFill");
  const txList = document.getElementById("walletTransactionsList");
  
  if (!pointsVal) return;
  
  const pts = user.rewardPoints || 0;
  pointsVal.textContent = `${pts.toLocaleString()} pts`;
  cashVal.textContent = `₹${(pts * 0.5).toLocaleString("en-IN")}`;
  
  let level = "Silver Member";
  let target = "1,000 pts for Gold";
  let pct = (pts / 1000) * 100;
  
  if (pts >= 1000 && pts < 2500) {
    level = "Gold Member";
    target = "2,500 pts for Platinum";
    pct = ((pts - 1000) / 1500) * 100;
  } else if (pts >= 2500) {
    level = "Platinum Member";
    target = "Highest Tier Achieved";
    pct = 100;
  }
  
  levelText.textContent = `Loyalty Tier: ${level}`;
  targetText.textContent = target === "Highest Tier Achieved" ? target : `${pts.toLocaleString()} / ${target}`;
  if (barFill) barFill.style.width = `${Math.min(100, Math.max(0, pct))}%`;
  
  const txs = user.walletTransactions || [];
  if (txList) {
    txList.innerHTML = "";
    if (txs.length === 0) {
      txList.innerHTML = `<tr><td colspan="4" style="text-align:center; padding:20px; color:#888;">No transactions logged yet.</td></tr>`;
      return;
    }
    txs.forEach(t => {
      const row = document.createElement("tr");
      row.innerHTML = `
        <td style="padding:10px; font-size:12.5px; color:var(--color-charcoal); border-bottom: 1px solid var(--color-cream-dark);">${t.date}</td>
        <td style="padding:10px; font-size:12.5px; color:var(--color-charcoal); border-bottom: 1px solid var(--color-cream-dark);">${t.type}</td>
        <td style="padding:10px; font-size:12.5px; border-bottom: 1px solid var(--color-cream-dark); font-weight:600; color: ${t.points >= 0 ? '#2e7d32' : '#c62828'}">${t.points >= 0 ? '+' : ''}${t.points}</td>
        <td style="padding:10px; font-size:12.5px; border-bottom: 1px solid var(--color-cream-dark); font-weight:600; color:var(--color-charcoal);">${t.balance} pts</td>
      `;
      txList.appendChild(row);
    });
  }
}

function renderCouponsTab(user) {
  const grid = document.getElementById("dashboardCouponsGrid");
  if (!grid) return;
  
  const coupons = [
    { code: "VAISHVEDA10", desc: "10% OFF on your first Ayurvedic order", minSpend: "₹999", tier: "All Tiers" },
    { code: "WELCOME100", desc: "₹100 OFF flat discount on any botanical purchase", minSpend: "No Minimum", tier: "All Tiers" }
  ];
  
  const pts = user.rewardPoints || 0;
  if (pts >= 1000) {
    coupons.push({ code: "PUREGOLD", desc: "15% OFF premium collections", minSpend: "₹1,999", tier: "Gold & Above" });
  }
  if (pts >= 2500) {
    coupons.push({ code: "PLATINUMPURE", desc: "20% OFF site-wide luxury coupon", minSpend: "₹2,500", tier: "Platinum" });
  }
  
  grid.innerHTML = "";
  
  coupons.forEach(c => {
    const card = document.createElement("div");
    card.style.cssText = "border: 1px dashed var(--color-accent); border-radius: var(--border-radius); padding:15px; background-color: var(--color-cream); display:flex; justify-content:space-between; align-items:center;";
    card.innerHTML = `
      <div>
        <div style="font-weight:700; color:var(--color-primary); font-size:14px; font-family:var(--font-serif);">${c.code}</div>
        <div style="font-size:11.5px; margin:4px 0; color:var(--color-charcoal);">${c.desc}</div>
        <div style="font-size:10px; color:#888;">Min spend: ${c.minSpend} | Tier: ${c.tier}</div>
      </div>
      <button class="btn btn-outline" style="padding:6px 12px; font-size:9.5px;" onclick="copyCouponCode('${c.code}')">Copy</button>
    `;
    grid.appendChild(card);
  });
}

function renderNotificationsTab(user) {
  const container = document.getElementById("dashboardNotificationsList");
  if (!container) return;
  
  const notifs = user.notifications || [];
  container.innerHTML = "";
  
  const unreadCountEl = document.getElementById("notificationsUnreadCount");
  const unread = notifs.filter(n => !n.read).length;
  if (unreadCountEl) {
    if (unread > 0) {
      unreadCountEl.textContent = unread;
      unreadCountEl.style.display = "inline-block";
    } else {
      unreadCountEl.style.display = "none";
    }
  }
  
  if (notifs.length === 0) {
    container.innerHTML = `<div style="text-align:center; padding:30px; color:#888;">No notifications logs.</div>`;
    return;
  }
  
  notifs.forEach((n, idx) => {
    const item = document.createElement("div");
    item.style.cssText = `border-bottom: 1px solid var(--color-cream-dark); padding: 15px 5px; position:relative; ${!n.read ? 'background-color: rgba(201, 158, 85, 0.03);' : ''}`;
    
    item.innerHTML = `
      <div style="display:flex; justify-content:space-between; align-items:start; margin-bottom:5px;">
        <h5 style="font-weight: ${!n.read ? '700' : '500'}; font-size:13px; color:var(--color-charcoal);">${n.title}</h5>
        <span style="font-size:10px; color:#888;">${n.date}</span>
      </div>
      <p style="font-size:12px; color:#666; line-height:1.4;">${n.message}</p>
      ${!n.read ? `<button class="btn btn-outline" style="padding:2px 8px; font-size:8.5px; margin-top:8px;" onclick="markNotifRead(${idx})">Mark Read</button>` : ''}
    `;
    container.appendChild(item);
  });
}

window.markNotifRead = function(idx) {
  let activeUser = JSON.parse(sessionStorage.getItem("vaishveda_active_user")) || JSON.parse(localStorage.getItem("vaishveda_active_user")) || null;
  if (!activeUser) return;
  
  activeUser.notifications[idx].read = true;
  saveNotificationState(activeUser);
};

// 10. SIMULATED OTP VERIFICATION ENGINE
function sendOtp(purpose, targetData) {
  window.otpPurpose = { purpose, targetData };
  handleOtpVerificationSuccess();
}

// Focus forward inputs for OTP blocks
const otpDigits = document.querySelectorAll(".otp-digit");
if (otpDigits.length > 0) {
  otpDigits.forEach((digit, index) => {
    digit.addEventListener("input", () => {
      if (digit.value.length === 1 && index < otpDigits.length - 1) {
        otpDigits[index + 1].focus();
      }
      checkOtpSubmissionComplete();
    });
    digit.addEventListener("keydown", (e) => {
      if (e.key === "Backspace" && digit.value === "" && index > 0) {
        otpDigits[index - 1].focus();
      }
    });
  });
}

function checkOtpSubmissionComplete() {
  const entered = Array.from(otpDigits).map(d => d.value).join("");
  if (entered.length === 6) {
    verifyOtp(entered);
  }
}

function verifyOtp(enteredCode) {
  const purpose = window.otpPurpose ? window.otpPurpose.purpose : "";
  const targetData = window.otpPurpose ? window.otpPurpose.targetData : null;
  
  if (!targetData) {
    alert("Verification session expired. Please try again.");
    return;
  }
  
  const contactLabel = (purpose === "SIGNUP" || purpose === "EMAIL_CHANGE") ? targetData.email : (purpose === "MOBILE_LOGIN" ? targetData.phone : (purpose === "FORGOT_PASSWORD" ? targetData.contact : targetData.newPhone));
  
  const isEmail = contactLabel && contactLabel.includes("@");
  
  if (isEmail) {
    // Verify via Server-Side API
    fetch("api.php?action=verify_email_otp", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ email: contactLabel, otp: enteredCode })
    })
    .then(res => res.json())
    .then(res => {
      if (res.success) {
        completeVerification();
      } else {
        alert(res.message || "Invalid OTP code.");
        resetOtpInputs();
      }
    })
    .catch(err => {
      console.error("OTP verification error:", err);
      alert("Verification failed on server. Please try again.");
      resetOtpInputs();
    });
  } else {
    // Fallback to simulated local verification (for phone SMS codes)
    if (enteredCode === window.currentSimulatedOtp) {
      completeVerification();
    } else {
      alert("Invalid OTP code. Please enter the correct code.");
      resetOtpInputs();
    }
  }
  
  function completeVerification() {
    if (window.otpInterval) clearInterval(window.otpInterval);
    if (window.resendInterval) clearInterval(window.resendInterval);
    
    const modal = document.getElementById("verificationOtpModal");
    const overlay = document.getElementById("drawerOverlay");
    if (modal && overlay) {
      modal.classList.remove("active");
      overlay.classList.remove("active");
    }
    
    otpDigits.forEach(d => d.value = "");
    handleOtpVerificationSuccess();
  }
  
  function resetOtpInputs() {
    otpDigits.forEach(d => d.value = "");
    const firstInput = document.getElementById("otp1");
    if (firstInput) firstInput.focus();
  }
}

function handleOtpVerificationSuccess() {
  const { purpose, targetData } = window.otpPurpose;
  let usersList = JSON.parse(localStorage.getItem("vaishveda_users")) || [];
  
  if (purpose === "SIGNUP") {
    fetch("api.php?action=register_user", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({
        name: targetData.name,
        email: targetData.email,
        phone: targetData.phone,
        password: targetData.password,
        referral: targetData.referral
      })
    })
    .then(res => res.json())
    .then(res => {
      if (res.success) {
        const newUser = res.user;
        sessionStorage.setItem("vaishveda_active_user", JSON.stringify(newUser));
        alert("Successfully registered and logged in! 100 welcome reward points credited.");
        location.reload();
      } else {
        alert(res.message);
      }
    })
    .catch(err => {
      console.error("Registration error:", err);
      alert("Registration failed on server. Please try again.");
    });
  }
  else if (purpose === "MOBILE_LOGIN") {
    fetch("api.php?action=otp_login_user", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ phone: targetData.phone })
    })
    .then(res => res.json())
    .then(res => {
      if (res.success) {
        const user = res.user;
        if (targetData.rememberMe) {
          localStorage.setItem("vaishveda_active_user", JSON.stringify(user));
        } else {
          sessionStorage.setItem("vaishveda_active_user", JSON.stringify(user));
        }
        alert("Successfully logged in via Mobile OTP!");
        location.reload();
      } else {
        alert(res.message);
      }
    })
    .catch(err => {
      console.error("Mobile login API error:", err);
      alert("Mobile login failed.");
    });
  }
  else if (purpose === "FORGOT_PASSWORD") {
    const newPass = prompt("OTP Verified! Please enter a new password (min 8 characters, uppercase, lowercase, digit, special):");
    if (!newPass) return;
    
    const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*(),.?":{}|<>]).{8,}$/;
    if (!regex.test(newPass)) {
      alert("Password requirements not met. Reset failed.");
      return;
    }
    
    const uIdx = usersList.findIndex(u => u.email === targetData.contact || u.phone === targetData.contact);
    if (uIdx !== -1) {
      usersList[uIdx].password = newPass;
      localStorage.setItem("vaishveda_users", JSON.stringify(usersList));
      alert("Password updated! Sign in with your new password.");
    }
  }
  else if (purpose === "EMAIL_CHANGE") {
    let activeUser = JSON.parse(sessionStorage.getItem("vaishveda_active_user")) || JSON.parse(localStorage.getItem("vaishveda_active_user")) || null;
    const uIdx = usersList.findIndex(u => u.email === activeUser.email);
    if (uIdx !== -1) {
      usersList[uIdx].email = targetData.newEmail;
      localStorage.setItem("vaishveda_users", JSON.stringify(usersList));
      
      activeUser.email = targetData.newEmail;
      const isLocal = !!localStorage.getItem("vaishveda_active_user");
      if (isLocal) {
        localStorage.setItem("vaishveda_active_user", JSON.stringify(activeUser));
      } else {
        sessionStorage.setItem("vaishveda_active_user", JSON.stringify(activeUser));
      }
      alert("Email updated!");
      location.reload();
    }
  }
  else if (purpose === "PHONE_CHANGE") {
    let activeUser = JSON.parse(sessionStorage.getItem("vaishveda_active_user")) || JSON.parse(localStorage.getItem("vaishveda_active_user")) || null;
    const uIdx = usersList.findIndex(u => u.email === activeUser.email);
    if (uIdx !== -1) {
      usersList[uIdx].phone = targetData.newPhone;
      localStorage.setItem("vaishveda_users", JSON.stringify(usersList));
      
      activeUser.phone = targetData.newPhone;
      const isLocal = !!localStorage.getItem("vaishveda_active_user");
      if (isLocal) {
        localStorage.setItem("vaishveda_active_user", JSON.stringify(activeUser));
      } else {
        sessionStorage.setItem("vaishveda_active_user", JSON.stringify(activeUser));
      }
      alert("Phone number updated!");
      location.reload();
    }
  }
}

// 11. SOCIAL AUTH SIMULATOR
window.triggerSocialAuth = function(provider) {
  const loader = document.getElementById("globalLoaderOverlay");
  if (loader) {
    document.getElementById("globalLoaderText").textContent = `Signing in with ${provider}...`;
    loader.classList.add("active");
  }
  
  setTimeout(() => {
    if (loader) loader.classList.remove("active");
    
    const names = ["Aarav Sharma", "Ananya Iyer", "Rahul Verma", "Priya Patel", "Vikram Sen"];
    const name = names[Math.floor(Math.random() * names.length)];
    const email = `${name.toLowerCase().replace(" ", "_")}@gmail.com`;
    const phone = Math.floor(6000000000 + Math.random() * 4000000000).toString();
    
    let usersList = JSON.parse(localStorage.getItem("vaishveda_users")) || [];
    let user = usersList.find(u => u.email === email);
    
    if (!user) {
      user = {
        name: name,
        email: email,
        phone: phone,
        joinedDate: new Date().toISOString().split("T")[0],
        status: "Active",
        rewardPoints: 100,
        walletTransactions: [{ date: new Date().toLocaleDateString("en-IN"), type: "Signup Bonus", points: 100, balance: 100 }],
        addresses: [],
        cards: [],
        notifications: [{ id: Date.now(), title: `Connected via ${provider}`, message: "Successfully logged in via social integration.", date: new Date().toLocaleDateString("en-IN"), read: false }],
        wishlist: [],
        cart: []
      };
      usersList.push(user);
      localStorage.setItem("vaishveda_users", JSON.stringify(usersList));
    }
    
    if (user.status === "Suspended") {
      alert("This account has been suspended.");
      return;
    }
    
    sessionStorage.setItem("vaishveda_active_user", JSON.stringify(user));
    alert(`Successfully signed in via ${provider} as ${user.name}!`);
    location.reload();
  }, 1200);
};

// Wire up verification timers cancellation triggers
const otpResendBtn = document.getElementById("otpResendBtn");
if (otpResendBtn) {
  otpResendBtn.addEventListener("click", () => {
    if (window.otpPurpose) sendOtp(window.otpPurpose.purpose, window.otpPurpose.targetData);
  });
}

const otpCancelBtn = document.getElementById("otpCancelBtn");
if (otpCancelBtn) {
  otpCancelBtn.addEventListener("click", () => {
    clearInterval(window.otpInterval);
    clearInterval(window.resendInterval);
    
    const modal = document.getElementById("verificationOtpModal");
    const overlay = document.getElementById("drawerOverlay");
    if (modal && overlay) {
      modal.classList.remove("active");
      overlay.classList.remove("active");
    }
  });
}

// 12. SCROLL REVEAL ANIMATION FOR CONTACT SECTION
function initScrollReveal() {
  const contactSec = document.getElementById("contact-section");
  if (!contactSec) return;

  // If IntersectionObserver is supported, reveal on scroll; otherwise reveal immediately
  if ('IntersectionObserver' in window) {
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          contactSec.classList.add("reveal");
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.1 });
    observer.observe(contactSec);
  } else {
    contactSec.classList.add("reveal");
  }
}

/* ==========================================================================
   FAQ DATABASE & INTERACTIVE ENGINE
   ========================================================================== */

const FAQ_CATEGORIES = {
  "General": { label: "General Questions", icon: "leaf-outline" },
  "Products": { label: "Product Information", icon: "flower-outline" },
  "Account": { label: "Account & Login", icon: "person-outline" },
  "Shipping": { label: "Shipping & Delivery", icon: "bus-outline" },
  "Payments": { label: "Payments", icon: "card-outline" },
  "Returns": { label: "Returns & Refunds", icon: "refresh-outline" },
  "Support": { label: "Orders & Support", icon: "heart-outline" },
  "Offers": { label: "Offers & Rewards", icon: "gift-outline" },
  "Security": { label: "Privacy & Security", icon: "lock-closed-outline" }
};

const DEFAULT_FAQ_DB = [
  // General Questions
  {
    id: "faq_1",
    category: "General",
    question: "What is VAISHVEDA?",
    answer: "VAISHVEDA is a premium Ayurvedic wellness brand dedicated to creating high-quality herbal skincare, haircare, and wellness products inspired by traditional Ayurveda and modern quality standards."
  },
  {
    id: "faq_2",
    category: "General",
    question: "What makes VAISHVEDA products unique?",
    answer: "Our products are formulated using carefully selected herbal ingredients and are designed to support your daily skincare and haircare routine while maintaining high quality standards."
  },
  {
    id: "faq_3",
    category: "General",
    question: "Are your products made with natural ingredients?",
    answer: "Yes. Our products are made with carefully selected herbal and naturally inspired ingredients. Please check each product page for the complete ingredient list."
  },
  {
    id: "faq_4",
    category: "General",
    question: "Are your products safe to use?",
    answer: "Yes. Our products are manufactured following quality standards. However, we recommend performing a patch test before first use."
  },
  {
    id: "faq_5",
    category: "General",
    question: "Where are your products manufactured?",
    answer: "Our products are manufactured in India following quality manufacturing practices."
  },
  // Product Information
  {
    id: "faq_6",
    category: "Products",
    question: "Are your products suitable for all skin types?",
    answer: "Most products are suitable for all skin types. Since everyone's skin is different, we recommend performing a patch test before first use."
  },
  {
    id: "faq_7",
    category: "Products",
    question: "Are your products suitable for sensitive skin?",
    answer: "Many of our products are suitable for sensitive skin, but individuals with allergies or specific skin conditions should consult a healthcare professional before use."
  },
  {
    id: "faq_8",
    category: "Products",
    question: "Are your products cruelty-free?",
    answer: "Yes. We are committed to ethical practices and do not test our products on animals."
  },
  {
    id: "faq_9",
    category: "Products",
    question: "Do your products contain harmful chemicals?",
    answer: "Our formulations are developed using carefully selected ingredients. Please refer to the product label for complete ingredient details."
  },
  {
    id: "faq_10",
    category: "Products",
    question: "How should I store the products?",
    answer: "Store products in a cool, dry place away from direct sunlight. Keep the cap tightly closed after every use."
  },
  {
    id: "faq_11",
    category: "Products",
    question: "What is the shelf life of your products?",
    answer: "Most products have a shelf life of 24–36 months. Please check the expiry date printed on the packaging."
  },
  {
    id: "faq_12",
    category: "Products",
    question: "Can pregnant or breastfeeding women use your products?",
    answer: "We recommend consulting a healthcare professional before using any skincare or wellness products during pregnancy or breastfeeding."
  },
  // Account & Login
  {
    id: "faq_13",
    category: "Account",
    question: "Why should I create an account?",
    answer: "Creating an account allows you to:\n\n- Track your orders\n- View order history\n- Save multiple addresses\n- Enjoy faster checkout\n- Manage your profile"
  },
  {
    id: "faq_14",
    category: "Account",
    question: "How do I create an account?",
    answer: "Click on the Sign Up button, enter your details, verify your email or mobile number, and your account will be ready."
  },
  {
    id: "faq_15",
    category: "Account",
    question: "I forgot my password. What should I do?",
    answer: "Click Forgot Password on the login page. We'll send a password reset link to your registered email."
  },
  {
    id: "faq_16",
    category: "Account",
    question: "Can I update my personal information?",
    answer: "Yes. Simply log in to your account and update your profile details anytime."
  },
  {
    id: "faq_17",
    category: "Account",
    question: "Can I place an order without creating an account?",
    answer: "Yes. Guest checkout is available, but creating an account offers additional benefits."
  },
  // Shipping & Delivery
  {
    id: "faq_18",
    category: "Shipping",
    question: "How long does shipping take?",
    answer: "Orders are usually processed within 24–48 hours.\n\nEstimated delivery:\n\n- Metro Cities: 2–5 business days\n- Other Locations: 4–8 business days"
  },
  {
    id: "faq_19",
    category: "Shipping",
    question: "Do you deliver across India?",
    answer: "Yes. We ship to most locations across India."
  },
  {
    id: "faq_20",
    category: "Shipping",
    question: "Do you offer international shipping?",
    answer: "International shipping may be available for selected countries. Please contact us before placing your order."
  },
  {
    id: "faq_21",
    category: "Shipping",
    question: "How can I track my order?",
    answer: "Once your order is shipped, you'll receive a tracking number via email or SMS."
  },
  {
    id: "faq_22",
    category: "Shipping",
    question: "What if my package is delayed?",
    answer: "Delivery may occasionally be delayed due to weather, courier issues, or public holidays. Our support team will be happy to assist you."
  },
  // Payments
  {
    id: "faq_23",
    category: "Payments",
    question: "Which payment methods do you accept?",
    answer: "We accept UPI, Credit Cards, Debit Cards, Net Banking, Wallets, and Cash on Delivery (Eligible Locations)."
  },
  {
    id: "faq_24",
    category: "Payments",
    question: "Is Cash on Delivery (COD) available?",
    answer: "Yes. COD is available in eligible serviceable locations."
  },
  {
    id: "faq_25",
    category: "Payments",
    question: "Is my payment secure?",
    answer: "Yes. All transactions are processed through secure, encrypted payment gateways."
  },
  {
    id: "faq_26",
    category: "Payments",
    question: "Will I receive an invoice?",
    answer: "Yes. A digital invoice will be sent to your registered email after your order is confirmed."
  },
  // Returns, Refunds & Cancellations
  {
    id: "faq_27",
    category: "Returns",
    question: "Can I cancel my order?",
    answer: "Yes. Orders can be cancelled before they are shipped."
  },
  {
    id: "faq_28",
    category: "Returns",
    question: "What is your return policy?",
    answer: "Returns are accepted only for damaged, defective, or incorrect products. Please contact us within 48 hours of delivery."
  },
  {
    id: "faq_29",
    category: "Returns",
    question: "How do I request a refund?",
    answer: "Once your returned product is received and approved, the refund will be processed within 5–7 business days."
  },
  {
    id: "faq_30",
    category: "Returns",
    question: "What if I receive a damaged product?",
    answer: "Please contact our support team immediately with photos of the damaged product and packaging."
  },
  // Orders & Customer Support
  {
    id: "faq_31",
    category: "Support",
    question: "How do I know my order is confirmed?",
    answer: "You'll receive an order confirmation email and SMS immediately after placing your order."
  },
  {
    id: "faq_32",
    category: "Support",
    question: "Can I modify my order after placing it?",
    answer: "Changes may be possible before your order is shipped. Please contact us as soon as possible."
  },
  {
    id: "faq_33",
    category: "Support",
    question: "How can I contact customer support?",
    answer: "You can contact us through:\n\n- Email: vaishveda26@gmail.com\n- Website: vaishveda.com\n- WhatsApp: Click the WhatsApp button available on our website."
  },
  {
    id: "faq_34",
    category: "Support",
    question: "What are your customer support hours?",
    answer: "Our support team is available Monday to Saturday during business hours. We'll respond to all queries as quickly as possible."
  },
  // Offers & Rewards
  {
    id: "faq_35",
    category: "Offers",
    question: "Do you offer discounts?",
    answer: "Yes. We regularly run seasonal sales, festive offers, and exclusive promotions."
  },
  {
    id: "faq_36",
    category: "Offers",
    question: "How can I stay updated about offers?",
    answer: "Subscribe to our newsletter and follow us on our social media channels for the latest updates."
  },
  {
    id: "faq_37",
    category: "Offers",
    question: "Do you offer gift cards?",
    answer: "Gift cards may be introduced in the future. Stay tuned for updates."
  },
  // Privacy & Security
  {
    id: "faq_38",
    category: "Security",
    question: "Is my personal information safe?",
    answer: "Yes. We protect your information using industry-standard security practices and do not share your personal information without your consent, except where required to fulfill your order or comply with legal obligations."
  },
  {
    id: "faq_39",
    category: "Security",
    question: "Do you store my payment details?",
    answer: "No. We do not store your card or banking details. Payments are securely processed by trusted payment partners."
  }
];

if (!localStorage.getItem("vaishveda_faq_db")) {
  localStorage.setItem("vaishveda_faq_db", JSON.stringify(DEFAULT_FAQ_DB));
}

function getFAQFromDB() {
  return JSON.parse(localStorage.getItem("vaishveda_faq_db")) || DEFAULT_FAQ_DB;
}

function saveFAQToDB(faqs) {
  localStorage.setItem("vaishveda_faq_db", JSON.stringify(faqs));
}

function initFaqPage() {
  const accordionContainer = document.getElementById("faqAccordionContainer");
  if (!accordionContainer) return;

  fetch("api.php?action=get_faqs")
    .then(res => res.json())
    .then(faqs => {
      if (!faqs || faqs.length === 0) {
        const faqList = getFAQFromDB();
        faqList.forEach(faq => {
          fetch("api.php?action=save_faq", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(faq)
          });
        });
        setupFaqDOM(faqList);
      } else {
        setupFaqDOM(faqs);
      }
    })
    .catch(err => {
      console.error("Error loading FAQs from database:", err);
      const faqList = getFAQFromDB();
      setupFaqDOM(faqList);
    });

  function setupFaqDOM(faqList) {
    const searchInput = document.getElementById("faqSearchInput");
    const countDisplay = document.getElementById("faqCountDisplay");
    const sidebarNav = document.getElementById("faqSidebarNav");
    
    function renderFAQs(filterQuery = "") {
    const query = filterQuery.toLowerCase().trim();
    const grouped = {};
    Object.keys(FAQ_CATEGORIES).forEach(cat => {
      grouped[cat] = [];
    });
    
    let totalCount = 0;
    faqList.forEach(faq => {
      const matchesSearch = faq.question.toLowerCase().includes(query) || 
                            faq.answer.toLowerCase().includes(query);
      if (matchesSearch) {
        if (grouped[faq.category]) {
          grouped[faq.category].push(faq);
          totalCount++;
        }
      }
    });
    
    if (countDisplay) {
      countDisplay.textContent = `Showing ${totalCount} FAQ${totalCount !== 1 ? 's' : ''}`;
    }
    
    if (totalCount === 0) {
      accordionContainer.innerHTML = `
        <div class="text-center" style="padding: 50px 20px;">
          <ion-icon name="search-outline" style="font-size: 3rem; color: var(--color-accent); opacity: 0.5; margin-bottom: 15px;"></ion-icon>
          <h3 style="font-family: var(--font-serif); font-size: 1.5rem; margin-bottom: 8px;">No FAQs Found</h3>
          <p style="color: #666; font-size: 13.5px;">We couldn't find any questions matching "${filterQuery}". Please try another search term.</p>
        </div>
      `;
      document.querySelectorAll(".faq-sidebar-item").forEach(item => {
        item.style.display = "none";
      });
      return;
    }
    
    let html = "";
    Object.keys(FAQ_CATEGORIES).forEach(cat => {
      const items = grouped[cat];
      const categoryMeta = FAQ_CATEGORIES[cat];
      const sidebarItem = document.querySelector(`.faq-sidebar-item[data-category="${cat}"]`);
      
      if (items.length === 0) {
        if (sidebarItem) sidebarItem.style.display = "none";
        return;
      }
      
      if (sidebarItem) sidebarItem.style.display = "block";
      
      html += `
        <div class="faq-category-section" id="cat-section-${cat}" style="margin-bottom: 45px; scroll-margin-top: 180px;">
          <h3 class="faq-category-header" style="font-family: var(--font-serif); font-size: 1.5rem; color: var(--color-primary); border-bottom: 1px solid var(--color-cream-dark); padding-bottom: 12px; margin-bottom: 25px; display: flex; align-items: center; gap: 12px;">
            <ion-icon name="${categoryMeta.icon}" style="color: var(--color-accent); font-size: 1.6rem;"></ion-icon>
            ${categoryMeta.label}
          </h3>
          <div class="faq-accordion-list" style="display: flex; flex-direction: column; gap: 15px;">
      `;
      
      items.forEach(faq => {
        html += `
          <div class="faq-accordion-card" id="${faq.id}">
            <button class="faq-accordion-btn" aria-expanded="false">
              <span class="faq-question">${faq.question}</span>
              <span class="faq-toggle-icon"><ion-icon name="add-outline"></ion-icon></span>
            </button>
            <div class="faq-answer-panel" style="max-height: 0px; overflow: hidden; transition: max-height 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);">
              <div class="faq-answer-content" style="padding: 0 25px 20px; font-size: 14px; color: #555; line-height: 1.6; white-space: pre-line;">
                ${faq.answer}
              </div>
            </div>
          </div>
        `;
      });
      
      html += `
          </div>
        </div>
      `;
    });
    
    accordionContainer.innerHTML = html;
    bindAccordionEvents();
    injectSeoSchema(grouped);
  }
  
  function bindAccordionEvents() {
    const cards = accordionContainer.querySelectorAll(".faq-accordion-card");
    cards.forEach(card => {
      const btn = card.querySelector(".faq-accordion-btn");
      const panel = card.querySelector(".faq-answer-panel");
      const iconNode = card.querySelector(".faq-toggle-icon ion-icon");
      
      btn.addEventListener("click", () => {
        const isOpen = btn.getAttribute("aria-expanded") === "true";
        
        cards.forEach(otherCard => {
          if (otherCard !== card) {
            const otherBtn = otherCard.querySelector(".faq-accordion-btn");
            const otherPanel = otherCard.querySelector(".faq-answer-panel");
            const otherIconNode = otherCard.querySelector(".faq-toggle-icon ion-icon");
            
            otherBtn.setAttribute("aria-expanded", "false");
            otherPanel.style.maxHeight = "0px";
            otherCard.classList.remove("open");
            if (otherIconNode) otherIconNode.setAttribute("name", "add-outline");
          }
        });
        
        if (isOpen) {
          btn.setAttribute("aria-expanded", "false");
          panel.style.maxHeight = "0px";
          card.classList.remove("open");
          if (iconNode) iconNode.setAttribute("name", "add-outline");
        } else {
          btn.setAttribute("aria-expanded", "true");
          panel.style.maxHeight = panel.scrollHeight + "px";
          card.classList.add("open");
          if (iconNode) iconNode.setAttribute("name", "remove-outline");
        }
      });
    });
  }
  
  function injectSeoSchema(grouped) {
    const existing = document.getElementById("faq-jsonld-schema");
    if (existing) existing.remove();
    
    const schema = {
      "@context": "https://schema.org",
      "@type": "FAQPage",
      "mainEntity": []
    };
    
    Object.keys(grouped).forEach(cat => {
      grouped[cat].forEach(faq => {
        schema.mainEntity.push({
          "@type": "Question",
          "name": faq.question,
          "acceptedAnswer": {
            "@type": "Answer",
            "text": faq.answer
          }
        });
      });
    });
    
    const script = document.createElement("script");
    script.id = "faq-jsonld-schema";
    script.type = "application/ld+json";
    script.text = JSON.stringify(schema);
    document.head.appendChild(script);
  }
  
  let sidebarHtml = "";
  Object.keys(FAQ_CATEGORIES).forEach((cat, idx) => {
    const meta = FAQ_CATEGORIES[cat];
    sidebarHtml += `
      <li class="faq-sidebar-item ${idx === 0 ? 'active' : ''}" data-category="${cat}">
        <a href="#cat-section-${cat}" class="faq-sidebar-link">
          <ion-icon name="${meta.icon}"></ion-icon>
          <span>${cat}</span>
        </a>
      </li>
    `;
  });
  if (sidebarNav) {
    sidebarNav.innerHTML = sidebarHtml;
  }
  
  document.querySelectorAll(".faq-sidebar-link").forEach(link => {
    link.addEventListener("click", (e) => {
      e.preventDefault();
      const targetId = link.getAttribute("href");
      const target = document.querySelector(targetId);
      if (target) {
        target.scrollIntoView({ behavior: "smooth" });
        document.querySelectorAll(".faq-sidebar-item").forEach(item => {
          item.classList.remove("active");
        });
        link.parentElement.classList.add("active");
      }
    });
  });
  
  if (sidebarNav && 'IntersectionObserver' in window) {
    const observerOptions = {
      root: null,
      rootMargin: "-100px 0px -60% 0px",
      threshold: 0
    };
    
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          const cat = entry.target.id.replace("cat-section-", "");
          document.querySelectorAll(".faq-sidebar-item").forEach(item => {
            if (item.getAttribute("data-category") === cat) {
              item.classList.add("active");
            } else {
              item.classList.remove("active");
            }
          });
        }
      });
    }, observerOptions);
    
    setTimeout(() => {
      document.querySelectorAll(".faq-category-section").forEach(sec => {
        observer.observe(sec);
      });
    }, 500);
  }
  
  if (searchInput) {
    searchInput.addEventListener("input", (e) => {
      renderFAQs(e.target.value);
    });
  }
  
  renderFAQs();
  }
}

/* ==========================================================================
   SHIPPING & RETURN POLICY CMS ENGINE
   ========================================================================== */

const DEFAULT_POLICY_DB = {
  lastUpdated: "2026-06-26",
  shipping: {
    processing: "Orders are processed within 1–2 business days after successful payment.\nOrders placed on Sundays or public holidays will be processed on the next working day.\nProcessing may take slightly longer during festivals or promotional sales.",
    charges: "Free shipping is available for all orders above ₹499. For orders below ₹499, a standard shipping charge of ₹99 is applicable.\nApplicable shipping charges are calculated and shown during checkout.",
    tracking: "Tracking details (Courier name and AWB number) will be sent via Email or SMS after dispatch. You can also track your orders directly from your personal dashboard in the My Account section.",
    deliveryInfo: "Please advise accurate shipping addresses and contact details. VAISHVEDA is not responsible for shipment delays or failed deliveries caused by incorrect or incomplete customer information.",
    times: [
      { location: "Metro Cities", time: "2–5 Business Days" },
      { location: "Tier 2 & Tier 3 Cities", time: "3–7 Business Days" },
      { location: "Remote Areas", time: "5–10 Business Days" }
    ]
  },
  returns: {
    eligibility: "Returns or replacements are accepted only if:\n- Product received is damaged.\n- Wrong product delivered.\n- Product is defective.\n- Product has missing items or accessories.",
    request: "Customers must contact our support team within 48 hours of receiving the order.\n\nPlease provide the following details when making a request:\n1. Order Number (e.g. #VV-12345)\n2. Product Name & Batch details\n3. Precise Reason for Return\n4. Unboxing photos or video demonstrating the issue",
    email: "vaishveda26@gmail.com"
  },
  nonReturnable: {
    text: "The following categories are strictly not eligible for returns or refunds due to hygiene and health guidelines:\n- Opened or used skincare products\n- Opened or used haircare products\n- Products showing signs of misuse or partial consumption\n- Products damaged due to improper storage after delivery\n- Clearance, festive sales, or final sale items (unless received defective)"
  },
  refunds: {
    processing: "Refunds are initiated only after the returned products reach our warehouse and successfully pass our quality control inspection check.\nApproved refunds are processed within 5–7 business days.",
    method: "Online payments (UPI, Card, Net Banking) are refunded directly to the original payment source.\nCash on Delivery (COD) refunds are processed via bank transfer after verifying the customer's bank account credentials."
  },
  cancellation: {
    text: "Orders can be cancelled before they are dispatched. Once an order is shipped, cancellation requests cannot be accepted.\nCustomers should contact support immediately for urgent cancellation requests."
  },
  damagedPackage: {
    text: "If you receive a package that appears damaged, tampered with, or leaking at the time of delivery:\n- Take clear photos of the package outer box BEFORE opening it.\n- Record a continuous unboxing video of the product if possible.\n- Contact support within 48 hours with order details and files.\n\nClaims submitted after the 48-hour window may not be eligible for replacement or refund."
  },
  contact: {
    email: "vaishveda26@gmail.com",
    website: "vaishveda.com",
    phone: "919876543210"
  }
};

if (!localStorage.getItem("vaishveda_policy_db")) {
  localStorage.setItem("vaishveda_policy_db", JSON.stringify(DEFAULT_POLICY_DB));
}

function getPolicyFromDB() {
  try {
    const data = localStorage.getItem("vaishveda_policy_db");
    if (data) {
      const parsed = JSON.parse(data);
      if (parsed && parsed.shipping && parsed.returns) {
        return parsed;
      }
    }
  } catch (e) {
    console.error("Failed to parse policy data", e);
  }
  return DEFAULT_POLICY_DB;
}

function savePolicyToDB(policy) {
  localStorage.setItem("vaishveda_policy_db", JSON.stringify(policy));
}

function initPolicyPage() {
  const container = document.getElementById("policyContainer");
  if (!container) return;

  container.style.opacity = 0.5;

  fetch("api.php?action=get_policy&key=global_policy")
    .then(res => res.json())
    .then(policyData => {
      let policy = DEFAULT_POLICY_DB;
      if (policyData && policyData.content_json) {
        policy = policyData.content_json;
      } else {
        fetch("api.php?action=save_policy", {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify({
            key_name: "global_policy",
            content_json: DEFAULT_POLICY_DB,
            last_updated: DEFAULT_POLICY_DB.lastUpdated
          })
        });
      }
      setupPolicyDOM(policy);
    })
    .catch(err => {
      console.error("Error loading policy from DB, fallback:", err);
      const policy = getPolicyFromDB();
      setupPolicyDOM(policy);
    });

  function setupPolicyDOM(policy) {
    container.style.opacity = 1;
    const formatText = (text) => text ? text.replace(/\n/g, "<br>") : "";

  // Populate Shipping Policy
  const shipProcessing = document.getElementById("shipProcessing");
  const shipCharges = document.getElementById("shipCharges");
  const shipTracking = document.getElementById("shipTracking");
  const shipDeliveryInfo = document.getElementById("shipDeliveryInfo");
  const shipTableBody = document.getElementById("shipTableBody");

  if (shipProcessing) shipProcessing.innerHTML = formatText(policy.shipping.processing);
  if (shipCharges) shipCharges.innerHTML = formatText(policy.shipping.charges);
  if (shipTracking) shipTracking.innerHTML = formatText(policy.shipping.tracking);
  if (shipDeliveryInfo) shipDeliveryInfo.innerHTML = formatText(policy.shipping.deliveryInfo);

  if (shipTableBody && policy.shipping.times) {
    shipTableBody.innerHTML = policy.shipping.times.map(t => `
      <tr>
        <td><strong>${t.location}</strong></td>
        <td>${t.time}</td>
      </tr>
    `).join("");
  }

  // Populate Returns
  const retEligibility = document.getElementById("retEligibility");
  const retRequest = document.getElementById("retRequest");
  const retEmailLinks = document.querySelectorAll(".ret-email-link");

  if (retEligibility) retEligibility.innerHTML = formatText(policy.returns.eligibility);
  if (retRequest) retRequest.innerHTML = formatText(policy.returns.request);
  retEmailLinks.forEach(link => {
    link.textContent = policy.returns.email;
    link.href = `mailto:${policy.returns.email}`;
  });

  // Populate Non-Returnable
  const nonReturnableText = document.getElementById("nonReturnableText");
  if (nonReturnableText) nonReturnableText.innerHTML = formatText(policy.nonReturnable.text);

  // Populate Refunds
  const refProcessing = document.getElementById("refProcessing");
  const refMethod = document.getElementById("refMethod");
  if (refProcessing) refProcessing.innerHTML = formatText(policy.refunds.processing);
  if (refMethod) refMethod.innerHTML = formatText(policy.refunds.method);

  // Populate Cancellation
  const cancellationText = document.getElementById("cancellationText");
  if (cancellationText) cancellationText.innerHTML = formatText(policy.cancellation.text);

  // Populate Damaged Package
  const damagedPackageText = document.getElementById("damagedPackageText");
  if (damagedPackageText) damagedPackageText.innerHTML = formatText(policy.damagedPackage.text);

  // Populate Contact & CTAs
  const contactEmailVal = document.getElementById("contactEmailVal");
  const contactWebVal = document.getElementById("contactWebVal");
  const contactPhoneVal = document.getElementById("contactPhoneVal");
  const contactMailBtn = document.getElementById("contactMailBtn");
  const contactWaBtn = document.getElementById("contactWaBtn");

  if (contactEmailVal) contactEmailVal.textContent = policy.contact.email;
  if (contactWebVal) {
    contactWebVal.textContent = policy.contact.website;
    contactWebVal.href = `https://${policy.contact.website}`;
  }
  if (contactPhoneVal) {
    contactPhoneVal.textContent = `+91 ${policy.contact.phone}`;
  }
  if (contactMailBtn) {
    contactMailBtn.href = `mailto:${policy.contact.email}`;
  }
  if (contactWaBtn) {
    contactWaBtn.href = "https://wa.me/message/NUOW33NFTUHNH1";
  }

  // Populate Last Updated
  const lastUpdatedEl = document.getElementById("policyLastUpdated");
  if (lastUpdatedEl) {
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    const date = new Date(policy.lastUpdated);
    const formattedDate = isNaN(date.getTime()) ? policy.lastUpdated : date.toLocaleDateString("en-US", options);
    lastUpdatedEl.textContent = `Last Updated: ${formattedDate}`;
  }

  // Setup Sidebar TOC scroll-spy
  setupPolicyTOCSpy();
  
  // Setup Mobile Accordions
  setupPolicyMobileAccordions();

  // Inject SEO WebPage & Organisation Schema
  injectPolicySeoSchema(policy);
  }
}

function setupPolicyTOCSpy() {
  const links = document.querySelectorAll(".policy-toc-link");
  if (links.length === 0 || !('IntersectionObserver' in window)) return;

  const observerOptions = {
    root: null,
    rootMargin: "-100px 0px -70% 0px",
    threshold: 0
  };

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const id = entry.target.id;
        links.forEach(link => {
          if (link.getAttribute("href") === `#${id}`) {
            link.parentElement.classList.add("active");
            const list = link.closest(".policy-toc-menu");
            if (list && window.innerWidth < 992) {
              list.scrollTo({
                left: link.parentElement.offsetLeft - 20,
                behavior: 'smooth'
              });
            }
          } else {
            link.parentElement.classList.remove("active");
          }
        });
      }
    });
  }, observerOptions);

  document.querySelectorAll(".policy-section").forEach(sec => {
    observer.observe(sec);
  });

  links.forEach(link => {
    link.addEventListener("click", (e) => {
      e.preventDefault();
      const targetId = link.getAttribute("href");
      const target = document.querySelector(targetId);
      if (target) {
        target.scrollIntoView({ behavior: "smooth" });
        links.forEach(l => l.parentElement.classList.remove("active"));
        link.parentElement.classList.add("active");
      }
    });
  });
}

function setupPolicyMobileAccordions() {
  const cards = document.querySelectorAll(".policy-card");
  
  const handleResize = () => {
    const isMobile = window.innerWidth < 768;
    cards.forEach(card => {
      const header = card.querySelector("h3");
      const content = card.querySelector(".policy-card-body");
      
      if (!header || !content) return;
      
      // Clear listeners
      const newHeader = header.cloneNode(true);
      header.parentNode.replaceChild(newHeader, header);
      
      if (isMobile) {
        card.classList.add("accordion-mode");
        content.style.maxHeight = card.classList.contains("open") ? content.scrollHeight + "px" : "0px";
        
        newHeader.addEventListener("click", () => {
          const isOpen = card.classList.contains("open");
          if (isOpen) {
            card.classList.remove("open");
            content.style.maxHeight = "0px";
          } else {
            card.classList.add("open");
            content.style.maxHeight = content.scrollHeight + "px";
          }
        });
      } else {
        card.classList.remove("accordion-mode", "open");
        content.style.maxHeight = "none";
      }
    });
  };

  window.addEventListener("resize", handleResize);
  handleResize();
}

function injectPolicySeoSchema(policy) {
  const existing = document.getElementById("policy-jsonld-schema");
  if (existing) existing.remove();

  const schema = {
    "@context": "https://schema.org",
    "@type": "WebPage",
    "name": "Shipping & Return Policy | Vaishveda",
    "description": "Read about Vaishveda's transparent shipping rates, fast processing timelines, return eligibility conditions, cancellation, and refund rules.",
    "publisher": {
      "@type": "Organization",
      "name": "Vaishveda Luxury Ayurveda",
      "logo": {
        "@type": "ImageObject",
        "url": "https://vaishveda.com/assets/logo.png"
      }
    },
    "dateModified": policy.lastUpdated
  };

  const script = document.createElement("script");
  script.id = "policy-jsonld-schema";
  script.type = "application/ld+json";
  script.text = JSON.stringify(schema);
  document.head.appendChild(script);
}

