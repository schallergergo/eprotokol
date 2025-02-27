<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventingShowJumping extends Model
{
    use HasFactory;
    protected $guarded =[];

    public function start(){
        return $this->belongsTo(Start::class);
   }
}
