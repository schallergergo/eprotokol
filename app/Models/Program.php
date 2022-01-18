<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;
   protected $guarded =[];

    public function block(){
        return $this->hasMany(Block::class);
    }

    public function event(){
        return $this->hasMany(Event::class);
    }
    
}
