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
   public function user(){
        return $this->belongsTo(User::class,'rider_id','username');
    }

    public function jumping_round(){

        return $this->hasMany(JumpingRound::class);
    }
     public function style(){

        return $this->hasMany(Style::class);
    }

    public function start_fee(){

        return $this->hasOne(StartFee::class);
    }


public static function boot()
    {
        parent::boot();

        static::created(function (Start $start) {
            StartFee::create([
                "start_id"=>$start->id,
                "competition_id"=>$start->event->competition->id,
                "amount" =>$start->event->start_fee,

            ]);
        });

        static::deleting(function (Start $start) {
            $start_fee = $start->start_fee;
            if ($start_fee == null) return ;
            $start->start_fee->delete();
        });
    }



}
