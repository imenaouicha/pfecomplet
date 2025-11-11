<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EvaluationReponse extends Model
{
    protected $primaryKey = 'id_reponse';
    protected $fillable = ['id_eval', 'id_question', 'note'];

    public function evaluation()
    {
        return $this->belongsTo(Evaluation::class, 'id_eval');
    }

    public function question()
    {
        return $this->belongsTo(EvaluationQuestion::class, 'id_question');
    }
    public function scopeSatisfaits($query)
    {
        return $query->select('id_eval')
            ->selectRaw('AVG(note) as moyenne')
            ->groupBy('id_eval')
            ->having('moyenne', '>=', 3);
    }
}
