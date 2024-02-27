<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;
    public $timestamps = false;
    
    
    protected $fillable = ['name', 'stadium','numMembers','budget'];

            //relationship OneToMany between Team and Player
            public function players() {
                //return $this->hasMany('App\Note');
                return $this->hasMany(Player::class);        
            }
}
