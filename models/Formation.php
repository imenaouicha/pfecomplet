<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    use HasFactory;
    public $incrementing = true; // Si auto-increment
    protected $keyType = 'int'; // Type de la clé

    protected $primaryKey = 'id_formation';
    protected $fillable = [
        'nom',
        'description',
        'nom_formateur',
        'capacite',
        'rating',
        'date_debut',
        'date_fin',
        'categorie_id'
    ];
    protected $casts = [
        'date_debut' => 'datetime',
        'date_fin' => 'datetime',
    ];

    // Optionnel : Format personnalisé si nécessaire
    protected $dateFormat = 'Y-m-d H:i:s';

    public function categorie()
{
    return $this->belongsTo(Categorie::class, 'categorie_id');
}



   
public function evaluations()
{
    return $this->hasMany(Evaluation::class, 'id_formation');
}

public function questions()
{
    return $this->hasMany(EvaluationQuestion::class, 'id_formation');
}
    
// Dans le modèle Formation
public function demandes()
{
    return $this->hasMany(Demande::class, 'id_formation', 'id_formation');
}
}
