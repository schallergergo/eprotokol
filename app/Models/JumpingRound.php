<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JumpingRound extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded =[];


    public function start(){
        return $this->belongsTo(Start::class);
    }
}
