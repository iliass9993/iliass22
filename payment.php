<div class="navbar">
    <div class="navbar-left">
        <div class="logo" onclick="goToHome()">WATCH NOW</div>
    </div>
</div>

<!-- Page de paiement -->
<div class="payment-page" id="paymentPage" style="z-index:1; margin-top:5rem;">
    <div class="payment-content">
        <h1>Finalisez votre inscription</h1>
        <div class="payment-methods">
            <div class="payment-card" onclick="selectPayment('card')">
                <i class="far fa-credit-card"></i>
                <h3>Carte bancaire</h3>
            </div>
            <div class="payment-card" onclick="selectPayment('paypal')">
                <i class="fab fa-paypal"></i>
                <h3>PayPal</h3>
            </div>
        </div>

        <div class="card-details" id="cardDetails" style="display:none;">
            <form id="creditCardForm">
                <div class="form-group">
                    <label>Numéro de carte</label>
                    <input type="text" placeholder="1234 5678 9012 3456" required>
                </div>
                <div class="form-group">
                    <label>Date d'expiration</label>
                    <input type="text" placeholder="MM/AA" required>
                </div>
                <div class="form-group">
                    <label>Code de sécurité</label>
                    <input type="text" placeholder="CVV" required>
                </div>
                <button type="button" onclick="processPayment()">Payer maintenant</button>
            </form>
        </div>

        <div class="paypal-redirect" id="paypalRedirect" style="display:none;">
            <p>Vous serez redirigé vers PayPal pour finaliser votre paiement.</p>
            <button onclick="redirectToPayPal()">Continuer vers PayPal</button>
        </div>
    </div>
</div>