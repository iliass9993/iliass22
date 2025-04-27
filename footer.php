 <script>
     // Function to create a movie item element
     //      function createMovieItem(movie) {
     //          const movieItem = document.createElement('div');
     //          movieItem.className = 'movie-item';
     //          movieItem.innerHTML = `
     // <img src="${movie.image}" alt="${movie.title}" title="${movie.title}">
     // <div class="overlay">
     //     <h3>${movie.title}</h3>
     //     <div class="info">
     //         <span>${movie.rating}</span>
     //         <span>${movie.year}</span>
     //         <span>${movie.duration}</span>
     //     </div>
     // </div>
     // `;

     //          // Add progress bar for continue watching
     //          if (movie.progress) {
     //              const progressBar = document.createElement('div');
     //              progressBar.className = 'progress-bar';
     //              progressBar.style.width = `${movie.progress}%`;
     //              movieItem.querySelector('.overlay').appendChild(progressBar);
     //          }

     //          // Add click event to add to My List
     //          movieItem.addEventListener('click', () => {
     //              // You can add functionality here for when a movie is clicked
     //              // For example, show a modal with more details
     //          });

     //          return movieItem;
     //      }

     // Function to update My List display
     //  function updateMyList() {
     //      const myListCarousel = document.getElementById('myList');
     //      if (myListCarousel) {
     //          myListCarousel.innerHTML = '';
     //          if (myList.length === 0) {
     //              myListCarousel.innerHTML = '<p class="empty-list">Your list is empty. Add movies and TV shows to watch later.</p>';
     //          } else {
     //              myList.forEach(movieId => {
     //                  // Find the movie in any category
     //                  let movie;
     //                  for (const category in movies) {
     //                      const found = movies[category].find(m => m.id === movieId);
     //                      if (found) {
     //                          movie = found;
     //                          break;
     //                      }
     //                  }
     //                  if (movie) {
     //                      const movieItem = createMovieItem(movie);
     //                      myListCarousel.appendChild(movieItem);
     //                  }
     //              });
     //          }
     //      }
     //  }

     // Function to toggle item in My List
     function toggleMyList(movieId) {
         const index = myList.indexOf(movieId);
         if (index === -1) {
             myList.push(movieId);
         } else {
             myList.splice(index, 1);
         }
         updateMyList();
         localStorage.setItem(`myList_${currentProfile}`, JSON.stringify(myList));
     }

     // Function to show profile selection modal
     function showProfileModal() {
         document.getElementById('profileModal').style.display = 'flex';
     }

     // Function to select a profile
     function selectProfile(profileName, imgPath) {
         currentProfile = profileName;
         document.getElementById('currentProfileName').textContent = profileName;
         document.getElementById('currentProfileImg').src = `https://randomuser.me/api/portraits/${imgPath}.jpg`;

         // Load profile's My List from localStorage
         const savedList = localStorage.getItem(`myList_${profileName}`);
         myList = savedList ? JSON.parse(savedList) : [];
         updateMyList();

         // Close modal
         document.getElementById('profileModal').style.display = 'none';
         document.getElementById('profileMenu').style.display = 'none';
     }

     //  // Function to toggle profile menu
     //  function toggleProfileMenu() {
     //      const menu = document.getElementById('profileMenu');
     //      menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
     //  }

     //  // Function to logout
     //  function logout() {
     //      // Remove login status but keep subscription info
     //      localStorage.removeItem('isLoggedIn');

     //      // Hide main content and show email entry page
     //      document.getElementById('emailEntryPage').style.display = 'flex';
     //      document.querySelector('.navbar').style.display = 'none';
     //      document.querySelector('.hero').style.display = 'none';
     //      document.querySelector('.content').style.display = 'none';

     //      // Close profile menu
     //      document.getElementById('profileMenu').style.display = 'none';

     //      // Reset to default profile
     //      currentProfile = "Profile 1";
     //  }

     // Function to open search overlay
     function openSearch() {
         document.getElementById('searchOverlay').style.display = 'block';
         document.getElementById('searchInput').focus();
     }

     // Function to close search overlay
     function closeSearch() {
         document.getElementById('searchOverlay').style.display = 'none';
         document.getElementById('searchInput').value = '';
         document.getElementById('searchResults').innerHTML = '';
     }

     // Function to search movies and TV shows
     function searchContent(query) {
         const resultsContainer = document.getElementById('searchResults');
         resultsContainer.innerHTML = '';

         if (query.length < 2) return;

         const results = [];
         for (const category in movies) {
             movies[category].forEach(item => {
                 if (item.title.toLowerCase().includes(query.toLowerCase())) {
                     results.push(item);
                 }
             });
         }

         if (results.length === 0) {
             resultsContainer.innerHTML = '<p class="no-results">No results found for "' + query + '"</p>';
         } else {
             results.forEach(item => {
                 const resultItem = document.createElement('div');
                 resultItem.className = 'search-result-item';
                 resultItem.innerHTML = `
    <img src="${item.image}" alt="${item.title}">
    <h4>${item.title}</h4>
    <p>${item.year} • ${item.type}</p>
    `;
                 resultsContainer.appendChild(resultItem);
             });
         }
     }

     // Function to toggle notifications dropdown
     function toggleNotifications() {
         const dropdown = document.getElementById('notificationsDropdown');
         dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
     }

     // Function to handle category navigation
     function setupCategoryNavigation() {
         document.getElementById('tvShowsLink').addEventListener('click', (e) => {
             e.preventDefault();
             scrollToSection('tvShowsSection');
         });

         document.getElementById('moviesLink').addEventListener('click', (e) => {
             e.preventDefault();
             scrollToSection('moviesSection');
         });

         document.getElementById('newPopularLink').addEventListener('click', (e) => {
             e.preventDefault();
             scrollToSection('newPopularSection');
         });

         document.getElementById('myListLink').addEventListener('click', (e) => {
             e.preventDefault();
             scrollToSection('myListSection');
         });
     }

     // Function to scroll to a specific section smoothly
     function scrollToSection(sectionId) {
         const section = document.getElementById(sectionId);
         if (section) {
             // Update active nav link
             document.querySelectorAll('.nav-links a').forEach(link => {
                 link.classList.remove('active');
             });
             event.target.classList.add('active');

             // Show the section if it's hidden
             section.style.display = 'block';

             // Scroll to section
             section.scrollIntoView({
                 behavior: 'smooth',
                 block: 'start'
             });
         }
     }

     // Function to scroll carousel
     function scrollCarousel(carouselId, scrollAmount) {
         const carousel = document.getElementById(carouselId);
         if (carousel) {
             carousel.scrollBy({
                 left: scrollAmount,
                 behavior: 'smooth'
             });
         }
     }

     // Fonction pour valider l'email
     //  function validateEmail() {
     //      const emailInput = document.getElementById('userEmail');
     //      const email = emailInput.value.trim();

     //      // Validation simple d'email
     //      if (!email.includes('@') || !email.includes('.')) {
     //          alert('Veuillez entrer une adresse e-mail valide');
     //          return;
     //      }

     //      userEmail = email;

     //      // Masquer la page email et afficher la page des abonnements
     //      document.getElementById('emailEntryPage').style.display = 'none';
     //      document.getElementById('plansPage').style.display = 'block';
     //  }

     // Fonction pour sélectionner un abonnement
     function selectPlan(plan) {
         selectedPlan = plan;

         // Mettre en évidence le plan sélectionné
         document.querySelectorAll('.plan-card').forEach(card => {
             card.style.border = 'none';
         });
         event.currentTarget.style.border = '2px solid #FFD700';

         // Masquer la page des abonnements et afficher la page de paiement
         document.getElementById('plansPage').style.display = 'none';
         document.getElementById('paymentPage').style.display = 'block';
     }

     // Fonction pour sélectionner un mode de paiement
     function selectPayment(method) {
         paymentMethod = method;

         // Mettre en évidence la méthode sélectionnée
         document.querySelectorAll('.payment-card').forEach(card => {
             card.style.border = 'none';
         });
         event.currentTarget.style.border = '2px solid #FFD700';

         // Afficher les détails appropriés
         if (method === 'card') {
             document.getElementById('cardDetails').style.display = 'block';
             document.getElementById('paypalRedirect').style.display = 'none';
         } else {
             document.getElementById('cardDetails').style.display = 'none';
             document.getElementById('paypalRedirect').style.display = 'block';
         }
     }

     // Fonction pour traiter le paiement
     function processPayment() {
         // Ici, vous intégreriez normalement un vrai système de paiement
         // Pour cet exemple, nous simulons simplement le paiement

         alert('Paiement effectué avec succès !');
         location.href = '/main.php';
         // Masquer la page de paiement et afficher le contenu principal
         //  completeRegistration();
     }

     // Fonction pour rediriger vers PayPal
     function redirectToPayPal() {
         // En production, vous redirigeriez vers l'API PayPal
         alert('Redirection vers PayPal...');

         // Simulation - après 2 secondes, considérer le paiement réussi
         setTimeout(() => {
             completeRegistration();
         }, 2000);
     }

     // Fonction pour terminer l'inscription
     function completeRegistration() {
         // Enregistrer les informations dans localStorage
         localStorage.setItem('userEmail', userEmail);
         localStorage.setItem('selectedPlan', selectedPlan);
         localStorage.setItem('paymentMethod', paymentMethod);
         localStorage.setItem('isSubscribed', 'true');
         localStorage.setItem('isLoggedIn', 'true');

         // Masquer toutes les pages d'inscription
         document.getElementById('emailEntryPage').style.display = 'none';
         document.getElementById('plansPage').style.display = 'none';
         document.getElementById('paymentPage').style.display = 'none';

         // Afficher la page principale
         document.querySelector('.navbar').style.display = 'flex';
         document.querySelector('.hero').style.display = 'flex';
         document.querySelector('.content').style.display = 'block';
     }

     // Fonction pour afficher le formulaire de connexion
     function showLoginForm() {
         const emailContent = document.querySelector('.email-content');
         emailContent.innerHTML = `
    <h1>Se connecter</h1>
    <div class="login-form">
        <input type="email" id="loginEmail" placeholder="Adresse e-mail" required>
        <input type="password" id="loginPassword" placeholder="Mot de passe" required>
        <button onclick="login()">Se connecter</button>
        <p class="login-link">Nouveau sur GoldFlix ? <a href="#" onclick="showEmailForm()">Inscrivez-vous maintenant</a></p>
    </div>
    `;
     }

     // Fonction pour afficher le formulaire d'email
     function showEmailForm() {
         const emailContent = document.querySelector('.email-content');
         emailContent.innerHTML = `
    <h1>Films, séries et bien plus en illimité.</h1>
    <h2>Où que vous soyez. Annulez à tout moment.</h2>
    <p>Prêt à regarder GoldFlix ? Entrez votre adresse e-mail pour créer ou réactiver votre abonnement.</p>
    <div class="email-form">
        <input type="email" id="userEmail" placeholder="Adresse e-mail" required>
        <button onclick="validateEmail()">Commencer <i class="fas fa-chevron-right"></i></button>
    </div>
    <p class="login-link">Déjà membre ? <a href="#" onclick="showLoginForm()">Se connecter</a></p>
    `;
     }

     // Fonction pour gérer la connexion
     function login() {
         const email = document.getElementById('loginEmail').value.trim();
         const password = document.getElementById('loginPassword').value;

         // Ici, vous vérifieriez normalement les identifiants avec votre backend
         // Pour cet exemple, nous vérifions simplement si l'email est valide

         if (!email.includes('@')) {
             alert('Veuillez entrer une adresse e-mail valide');
             return;
         }

         if (password.length < 6) {
             alert('Le mot de passe doit contenir au moins 6 caractères');
             return;
         }

         // Simuler une connexion réussie
         localStorage.setItem('isLoggedIn', 'true');

         // Masquer la page d'email et afficher le contenu principal
         document.getElementById('emailEntryPage').style.display = 'none';
         document.querySelector('.navbar').style.display = 'flex';
         document.querySelector('.hero').style.display = 'flex';
         document.querySelector('.content').style.display = 'block';
     }

     // Initialize the page
     document.addEventListener('DOMContentLoaded', () => {
         // Load movies and setup UI
         loadMovies();
         selectProfile(currentProfile, 'men/32');

         // Setup search functionality
         document.getElementById('searchInput').addEventListener('input', (e) => {
             searchContent(e.target.value);
         });

         // Setup category navigation
         setupCategoryNavigation();

         // Setup "Add to My List" button
         document.getElementById('addToMyList').addEventListener('click', function() {
             this.classList.toggle('added');
             this.innerHTML = this.classList.contains('added') ?
                 '<i class="fas fa-check"></i> My List' :
                 '<i class="fas fa-plus"></i> My List';
             // Add the featured movie to My List
             toggleMyList(1); // Assuming The Dark Knight has ID 1
         });

         // Close notifications dropdown when clicking outside
         document.addEventListener('click', (e) => {
             if (!e.target.closest('.notification-icon') && !e.target.closest('.notifications-dropdown')) {
                 document.getElementById('notificationsDropdown').style.display = 'none';
             }

             if (!e.target.closest('.profile')) {
                 document.getElementById('profileMenu').style.display = 'none';
             }
         });

         // Check if user is subscribed and logged in
         const isSubscribed = localStorage.getItem('isSubscribed');
         const isLoggedIn = localStorage.getItem('isLoggedIn');

         if (isSubscribed === 'true' && isLoggedIn === 'true') {
             // User is subscribed and logged in, show main content
             document.getElementById('emailEntryPage').style.display = 'none';
         } else if (isSubscribed === 'true' && isLoggedIn !== 'true') {
             // User is subscribed but not logged in, show login form
             document.getElementById('emailEntryPage').style.display = 'flex';
             document.querySelector('.navbar').style.display = 'none';
             document.querySelector('.hero').style.display = 'none';
             document.querySelector('.content').style.display = 'none';
             showLoginForm();
         } else {
             // New user, show email form
             document.getElementById('emailEntryPage').style.display = 'flex';
             document.querySelector('.navbar').style.display = 'none';
             document.querySelector('.hero').style.display = 'none';
             document.querySelector('.content').style.display = 'none';
         }

         // Navbar scroll effect
         window.addEventListener('scroll', () => {
             const navbar = document.querySelector('.navbar');
             if (window.scrollY > 100) {
                 navbar.classList.add('scrolled');
             } else {
                 navbar.classList.remove('scrolled');
             }
         });
     });
 </script>
 </body>

 </html>