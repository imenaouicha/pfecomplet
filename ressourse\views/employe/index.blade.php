<!DOCTYPE html>
<html lang="fr">
<head>
<meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace Employé</title>

    <link rel="stylesheet" href="{{ asset('css/employe.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
</head>
<body>
 <div class="container">
        <!-- Navigation -->

        <div class="navigation">
            <ul>
                <li>
                    <a href="#profil">
                        <span class="icon"><ion-icon name="person-circle-outline"></ion-icon></span>
                        <span class="title">Profil</span>
                    </a>
                </li>
                <li>
                    <a href="#formation">
                        <span class="icon"><ion-icon name="document-text-outline"></ion-icon></span>
                        <span class="title">Formation</span>
                    </a>
                </li>
                <li>
                    <a href="#historique">
                        <span class="icon"><ion-icon name="time-outline"></ion-icon></span>
                        <span class="title">Historique</span>
                    </a>
                </li>
                <li>
                    <a href="#evaluation">
                        <span class="icon"><ion-icon name="clipboard-outline"></ion-icon></span>
                        <span class="title">Evaluation</span>
                    </a>
                </li>
           
                <li>
                

                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
    <span class="icon"><ion-icon name="log-out-outline"></ion-icon></span>
    <span class="title">Déconnexion</span>
</a>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
                </li>
            </ul>
        </div>

        <!-- Main -->
        <div class="main">
         
        <div class="topbar">
    <div class="toggle">
        <ion-icon name="menu-outline"></ion-icon>
    </div>
    
    <!-- Conteneur flex pour aligner à droite -->
    <div class="topbar-right">
        <!-- Icône notifications -->
        <div class="notification-icon-container">
            <div class="notification-icon" onclick="toggleNotifications(e)">
                <ion-icon name="notifications-outline"></ion-icon>
                <span class="notification-badge">3</span>
            </div>
            <!-- Dropdown notifications -->
            <div class="notification-dropdown" id="notificationDropdown">
                <!-- Contenu des notifications -->
            </div>
        </div>
        
        <!-- Photo de profil -->
        <div class="user">
            <img src="{{ $employe->imageE }}" alt="Photo employé">
        </div>
    </div>
</div>

            <!-- Contenu principal -->
            <div class="details">
              <!-- Section Profil Employé -->
              <div class="profil-info">
