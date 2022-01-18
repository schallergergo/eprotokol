<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\SoftDeletes;
class Start extends Model
{   use SoftDeletes;
    use HasFactory;
    protected $guarded =[];
    public $incrementing=false;
    public function event(){
        return $this->belongsTo(Event::class);
   }
   
   public function result(){
        return $this->hasMany(Result::class);
   }
}
