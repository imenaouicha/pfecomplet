<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;
protected $table = 'categories';
    protected $fillable = ['titre', 'imageC'];

    public function formations()
{
    return $this->hasMany(Formation::class, 'categorie_id');
}
public function getImageCAttribute($value)
{
    if (!$value) return asset('images/categories/default.jpg');
    return asset('images/categories/'.$value);
}

}
