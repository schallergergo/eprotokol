<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $guarded =[];

    public function competition(){

        return $this->belongsTo(Competition::class);
        
    }

     public function start_fee(){

        return $this->hasMany(StartFee::class);
        
    }

    public function box_fee(){

        return $this->hasMany(BoxFee::class);
        
    }
}
