<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demande extends Model
{
    use HasFactory;

    protected $table = 'demandes'; // Nom de la table
    protected $primaryKey = 'id_demande'; // Clé primaire

    protected $fillable = [
        'statut',
        'id_emp',
        'id_formation',
    ];

    public function employe()
    {
        return $this->belongsTo(Employe::class, 'id_emp');
    }

    public function formation()
    {
        return $this->belongsTo(Formation::class, 'id_formation', 'id_formation');
    }

    
}
