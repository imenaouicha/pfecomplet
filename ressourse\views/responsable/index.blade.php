<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace Responsable</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('css/responsable.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Icons -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
</head>
<body>
    <div class="container">
        <!-- ==================== NAVIGATION ==================== -->
        <!-- Navigation Employé (par défaut) -->
        <div class="navigation employe-navigation">
            <ul>
                <li>
                    <a href="#profil" class="nav-link" data-section="profil">
                        <span class="icon"><ion-icon name="person-circle-outline"></ion-icon></span>
                        <span class="title">Profil</span>
                    </a>
                </li>
                <li>
                    <a href="#formation" class="nav-link" data-section="formation">
                        <span class="icon"><ion-icon name="document-text-outline"></ion-icon></span>
                        <span class="title">Formations</span>
                    </a>
                </li>
                <li>
                    <a href="#historique" class="nav-link" data-section="historique">
                        <span class="icon"><ion-icon name="layers-outline"></ion-icon></span>
                        <span class="title">Historique</span>
                    </a>
                </li>
                <li>
                    <a href="#evaluation" class="nav-link" data-section="evaluation">
                        <span class="icon"><ion-icon name="star-outline"></ion-icon></span>
                        <span class="title">Évaluations</span>
                    </a>
                </li>
                <li class="switch-mode">
                    <a href="#responsable" class="nav-link" data-section="responsable">
                        <span class="icon"><ion-icon name="people-outline"></ion-icon></span>
                        <span class="title">Espace Responsable</span>
                    </a>
                </li>
                <li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a href="#" class="nav-link" id="logout-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <span class="icon"><ion-icon name="log-out-outline"></ion-icon></span>
                        <span class="title">Déconnexion</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Navigation Responsable (cachée par défaut) -->
        <div class="navigation responsable-navigation" style="display: none;">
            <ul>
                <li>
                    <a href="#liste_demande" class="nav-link" data-section="liste_demande">
                        <span class="icon"><ion-icon name="list-outline"></ion-icon></span>
                        <span class="title">Gestion des demandes</span>
                    </a>
                </li>
                <li>
                    <a href="#liste_employe" class="nav-link" data-section="liste_employe">
                        <span class="icon"><ion-icon name="people-outline"></ion-icon></span>
                        <span class="title">Liste des employés</span>
                    </a>
                </li>
                <li class="switch-mode">
                    <a href="#employe" class="nav-link" data-section="employe">
                        <span class="icon"><ion-icon name="person-outline"></ion-icon></span>
                        <span class="title">Espace Employé</span>
                    </a>
                </li>
                <li>
                    <form id="logout-form-resp" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a href="#" class="nav-link" id="logout-link-resp" onclick="event.preventDefault(); document.getElementById('logout-form-resp').submit();">
                        <span class="icon"><ion-icon name="log-out-outline"></ion-icon></span>
                        <span class="title">Déconnexion</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- ==================== MAIN CONTENT ==================== -->
        <div class="main">
            <!-- Top Bar -->
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>
                <div class="topbar-right">
                    <!-- Notification Icon -->
                    <div class="notification-icon-container">
                        <div class="notification-icon" onclick="toggleNotifications(e)">
                            <ion-icon name="notifications-outline"></ion-icon>
                            <span class="notification-badge">3</span>
                        </div>
                        <div class="notification-dropdown" id="notificationDropdown">
                            <!-- Notification content will be loaded here -->
                        </div>
                    </div>
                    <!-- User Profile -->
                    <div class="user">
                        <img src="{{ $employe->imageE }}" alt="Photo employé">
                    </div>
                </div>
            </div>

            <!-- ==================== CONTENT SECTIONS ==================== -->
            <div class="details">
                <!-- Section Profil -->
                <div class="recentOrders active" id="profil">
                    <div class="cardHeader">
                        <h2><ion-icon name="badge-outline"></ion-icon> Mon Profil</h2>
                    </div>
                    <div class="profil-content">
                        <div class="employee-header">
                            <div class="employee-photo">
                                <img src="{{ $employe->imageE }}" alt="Photo employé" class="profil-image">
                            </div>
                            <div class="employee-identity">
                                <div class="employee-matricule">Matricule : #<span id="matricule">{{ $employe->matricule }}</span></div>
                                <h1 class="employee-name">
                                    <span id="nom">{{ $employe->nom }}</span>
                                    <span id="prenom">{{ $employe->prenom }}</span>
                                </h1>
                                <div class="employee-department">
                                    <ion-icon name="business-outline"></ion-icon>
                                    <span id="departement">{{ $employe->departement }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="employee-details-grid">
                            <!-- Personal Info Column -->
                            <div class="detail-column personal-info">
                                <h3><ion-icon name="person-circle-outline"></ion-icon> État Civil</h3>
                                <div class="detail-item">
                                    <label>Né(e) le :</label>
                                    <p id="date_naissance">{{ $employe->date_naissance->format('d/m/Y') }}</p>
                                </div>
                                <div class="detail-item">
                                    <label>Lieu de naissance :</label>
                                    <p id="lieu_naissance">{{ $employe->lieu_naissance }}</p>
                                </div>
                            </div>
                            <!-- Contact Info Column -->
                            <div class="detail-column contact-info">
                                <h3><ion-icon name="at-outline"></ion-icon> Contact</h3>
                                <div class="detail-item">
                                    <ion-icon name="mail-outline"></ion-icon>
                                    <a href="mailto:{{ $employe->email }}" id="email">{{ $employe->email }}</a>
                                </div>
                                <div class="detail-item">
                                    <ion-icon name="phone-portrait-outline"></ion-icon>
                                    <a href="tel:{{ $employe->tel }}" id="tel">{{ $employe->tel }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section Formations -->
                <div class="recentOrders" id="formation">
                    <div class="cardHeader">
                        <h2>Catégories des Formations</h2>
                    </div>
                    <div class="categories-slider">
                        <div class="categories-slides">
                            @foreach($categories as $category)
                            <div class="category-card" data-category="{{ $category->id }}">
                                <img src="{{ $category->imageC }}" alt="{{ $category->titre }}" class="category-image">
                                <h3>{{ $category->titre }}</h3>
                            </div>
                            @endforeach
                        </div>
                        <button class="slider-button prev">❮</button>
                        <button class="slider-button next">❯</button>
                    </div>
                </div>

                <!-- Section Formations List (hidden by default) -->
                <div class="recentOrders" id="formations-list" style="display: none;">
                    <div class="cardHeader">
                        <h2>Formations Disponibles</h2>
                        <button class="btn return-btn" onclick="showCategories()">← Retour</button>
                    </div>
                    <div class="formations-grid"></div>
                </div>

                <!-- Section Formation Details (hidden by default) -->
                <div class="recentOrders" id="formation-details" style="display: none;">
                    <div class="cardHeader">
                        <h2>Détails de la Formation</h2>
                        <button class="btn return-btn" onclick="showFormations()">← Retour</button>
                    </div>
                    <div class="detail-content"></div>
                </div>

                <!-- Confirmation Modal (hidden by default) -->
                <div id="confirmationModal" class="modal" style="display: none;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3>📝 Demande de Formation</h3>
                            <span class="close" onclick="closeModal()">×</span>
                        </div>
                        <div id="errorMessage" class="error-message"></div>
                        <form id="demandeForm" onsubmit="submitDemandeForm(event)">
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
                            <div class="form-buttons">
                                <button type="button" class="btn btn-cancel" onclick="closeModal()">Annuler</button>
                                <button type="submit" class="btn btn-confirm"><i class="fas fa-paper-plane"></i> Envoyer la demande</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Section Historique -->
                <div class="recentOrders" id="historique">
                    <div class="cardHeader">
                        <h2>Historique des Demandes</h2>
                        <button class="btn refresh-btn" onclick="loadHistorique()">
                            <ion-icon name="refresh-outline"></ion-icon>
                        </button>
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
                            <!-- Data will be loaded dynamically -->
                        </tbody>
                    </table>
                </div>

                <!-- Section Évaluations -->
               <!-- Section Évaluations -->
<div class="recentOrders" id="evaluation">
    <div class="cardHeader">
        <h2>Evaluations des Formations</h2>
    </div>
    <div class="eval-grid">
        <!-- Les cartes seront ajoutées dynamiquement par JavaScript -->
    </div>

    <!-- Evaluation Modal -->
    <div id="evaluationModal" class="modal" style="display: none;">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Évaluation à chaud</h3>
                <span class="close" onclick="closeModal()">×</span>
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
</div>

                <!-- Section Liste des Employés -->
                <div class="recentOrders" id="liste_employe">
                    <div class="cardHeader">
                        <h2>Liste des employés</h2>
                    </div>
                    <div class="search-containers">
                        <input type="search" name="search" id="search" placeholder="Rechercher" class="form-control">
                    </div>
                    <div class="formation-table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Matricule</th>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Département</th>
                                    <th>Email</th>
                                    <th>Téléphone</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($employes as $employe)
                                <tr>
                                    <td>{{ $employe->matricule }}</td>
                                    <td>{{ $employe->nom }}</td>
                                    <td>{{ $employe->prenom }}</td>
                                    <td>{{ $employe->departement }}</td>
                                    <td>{{ $employe->email }}</td>
                                    <td>{{ $employe->tel }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Section Liste des Demandes -->
                <div class="recentOrders" id="liste_demande">
                    <div class="cardHeader">
                        <h2>Liste des demandes</h2>
                    </div>
                    <div class="search-container">
                        <div class="search-wrapper">
                            <input type="search" name="search" id="search_demande" placeholder="Rechercher" class="form-control search-input">
                        </div>
                    </div>
                    <div class="demande-table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Formation</th>
                                    <th>Date demande</th>
                                    <th>Statut</th>
                                    <th class="action-column">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($demandes as $demande)
                                <tr data-id="{{ $demande['id_demande'] }}">
                                    <td>{{ $demande['nom'] }}</td>
                                    <td>{{ $demande['prenom'] }}</td>
                                    <td>{{ $demande['formation'] }}</td>
                                    <td class="date-demande">{{ ($demande['date_demande']) }}</td>
                                    <td class="status-cell">
                                        <span class="status status-{{ strtolower(str_replace(' ', '-', $demande['statut'])) }}">{{ $demande['statut'] }}</span>
                                    </td>
                                   <td class="action-cell">
    @if($demande['statut'] == 'En attente')
        <button class="btn action-btn accepter" onclick="traiterDemande({{ $demande['id_demande'] }}, 'accept')">
            <ion-icon name="checkmark-circle-outline"></ion-icon>
        </button>
        <button class="btn action-btn refuser" onclick="traiterDemande({{ $demande['id_demande'] }}, 'reject')">
            <ion-icon name="close-circle-outline"></ion-icon>
        </button>
    @else
        <span class="status-completed">
            Terminée
        </span>
    @endif
</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Evaluation Modal (hidden by default) -->
    <div id="evaluationModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Évaluation à chaud</h3>
                <span class="close" onclick="closeModal()">×</span>
            </div>
            <form id="evaluationForm">
                <input type="hidden" id="formationId" name="formation_id">
                <input type="hidden" id="evalType" name="eval_type" value="CHAUD">
                <div class="evaluation-questions">
                    <!-- Questions will be injected here dynamically -->
                </div>
                <div class="form-buttons">
                    <button type="button" class="btn btn-cancel" onclick="closeModal()">Annuler</button>
                    <button type="submit" class="btn btn-confirm">Envoyer</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Success Notification -->
    <div id="successNotification" class="success-notification">
        <i class="fas fa-check-circle"></i> Demande envoyée avec succès !
    </div>

    <!-- Hidden Inputs -->
    <input type="hidden" id="currentEmpId" value="{{ auth()->user()->id_emp ?? '' }}">
    <div id="notifications-container" class="notifications-container"></div>

    <!-- Scripts -->
    <script src="{{ asset('js/responsable.js') }}"></script>
</body>
</html>
