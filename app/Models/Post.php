<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model{

    use HasFactory;

    protected $table='posts';

    public function comments(){
        return $this->hasMany('\App\Models\Comment')->orderBy('id','desc');
    }
    
    public function likes(){
        return $this->hasMany('\App\Models\Like');
    }

    public function user(){
        return $this->belongsTo('\App\Models\User', 'user_id');
    }

    public function passos(){
        return $this->hasMany('\App\Models\Pas');
    }
    
}