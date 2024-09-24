<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;
    protected $guarded =[];


    public function championship(){
        
        return $this->belongsTo(Championship::class);
    }

    public function team_member(){
        
        return $this->hasMany(TeamMember::class);
    }

}
