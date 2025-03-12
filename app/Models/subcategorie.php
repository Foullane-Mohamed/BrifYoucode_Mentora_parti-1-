<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subcategorie extends Model
{
    /** @use HasFactory<\Database\Factories\SubcategorieFactory> */
    use HasFactory;
    protected $fillable = ['name','slug','description','category_id'];

    public function category(){
        return $this->belongsTo(category::class);
    }
    public function tags(){
        return $this->belongsToMany(Tag::class);
    }
}
