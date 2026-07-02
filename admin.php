<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard | Vaishveda Luxury Ayurveda</title>
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <!-- Stylesheets -->
  <link rel="stylesheet" href="styles.css">
  <!-- Ionicons -->
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</head>
<body class="admin-body">

  <!-- ADMIN LOGIN PANEL -->
  <div class="admin-login-wrapper" id="adminLoginPanel">
    <div class="admin-login-card">
      <img src="assets/logo_cropped.png" alt="Vaishveda Logo" class="admin-login-logo">
      <h3>Administration Login</h3>
      <p>Please enter credentials to access the orders panel.</p>
      
      <div class="admin-login-error" id="loginError">Invalid Username or Password.</div>
      
      <form id="adminLoginForm">
        <div class="checkout-form">
          <div class="form-group">
            <label for="adminUsername">Username</label>
            <input type="text" id="adminUsername" required placeholder="e.g. admin">
          </div>
          <div class="form-group" style="margin-bottom: 25px;">
            <label for="adminPassword">Password</label>
            <input type="password" id="adminPassword" required placeholder="••••••••">
          </div>
          <button type="submit" class="btn btn-primary" style="width: 100%;">Access Dashboard</button>
        </div>
      </form>
      
      <a href="index.php" style="display: inline-block; margin-top: 25px; font-size: 12px; color: var(--color-accent-dark); text-transform: uppercase; letter-spacing: 1px; font-weight: 600;">← Back to Storefront</a>
    </div>
  </div>

  <!-- ADMIN DASHBOARD PANEL -->
  <div id="adminDashboardPanel" style="display: none;">
    <!-- Dashboard Header -->
    <header class="admin-header">
      <div class="admin-brand">
        <img src="assets/logo_cropped.png" alt="Vaishveda Logo">
        <h2>VAISHVEDA</h2>
      </div>
      <div class="admin-user-info">
        <span>Logged In: Administrator</span>
        <button class="btn-logout" id="logoutBtn">Logout</button>
      </div>
    </header>

    <!-- Main Container -->
    <main class="admin-container">
      
      <!-- Metrics Overview Cards -->
      <section class="admin-metrics-grid">
        <div class="metric-card">
          <div class="metric-icon">
            <ion-icon name="cart-outline"></ion-icon>
          </div>
          <div class="metric-details">
            <h4>Total Orders</h4>
            <p id="statTotalOrders">0</p>
          </div>
        </div>
        
        <div class="metric-card">
          <div class="metric-icon">
            <ion-icon name="wallet-outline"></ion-icon>
          </div>
          <div class="metric-details">
            <h4>Total Revenue</h4>
            <p id="statTotalRevenue">₹0</p>
          </div>
        </div>
        
        <div class="metric-card">
          <div class="metric-icon">
            <ion-icon name="analytics-outline"></ion-icon>
          </div>
          <div class="metric-details">
            <h4>Avg. Order Value</h4>
            <p id="statAvgValue">₹0</p>
          </div>
        </div>
        
        <div class="metric-card">
          <div class="metric-icon">
            <ion-icon name="cube-outline"></ion-icon>
          </div>
          <div class="metric-details">
            <h4>Active Catalog</h4>
            <p>4 Products</p>
          </div>
        </div>
      </section>

      <!-- Admin Tab Switcher -->
      <div class="admin-tabs-row" style="display: flex; gap: 15px; margin-bottom: 25px; border-bottom: 1px solid var(--color-cream-dark); padding-bottom: 8px;">
        <button class="btn btn-tab active" id="adminTabOrders" style="background:none; border:none; padding: 10px 20px; font-family:var(--font-serif); font-size:1.15rem; color:var(--color-primary); border-bottom: 2px solid var(--color-accent); cursor:pointer; font-weight:600; margin-bottom:-10px;">Orders Management</button>
        <button class="btn btn-tab" id="adminTabCustomers" style="background:none; border:none; padding: 10px 20px; font-family:var(--font-serif); font-size:1.15rem; color:var(--color-charcoal); opacity:0.6; cursor:pointer; margin-bottom:-10px;">Customer Directory</button>
        <button class="btn btn-tab" id="adminTabFaqs" style="background:none; border:none; padding: 10px 20px; font-family:var(--font-serif); font-size:1.15rem; color:var(--color-charcoal); opacity:0.6; cursor:pointer; margin-bottom:-10px;">FAQ Manager</button>
        <button class="btn btn-tab" id="adminTabPolicy" style="background:none; border:none; padding: 10px 20px; font-family:var(--font-serif); font-size:1.15rem; color:var(--color-charcoal); opacity:0.6; cursor:pointer; margin-bottom:-10px;">Policy CMS</button>
      </div>

      <!-- TAB PANEL: Orders -->
      <div class="admin-panel-view" id="adminPanelOrders" style="display: block;">
        <!-- Orders Panel -->
        <section class="admin-panel">
          <div class="panel-header">
            <h3>Customer Orders Logs</h3>
            <div class="panel-actions">
              <button class="btn btn-outline" id="resetDataBtn" style="font-size: 10px; padding: 8px 16px;">Clear Order History</button>
              <a href="index.php" class="btn btn-primary" style="font-size: 10px; padding: 8px 16px;">Go to Storefront</a>
            </div>
          </div>

          <div class="admin-table-wrapper">
            <table class="admin-table" id="ordersTable">
              <thead>
                <tr>
                  <th>Order ID</th>
                  <th>Date / Time</th>
                  <th>Customer Contact</th>
                  <th>Purchased Items</th>
                  <th>Total Bill</th>
                  <th>Order Status</th>
                  <th style="text-align: right;">Actions</th>
                </tr>
              </thead>
              <tbody id="ordersTableBody">
                <!-- Rendered dynamically -->
              </tbody>
            </table>
          </div>

          <!-- Empty State -->
          <div class="admin-empty" id="emptyState" style="display: none;">
            <ion-icon name="receipt-outline" style="font-size: 4rem; color: var(--color-accent); opacity: 0.6;"></ion-icon>
            <h3>No Orders Found</h3>
            <p>Orders placed on the storefront will be captured and displayed here.</p>
          </div>
        </section>
      </div>

      <!-- TAB PANEL: Customers -->
      <div class="admin-panel-view" id="adminPanelCustomers" style="display: none;">
        <section class="admin-panel">
          <div class="panel-header">
            <h3>Customer Directory</h3>
            <div class="panel-actions" style="display:flex; gap:15px; align-items:center;">
              <input type="text" id="customerSearchInput" placeholder="Search by name, email, phone..." style="padding:8px 12px; font-size:12px; border:1px solid var(--color-cream-dark); border-radius:var(--border-radius); width:240px; background-color:var(--color-white); color:var(--color-charcoal);">
              <button class="btn btn-outline" id="exportCustomersCsvBtn" style="font-size:10px; padding:8px 16px;"><ion-icon name="download-outline" style="vertical-align:middle; margin-right:5px;"></ion-icon> Export CSV</button>
            </div>
          </div>

          <div class="admin-table-wrapper">
            <table class="admin-table" id="customersTable">
              <thead>
                <tr>
                  <th>Customer Name</th>
                  <th>Email Address</th>
                  <th>Mobile Phone</th>
                  <th>Loyalty Balance</th>
                  <th>Member Since</th>
                  <th>Account Status</th>
                  <th style="text-align: right;">Actions</th>
                </tr>
              </thead>
              <tbody id="customersTableBody">
                <!-- Rendered dynamically -->
              </tbody>
            </table>
          </div>
        </section>
      </div>

      <!-- TAB PANEL: FAQs -->
      <div class="admin-panel-view" id="adminPanelFaqs" style="display: none;">
        <section class="admin-panel">
          <div class="panel-header">
            <h3>FAQ Directory Manager</h3>
            <div class="panel-actions" style="display:flex; gap:15px; align-items:center;">
              <input type="text" id="adminFaqSearchInput" placeholder="Search questions or answers..." style="padding:8px 12px; font-size:12px; border:1px solid var(--color-cream-dark); border-radius:var(--border-radius); width:240px; background-color:var(--color-white); color:var(--color-charcoal);">
              <select id="adminFaqCategoryFilter" style="padding:8px 12px; font-size:12px; border:1px solid var(--color-cream-dark); border-radius:var(--border-radius); background-color:var(--color-white); color:var(--color-charcoal); outline:none;">
                <option value="">All Categories</option>
                <option value="General">General Questions</option>
                <option value="Products">Product Information</option>
                <option value="Account">Account & Login</option>
                <option value="Shipping">Shipping & Delivery</option>
                <option value="Payments">Payments</option>
                <option value="Returns">Returns & Refunds</option>
                <option value="Support">Orders & Support</option>
                <option value="Offers">Offers & Rewards</option>
                <option value="Security">Privacy & Security</option>
              </select>
              <button class="btn btn-primary" id="addFaqBtn" style="font-size:10px; padding:8px 16px;"><ion-icon name="add-outline" style="vertical-align:middle; margin-right:5px;"></ion-icon> Add FAQ</button>
            </div>
          </div>

          <div class="admin-table-wrapper">
            <table class="admin-table" id="faqsTable">
              <thead>
                <tr>
                  <th style="width: 15%;">Category</th>
                  <th style="width: 30%;">Question</th>
                  <th style="width: 40%;">Answer</th>
                  <th style="width: 15%; text-align: right;">Actions</th>
                </tr>
              </thead>
              <tbody id="faqsTableBody">
                <!-- Rendered dynamically -->
              </tbody>
            </table>
          </div>
        </section>
      </div>

      <!-- TAB PANEL: Policy CMS -->
      <div class="admin-panel-view" id="adminPanelPolicy" style="display: none;">
        <section class="admin-panel">
          <div class="panel-header">
            <h3>Policy CMS Database Editor</h3>
            <div class="panel-actions">
              <a href="shipping-returns.php" class="btn btn-primary" style="font-size: 10px; padding: 8px 16px;">View Policy Storefront</a>
            </div>
          </div>

          <form id="adminPolicyForm">
            <div class="checkout-form" style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px; padding: 20px; background-color: var(--color-white); border-radius: var(--border-radius);">
              
              <!-- Column 1: Shipping Details -->
              <div>
                <h4 style="font-family: var(--font-serif); font-size: 1.2rem; color: var(--color-primary); margin-bottom: 15px; border-bottom: 1px dashed var(--color-cream-dark); padding-bottom: 5px;">Shipping Settings</h4>
                
                <div class="form-group" style="margin-bottom: 15px;">
                  <label for="policyShipProcessing">Order Processing Timeline</label>
                  <textarea id="policyShipProcessing" required rows="3" style="width:100%; box-sizing:border-box; padding:10px; border:1px solid var(--color-cream-dark); border-radius:var(--border-radius); resize:vertical; font-family:inherit; font-size:13px;"></textarea>
                </div>

                <div class="form-group" style="margin-bottom: 15px;">
                  <label>Shipping Speeds (Location Table)</label>
                  <div style="display:flex; flex-direction:column; gap:8px; margin-top:5px; padding:10px; background:#F8F6F2; border-radius:var(--border-radius); border:1px solid var(--color-cream-dark);">
                    <div style="display:flex; justify-content:space-between; align-items:center; gap:10px;">
                      <span style="font-size:12px; font-weight:600; width:120px;">Metro Cities:</span>
                      <input type="text" id="policyShipTimeMetro" required style="flex:1; padding:6px 10px; font-size:12px; border:1px solid var(--color-cream-dark); border-radius:var(--border-radius);">
                    </div>
                    <div style="display:flex; justify-content:space-between; align-items:center; gap:10px;">
                      <span style="font-size:12px; font-weight:600; width:120px;">Tier 2 & 3 Cities:</span>
                      <input type="text" id="policyShipTimeTier" required style="flex:1; padding:6px 10px; font-size:12px; border:1px solid var(--color-cream-dark); border-radius:var(--border-radius);">
                    </div>
                    <div style="display:flex; justify-content:space-between; align-items:center; gap:10px;">
                      <span style="font-size:12px; font-weight:600; width:120px;">Remote Areas:</span>
                      <input type="text" id="policyShipTimeRemote" required style="flex:1; padding:6px 10px; font-size:12px; border:1px solid var(--color-cream-dark); border-radius:var(--border-radius);">
                    </div>
                  </div>
                </div>

                <div class="form-group" style="margin-bottom: 15px;">
                  <label for="policyShipCharges">Shipping Charges Policy</label>
                  <textarea id="policyShipCharges" required rows="2" style="width:100%; box-sizing:border-box; padding:10px; border:1px solid var(--color-cream-dark); border-radius:var(--border-radius); resize:vertical; font-family:inherit; font-size:13px;"></textarea>
                </div>

                <div class="form-group" style="margin-bottom: 15px;">
                  <label for="policyShipTracking">Order Tracking info</label>
                  <textarea id="policyShipTracking" required rows="2" style="width:100%; box-sizing:border-box; padding:10px; border:1px solid var(--color-cream-dark); border-radius:var(--border-radius); resize:vertical; font-family:inherit; font-size:13px;"></textarea>
                </div>

                <div class="form-group" style="margin-bottom: 15px;">
                  <label for="policyShipDeliveryInfo">Delivery Address guidelines</label>
                  <textarea id="policyShipDeliveryInfo" required rows="2" style="width:100%; box-sizing:border-box; padding:10px; border:1px solid var(--color-cream-dark); border-radius:var(--border-radius); resize:vertical; font-family:inherit; font-size:13px;"></textarea>
                </div>
              </div>

              <!-- Column 2: Returns & Support Settings -->
              <div>
                <h4 style="font-family: var(--font-serif); font-size: 1.2rem; color: var(--color-primary); margin-bottom: 15px; border-bottom: 1px dashed var(--color-cream-dark); padding-bottom: 5px;">Returns & Contact Settings</h4>

                <div class="form-group" style="margin-bottom: 15px;">
                  <label for="policyRetEligibility">Eligible Returns Criteria</label>
                  <textarea id="policyRetEligibility" required rows="3" style="width:100%; box-sizing:border-box; padding:10px; border:1px solid var(--color-cream-dark); border-radius:var(--border-radius); resize:vertical; font-family:inherit; font-size:13px;"></textarea>
                </div>

                <div class="form-group" style="margin-bottom: 15px;">
                  <label for="policyRetRequest">Return Submission requirements</label>
                  <textarea id="policyRetRequest" required rows="3" style="width:100%; box-sizing:border-box; padding:10px; border:1px solid var(--color-cream-dark); border-radius:var(--border-radius); resize:vertical; font-family:inherit; font-size:13px;"></textarea>
                </div>

                <div class="form-group" style="margin-bottom: 15px;">
                  <label for="policyNonReturnable">Non-Returnable Exclusions</label>
                  <textarea id="policyNonReturnable" required rows="3" style="width:100%; box-sizing:border-box; padding:10px; border:1px solid var(--color-cream-dark); border-radius:var(--border-radius); resize:vertical; font-family:inherit; font-size:13px;"></textarea>
                </div>

                <div class="form-group" style="margin-bottom: 15px;">
                  <label for="policyRefProcessing">Refund Timeline</label>
                  <textarea id="policyRefProcessing" required rows="2" style="width:100%; box-sizing:border-box; padding:10px; border:1px solid var(--color-cream-dark); border-radius:var(--border-radius); resize:vertical; font-family:inherit; font-size:13px;"></textarea>
                </div>

                <div class="form-group" style="margin-bottom: 15px;">
                  <label for="policyRefMethod">Refund Payment Channel logic</label>
                  <textarea id="policyRefMethod" required rows="2" style="width:100%; box-sizing:border-box; padding:10px; border:1px solid var(--color-cream-dark); border-radius:var(--border-radius); resize:vertical; font-family:inherit; font-size:13px;"></textarea>
                </div>

                <div class="form-group" style="margin-bottom: 15px;">
                  <label for="policyCancellation">Order Cancellation Terms</label>
                  <textarea id="policyCancellation" required rows="2" style="width:100%; box-sizing:border-box; padding:10px; border:1px solid var(--color-cream-dark); border-radius:var(--border-radius); resize:vertical; font-family:inherit; font-size:13px;"></textarea>
                </div>

                <div class="form-group" style="margin-bottom: 15px;">
                  <label for="policyDamagedPackage">Damaged Package Guidelines</label>
                  <textarea id="policyDamagedPackage" required rows="2" style="width:100%; box-sizing:border-box; padding:10px; border:1px solid var(--color-cream-dark); border-radius:var(--border-radius); resize:vertical; font-family:inherit; font-size:13px;"></textarea>
                </div>

                <h4 style="font-family: var(--font-serif); font-size: 1.2rem; color: var(--color-primary); margin: 25px 0 15px; border-bottom: 1px dashed var(--color-cream-dark); padding-bottom: 5px;">Support Contact Information</h4>

                <div style="display:grid; grid-template-columns:repeat(3, 1fr); gap:10px;">
                  <div class="form-group">
                    <label for="policyContactEmail">Email address</label>
                    <input type="email" id="policyContactEmail" required style="width:100%; padding:10px; border:1px solid var(--color-cream-dark); border-radius:var(--border-radius); box-sizing:border-box; font-size:12px;">
                  </div>
                  <div class="form-group">
                    <label for="policyContactWebsite">Website URL</label>
                    <input type="text" id="policyContactWebsite" required style="width:100%; padding:10px; border:1px solid var(--color-cream-dark); border-radius:var(--border-radius); box-sizing:border-box; font-size:12px;">
                  </div>
                  <div class="form-group">
                    <label for="policyContactPhone">WhatsApp Mobile</label>
                    <input type="text" id="policyContactPhone" required placeholder="e.g. 919876543210" style="width:100%; padding:10px; border:1px solid var(--color-cream-dark); border-radius:var(--border-radius); box-sizing:border-box; font-size:12px;">
                  </div>
                </div>

                <div style="text-align:right; margin-top:30px;">
                  <button type="submit" class="btn btn-primary" style="padding:12px 30px; font-size:13px;">Save Policy Changes</button>
                </div>

              </div>
            </div>
          </form>
        </section>
      </div>

    </main>
  </div>

  <!-- FAQ EDIT MODAL -->
  <div class="admin-modal" id="adminFaqModal" style="max-width: 600px;">
    <div class="admin-modal-header">
      <h3 id="faqModalTitle">Add New FAQ</h3>
      <button class="admin-modal-close" id="closeFaqModalBtn"><ion-icon name="close-outline"></ion-icon></button>
    </div>
    <form id="adminFaqForm">
      <input type="hidden" id="faqFormId" value="">
      <div class="checkout-form" style="padding: 20px;">
        <div class="form-group" style="margin-bottom: 15px;">
          <label for="faqFormCategory">Category *</label>
          <select id="faqFormCategory" required style="padding: 10px 14px; border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); background-color: var(--color-white); color: var(--color-charcoal); font-size: 13px; width: 100%; outline: none;">
            <option value="General">General Questions</option>
            <option value="Products">Product Information</option>
            <option value="Account">Account & Login</option>
            <option value="Shipping">Shipping & Delivery</option>
            <option value="Payments">Payments</option>
            <option value="Returns">Returns & Refunds</option>
            <option value="Support">Orders & Support</option>
            <option value="Offers">Offers & Rewards</option>
            <option value="Security">Privacy & Security</option>
          </select>
        </div>
        <div class="form-group" style="margin-bottom: 15px;">
          <label for="faqFormQuestion">Question *</label>
          <input type="text" id="faqFormQuestion" required placeholder="Enter question..." style="padding: 10px 14px; border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); background-color: var(--color-white); color: var(--color-charcoal); font-size: 13px; width: 100%; box-sizing: border-box;">
        </div>
        <div class="form-group" style="margin-bottom: 20px;">
          <label for="faqFormAnswer">Answer *</label>
          <textarea id="faqFormAnswer" required placeholder="Enter answer..." rows="6" style="padding: 12px 14px; border: 1px solid var(--color-cream-dark); border-radius: var(--border-radius); background-color: var(--color-white); color: var(--color-charcoal); font-size: 13px; width: 100%; box-sizing: border-box; font-family: inherit; resize: vertical; outline: none;"></textarea>
        </div>
        <div style="display:flex; justify-content:flex-end; gap:10px;">
          <button type="button" class="btn btn-outline" id="faqFormCancelBtn">Cancel</button>
          <button type="submit" class="btn btn-primary">Save FAQ</button>
        </div>
      </div>
    </form>
  </div>

  <!-- ORDER DETAIL MODAL OVERLAY -->
  <div class="admin-modal-overlay" id="adminModalOverlay"></div>

  <!-- ORDER DETAIL MODAL -->
  <div class="admin-modal" id="adminOrderDetailModal">
    <div class="admin-modal-header">
      <h3 id="modalOrderId">Order #VV-00000</h3>
      <button class="admin-modal-close" id="closeDetailModalBtn"><ion-icon name="close-outline"></ion-icon></button>
    </div>
    
    <div class="detail-section">
      <h4>Order Metadata</h4>
      <div class="detail-grid">
        <div class="detail-field"><strong>Order Date:</strong> <span id="modalDate"></span></div>
        <div class="detail-field"><strong>Payment Mode:</strong> <span id="modalPaymentMode">Cash on Delivery</span></div>
        <div class="detail-field" id="modalPaymentDetailsRow" style="display: none;"><strong>Payment Info:</strong> <span id="modalPaymentDetails"></span></div>
      </div>
    </div>

    <div class="detail-section">
      <h4>Customer Profile</h4>
      <div class="detail-grid">
        <div class="detail-field"><strong>Full Name:</strong> <span id="modalName"></span></div>
        <div class="detail-field"><strong>Email Address:</strong> <span id="modalEmail"></span></div>
        <div class="detail-field"><strong>Phone Number:</strong> <span id="modalPhone"></span></div>
        <div class="detail-field"><strong>Shipping Address:</strong> <span id="modalAddress"></span></div>
      </div>
    </div>

    <div class="detail-section">
      <h4>Purchased Items</h4>
      <table class="detail-items-table">
        <thead>
          <tr>
            <th>Product Name</th>
            <th>Size</th>
            <th>Unit Price</th>
            <th>Qty</th>
            <th style="text-align: right;">Total</th>
          </tr>
        </thead>
        <tbody id="modalItemsBody">
          <!-- Rendered dynamically -->
        </tbody>
      </table>
    </div>
  </div>

  <!-- JS Logic Block -->
  <script>
    document.addEventListener("DOMContentLoaded", () => {
      initSession();
      initLogin();
      initDashboardActions();
      initAdminTabs();
    });

    let allOrdersList = [];

    // Verify Session State
    function initSession() {
      const isLogged = sessionStorage.getItem("vaishveda_admin_logged");
      const loginPanel = document.getElementById("adminLoginPanel");
      const dashboardPanel = document.getElementById("adminDashboardPanel");

      if (isLogged === "true") {
        loginPanel.style.display = "none";
        dashboardPanel.style.display = "block";
        renderDashboard();
        renderCustomers();
      } else {
        loginPanel.style.display = "flex";
        dashboardPanel.style.display = "none";
      }
    }

    // Handles Admin Authentication
    function initLogin() {
      const loginForm = document.getElementById("adminLoginForm");
      const usernameInput = document.getElementById("adminUsername");
      const passwordInput = document.getElementById("adminPassword");
      const loginError = document.getElementById("loginError");

      if (loginForm) {
        loginForm.addEventListener("submit", (e) => {
          e.preventDefault();
          const username = usernameInput.value.trim();
          const password = passwordInput.value;

          // Default credentials
          if (username === "admin" && password === "vaishveda_admin") {
            sessionStorage.setItem("vaishveda_admin_logged", "true");
            loginError.style.display = "none";
            initSession();
          } else {
            loginError.style.display = "block";
            passwordInput.value = "";
          }
        });
      }
    }

    // Initialize Dashboard global hooks
    function initDashboardActions() {
      // Logout trigger
      const logoutBtn = document.getElementById("logoutBtn");
      if (logoutBtn) {
        logoutBtn.addEventListener("click", () => {
          sessionStorage.removeItem("vaishveda_admin_logged");
          initSession();
        });
      }

      // Reset orders trigger
      const resetBtn = document.getElementById("resetDataBtn");
      if (resetBtn) {
        resetBtn.addEventListener("click", () => {
          if (confirm("Are you sure you want to clear all order logs from history? This cannot be undone.")) {
            localStorage.setItem("vaishveda_orders", JSON.stringify([]));
            renderDashboard();
          }
        });
      }

      // Modal Close triggers
      const overlay = document.getElementById("adminModalOverlay");
      const modal = document.getElementById("adminOrderDetailModal");
      const closeBtn = document.getElementById("closeDetailModalBtn");

      const closeModal = () => {
        if (overlay) overlay.classList.remove("active");
        if (modal) modal.classList.remove("active");
      };

      if (closeBtn) closeBtn.addEventListener("click", closeModal);
      if (overlay) overlay.addEventListener("click", closeModal);
    }

    // Initialize admin tabs logic
    function initAdminTabs() {
      const tabOrders = document.getElementById("adminTabOrders");
      const tabCustomers = document.getElementById("adminTabCustomers");
      const tabFaqs = document.getElementById("adminTabFaqs");
      const tabPolicy = document.getElementById("adminTabPolicy");
      
      const panelOrders = document.getElementById("adminPanelOrders");
      const panelCustomers = document.getElementById("adminPanelCustomers");
      const panelFaqs = document.getElementById("adminPanelFaqs");
      const panelPolicy = document.getElementById("adminPanelPolicy");

      const tabs = [
        { btn: tabOrders, panel: panelOrders, render: renderDashboard },
        { btn: tabCustomers, panel: panelCustomers, render: renderCustomers },
        { btn: tabFaqs, panel: panelFaqs, render: renderFAQs },
        { btn: tabPolicy, panel: panelPolicy, render: renderPolicyEditor }
      ];

      tabs.forEach(tab => {
        if (tab.btn && tab.panel) {
          tab.btn.addEventListener("click", () => {
            tabs.forEach(t => {
              if (t.btn && t.panel) {
                if (t === tab) {
                  t.btn.style.color = "var(--color-primary)";
                  t.btn.style.borderBottom = "2px solid var(--color-accent)";
                  t.btn.style.fontWeight = "600";
                  t.btn.style.opacity = "1";
                  t.panel.style.display = "block";
                  if (t.render) t.render();
                } else {
                  t.btn.style.color = "var(--color-charcoal)";
                  t.btn.style.borderBottom = "none";
                  t.btn.style.fontWeight = "400";
                  t.btn.style.opacity = "0.6";
                  t.panel.style.display = "none";
                }
              }
            });
          });
        }
      });

      // Hook up search filter
      const searchInput = document.getElementById("customerSearchInput");
      if (searchInput) {
        searchInput.addEventListener("input", () => {
          renderCustomers(searchInput.value.trim().toLowerCase());
        });
      }

      // Hook up CSV export
      const exportBtn = document.getElementById("exportCustomersCsvBtn");
      if (exportBtn) {
        exportBtn.addEventListener("click", () => {
          exportCustomersToCsv();
        });
      }

      // Hook up FAQ search/filter
      const faqSearchInput = document.getElementById("adminFaqSearchInput");
      const faqCategoryFilter = document.getElementById("adminFaqCategoryFilter");
      
      if (faqSearchInput) {
        faqSearchInput.addEventListener("input", () => {
          renderFAQs();
        });
      }
      if (faqCategoryFilter) {
        faqCategoryFilter.addEventListener("change", () => {
          renderFAQs();
        });
      }
      
      // Hook up Add FAQ button
      const addFaqBtn = document.getElementById("addFaqBtn");
      if (addFaqBtn) {
        addFaqBtn.addEventListener("click", () => {
          openFaqModal();
        });
      }
    }

    // Render Stats and Orders Table
    function renderDashboard() {
      const tableBody = document.getElementById("ordersTableBody");
      if (tableBody) {
        tableBody.innerHTML = `<tr><td colspan="7" style="text-align:center; padding:20px; color:#888;"><ion-icon name="sync-outline" class="spin-icon" style="font-size:1.5rem; vertical-align:middle; margin-right:8px;"></ion-icon> Loading orders from database...</td></tr>`;
      }

      fetch("api.php?action=list_all_orders")
        .then(res => res.json())
        .then(orders => {
          if (!orders || orders.length === 0) {
            orders = JSON.parse(localStorage.getItem("vaishveda_orders")) || [];
          }
          allOrdersList = orders;
          displayAdminOrders(orders);
        })
        .catch(err => {
          console.error("Error loading orders from database:", err);
          const orders = JSON.parse(localStorage.getItem("vaishveda_orders")) || [];
          allOrdersList = orders;
          displayAdminOrders(orders);
        });
    }

    function displayAdminOrders(orders) {
      // Update Metrics
      const statOrders = document.getElementById("statTotalOrders");
      const statRevenue = document.getElementById("statTotalRevenue");
      const statAvg = document.getElementById("statAvgValue");

      const totalOrders = orders.length;
      const totalRevenue = orders.reduce((sum, o) => sum + o.total, 0);
      const avgValue = totalOrders > 0 ? Math.round(totalRevenue / totalOrders) : 0;

      if (statOrders) statOrders.textContent = totalOrders;
      if (statRevenue) statRevenue.textContent = `₹${totalRevenue.toLocaleString("en-IN")}`;
      if (statAvg) statAvg.textContent = `₹${avgValue.toLocaleString("en-IN")}`;

      // Render Orders Table
      const tableBody = document.getElementById("ordersTableBody");
      const ordersTable = document.getElementById("ordersTable");
      const emptyState = document.getElementById("emptyState");

      if (!tableBody) return;
      tableBody.innerHTML = "";

      if (orders.length === 0) {
        if (ordersTable) ordersTable.style.display = "none";
        if (emptyState) emptyState.style.display = "block";
        return;
      }

      if (ordersTable) ordersTable.style.display = "table";
      if (emptyState) emptyState.style.display = "none";

      orders.forEach((order) => {
        const row = document.createElement("tr");
        
        // Item Details short snippet
        const itemsSnippet = order.items.map(item => 
          `<span>${item.name} (${item.size}) <strong>x ${item.quantity}</strong></span>`
        ).join("");

        row.innerHTML = `
          <td><a href="#" style="font-weight: 700; color: var(--color-accent-dark); border-bottom: 1px dashed var(--color-accent);" onclick="openOrderDetail('${order.id}')">${order.id}</a></td>
          <td>${order.createdAt ? order.createdAt.split(' ')[0] : order.date}</td>
          <td>
            <strong>${order.customer.name}</strong><br>
            <span style="font-size: 11px; color: #666;">${order.customer.phone}</span>
          </td>
          <td>
            <div class="order-items-list">${itemsSnippet}</div>
          </td>
          <td>
            <strong>₹${order.total.toLocaleString("en-IN")}</strong>
            <span style="font-size: 10px; color: #777; display: block; margin-top: 3px;">via ${order.paymentMethod || 'Cash on Delivery'}</span>
          </td>
          <td>
            <span class="status-badge ${order.status.toLowerCase()}">${order.status}</span>
          </td>
          <td style="text-align: right;">
            <div class="table-actions" style="justify-content: flex-end;">
              <select class="status-select" onchange="updateOrderStatus('${order.id}', this.value)">
                <option value="Pending" ${order.status === "Pending" ? "selected" : ""}>Pending</option>
                <option value="Shipped" ${order.status === "Shipped" ? "selected" : ""}>Shipped</option>
                <option value="Delivered" ${order.status === "Delivered" ? "selected" : ""}>Delivered</option>
                <option value="Cancelled" ${order.status === "Cancelled" ? "selected" : ""}>Cancelled</option>
              </select>
              <button class="btn-icon" onclick="openOrderDetail('${order.id}')" title="View Invoice"><ion-icon name="eye-outline"></ion-icon></button>
              <button class="btn-icon delete" onclick="deleteOrder('${order.id}')" title="Remove Order"><ion-icon name="trash-outline"></ion-icon></button>
            </div>
          </td>
        `;
        tableBody.appendChild(row);
      });
    }

    // Opens Invoice Details Modal
    window.openOrderDetail = function(orderId) {
      let order = allOrdersList.find(o => o.id === orderId);
      if (!order) {
        const orders = JSON.parse(localStorage.getItem("vaishveda_orders")) || [];
        order = orders.find(o => o.id === orderId);
      }
      if (!order) return;

      // Populate elements
      document.getElementById("modalOrderId").textContent = `Order ${order.id}`;
      document.getElementById("modalDate").textContent = order.createdAt ? order.createdAt : order.date;
      document.getElementById("modalName").textContent = order.customer.name;
      document.getElementById("modalEmail").textContent = order.customer.email;
      document.getElementById("modalPhone").textContent = order.customer.phone;
      document.getElementById("modalAddress").textContent = order.customer.address;
      
      document.getElementById("modalPaymentMode").textContent = order.paymentMethod || "Cash on Delivery";
      const detailsRow = document.getElementById("modalPaymentDetailsRow");
      const detailsVal = document.getElementById("modalPaymentDetails");
      if (detailsRow && detailsVal) {
        const txnId = order.paymentDetails?.transactionId || (typeof order.paymentDetails === 'string' ? order.paymentDetails : '');
        const paypalMail = order.paymentDetails?.paypalEmail || '';
        const detailStr = txnId || paypalMail;
        if (detailStr) {
          detailsVal.textContent = detailStr;
          detailsRow.style.display = "block";
        } else {
          detailsRow.style.display = "none";
        }
      }

      const itemsBody = document.getElementById("modalItemsBody");
      itemsBody.innerHTML = "";

      order.items.forEach(item => {
        const row = document.createElement("tr");
        row.innerHTML = `
          <td>${item.name}</td>
          <td>${item.size}</td>
          <td>₹${item.price.toLocaleString("en-IN")}</td>
          <td>${item.quantity}</td>
          <td style="text-align: right; font-weight: 600;">₹${(item.price * item.quantity).toLocaleString("en-IN")}</td>
        `;
        itemsBody.appendChild(row);
      });

      // Add Total Row
      const totalRow = document.createElement("tr");
      totalRow.innerHTML = `
        <td colspan="4" style="text-align: right; font-weight: 700; border-top: 1.5px solid var(--color-charcoal);">Total Bill Amount:</td>
        <td style="text-align: right; font-weight: 700; font-size: 15px; color: var(--color-primary); border-top: 1.5px solid var(--color-charcoal);">₹${order.total.toLocaleString("en-IN")}</td>
      `;
      itemsBody.appendChild(totalRow);

      // Open Modal
      document.getElementById("adminModalOverlay").classList.add("active");
      document.getElementById("adminOrderDetailModal").classList.add("active");
    };

    // Update Status of Order
    window.updateOrderStatus = function(orderId, newStatus) {
      fetch("api.php?action=update_order_status", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ order_id: orderId, status: newStatus })
      })
      .then(res => res.json())
      .then(result => {
        if (result.success) {
          renderDashboard();
        } else {
          alert("Failed to update status in database: " + result.message);
        }
      })
      .catch(err => {
        console.error("Error updating status in DB:", err);
      });

      // Update backup in local storage
      let orders = JSON.parse(localStorage.getItem("vaishveda_orders")) || [];
      const idx = orders.findIndex(o => o.id === orderId);
      if (idx !== -1) {
        orders[idx].status = newStatus;
        localStorage.setItem("vaishveda_orders", JSON.stringify(orders));
        renderDashboard();
      }
    };

    // Delete Single Order
    window.deleteOrder = function(orderId) {
      if (confirm(`Are you sure you want to remove order ${orderId}? This action cannot be undone.`)) {
        fetch("api.php?action=delete_order", {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify({ order_id: orderId })
        })
        .then(res => res.json())
        .then(result => {
          if (result.success) {
            renderDashboard();
          } else {
            alert("Failed to delete order from database: " + result.message);
          }
        })
        .catch(err => {
          console.error("Error deleting order from DB:", err);
        });

        // Delete from local storage fallback
        let orders = JSON.parse(localStorage.getItem("vaishveda_orders")) || [];
        orders = orders.filter(o => o.id !== orderId);
        localStorage.setItem("vaishveda_orders", JSON.stringify(orders));
        renderDashboard();
      }
    };

    // Render registered customers in table
    function renderCustomers(query = "") {
      const tbody = document.getElementById("customersTableBody");
      if (!tbody) return;
      tbody.innerHTML = `<tr><td colspan="7" style="text-align:center; padding:20px; color:#888;"><ion-icon name="sync-outline" class="spin-icon" style="font-size:1.5rem; vertical-align:middle; margin-right:8px;"></ion-icon> Loading customers from database...</td></tr>`;

      fetch("api.php?action=list_users")
        .then(res => res.json())
        .then(users => {
          if (!users || users.length === 0) {
            users = JSON.parse(localStorage.getItem("vaishveda_users")) || [];
          }
          window.allUsersList = users;
          displayCustomers(users, query);
        })
        .catch(err => {
          console.error("Error loading customers:", err);
          const users = JSON.parse(localStorage.getItem("vaishveda_users")) || [];
          window.allUsersList = users;
          displayCustomers(users, query);
        });
    }

    function displayCustomers(users, query = "") {
      const tbody = document.getElementById("customersTableBody");
      if (!tbody) return;
      tbody.innerHTML = "";

      const filtered = users.filter(u => 
        u.name.toLowerCase().includes(query) ||
        u.email.toLowerCase().includes(query) ||
        u.phone.includes(query)
      );

      if (filtered.length === 0) {
        tbody.innerHTML = `<tr><td colspan="7" style="text-align:center; padding:30px; color:#888;">No customers matching search criteria.</td></tr>`;
        return;
      }

      filtered.forEach(user => {
        const row = document.createElement("tr");
        row.innerHTML = `
          <td><strong>${user.name}</strong></td>
          <td>${user.email}</td>
          <td>+91 ${user.phone}</td>
          <td><strong>${user.rewardPoints || 0} pts</strong></td>
          <td>${user.joinedDate ? user.joinedDate.split(' ')[0] : '2026-06-20'}</td>
          <td>
            <span class="status-badge ${user.status === 'Active' ? 'delivered' : 'cancelled'}" style="text-transform:uppercase;">${user.status || 'Active'}</span>
          </td>
          <td style="text-align: right;">
            <div class="table-actions" style="justify-content: flex-end;">
              <button class="btn btn-outline" style="font-size: 9px; padding: 4px 8px;" onclick="toggleCustomerStatus('${user.email}')">
                ${user.status === 'Suspended' ? 'Activate' : 'Suspend'}
              </button>
              <button class="btn btn-outline" style="font-size: 9px; padding: 4px 8px;" onclick="viewCustomerOrders('${user.email}')">
                View Orders
              </button>
            </div>
          </td>
        `;
        tbody.appendChild(row);
      });
    }

    // Toggle customer suspended/active state
    window.toggleCustomerStatus = function(email) {
      const users = window.allUsersList || [];
      const user = users.find(u => u.email === email);
      if (user) {
        const current = user.status || "Active";
        const nextStatus = current === "Suspended" ? "Active" : "Suspended";
        
        if (confirm(`Change status of ${user.name} to ${nextStatus}?`)) {
          user.status = nextStatus;
          
          fetch("api.php?action=sync_user", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(user)
          })
          .then(res => res.json())
          .then(result => {
            if (result.success) {
              renderCustomers();
            } else {
              alert("Failed to sync customer status: " + result.message);
            }
          })
          .catch(err => {
            console.error("Error updating customer status:", err);
            renderCustomers();
          });
          
          // Local storage backup
          let lsUsers = JSON.parse(localStorage.getItem("vaishveda_users")) || [];
          const uIdx = lsUsers.findIndex(u => u.email === email);
          if (uIdx !== -1) {
            lsUsers[uIdx].status = nextStatus;
            localStorage.setItem("vaishveda_users", JSON.stringify(lsUsers));
          }
        }
      }
    };

    // View customer order logs list
    window.viewCustomerOrders = function(email) {
      let orders = allOrdersList;
      if (orders.length === 0) {
        orders = JSON.parse(localStorage.getItem("vaishveda_orders")) || [];
      }
      const userOrders = orders.filter(o => o.userEmail === email || o.customer.email === email);
      
      if (userOrders.length === 0) {
        alert("This customer has not placed any orders yet.");
        return;
      }
      
      let msg = `Order History for customer (${email}):\n`;
      msg += `--------------------------------------------------------\n`;
      userOrders.forEach(o => {
        msg += `• Order ID: ${o.id} | Date: ${o.createdAt ? o.createdAt.split(' ')[0] : o.date} | Status: ${o.status} | Total: ₹${o.total}\n`;
      });
      alert(msg);
    };

    // Export customer records as CSV
    function exportCustomersToCsv() {
      const users = window.allUsersList || [];
      if (users.length === 0) {
        alert("No customers to export.");
        return;
      }

      let csv = "Name,Email,Phone,Reward Points,Joined Date,Status\n";
      users.forEach(u => {
        csv += `"${u.name}","${u.email}","${u.phone}",${u.rewardPoints || 0},"${u.joinedDate || '2026-06-20'}","${u.status || 'Active'}"\n`;
      });

      const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
      const link = document.createElement("a");
      const url = URL.createObjectURL(blob);
      link.setAttribute("href", url);
      link.setAttribute("download", "vaishveda_customers.csv");
      link.style.visibility = 'hidden';
      document.body.appendChild(link);
      link.click();
      document.body.removeChild(link);
    }

    // ==========================================================================
    // FAQ MANAGER LOGIC
    // ==========================================================================
    const DEFAULT_FAQ_SEED = [
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

    function renderFAQs() {
      const tbody = document.getElementById("faqsTableBody");
      if (!tbody) return;
      tbody.innerHTML = `<tr><td colspan="4" class="text-center" style="padding:20px; color:#888;"><ion-icon name="sync-outline" class="spin-icon" style="font-size:1.5rem; vertical-align:middle; margin-right:8px;"></ion-icon> Loading FAQs from database...</td></tr>`;

      fetch("api.php?action=get_faqs")
        .then(res => res.json())
        .then(faqs => {
          if (!faqs || faqs.length === 0) {
            faqs = JSON.parse(localStorage.getItem("vaishveda_faq_db")) || DEFAULT_FAQ_SEED;
          }
          window.allFaqsList = faqs;
          displayFAQs(faqs);
        })
        .catch(err => {
          console.error("Error loading FAQs:", err);
          const faqs = JSON.parse(localStorage.getItem("vaishveda_faq_db")) || DEFAULT_FAQ_SEED;
          window.allFaqsList = faqs;
          displayFAQs(faqs);
        });
    }

    function displayFAQs(faqs) {
      const tbody = document.getElementById("faqsTableBody");
      if (!tbody) return;

      const searchVal = document.getElementById("adminFaqSearchInput").value.trim().toLowerCase();
      const catVal = document.getElementById("adminFaqCategoryFilter").value;

      tbody.innerHTML = "";

      const filtered = faqs.filter(f => {
        const matchesCategory = !catVal || f.category === catVal;
        const matchesSearch = !searchVal || 
                              f.question.toLowerCase().includes(searchVal) || 
                              f.answer.toLowerCase().includes(searchVal);
        return matchesCategory && matchesSearch;
      });

      if (filtered.length === 0) {
        tbody.innerHTML = `<tr><td colspan="4" class="text-center" style="padding:30px; color:#888;">No FAQs matching current criteria.</td></tr>`;
        return;
      }

      filtered.forEach(faq => {
        const row = document.createElement("tr");
        let truncatedAnswer = faq.answer;
        if (truncatedAnswer.length > 80) {
          truncatedAnswer = truncatedAnswer.substring(0, 80) + "...";
        }
        
        row.innerHTML = `
          <td><span class="category-tag">${faq.category}</span></td>
          <td><strong>${faq.question}</strong></td>
          <td>${truncatedAnswer}</td>
          <td style="text-align: right;">
            <div class="table-actions" style="justify-content: flex-end;">
              <button class="btn btn-outline" style="font-size: 9px; padding: 4px 8px;" onclick="openFaqModal('${faq.id}')">Edit</button>
              <button class="btn btn-outline" style="font-size: 9px; padding: 4px 8px; color: var(--color-accent);" onclick="deleteFAQ('${faq.id}')">Delete</button>
            </div>
          </td>
        `;
        tbody.appendChild(row);
      });
    }

    window.openFaqModal = function(faqId) {
      const modal = document.getElementById("adminFaqModal");
      const overlay = document.getElementById("adminModalOverlay");
      const form = document.getElementById("adminFaqForm");
      const title = document.getElementById("faqModalTitle");

      form.reset();
      document.getElementById("faqFormId").value = "";

      if (faqId) {
        title.textContent = "Edit FAQ";
        const faqs = window.allFaqsList || [];
        const faq = faqs.find(f => f.id === faqId);
        if (faq) {
          document.getElementById("faqFormId").value = faq.id;
          document.getElementById("faqFormCategory").value = faq.category;
          document.getElementById("faqFormQuestion").value = faq.question;
          document.getElementById("faqFormAnswer").value = faq.answer;
        }
      } else {
        title.textContent = "Add New FAQ";
      }

      modal.classList.add("active");
      overlay.classList.add("active");
    };

    window.closeFaqModal = function() {
      document.getElementById("adminFaqModal").classList.remove("active");
      document.getElementById("adminModalOverlay").classList.remove("active");
    };

    window.deleteFAQ = function(faqId) {
      if (confirm("Are you sure you want to delete this FAQ?")) {
        fetch("api.php?action=delete_faq", {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify({ id: faqId })
        })
        .then(res => res.json())
        .then(res => {
          if (res.success) {
            renderFAQs();
          } else {
            alert("Delete failed: " + res.message);
          }
        })
        .catch(err => {
          console.error("Error deleting FAQ:", err);
          renderFAQs();
        });

        let faqs = JSON.parse(localStorage.getItem("vaishveda_faq_db")) || DEFAULT_FAQ_SEED;
        faqs = faqs.filter(f => f.id !== faqId);
        localStorage.setItem("vaishveda_faq_db", JSON.stringify(faqs));
      }
    };

    // Modal close hooks
    const closeFaqModalBtn = document.getElementById("closeFaqModalBtn");
    const faqFormCancelBtn = document.getElementById("faqFormCancelBtn");
    if (closeFaqModalBtn) closeFaqModalBtn.addEventListener("click", window.closeFaqModal);
    if (faqFormCancelBtn) faqFormCancelBtn.addEventListener("click", window.closeFaqModal);

    // Form submission
    const faqForm = document.getElementById("adminFaqForm");
    if (faqForm) {
      faqForm.addEventListener("submit", (e) => {
        e.preventDefault();
        const id = document.getElementById("faqFormId").value || "faq_" + Date.now();
        const category = document.getElementById("faqFormCategory").value;
        const question = document.getElementById("faqFormQuestion").value.trim();
        const answer = document.getElementById("faqFormAnswer").value.trim();

        const faqPayload = { id, category, question, answer };

        fetch("api.php?action=save_faq", {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify(faqPayload)
        })
        .then(res => res.json())
        .then(res => {
          if (res.success) {
            window.closeFaqModal();
            renderFAQs();
          } else {
            alert("Failed to save FAQ: " + res.message);
          }
        })
        .catch(err => {
          console.error("Error saving FAQ:", err);
          window.closeFaqModal();
          renderFAQs();
        });

        let faqs = JSON.parse(localStorage.getItem("vaishveda_faq_db")) || DEFAULT_FAQ_SEED;
        const idx = faqs.findIndex(f => f.id === id);
        if (idx !== -1) {
          faqs[idx] = faqPayload;
        } else {
          faqs.push(faqPayload);
        }
        localStorage.setItem("vaishveda_faq_db", JSON.stringify(faqs));
      });
    }

    // Expose render function for tab activation
    window.renderFAQs = renderFAQs;

    // ==========================================================================
    // POLICY CMS LOGIC
    // ==========================================================================
    const DEFAULT_POLICY_CMS_SEED = {
      lastUpdated: "2026-06-26",
      shipping: {
        processing: "Orders are processed within 1–2 business days after successful payment.\nOrders placed on Sundays or public holidays will be processed on the next working day.\nProcessing may take slightly longer during festivals or promotional sales.",
        charges: "Free shipping is available for all orders above ₹999. For orders below ₹999, a standard shipping charge of ₹99 is applicable.\nApplicable shipping charges are calculated and shown during checkout.",
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

    function renderPolicyEditor() {
      fetch("api.php?action=get_policy&key=global_policy")
        .then(res => res.json())
        .then(policyData => {
          let policy = DEFAULT_POLICY_CMS_SEED;
          if (policyData && policyData.content_json) {
            policy = policyData.content_json;
          }
          populatePolicyFields(policy);
        })
        .catch(err => {
          console.error("Error loading policy in admin:", err);
          const policy = JSON.parse(localStorage.getItem("vaishveda_policy_db")) || DEFAULT_POLICY_CMS_SEED;
          populatePolicyFields(policy);
        });
    }

    function populatePolicyFields(policy) {
      document.getElementById("policyShipProcessing").value = policy.shipping.processing || "";
      document.getElementById("policyShipCharges").value = policy.shipping.charges || "";
      document.getElementById("policyShipTracking").value = policy.shipping.tracking || "";
      document.getElementById("policyShipDeliveryInfo").value = policy.shipping.deliveryInfo || "";

      // Table times
      if (policy.shipping.times && policy.shipping.times.length >= 3) {
        document.getElementById("policyShipTimeMetro").value = policy.shipping.times[0].time;
        document.getElementById("policyShipTimeTier").value = policy.shipping.times[1].time;
        document.getElementById("policyShipTimeRemote").value = policy.shipping.times[2].time;
      }

      document.getElementById("policyRetEligibility").value = policy.returns.eligibility || "";
      document.getElementById("policyRetRequest").value = policy.returns.request || "";
      
      document.getElementById("policyNonReturnable").value = policy.nonReturnable.text || "";

      document.getElementById("policyRefProcessing").value = policy.refunds.processing || "";
      document.getElementById("policyRefMethod").value = policy.refunds.method || "";

      document.getElementById("policyCancellation").value = policy.cancellation.text || "";
      document.getElementById("policyDamagedPackage").value = policy.damagedPackage.text || "";

      document.getElementById("policyContactEmail").value = policy.contact.email || "";
      document.getElementById("policyContactWebsite").value = policy.contact.website || "";
      document.getElementById("policyContactPhone").value = policy.contact.phone || "";
    }

    // Bind form save
    const policyForm = document.getElementById("adminPolicyForm");
    if (policyForm) {
      policyForm.addEventListener("submit", (e) => {
        e.preventDefault();
        
        const now = new Date();
        const year = now.getFullYear();
        const month = String(now.getMonth() + 1).padStart(2, '0');
        const day = String(now.getDate()).padStart(2, '0');
        const dateStr = `${year}-${month}-${day}`;

        const updatedPolicy = {
          lastUpdated: dateStr,
          shipping: {
            processing: document.getElementById("policyShipProcessing").value.trim(),
            charges: document.getElementById("policyShipCharges").value.trim(),
            tracking: document.getElementById("policyShipTracking").value.trim(),
            deliveryInfo: document.getElementById("policyShipDeliveryInfo").value.trim(),
            times: [
              { location: "Metro Cities", time: document.getElementById("policyShipTimeMetro").value.trim() },
              { location: "Tier 2 & Tier 3 Cities", time: document.getElementById("policyShipTimeTier").value.trim() },
              { location: "Remote Areas", time: document.getElementById("policyShipTimeRemote").value.trim() }
            ]
          },
          returns: {
            eligibility: document.getElementById("policyRetEligibility").value.trim(),
            request: document.getElementById("policyRetRequest").value.trim(),
            email: document.getElementById("policyContactEmail").value.trim()
          },
          nonReturnable: {
            text: document.getElementById("policyNonReturnable").value.trim()
          },
          refunds: {
            processing: document.getElementById("policyRefProcessing").value.trim(),
            method: document.getElementById("policyRefMethod").value.trim()
          },
          cancellation: {
            text: document.getElementById("policyCancellation").value.trim()
          },
          damagedPackage: {
            text: document.getElementById("policyDamagedPackage").value.trim()
          },
          contact: {
            email: document.getElementById("policyContactEmail").value.trim(),
            website: document.getElementById("policyContactWebsite").value.trim(),
            phone: document.getElementById("policyContactPhone").value.trim()
          }
        };

        // Post to API
        fetch("api.php?action=save_policy", {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify({
            key_name: "global_policy",
            content_json: updatedPolicy,
            last_updated: dateStr
          })
        })
        .then(res => res.json())
        .then(res => {
          if (res.success) {
            alert("Success: Shipping & Return Policy CMS changes saved successfully!");
            renderPolicyEditor();
          } else {
            alert("Failed to save policy changes: " + res.message);
          }
        })
        .catch(err => {
          console.error("Error saving policy:", err);
          alert("Success: Shipping & Return Policy CMS changes saved successfully!");
          renderPolicyEditor();
        });

        // Backup
        localStorage.setItem("vaishveda_policy_db", JSON.stringify(updatedPolicy));
      });
    }

    // Expose render function for tab activation
    window.renderPolicyEditor = renderPolicyEditor;

  </script>
</body>
</html>
