<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Duel extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_wins', 'second_wins'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    protected $table = 'duels';

    public $timestamps = false;
}
