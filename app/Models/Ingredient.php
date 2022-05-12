<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model{
    
    use HasFactory;
    
    protected $table='ingredients';

    public function post(){
        return $this->belongsTo('\App\Models\Post', 'post_id');
    }
}