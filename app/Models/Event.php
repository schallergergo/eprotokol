<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $guarded =[];

    public function start(){
        return $this->hasMany(Start::class);
   }

   public function program(){
        return $this->belongsTo(Program::class);
   }

   public function competition(){
      return $this->belongsTo(Competition::class);
   }

   public function official(){
        return $this->hasMany(Official::class);
   }
   public function sponsor(){
      return $this->belongsTo(Sponsor::class);
   }
}