<div class="recentOrders" id="profil">
    <div class="cardHeader">
        <h2><ion-icon name="badge-outline"></ion-icon> Mon Profil</h2>
    </div>
    
    <div class="profil-content">
        <div class="employee-header">
            <div class="employee-photo">
            <img src="{{ $employe->imageE }}" alt="Photo employé" class="profil-image">          
          </div>
            <div class="employee-identity">
                <div class="employee-matricule">Matricule : #<span id="matricule">#{{ $employe->matricule }}</span></div>
                <h1 class="employee-name">
                    <span id="nom">   {{ $employe->nom }}</span> 
                    <span id="prenom">   {{ $employe->prenom }}</span>
                </h1>
                <div class="employee-department">
                    <ion-icon name="business-outline"></ion-icon>
                    <span id="departement"> {{ $employe->departement }}</span>
                </div>
            </div>
        </div>

        <div class="employee-details-grid">
            <!-- Colonne Informations Personnelles -->
            <div class="detail-column personal-info">
                <h3><ion-icon name="person-circle-outline"></ion-icon> État Civil</h3>
                <div class="detail-item">
                    <label>Né(e) le :</label>
                    <p id="date_naissance">{{ $employe->date_naissance->format('d/m/Y') }} </p>
                </div>
                <div class="detail-item">
                    <label>Lieu de naissance :</label>
                    <p id="lieu_naissance">{{ $employe->lieu_naissance }}</p>
                </div>
            </div>

            <!-- Colonne Coordonnées -->
            <div class="detail-column contact-info">
                <h3><ion-icon name="at-outline"></ion-icon> Contact</h3>
                <div class="detail-item">
                    <ion-icon name="mail-outline"></ion-icon>
                    <a href="" id="email">{{ $employe->email }}</a>
                </div>
                <div class="detail-item">
                    <ion-icon name="phone-portrait-outline"></ion-icon>
                    <a href="" id="tel">{{ $employe->tel }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- Section des catégories -->
<div class="recentOrders" id="formation">
  <div class="cardHeader">
    <h2>Catégories des Formations</h2>
  </div>
  <div class="categories-slider">
    <div class="categories-slides">
      @foreach($categories as $category)
      <div class="category-card" data-category="{{ $category->id }}">
      <img src="{{ $category->imageC }}" alt="{{ $category->titre }}" class="category-image">        <h3>{{ $category->titre }}</h3>
      </div>
      @endforeach
    </div>
    <button class="slider-button prev">&#10094;</button>
    <button class="slider-button next">&#10095;</button>
  </div>
</div>

<!-- Section des formations -->
<div class="recentOrders" id="formations-list" style="display: none;">
  <div class="cardHeader">
    <h2>Formations Disponibles</h2>
    <button class="btn return-btn" onclick="showCategories()">&larr; Retour</button>
  </div>
  <div class="formations-grid"></div>
</div>
<!-- Détails de la formation -->
<div class="recentOrders" id="formation-details" style="display: none;">
  <div class="cardHeader">
    <h2>Détails de la Formation</h2>
    <button class="btn return-btn" onclick="showFormations()">&larr; Retour</button>

  </div>
  <div class="detail-content"></div>
</div>

<div id="confirmationModal" class="modal" style="display: none;">
  <div class="modal-content">
    <div class="modal-header">
      <h3>📝 Demande de Formation</h3>
      <span class="close" onclick="closeModal()">&times;</span>
    </div>
    <div id="errorMessage" class="error-message"></div>

    <form id="demandeForm">
      <div class="form-group">
        <label>Formation demandée :</label>
        <input type="text" id="formationName" readonly class="input-field">
      </div>
      <div class="form-group">
        <label>Votre nom complet :</label>
        <input type="text" id="fullName" required class="input-field" placeholder="Entrez votre nom complet">
      </div>
      <div class="form-group">
        <label>Adresse email :</label>
        <input type="email" id="demandeEmail" required class="input-field" placeholder="exemple@entreprise.com">
      </div>
      <div class="form-group">
        <label>Téléphone :</label>
        <input type="tel" id="demandeTel" required class="input-field" placeholder="Entrez votre numéro de téléphone">
      </div>
      <div class="form-button">
        <button type="button" class="btn btn-cancel" onclick="closeModal()">Annuler</button>
        <button type="submit" class="btn btn-confirm" ><i class="fas fa-paper-plane"></i> Envoyer la demande</button>
      </div>
    </form>
  </div>
</div>
<input type="hidden" id="currentEmpId" value="{{ auth()->user()->id_emp ?? '' }}">
<div id="notifications-container" class="notifications-container"></div>

              <!-- Section Historique -->
<div class="recentOrders" id="historique">
    <div class="cardHeader">
        <h2>Historique des Demandes</h2>
    </div>
    <table>
        <thead>
            <tr>
                <td>Formation</td>
                <td>Date</td>
                <td>Statut</td>
            </tr>
        </thead>
        <tbody>
            <!-- Les données seront chargées dynamiquement via JavaScript -->
        </tbody>
    </table>
</div>

        
<div class="recentOrders" id="evaluation">
    <div class="cardHeader">
        <h2>Evaluations des Formations</h2>
    </div>
    
    <div class="eval-grid">
        <!-- Les cartes seront ajoutées dynamiquement par JavaScript -->
        
    </div>

    
    <div id="evaluationModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Évaluation à chaud</h3>
            <span class="close" onclick="closeModal()">&times;</span>
            
        </div>
        <form id="evaluationForm">
            <input type="hidden" id="formationId" name="formation_id">
            <input type="hidden" id="evalType" name="eval_type" value="CHAUD">
            
            <div class="evaluation-questions">
                <!-- Les questions seront injectées ici dynamiquement -->
            </div>
            
          
            
            <div class="form-buttons">
                <button type="button" class="btn btn-cancel" onclick="closeModal()">Annuler</button>
                <button type="submit" class="btn btn-confirm">Envoyer</button>
            </div>
        </form>
    </div>
</div>

    <!-- Notification -->
    <div id="successNotification" class="success-notification"><i class="fas fa-check-circle"></i> Demande envoyée avec succès !</div>
</div>
</div>
</div>
<script src="{{ asset('js/ionicons.js') }}"></script>
<script src="{{ asset('js/employe.js') }}"></script>

</body>
</html>
