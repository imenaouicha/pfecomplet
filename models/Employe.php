<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Employe extends Authenticatable
{
    protected $casts = [
        'date_naissance' => 'date', // Conversion automatique en Carbon
    ];
    protected $table = 'employes'; // Nom de la table
    protected $primaryKey = 'id_emp'; // Clé primaire personnalisée
    public $incrementing = true; // Assurez-vous que l'incrémentation est activée
    protected $keyType = 'int'; // Type de la clé primaire

    
    public function demandes()
    {
        return $this->hasMany(Demande::class, 'id_emp', 'id_emp');
    }

    
    public function user()
    {
        return $this->belongsTo(User::class, 'id_emp', 'id_emp');
    }
    public function evaluations()
{
    return $this->hasMany(Evaluation::class, 'id_emp');
}


    // Champs remplissables (fillable)
    protected $fillable = [
        'matricule',
        'nom',
        'prenom',
        'email',
        'mdp',
        'role',
        'date_naissance',
        'lieu_naissance',
        'departement',
        'tel',
        'imageE',
        'poste',

    ];

    // Champs cachés (hidden)
    protected $hidden = [
        'mdp', // Masquer le mot de passe
    ];

    // Nom de la colonne pour le mot de passe
    public function getAuthPassword()
    {
        return $this->mdp; // Utilisez la colonne 'mdp' comme mot de passe
    }
    public function store(Request $request)
    {
        $request->validate([
            'matricule' => 'required|unique:employes|max:20',
            'nom' => 'required|max:100',
            'prenom' => 'required|max:100',
            'imageE' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            // autres validations...
        ]);

        $data = $request->except('imageE');
        $data['mdp'] = Hash::make($request->mdp);

        if ($request->hasFile('imageE')) {
            $imagePath = $request->file('imageE')->store('public/employes');
            $data['imageE'] = basename($imagePath);
        }

        Employe::create($data);

        return back()->with('success', 'Employé créé avec succès');
    }
    public function getImageEAttribute($value)
    {
        // Debug: Affiche la valeur enregistrée
        \Log::info("Valeur imageE: ".$value);
        
        if (empty($value)) {
            return asset('images/employes/default.jpg');
        }
        
        // Supprime tout chemin existant (au cas où)
        $filename = basename($value);
        
        return asset('images/employes/'.$filename);
    }
    

}
