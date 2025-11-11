<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Espace Admin</title>
    
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/admin.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    <div class="container-fluid">
        <!-- Navigation Admin -->
       <div class="navigation admin-navigation">
    <ul>
        <li>
            <a href="#dashboard" class="nav-link active" data-section="dashboard">
<span class="icon"><i class="bi bi-graph-up-arrow"></i></span>
                <span class="title">Dashboard</span>
            </a>
        </li>
        <li>
            <a href="#gestionformation" class="nav-link" data-section="gestionformation">
                <span class="icon"><ion-icon name="book-outline"></ion-icon></span>
                <span class="title">Gestion Formations</span>
            </a>
        </li>
        <li>
            <a href="#gestionEmploye" class="nav-link" data-section="gestionEmploye">
                <span class="icon"><ion-icon name="people-outline"></ion-icon></span>
                <span class="title">Gestion Employés</span>
            </a>
        </li>
        <li>
            <a href="#gestionCategorie" class="nav-link" data-section="gestionCategorie">
                <span class="icon"><ion-icon name="folder-outline"></ion-icon></span>
                <span class="title">Gestion Catégories</span>
            </a>
        </li>
        <li>
            <a href="#liste_demande" class="nav-link" data-section="liste_demande">
                <span class="icon"><ion-icon name="list-outline"></ion-icon></span>
                <span class="title">Gestion des demandes</span>
            </a>
        </li>
    
        <li class="switch-mode">
            <a href="#employe" class="nav-link switch-link" data-target="employe">
                <span class="icon"><ion-icon name="person-outline"></ion-icon></span>
                <span class="title">Espace Employé</span>
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

        <!-- Navigation Employé -->
        <div class="navigation employe-navigation" style="display: none;">
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
                    <a href="#admin" class="nav-link switch-link" data-target="admin">
                        <span class="icon"><ion-icon name="settings-outline"></ion-icon></span>
                        <span class="title">Espace Admin</span>
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
                        <div class="notification-icon">
                            <ion-icon name="notifications-outline"></ion-icon>
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

            <!-- Content Sections -->
            <div class="details">
                <!-- Profil Section -->
                <div class="profil-info">
                    <div class="recentOrders section" id="profil">
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

                <!-- Categories Section -->
                <div class="recentOrders section" id="formation">
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
                        <button class="slider-button prev">&#10094;</button>
                        <button class="slider-button next">&#10095;</button>
                    </div>
                </div>

                <!-- Formations List Section -->
                <div class="recentOrders" id="formations-list" style="display: none;">
                    <div class="cardHeader">
                        <h2>Formations Disponibles</h2>
                        <button class="btn return-btn" onclick="showCategories()">&larr; Retour</button>
                    </div>
                    <div class="formations-grid"></div>
                </div>

                <!-- Formation Details Section -->
                <div class="recentOrders" id="formation-details" style="display: none;">
                    <div class="cardHeader">
                        <h2>Détails de la Formation</h2>
                        <button class="btn return-btn" onclick="showFormations()">&larr; Retour</button>
                    </div>
                    <div class="detail-content"></div>
                </div>

                <!-- Confirmation Modal -->
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
                            <div class="form-buttons">
                                <button type="button" class="btn btn-cancel" onclick="closeModal()">Annuler</button>
                                <button type="submit" class="btn btn-confirm"><i class="fas fa-paper-plane"></i> Envoyer la demande</button>
                            </div>
                        </form>
                    </div>
                </div>

                <input type="hidden" id="currentEmpId" value="{{ auth()->user()->id_emp ?? '' }}">
                <div id="notifications-container" class="notifications-container"></div>

                <!-- History Section -->
                <div class="recentOrders section" id="historique">
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
                            <!-- Data will be loaded dynamically via JavaScript -->
                        </tbody>
                    </table>
                </div>

                <!-- Evaluation Section -->
                <div class="recentOrders section" id="evaluation">
                    <div class="cardHeader">
                        <h2>Evaluations des Formations</h2>
                    </div>
                    
                    <div class="eval-grid">
                        <!-- Cards will be added dynamically by JavaScript -->
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
                                    <!-- Questions will be injected here dynamically -->
                                </div>
                                
                                <div class="form-buttons">
                                    <button type="button" class="btn btn-cancel" onclick="closeModal()">Annuler</button>
                                    <button type="submit" class="btn btn-confirm">Envoyer</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Training Management Section -->
                <div class="recentOrders section" id="gestionformation">
    <div class="cardHeader">
        <h2>Gestion des Formation</h2>
        <button class="custom-button" data-bs-toggle="modal" data-bs-target="#addFormationModal">
            <svg ...>ajouter</svg>
        </button>
    </div>
    <div class="FIRSTLine">
        <form method="get" action="#">
            <div class="input-group custom-search">
                <input type="text" id="search-formation" class="form-control" name="search" placeholder="Rechercher...">
            </div>
        </form>
    </div>
    @include('admin.partials.addFormationModal')
    @include('admin.partials.editFormationModal')
    @include('admin.partials.deleteFormationModal')
        @include('admin.partials.viewFormationModal')

    <table>
        <thead>
            <tr>
                <td>Nom</td>
                <td>Categorie</td>
                <td>Date debut</td>
                <td>Date fin</td>
                <td>Nom formateur</td> 
                <td>Capacité</td>
                <td class="text-center align-middle">Action</td>
            </tr>
        </thead>
        <tbody id="formation-body">
            <!-- Content will be loaded dynamically -->
        </tbody>
    </table>
