<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subs extends Model
{
    protected $table = 'subs';

    protected $fillable = [
        'email'
    ];
}
