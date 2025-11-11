<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\ResponsableController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\DemandeController;
use App\Http\Controllers\CategorieController;
Route::get('/fetchDemande', [AdminController::class, 'getDemandes'])->name('fetch.demandes');
Route::middleware(['auth:employe'])->group(function () {
    Route::get('/employe/dashboard', [EmployeController::class, 'dashboard'])->name('employe.dashboard');
});
Route::get('/fetchCat', [CategorieController::class, 'fetchCat']);
Route::post('/addCat', [CategorieController::class, 'addCat']);
Route::get('/editCat/{id_cat}', [CategorieController::class, 'editCat']);
Route::post('/updateCat/{id_cat}', [CategorieController::class, 'updateCat']);
Route::delete('/deleteCat/{id_cat}', [CategorieController::class, 'deleteCat']);
// Routes Admin (guard: admin)
Route::middleware(['auth:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'display'])->name('admin.dashboard');
    Route::post('/addEmp', [AdminController::class, 'addEmp']);
    Route::get('/fetchEmp', [AdminController::class, 'fetchEmp']);
    Route::get('/employe/{id_emp}', [AdminController::class, 'editEmp']);
    Route::post('/updateEmp/{id_emp}', [AdminController::class, 'updateEmp']);
    Route::delete('/deleteEmp/{id_emp}', [AdminController::class, 'deleteEmp']);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/fetchEmp', [EmployeController::class, 'fetchEmp'])->name('fetch.employees');
    Route::get('/fetchFormation', [FormationController::class, 'fetchFormation'])->name('fetch.formations');
    Route::get('/fetchCat', [CategorieController::class, 'fetchCat'])->name('fetch.categories');
});
// Récupérer les données de l'employé
Route::get('/api/employe', [EmployeController::class, 'getEmploye']);

// Récupérer les catégories de formation
Route::get('/api/categories', [FormationController::class, 'getCategories']);

// Récupérer l'historique des demandes
Route::get('/api/historique', [HistoriqueController::class, 'getHistorique']);

// Récupérer les évaluations
Route::get('/api/evaluations', [EvaluationController::class, 'getEvaluations']);



// Récupérer les formations par catégorie
Route::get('/categories/{categoryId}/formations', [FormationController::class, 'getFormationsByCategory']);
// Récupérer les détails d'une formation
Route::get('/formations/{formationId}', [FormationController::class, 'getFormationDetails']);

// Soumettre une demande
//Route::post('/demandes', [FormationController::class, 'submitDemande']);
Route::post('/relogin', [AuthController::class, 'relogin'])->name('relogin');

// Authentification
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::middleware('auth')->group(function () {
    Route::get('/change-password', [AuthController::class, 'showChangePasswordForm'])->name('change.password.form');
    Route::post('/change-password', [AuthController::class, 'changePassword'])->name('change.password');
});
Route::get('/password-changed', [AuthController::class, 'showPasswordChanged']) ->name('password.changed');
// Tableau de bord employé
Route::get('/employe/dashboard', [EmployeController::class, 'dashboard'])->name('employe.dashboard');
Route::middleware('auth:sanctum')->get('/formations-evaluables', [FormationController::class, 'getEvaluableFormations']);
// Formations
Route::get('/formations', [FormationController::class, 'index'])->name('formations.index');
Route::get('/formations/{formationId}', [FormationController::class, 'show'])->name('formations.show');

// Évaluations
Route::post('/evaluations/{formationId}', [EvaluationController::class, 'evaluer'])->name('evaluations.evaluer');
// Page de connexion
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Déconnexion
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Tableau de bord de l'employé
Route::middleware('auth')->group(function () {
    Route::get('/employe/dashboard', [EmployeController::class, 'dashboard'])->name('employe.dashboard');
});

// Tableau de bord du responsable
Route::middleware('auth')->group(function () {
    Route::get('/responsable/dashboard', [ResponsableController::class, 'dashboard'])->name('responsable.dashboard');
});
Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
Route::post('/employes', [EmployeController::class, 'store'])->name('employes.store');

// Tableau de bord de l'administrateur
Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});

Route::get('/formations', [FormationController::class, 'index'])->name('formations.index');
Route::get('/formations/{id}', [FormationController::class, 'show'])->name('formations.show');

// Routes pour demandes
Route::post('/demandes', [DemandeController::class, 'store'])
     ->name('demandes.store')
     ->middleware('auth:employe');
    
// Routes pour évaluations
Route::post('/evaluations', [EvaluationController::class, 'store'])
     ->name('evaluations.store')
     ->middleware('auth:employe');
    

     Route::middleware('auth')->group(function () {
        Route::post('/demandes', [DemandeController::class, 'store']);
    });
   

    Route::prefix('responsable')->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\ResponsableController::class, 'dashboard'])->name('responsable.dashboard');
        Route::patch('/demandes/{demande}', [App\Http\Controllers\ResponsableController::class, 'traiterDemande'])->name('demandes.traiter');
    });
    Route::get('/responsable', [ResponsableController::class, 'listData']);
    Route::middleware(['auth'])->group(function () {
        Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
        // Autres routes admin...
    });

    Route::get('/responsable', [ResponsableController::class, 'listData']);
Route::get('/accept_demande/{id_demande}', [ResponsableController::class, 'accept_demande']);
Route::get('/reject_demande/{id_demande}', [ResponsableController::class, 'reject_demande']);
Route::get('/search', [ResponsableController::class, 'search']);
Route::get('/search_demande', [ResponsableController::class, 'search_demande']);



Route::get('/api/demandes', [ResponsableController::class, 'getDemandes']);
Route::get('/', function () {
    return view('welcome');
});
Route::middleware(['auth', 'check.responsable'])->group(function () {
    Route::get('/responsable', [ResponsableController::class, 'listData'])->name('responsable.dashboard');
    
    // Nommez explicitement ces routes
    Route::get('/accept_demande/{id_demande}', [ResponsableController::class, 'accept_demande'])->name('demandes.accept');
    Route::get('/reject_demande/{id_demande}', [ResponsableController::class, 'reject_demande'])->name('demandes.reject');
    
    Route::get('/search', [ResponsableController::class, 'search']);
    Route::get('/search_demande', [ResponsableController::class, 'search_demande']);
});
Route::middleware(['auth', 'check.responsable'])->prefix('responsable')->group(function () {
    // ... other routes ...
    
    // Properly define the demande routes
    Route::post('/demandes/{demande}/accept', [ResponsableController::class, 'accept_demande'])->name('responsable.demandes.accept');
    Route::post('/demandes/{demande}/reject', [ResponsableController::class, 'reject_demande'])->name('responsable.demandes.reject');
});
Route::get('/admin', [AdminController::class, 'listData'])->name('admin.dashboard');// Routes pour l'admin
Route::prefix('admin')->group(function() {
    Route::post('/demandes/{id}/accept', [AdminController::class, 'acceptDemande'])->name('admin.demandes.accept');
    Route::post('/demandes/{id}/reject', [AdminController::class, 'rejectDemande'])->name('admin.demandes.reject');
});
Route::get('/fetchDemande', [AdminController::class, 'getDemandes'])->name('fetch.demandes');
