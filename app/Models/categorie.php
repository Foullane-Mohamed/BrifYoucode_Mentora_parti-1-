<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class categorie extends Model
{
    /** @use HasFactory<\Database\Factories\CategorieFactory> */
    use HasFactory;
    protected $fillable = ['name','slug','description'];
    public function subcategorie(){
        return $this->hasMany(subcategorie::class);
    }

}
