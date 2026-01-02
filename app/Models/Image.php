<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['chemin', 'ordre', 'produit_id'];

    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }
}
