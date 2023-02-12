<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Official extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $guarded =[];
    
    public function event(){
        return $this->belongsTo(Event::class);
   }
       public function penciler(){
        return $this->belongsTo(User::class,'penciler','id');
    }
    public function user(){
        return $this->belongsTo(User::class,'penciler','id');
    }
}
