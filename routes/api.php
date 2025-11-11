<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\{
    AuthController,
    EvaluationController,
    FormationController,
    DemandeController
};
// Dans routes/api.php
Route::get('/mes-demandes', [DemandeController::class, 'index'])->middleware('auth:api');// Auth
Route::post('/login', [AuthController::class, 'login']);

// Public routes
Route::get('/formations-completed', [FormationController::class, 'completed']);
Route::get('/formations/{id}', [FormationController::class, 'getFormationDetails']);
Route::get('/categories/{categoryId}/formations', [FormationController::class, 'getByCategory']);
Route::get('/evaluations/questions/{formation}/{type}', function ($formationId, $type) {
    $questions = \App\Models\EvaluationQuestion::where('id_formation', $formationId)
        ->where(function($query) use ($type) {
            $query->where('type', strtoupper($type))
                  ->orWhere('type', 'COMMUN');
        })
        ->orderBy('ordre')
        ->get();
    return response()->json($questions);
});
Route::get('/evaluations/{id}/verify', function ($id) {
    $evaluation = Evaluation::with('reponses')->find($id);
    return response()->json([
        'exists' => $evaluation !== null,
        'reponses_count' => $evaluation ? $evaluation->reponses->count() : 0
    ]);
})->middleware('auth:sanctum');
// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', fn(Request $request) => $request->user());
    Route::get('/formations-evaluables', [FormationController::class, 'getEvaluableFormations']);
    Route::get('/formations-with-status', [FormationController::class, 'getFormationsWithStatus']);
    Route::post('/evaluations', [EvaluationController::class, 'store']);
    Route::post('/evaluations/hot', [EvaluationController::class, 'storeHotEvaluation']);
    Route::post('/evaluations/cold', [EvaluationController::class, 'storeColdEvaluation']);
    Route::get('/evaluations/questions/{formation}/{type}', [EvaluationController::class, 'getQuestions']);
    Route::get('/check-evaluation/{formationId}/{type}', function ($formationId, $type) {
        $user = auth()->user();
        if (!$user) return response()->json(['error' => 'Non authentifié'], 401);
        $evaluation = \App\Models\Evaluation::where([
            ['id_emp', $user->id_emp],
            ['id_formation', $formationId],
            ['type', strtoupper($type)]
        ])->first();
        return response()->json(['alreadyEvaluated' => $evaluation !== null]);
    });
    Route::post('/evaluations', [EvaluationController::class, 'store']);
    Route::get('/evaluations/questions/{formation}/{type}', [EvaluationController::class, 'getQuestions']);
    Route::get('/formations-with-status', [FormationController::class, 'getFormationsWithStatus']);
    // Demandes
    Route::get('/demandes', [DemandeController::class, 'index']);
    Route::post('/demandes', [DemandeController::class, 'store']);
});

Route::post('/api/demandes/{demande}/accepter', [ResponsableController::class, 'accepterDemande']);
Route::post('/api/demandes/{demande}/refuser', [ResponsableController::class, 'refuserDemande']);
