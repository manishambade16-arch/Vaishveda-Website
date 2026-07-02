<?php
include 'db.php';
$page_title = "Your Account | Vaishveda";
$page_desc = "Access your Vaishveda dashboard to manage profile details, track orders, edit saved addresses, view rewards, and update preferences.";
include 'header.php';
?>

  <!-- Page Breadcrumbs -->
  <section class="account-breadcrumbs" style="padding: 30px 0 10px; background-color: var(--color-white); border-bottom: 1px solid var(--color-cream-dark);">
    <div class="container">
      <div style="font-size: 11px; text-transform: uppercase; letter-spacing: 1px; opacity: 0.6;">
        <a href="index.html">Home</a> &nbsp;/&nbsp; <span style="color: var(--color-primary); font-weight: 500;">Account</span>
      </div>
    </div>
  </section>

  <!-- Main Portal Section -->
  <section class="section-padding account-portal-section" style="background-color: var(--color-cream); min-height: 700px;">
    <div class="container">
      
      <!-- LOGOUT MODE: REGISTRATION & LOGIN PORTAL -->
      <div class="auth-wrapper" id="authPortalSection" style="display: none;">
        <div class="auth-card">
          <!-- Switch Tabs -->
          <div class="auth-tabs">
            <button class="auth-tab-btn active" id="tabBtnLogin">Sign In</button>
            <button class="auth-tab-btn" id="tabBtnRegister">Create Account</button>
          </div>

          <!-- SIGN IN PANEL -->
          <div class="auth-panel active" id="panelLogin">
            <!-- Social Sign-ins -->
            <div class="social-login-grid">
              <button class="social-btn google" onclick="triggerSocialAuth('Google')">
                <ion-icon name="logo-google"></ion-icon>
                <span>Google</span>
              </button>
              <button class="social-btn facebook" onclick="triggerSocialAuth('Facebook')">
                <ion-icon name="logo-facebook"></ion-icon>
                <span>Facebook</span>
              </button>
              <button class="social-btn apple" onclick="triggerSocialAuth('Apple')">
                <ion-icon name="logo-apple"></ion-icon>
                <span>Apple</span>
              </button>
            </div>

            <div class="auth-divider">Or sign in with</div>

            <form id="loginForm">
              <!-- Switch Login Mode (Password vs OTP) -->
              <div style="display: flex; gap: 20px; margin-bottom: 20px; font-size: 12px;">
                <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                  <input type="radio" name="loginType" value="PASSWORD" checked style="accent-color:var(--color-primary);">
                  Email & Password
                </label>
                <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                  <input type="radio" name="loginType" value="OTP" style="accent-color:var(--color-primary);">
                  Mobile Number & OTP
                </label>
              </div>

              <!-- Login Field Options -->
              <div id="loginFieldEmail">
                <div class="form-group">
                  <label for="loginEmail">Email Address *</label>
                  <input type="email" id="loginEmail" placeholder="e.g. name@example.com">
                </div>
                <div class="form-group" style="margin-bottom: 10px;">
                  <label for="loginPassword">Password *</label>
                  <input type="password" id="loginPassword" placeholder="••••••••">
                </div>
              </div>

              <div id="loginFieldMobile" style="display: none;">
                <div class="form-group">
                  <label for="loginMobile">Mobile Number *</label>
                  <div style="display: flex; gap: 10px;">
                    <span style="border: 1px solid var(--color-cream-dark); padding: 10px; background-color: var(--color-cream); border-radius: var(--border-radius); font-size:13px;">+91</span>
                    <input type="tel" id="loginMobile" placeholder="10-digit number" pattern="[0-9]{10}" style="flex-grow: 1;">
                  </div>
                </div>
              </div>

              <!-- Utilities -->
              <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; font-size: 12px;">
                <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                  <input type="checkbox" id="loginRememberMe" style="accent-color:var(--color-primary); width:14px; height:14px;">
                  Remember Me
                </label>
                <a href="#" id="forgotPasswordLink" style="color: var(--color-accent-dark); text-decoration: none; font-weight: 500;">Forgot Password?</a>
              </div>

              <!-- CAPTCHA Simulator -->
              <div class="captcha-container">
                <label class="captcha-check">
                  <input type="checkbox" id="loginCaptcha" required>
                  <span>I am not a robot</span>
                </label>
                <div class="captcha-brand">
                  <ion-icon name="shield-checkmark" style="font-size:1.5rem; color:#4285F4;"></ion-icon>
                  <span>reCAPTCHA</span>
                </div>
              </div>

              <button type="submit" class="btn btn-primary" style="width: 100%;">Sign In</button>
            </form>
          </div>

          <!-- SIGN UP PANEL -->
          <div class="auth-panel" id="panelRegister">
            <form id="registerForm">
              <div class="form-group">
                <label for="registerName">Full Name *</label>
                <input type="text" id="registerName" placeholder="e.g. Jane Doe" required>
              </div>

              <div class="form-group">
                <label for="registerEmail">Email Address *</label>
                <input type="email" id="registerEmail" placeholder="e.g. name@example.com" required>
              </div>

              <div class="form-group">
                <label for="registerMobile">Mobile Number *</label>
                <div style="display: flex; gap: 10px;">
                  <span style="border: 1px solid var(--color-cream-dark); padding: 10px; background-color: var(--color-cream); border-radius: var(--border-radius); font-size:13px;">+91</span>
                  <input type="tel" id="registerMobile" placeholder="10-digit number" pattern="[0-9]{10}" style="flex-grow: 1;" required>
                </div>
              </div>

              <div class="form-group" style="margin-bottom: 5px;">
                <label for="registerPassword">Password *</label>
                <input type="password" id="registerPassword" placeholder="Minimum 8 characters" required>
                <!-- Real-time Password Strength checklist -->
                <div class="password-requirements invalid" id="pwRequirements">
                  <div class="req-item" id="reqLen"><ion-icon name="close-circle-outline"></ion-icon> Minimum 8 characters</div>
                  <div class="req-item" id="reqUpper"><ion-icon name="close-circle-outline"></ion-icon> At least one uppercase letter</div>
                  <div class="req-item" id="reqLower"><ion-icon name="close-circle-outline"></ion-icon> At least one lowercase letter</div>
                  <div class="req-item" id="reqNum"><ion-icon name="close-circle-outline"></ion-icon> At least one number</div>
                  <div class="req-item" id="reqSpec"><ion-icon name="close-circle-outline"></ion-icon> At least one special character</div>
                </div>
              </div>

              <div class="form-group">
                <label for="registerConfirmPassword">Confirm Password *</label>
                <input type="password" id="registerConfirmPassword" placeholder="Re-enter password" required>
                <small id="confirmPasswordError" style="color:var(--color-sale); display:none;">Passwords do not match.</small>
              </div>

              <div class="form-group">
                <label for="registerReferral">Referral Code (Optional)</label>
                <input type="text" id="registerReferral" placeholder="e.g. REFER10">
              </div>

              <!-- CAPTCHA Simulator -->
              <div class="captcha-container">
                <label class="captcha-check">
                  <input type="checkbox" id="registerCaptcha" required>
                  <span>I am not a robot</span>
                </label>
                <div class="captcha-brand">
                  <ion-icon name="shield-checkmark" style="font-size:1.5rem; color:#4285F4;"></ion-icon>
                  <span>reCAPTCHA</span>
                </div>
              </div>

              <button type="submit" class="btn btn-primary" style="width: 100%;">Create Account</button>
            </form>
          </div>

          <!-- FORGOT PASSWORD PANEL -->
          <div class="auth-panel" id="panelForgot">
            <h4 style="font-family:var(--font-serif); font-size:1.25rem; margin-bottom:10px;">Recover Password</h4>
            <p style="font-size:12px; color:#666; margin-bottom:20px;">Enter your registered Email Address or Mobile Number. We will send you verification instructions.</p>

            <form id="forgotForm">
              <div class="form-group">
                <label for="forgotContact">Email or Mobile Number *</label>
                <input type="text" id="forgotContact" placeholder="e.g. user@email.com or 9876543210" required>
              </div>
              <button type="submit" class="btn btn-primary" style="width: 100%; margin-bottom:15px;">Send Verification OTP</button>
              <a href="#" id="forgotBackToLogin" style="display:block; text-align:center; font-size:12px; color:var(--color-primary); text-decoration:none; font-weight:600;">Back to Sign In</a>
            </form>
          </div>

        </div>
      </div>

      <!-- LOGIN MODE: CUSTOMER ACCOUNT DASHBOARD PORTAL -->
      <div class="dashboard-container" id="customerDashboardSection" style="display: none;">
        <!-- Sidebar Navigation Menu -->
        <aside class="dashboard-sidebar">
          <ul class="db-nav-list">
            <li class="db-nav-item active" data-tab="profile">
              <button><ion-icon name="person-outline"></ion-icon> My Profile</button>
            </li>
            <li class="db-nav-item" data-tab="orders">
              <button><ion-icon name="receipt-outline"></ion-icon> Order History</button>
            </li>
            <li class="db-nav-item" data-tab="wishlist">
              <button><ion-icon name="heart-outline"></ion-icon> My Wishlist</button>
            </li>
            <li class="db-nav-item" data-tab="addresses">
              <button><ion-icon name="location-outline"></ion-icon> Saved Addresses</button>
            </li>
            <li class="db-nav-item" data-tab="payments">
              <button><ion-icon name="card-outline"></ion-icon> Saved Payments</button>
            </li>
            <li class="db-nav-item" data-tab="wallet">
              <button><ion-icon name="wallet-outline"></ion-icon> Wallet & Rewards</button>
            </li>
            <li class="db-nav-item" data-tab="coupons">
              <button><ion-icon name="gift-outline"></ion-icon> My Coupons</button>
            </li>
            <li class="db-nav-item" data-tab="notifications">
              <button><ion-icon name="notifications-outline"></ion-icon> Notifications <span class="badge" id="notificationsUnreadCount" style="margin-left: 5px; position:static; display:none; background-color:var(--color-primary);">0</span></button>
            </li>
            <li class="db-nav-item" data-tab="settings">
              <button><ion-icon name="settings-outline"></ion-icon> Account Settings</button>
            </li>
            <li class="db-nav-item" style="border-top: 1px solid var(--color-cream-dark); margin-top: 15px;">
              <button id="dashboardLogoutBtn" style="color: var(--color-sale);"><ion-icon name="log-out-outline"></ion-icon> Sign Out</button>
            </li>
          </ul>
        </aside>

        <!-- Main Tab Content Area -->
        <main class="dashboard-content-box">
          
          <!-- TAB: Profile Details -->
          <div class="dashboard-panel-view active" id="tabPanelProfile">
            <div class="panel-title-container">
              <h2 class="panel-title">Personal Profile</h2>
            </div>
            <!-- Profile avatar upload -->
            <div class="profile-avatar-wrapper">
              <div class="avatar-container">
                <img src="assets/products/kumkumadi_cream3.jpg" alt="Profile Avatar" class="avatar-img" id="profileAvatarImg">
                <label class="avatar-upload-overlay" for="avatarUploadInput">
                  <ion-icon name="camera"></ion-icon>
                </label>
              </div>
              <input type="file" id="avatarUploadInput" class="avatar-input" accept="image/*">
              <span style="font-size:11px; color:#888; margin-top:10px;">Click overlay to change profile picture</span>
            </div>

            <!-- Profile Info Edit Form -->
            <form id="profileForm">
              <div class="form-row" style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
                <div class="form-group">
                  <label for="profileName">Full Name</label>
                  <input type="text" id="profileName" required>
                </div>
                <div class="form-group">
                  <label for="profileEmail">Email Address (Requires OTP to change)</label>
                  <input type="email" id="profileEmail" required>
                </div>
              </div>
              <div class="form-row" style="display:grid; grid-template-columns:1fr 1fr; gap:20px; margin-top: 10px;">
                <div class="form-group">
                  <label for="profileMobile">Mobile Number (Requires OTP to change)</label>
                  <input type="tel" id="profileMobile" required>
                </div>
                <div class="form-group">
                  <label for="profileJoined">Joined Date</label>
                  <input type="text" id="profileJoined" readonly style="background-color: var(--color-cream); cursor: not-allowed;">
                </div>
              </div>
              <button type="submit" class="btn btn-primary" style="margin-top: 20px;">Save Profile Changes</button>
            </form>

            <!-- Change Password Section -->
            <div style="border-top: 1px solid var(--color-cream-dark); margin-top:35px; padding-top:25px;">
              <h4 style="font-family:var(--font-serif); font-size:1.35rem; margin-bottom:15px; color:var(--color-primary);">Change Password</h4>
              <form id="changePasswordForm">
                <div class="form-group">
                  <label for="profileOldPassword">Current Password</label>
                  <input type="password" id="profileOldPassword" placeholder="••••••••" required>
                </div>
                <div class="form-row" style="display:grid; grid-template-columns:1fr 1fr; gap:20px; margin-top:10px;">
                  <div class="form-group">
                    <label for="profileNewPassword">New Password</label>
                    <input type="password" id="profileNewPassword" placeholder="••••••••" required>
                  </div>
                  <div class="form-group">
                    <label for="profileConfirmNewPassword">Confirm New Password</label>
                    <input type="password" id="profileConfirmNewPassword" placeholder="••••••••" required>
                  </div>
                </div>
                <button type="submit" class="btn btn-outline" style="margin-top: 20px;">Update Password</button>
              </form>
            </div>
          </div>

          <!-- TAB: Order History -->
          <div class="dashboard-panel-view" id="tabPanelOrders">
            <div class="panel-title-container">
              <h2 class="panel-title">My Orders</h2>
            </div>
            <div id="dashboardOrdersList">
              <!-- Orders log tables will be dynamically rendered here -->
            </div>
          </div>

          <!-- TAB: Wishlist -->
          <div class="dashboard-panel-view" id="tabPanelWishlist">
            <div class="panel-title-container">
              <h2 class="panel-title">Saved Wishlist</h2>
            </div>
            <div id="dashboardWishlistGrid" class="product-row" style="display:grid; grid-template-columns: repeat(3, 1fr); gap:20px; flex-wrap:wrap;">
              <!-- Wishlist items will render dynamically -->
            </div>
          </div>

          <!-- TAB: Saved Addresses -->
          <div class="dashboard-panel-view" id="tabPanelAddresses">
            <div class="panel-title-container">
              <h2 class="panel-title">My Addresses</h2>
              <button class="btn btn-outline" id="addAddressBtn" style="font-size:10px; padding:8px 15px;"><ion-icon name="add"></ion-icon> Add Address</button>
            </div>
            <div class="addresses-grid" id="dashboardAddressesGrid">
              <!-- Addresses list cards will render dynamically -->
            </div>

            <!-- Address Form Modal -->
            <div class="otp-modal" id="addressFormModal" style="max-width: 550px;">
              <h4 style="font-family:var(--font-serif); font-size:1.35rem; margin-bottom:15px; color:var(--color-primary);" id="addressFormTitle">Add New Address</h4>
              <form id="addressDetailsForm">
                <input type="hidden" id="addressFormIndex" value="">
                <div class="form-row" style="display:grid; grid-template-columns:1.2fr 0.8fr; gap:15px;">
                  <div class="form-group">
                    <label for="addrName">Full Name *</label>
                    <input type="text" id="addrName" required>
                  </div>
                  <div class="form-group">
                    <label for="addrPhone">Mobile Number *</label>
                    <input type="tel" id="addrPhone" required>
                  </div>
                </div>
                <div class="form-row" style="display:grid; grid-template-columns:0.8fr 1.2fr; gap:15px; margin-top:10px;">
                  <div class="form-group">
                    <label for="addrHouse">House / Flat No *</label>
                    <input type="text" id="addrHouse" required>
                  </div>
                  <div class="form-group">
                    <label for="addrStreet">Street / Area *</label>
                    <input type="text" id="addrStreet" required>
                  </div>
                </div>
                <div class="form-row" style="display:grid; grid-template-columns:repeat(3, 1fr); gap:12px; margin-top:10px;">
                  <div class="form-group">
                    <label for="addrCity">City *</label>
                    <input type="text" id="addrCity" required>
                  </div>
                  <div class="form-group">
                    <label for="addrState">State *</label>
                    <input type="text" id="addrState" required>
                  </div>
                  <div class="form-group">
                    <label for="addrPincode">PIN Code *</label>
                    <input type="text" id="addrPincode" required pattern="[0-9]{6}">
                  </div>
                </div>
                <div class="form-group" style="margin-top:10px;">
                  <label for="addrCountry">Country *</label>
                  <input type="text" id="addrCountry" value="India" required>
                </div>
                <div style="display:flex; justify-content:flex-end; gap:10px; margin-top:20px;">
                  <button type="button" class="btn btn-outline" id="addressFormCloseBtn">Cancel</button>
                  <button type="submit" class="btn btn-primary">Save Address</button>
                </div>
              </form>
            </div>
          </div>

          <!-- TAB: Saved Payments -->
          <div class="dashboard-panel-view" id="tabPanelPayments">
            <div class="panel-title-container">
              <h2 class="panel-title">Saved Cards</h2>
              <button class="btn btn-outline" id="addCardBtn" style="font-size:10px; padding:8px 15px;"><ion-icon name="add"></ion-icon> Add Card</button>
            </div>
            <div class="addresses-grid" id="dashboardCardsGrid">
              <!-- Payment cards lists will render dynamically -->
            </div>

            <!-- Card Form Modal -->
            <div class="otp-modal" id="cardFormModal">
              <h4 style="font-family:var(--font-serif); font-size:1.35rem; margin-bottom:15px; color:var(--color-primary);">Add Credit/Debit Card</h4>
              <form id="cardDetailsForm">
                <div class="form-group">
                  <label for="cardHolder">Name on Card *</label>
                  <input type="text" id="cardHolder" required>
                </div>
                <div class="form-group" style="margin-top:10px;">
                  <label for="cardNumber">Card Number *</label>
                  <input type="text" id="cardNumber" placeholder="16-digit card number" required pattern="[0-9]{16}">
                </div>
                <div class="form-row" style="display:grid; grid-template-columns:1fr 1fr; gap:15px; margin-top:10px;">
                  <div class="form-group">
                    <label for="cardExpiry">Expiry (MM/YY) *</label>
                    <input type="text" id="cardExpiry" placeholder="MM/YY" required pattern="(0[1-9]|1[0-2])\/[0-9]{2}">
                  </div>
                  <div class="form-group">
                    <label for="cardCvv">CVV *</label>
                    <input type="password" id="cardCvv" placeholder="•••" required pattern="[0-9]{3}">
                  </div>
                </div>
                <div style="display:flex; justify-content:flex-end; gap:10px; margin-top:25px;">
                  <button type="button" class="btn btn-outline" id="cardFormCloseBtn">Cancel</button>
                  <button type="submit" class="btn btn-primary">Save Card</button>
                </div>
              </form>
            </div>
          </div>

          <!-- TAB: Wallet & Rewards -->
          <div class="dashboard-panel-view" id="tabPanelWallet">
            <div class="panel-title-container">
              <h2 class="panel-title">Wallet & Loyalty Rewards</h2>
            </div>
            <!-- Wallet Card Panel -->
            <div class="wallet-card-panel">
              <div class="wallet-balance-row">
                <div>
                  <div class="wallet-label">Available Reward Points</div>
                  <div class="wallet-val" id="walletPointsVal">0 pts</div>
                </div>
                <div style="text-align: right;">
                  <div class="wallet-label">Cash Value</div>
                  <div class="wallet-val" id="walletCashVal">₹0</div>
                </div>
              </div>
              <div class="loyalty-progress-container">
                <div style="display:flex; justify-content:space-between; font-size:11px; font-weight:600;">
                  <span id="loyaltyLevelText">Loyalty Tier: Silver Member</span>
                  <span id="loyaltyPointsTarget">0 / 2,500 pts for Gold</span>
                </div>
                <div class="loyalty-progress-bar">
                  <div class="loyalty-progress-fill" id="loyaltyBarFill" style="width: 0%;"></div>
                </div>
                <p style="font-size:10px; opacity:0.8; margin-top:3px;">Earn 10 reward points for every ₹100 spent. Redeem points directly as cash on checkouts.</p>
              </div>
            </div>

            <!-- Transaction Logs -->
            <h4 style="font-family:var(--font-serif); font-size:1.35rem; margin-bottom:15px; color:var(--color-primary);">Wallet Transactions</h4>
            <table class="detail-items-table" style="width:100%;">
              <thead>
                <tr>
                  <th>Date</th>
                  <th>Transaction Type</th>
                  <th>Points</th>
                  <th>Balance</th>
                </tr>
              </thead>
              <tbody id="walletTransactionsList">
                <!-- Transactions will render dynamically -->
              </tbody>
            </table>
          </div>

          <!-- TAB: My Coupons -->
          <div class="dashboard-panel-view" id="tabPanelCoupons">
            <div class="panel-title-container">
              <h2 class="panel-title">My Reward Coupons</h2>
            </div>
            <div class="coupons-grid" id="dashboardCouponsGrid">
              <!-- Coupons cards will render dynamically -->
            </div>
          </div>

          <!-- TAB: Notification Center -->
          <div class="dashboard-panel-view" id="tabPanelNotifications">
            <div class="panel-title-container">
              <h2 class="panel-title">Notification Center</h2>
              <button class="btn btn-outline" id="markAllReadBtn" style="font-size:10px; padding:8px 15px;">Mark All Read</button>
            </div>
            <div id="dashboardNotificationsList">
              <!-- Notifications will render dynamically -->
            </div>
          </div>

          <!-- TAB: Account Settings -->
          <div class="dashboard-panel-view" id="tabPanelSettings">
            <div class="panel-title-container">
              <h2 class="panel-title">Account Settings</h2>
            </div>
            
            <div class="settings-section">
              <h4 style="font-family:var(--font-serif); font-size:1.25rem; margin-bottom:15px; color:var(--color-primary);">Display Preferences</h4>
              <div style="display:flex; justify-content:space-between; align-items:center; border-bottom:1px solid var(--color-cream-dark); padding-bottom:15px; margin-bottom:25px;">
                <div>
                  <span style="font-size:13.5px; font-weight:600; display:block;">Theme Color Mode</span>
                  <span style="font-size:11px; color:#666;">Toggle between Dark Mode and Light Mode</span>
                </div>
                <!-- Theme Slider Toggle -->
                <label style="position:relative; display:inline-block; width:50px; height:24px;">
                  <input type="checkbox" id="themeSwitchBtn" style="opacity:0; width:0; height:0;">
                  <span style="position:absolute; cursor:pointer; top:0; left:0; right:0; bottom:0; background-color:#ccc; transition:0.4s; border-radius:34px;" id="themeSwitchSlider"></span>
                </label>
              </div>
            </div>

            <div class="settings-section" style="margin-top: 15px;">
              <h4 style="font-family:var(--font-serif); font-size:1.25rem; margin-bottom:15px; color:var(--color-primary);">Communication Preferences</h4>
              <ul style="list-style:none; font-size:13px; color:var(--color-charcoal);">
                <li style="margin-bottom:12px; display:flex; align-items:center; gap:10px;">
                  <input type="checkbox" checked id="prefOrderEmails" style="accent-color:var(--color-primary); width:16px; height:16px;">
                  Email alerts for order confirmations, shipping updates, and invoice details.
                </li>
                <li style="margin-bottom:12px; display:flex; align-items:center; gap:10px;">
                  <input type="checkbox" checked id="prefMarketing" style="accent-color:var(--color-primary); width:16px; height:16px;">
                  Newsletter subscriptions featuring seasonal collections and loyalty coupons.
                </li>
                <li style="margin-bottom:12px; display:flex; align-items:center; gap:10px;">
                  <input type="checkbox" checked id="prefSms" style="accent-color:var(--color-primary); width:16px; height:16px;">
                  Mobile SMS messages for instantaneous tracking updates.
                </li>
              </ul>
            </div>

            <div style="border-top:1px solid var(--color-cream-dark); margin-top:35px; padding-top:25px;">
              <h4 style="font-family:var(--font-serif); font-size:1.25rem; color:var(--color-sale); margin-bottom:10px;">Danger Zone</h4>
              <p style="font-size:12px; color:#666; margin-bottom:15px;">Permanently disable your account. This action cannot be undone. You will lose all accumulated loyalty points.</p>
              <button class="btn btn-outline" id="deactivateAccountBtn" style="border-color:var(--color-sale); color:var(--color-sale);">Deactivate My Account</button>
            </div>
          </div>

        </main>
      </div>

    </div>
  </section>

  <!-- Dynamic Verification Modal (OTP Popup) -->
  <div class="otp-modal" id="verificationOtpModal">
    <div style="text-align: center;">
      <ion-icon name="shield-checkmark" style="font-size:3rem; color:var(--color-accent); margin-bottom:15px;"></ion-icon>
      <h3 style="font-family:var(--font-serif); font-size:1.5rem; color:var(--color-primary); margin-bottom:8px;">Enter Verification OTP</h3>
      <p style="font-size:12.5px; color:#555;" id="otpInstructionsText">We have sent a 6-digit OTP to your contact device.</p>
    </div>
    
    <div class="otp-inputs-wrapper" id="otpInputsGrid">
      <input type="text" class="otp-digit" maxlength="1" pattern="[0-9]" id="otp1">
      <input type="text" class="otp-digit" maxlength="1" pattern="[0-9]" id="otp2">
      <input type="text" class="otp-digit" maxlength="1" pattern="[0-9]" id="otp3">
      <input type="text" class="otp-digit" maxlength="1" pattern="[0-9]" id="otp4">
      <input type="text" class="otp-digit" maxlength="1" pattern="[0-9]" id="otp5">
      <input type="text" class="otp-digit" maxlength="1" pattern="[0-9]" id="otp6">
    </div>
    
    <div class="otp-timer" id="otpTimerText">OTP expires in: 05:00</div>
    
    <div style="display:flex; justify-content:space-between; align-items:center;">
      <button class="btn btn-outline" id="otpCancelBtn" style="font-size:11px; padding:10px 18px;">Cancel</button>
      <button class="btn btn-outline" id="otpResendBtn" style="font-size:11px; padding:10px 18px;" disabled>Resend in 30s</button>
    </div>
  </div>

  <!-- Global Action overlay overlay (drawerOverlay) -->
  <div class="drawer-overlay" id="drawerOverlay"></div>

  <!-- Global Loading Indicator -->
  <div class="auth-loader-overlay" id="globalLoaderOverlay">
    <div class="spinner-icon"></div>
    <div class="loader-text" id="globalLoaderText">Securing Session...</div>
  </div>

<?php include 'footer.php'; ?>
