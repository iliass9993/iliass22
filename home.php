<!-- Email Entry Page -->
<div class="navbar">
    <div class="navbar-left">
        <div class="logo" onclick="goToHome()">WATCH NOW</div>
    </div>
</div>
<div class="email-entry-page" id="emailEntryPage" style="background: #000; z-index:1;">
    <div class="email-content">
        <h1>Films, séries et bien plus en illimité.</h1>
        <h2>Où que vous soyez. Annulez à tout moment.</h2>
        <p>
            Prêt à regarder Watch Now ? Entrez votre adresse e-mail pour créer ou
            réactiver votre abonnement.
        </p>
        <form class="email-form" method="post">
            <input
                type="email"
                id="userEmail"
                placeholder="Adresse e-mail"
                name="email"
                required 
                value="<?php echo isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : ''; ?>" />
            <button onclick="validateEmail()" type="submit">
                Commencer <i class="fas fa-chevron-right"></i>
            </button>
        </form>
        <p class="login-link">
            Déjà membre ? <a href="#" onclick="showLoginForm()">Se connecter</a>
        </p>
    </div>
</div>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION['email'] = $_POST["email"] ?? "";
    header("Location: ?page=plans");
}
?>
<script>
    const validateEmail = () => {
        const emailInput = document.getElementById("userEmail");
        const email = emailInput.value.trim();

        // Validation simple d'email
        if (!email.includes("@") || !email.includes(".")) {
            alert("Veuillez entrer une adresse e-mail valide");
            return;
        }
        console.log("test");
        // location.href = '/?page=plans';
    }
</script>