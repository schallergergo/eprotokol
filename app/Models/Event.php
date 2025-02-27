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

    public function eventing_info(){
        return $this->hasOne(EventingExtraInfo::class);
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

   public function isLonge(){
    for ($i=34; $i<38; $i++){
        if ($this->program_id == $i ) return true;
        }
    return false;
   }


   public static function boot()

    {

        parent::boot();



        static::created(function (Event $event) {

            $competition = $event->competition;

           

            if ($competition->eventing) {
                EventingExtraInfo::create([ "event_id"=>$event->id]);
            }





        });



        static::deleting(function (Event $event) {

            $eventing_info = $event->eventing_info;

            if ($eventing_info == null) return ;

            $eventing_info->delete();

        });

    }



}
