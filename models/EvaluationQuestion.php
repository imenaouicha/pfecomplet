<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EvaluationQuestion extends Model
{
    protected $primaryKey = 'id_question';
    protected $fillable = ['id_formation', 'type', 'texte', 'ordre'];

    public function formation()
    {
        return $this->belongsTo(Formation::class, 'id_formation');
    }

    public function reponses()
    {
        return $this->hasMany(EvaluationReponse::class, 'id_question');
    }
}
