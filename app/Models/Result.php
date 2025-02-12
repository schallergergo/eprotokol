<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Result extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded =[];
     public function event(){
        return $this->belongsTo(Event::class);
        
   }

    public function start(){
        return $this->belongsTo(Start::class);
    }
    
    public function resultlog(){
        return $this->hasMany(Resultlog::class);
    }

    public function resultphoto(){
        return $this->hasMany(ResultPhoto::class);
    }
}
