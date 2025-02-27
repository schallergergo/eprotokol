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

     public function eventing_cross(){



        return $this->hasOne(EventingCross::class);

    }

     public function eventing_show_jumping(){



        return $this->hasOne(EventingShowJumping::class);

    }

     public function eventing(){



        return $this->hasOne(Eventing::class);

    }






public static function boot()

    {

        parent::boot();



        static::created(function (Start $start) {

            $competition = $start->event->competition;

            StartFee::create([

                "start_id"=>$start->id,

                "competition_id"=>$competition->id,

                "amount" =>$start->event->start_fee,



            ]);

            if ($competition->eventing) {
                Eventing::create([ "start_id"=>$start->id,"rank"=>$start->rank]);
                EventingCross::create([ "start_id"=>$start->id]);
                EventingShowJumping::create([ "start_id"=>$start->id]);
            }





        });



        static::deleting(function (Start $start) {

            $start_fee = $start->start_fee;

            if ($start_fee == null) return ;

            $start->start_fee->delete();

        });

    }







}

