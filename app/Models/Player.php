<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;
    public $timestamps = false; 

//fields fillable with mass create method.

    protected $fillable = ['name', 'position','salary'];

//relationship ManyToOne between Team and Player
    public function team()
     {(Team::class);
            }  
}
