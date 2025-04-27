<?php include 'header.php'; ?>
<style>
    .signup-page {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100vh;
        background: #000;
        color: white;
        padding: 20px;
    }
    .signup-form {
        display: flex;
        flex-direction: column;
        width: 100%;
        max-width: 400px;
        gap: 15px;
    }
    .signup-form input {
        padding: 12px;
        border-radius: 4px;
        border: none;
        font-size: 16px;
    }
    .signup-form button {
        padding: 12px;
        background: #FFD700;
        color: #000;
        border: none;
        border-radius: 4px;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
    }
    .login-link {
        margin-top: 20px;
        color: #ccc;
    }
    .login-link a {
        color: #FFD700;
        text-decoration: none;
    }
</style>

<!-- Main Content -->
<div class="navbar">
    <div class="navbar-left">
        <div class="logo" onclick="goToHome()">WATCH NOW</div>
    </div>
</div>

<div class="signup-page" id="signupPage">
    <h2>S'inscrire</h2>
    <form class="signup-form" method="post" action="?page=home">
        <input type="email" name="email" placeholder="Adresse e-mail" required>
        <input type="password" name="password" placeholder="Mot de passe" required minlength="6">
        <button type="submit">S'inscrire</button>
    </form>
    <p class="login-link">Déjà membre ? <a href="?page=login">Se connecter</a></p>
</div>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION['email'] = $_POST["email"] ?? "";
    $_SESSION['password'] = $_POST["password"] ?? "";
}
?>

<?php include 'footer.php'; ?>