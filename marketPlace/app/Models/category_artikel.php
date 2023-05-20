<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category_artikel extends Model
{
    use HasFactory;

    public function artikels(){
        return $this->hasMany(artikel::class);
    }
}
