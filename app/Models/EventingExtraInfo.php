<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventingExtraInfo extends Model
{
    use HasFactory;
    protected $guarded =[];

    public function event(){
        return $this->belongsTo(Event::class);
    }
}