</div>

                <!-- Employee Management Section -->
               <div class="recentOrders section" id="gestionEmploye">
    <div class="cardHeader">
        <h2>Gestion des employés</h2>
        <button class="custom-button" data-bs-toggle="modal" data-bs-target="#addEmpModal">
            <svg ...>ajouter</svg>
        </button>
    </div>
    <div class="FIRSTLine">
        <form method="get" action="#">
            <div class="input-group custom-search">
                <input type="text" id="search" class="form-control" name="search" placeholder="Rechercher...">
            </div>
        </form>
    </div>
    @include('admin.partials.addEmpModal')
    @include('admin.partials.editEmpModal')
    @include('admin.partials.deleteEmpModal')
        @include('admin.partials.viewEmpModal')

    <table>
        <thead>
            <tr>
                <td>Image</td>
                <td class="text-center align-middle">Matricule</td>
                <td class="text-center align-middle">Nom</td>
                <td class="text-center align-middle">Prenom</td>
                <td class="text-center align-middle">Role</td>
                <td class="text-center align-middle">Departement</td>
                <td class="text-center align-middle">Action</td>
            </tr>
        </thead>
        <tbody id="emp-body">
            <!-- Content will be loaded dynamically -->
        </tbody>
    </table>
</div>
                <!-- Dashboard Section -->
                <div class="recentOrders section" id="dashboard">
                    <div> 
                        <h2>Mon dashboard</h2>
                        <hr>
                    </div>
                    
                    <!-- Statistics Cards -->
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card card-body text-black mb-3" style="background-color: #ccd3ff;">
                                <label>Nombre de demandes</label>
                                <h4>{{ $totalDemandes }}</h4>
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="card card-body text-black mb-3" style="background-color: #b9ebbe;">
                                <label>Nombre de formations</label>
                                <h4>{{ $totalFormation }}</h4>
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="card card-body text-black mb-3" style="background-color: #a489e9;">
                                <label>Nombre de catégories</label>
                                <h4>{{ $totalCategorie }}</h4>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card card-body text-black mb-3" style="background-color: #97c4e7;">
                                <label>Nombre d'employés</label>
                                <h4>{{ $totalEmployes }}</h4>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Charts -->
                    <div class="row mt-3">
                        <div class="col-md-6">
                            @include('admin.charts.barChart', [
                                'categories' => $categories,
                                'data' => $data
                            ])
                        </div>
                        
                        <div class="col-md-6">
                            @include('admin.charts.pieChart', [
                                'pieData' => $pieData
                            ])
                        </div>
                        
                        <div class="col-md-12 mt-3">
                            @include('admin.charts.lineChart', [
                                'months' => $months,
                                'monthlyData' => $monthlyData
                            ])
                        </div>
                    </div>
                </div>

                <div class="recentOrders section" id="gestionCategorie">
    <div class="cardHeader">
        <h2>Gestion des catégories</h2>
        <button class="custom-button" data-bs-toggle="modal" data-bs-target="#addCatModal">
            <svg ...>ajouter</svg>
        </button>
    </div>
    <div class="FIRSTLine">
        <form method="get" action="#">
            <div class="input-group custom-search">
                <input type="text" id="search-categorie" class="form-control" name="search" placeholder="Rechercher...">
            </div>
        </form>
    </div>
    @include('admin.partials.addCatModal')
    @include('admin.partials.editCatModal')
    @include('admin.partials.deleteCatModal')
    <table>
        <thead>
            <tr>
                <td class="text-center align-middle">Image</td>
                <td class="text-start align-middle">Nom</td>
                <td class="text-end align-middle pe-4">Action</td>
            </tr>
        </thead>
        <tbody id="cat-body">
            <!-- Content will be loaded dynamically -->
        </tbody>
    </table>
</div>

                <!-- Notification -->
                <div id="successNotification" class="success-notification">
                    <i class="fas fa-check-circle"></i> Demande envoyée avec succès !
                </div>


                 <!-- Section Liste des Demandes -->
<div class="recentOrders" id="liste_demande">
    <div class="cardHeader">
        <h2>Liste des demandes</h2>
    </div>
    <div class="search-container">
        <div class="search-wrapper">
            <ion-icon name="search-outline" class="search-icon"></ion-icon>
            <input type="search" name="search" id="search_demande" placeholder="Rechercher" class="form-control search-input">
        </div>
    </div>
    <div class="demande-table">
        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Rôle</th>
                    <th>Formation</th>
                    <th>Date demande</th>
                    <th>Statut</th>
                    <th class="action-column">Action</th>
                </tr>
            </thead>
            <tbody id="demande-body">
                <!-- Les lignes seront insérées dynamiquement par FetchDemande -->
            </tbody>
        </table>
    </div>
</div>
            </div>
        </div>
    </div>
   
    <!-- Bootstrap JavaScript (Make sure it's here) -->
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script src="{{ asset('js/admin.js') }}"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
</body>
</html>
