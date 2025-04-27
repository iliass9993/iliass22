<!-- Plans Page -->
<div class="navbar">
    <div class="navbar-left">
        <div class="logo" onclick="goToHome()">WATCH NOW</div>
    </div>
</div>
<div class="plans-page" id="plansPage" style="z-index: 1; margin-top:5rem;">
    <div class="plans-content">
        <h1>Choisissez votre abonnement</h1>
        <div class="plans-container">
            <div class="plan-card" onclick="selectPlan('basic')">
                <h3>Basique</h3>
                <h4>9.99€/mois</h4>
                <ul>
                    <li>Qualité SD (480p)</li>
                    <li>1 écran à la fois</li>
                    <li>Téléchargements limités</li>
                </ul>
                <button>Sélectionner</button>
            </div>
            <div class="plan-card" onclick="selectPlan('standard')">
                <h3>Standard</h3>
                <h4>13.99€/mois</h4>
                <ul>
                    <li>Qualité HD (1080p)</li>
                    <li>2 écrans simultanés</li>
                    <li>Téléchargements illimités</li>
                </ul>
                <button>Sélectionner</button>
            </div>
            <div class="plan-card" onclick="selectPlan('premium')">
                <h3>Premium</h3>
                <h4>17.99€/mois</h4>
                <ul>
                    <li>Qualité Ultra HD (4K)</li>
                    <li>4 écrans simultanés</li>
                    <li>Téléchargements illimités</li>
                    <li>Accès aux nouveautés</li>
                </ul>
                <button>Sélectionner</button>
            </div>
        </div>
    </div>
</div>
<script>
    const selectPlan = (str) => {
        location.href = '/?page=payment?' + str;
    }
</script>