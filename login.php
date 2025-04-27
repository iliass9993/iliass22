<?php include 'header.php'; ?>
<style>
    .email-entry-page {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100vh;
        background: #000;
        color: white;
        padding: 20px;
    }
    .login-form {
        display: flex;
        flex-direction: column;
        width: 100%;
        max-width: 400px;
        gap: 15px;
    }
    .login-form input {
        padding: 12px;
        border-radius: 4px;
        border: none;
        font-size: 16px;
    }
    .login-form button {
        padding: 12px;
        background: #FFD700;
        color: #000;
        border: none;
        border-radius: 4px;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
    }
    .signup-link {
        margin-top: 20px;
        color: #ccc;
    }
    .signup-link a {
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

<div class="email-entry-page" id="loginPage">
    <h2>Se connecter</h2>
    <form class="login-form" method="post" action="?page=home">
        <input type="email" name="email" placeholder="Adresse e-mail" required 
               value="<?php echo isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : ''; ?>">
        <input type="password" name="password" placeholder="Mot de passe" required>
        <button type="submit">Se connecter</button>
    </form>
    <p class="signup-link">Nouveau sur Watch Now ? <a href="?page=signup">S'inscrire</a></p>
</div>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ici vous devriez vérifier les identifiants dans une base de données
    // Pour cet exemple, nous vérifions simplement si le mot de passe correspond à celui enregistré
    if (isset($_SESSION['password']) && $_POST['password'] === $_SESSION['password']) {
        $_SESSION['logged_in'] = true;
        header("Location: ?page=home");
    } else {
        echo "<script>alert('Email ou mot de passe incorrect');</script>";
    }
}
?>

<?php include 'footer.php'; ?>