<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;
    protected $fillable = ['nom', 'description', 'image', 'categorie_id', 'marque_id', 'active', 'stock'];

    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    public function marque()
    {
        return $this->belongsTo(Marque::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class)->orderBy('ordre');
    }
}
