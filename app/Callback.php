<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Callback extends Model
{
    protected $table = 'callbacks';
    
    protected $fillable = [
        'name', 'phone'
    ];
}
