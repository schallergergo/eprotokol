<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;



class Competition extends Model

{

    use HasFactory;

    protected $guarded =[];



    public function event(){

        return $this->hasMany(Event::class);

    }
    public function tournament(){

        return $this->belongsTo(Tournament::class);

    }





    public function transaction(){



        return $this->hasMany(Transaction::class);

        

    }



    public function box_fee(){



        return $this->hasMany(BoxFee::class);

        

    }

}

