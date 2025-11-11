<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;
// Evaluation.php
public function reponses()
{
    return $this->hasMany(EvaluationReponse::class, 'id_eval');
}

public static function createWithReponses(array $data)
{
    return DB::transaction(function () use ($data) {
        // Calculer la note moyenne
        $rating = collect($data['reponses'])->avg('note');
        
        $evaluation = self::create([
            'id_formation' => $data['formation_id'],
            'id_emp' => auth()->id(),
            'type_eval' => $data['type'],
            'rating' => $rating,
            'date' => now()
        ]);

        // Enregistrer chaque réponse
        foreach ($data['reponses'] as $reponse) {
            $evaluation->reponses()->create([
                'id_question' => $reponse['question_id'],
                'note' => $reponse['note']
            ]);
        }

        return $evaluation;
    });
}
    protected $table = 'Evaluations'; // Nom de la table
    protected $primaryKey = 'id_eval'; // Clé primaire

    protected $fillable = [
        'date',
        'rating',
        'commentaire',
        'type_eval',
        'id_emp',
        'id_formation',
    ];

    // Relation avec l'employé
    public function employe()
    {
        return $this->belongsTo(Employe::class, 'id_emp');
    }


    public function formation()
{
    return $this->belongsTo(Formation::class, 'id_formation');
}

}
